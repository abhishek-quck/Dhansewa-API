<?php
namespace App\Http\Controllers\Api;

use DateTime;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdditionalEnrollment;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\LoanProductRequest;
use App\Http\Requests\VoucherRequest;
use App\Http\Resources\ClientLoanResource;
use App\Http\Resources\EnrollmentBaseResource;
use App\Http\Resources\EnrollmentResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\{Account, AccountHead,
    Branch,
    Center,
    ClientCGT,
    ClientDocument,
    ClientGRT,
    ClientLoan,
    Company,
    CreditAppraisal,
    Designation,
    District,
    Document,
    Employee,
    Enrollment,
    EnrollmentAdditional,
    Ledger,
    LoanDisbursement,
    LoanProduct,
    Permission,
    Sidebar,
    State,
    SidebarSubmenu,
    User,
    UserPermission,
    UserReportAccess,
    Voucher
};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public $cID;
    private $isGood = ['status'=> true, 'message'=>''];
    private $badResponse = ['status'=> false, 'message'=>'Something went wrong!'];
    public function __construct(){}
    public const BAD_REQUEST = 400;

    private function added($msg='Records added succesfully!')
    {
        $this->isGood['message']=$msg;
        return $this->isGood;
    }

    private function updated()
    {
        $this->isGood['message']='Records updated succesfully!';
        return $this->isGood;
    }

    private function withError( $msg='Something went wrong!', $code=500 )
    {
        $this->badResponse['message']=$msg;
        return response($this->badResponse, $code );
    }
    public function getCompanies()
    {
        return Company::get(['id','name']);
    }
    public function getMenus()
    {
        if(auth()->user()->id==9 || auth()->user()->emp_type )
        {
            return ['admin'=> true];
        }
        $user = User::whereId(auth()->user()->id)->with('menu')->first();
        return $user;
    }
    public function getUsers()
    {
        return User::all();
    }

    public function permissionsList()
    {
        return Permission::all();
    }
    public function updatePermissions(Request $request)
    {
        $payload = $request->all();
        $userID = $request->user_id;
        unset($payload['user_id']);
        $permission = UserPermission::where('user_id', $userID);
        if($permission->exists())
        {
            $permission->delete();
        }
        foreach($payload as $key => $value)
        {
            list( $permID, $column ) = explode('_',$key );
            $perm = UserPermission::where('user_id', $userID)->where('permission_id', $permID);
            if($perm->exists())
            {
                $perm->update([
                    $column => true
                ]);
            } else {
                UserPermission::create([
                    'user_id' => $userID,
                    'permission_id' => $permID,
                    $column => true
                ]);
            }
        }
        return $this->updated();
    }

    public function getPermissions($userID=null)
    {
        return UserPermission::where('user_id', $userID ?? auth()->user()->id )->get();
    }
    public function updateReportAccess(Request $req)
    {
        try {
            $employee = UserReportAccess::where('employee_id',$req->employee_id);
            $inputs = $req->all();
            unset($inputs['employee_id']);
            $insertData =[];
            foreach ($inputs as $key => $input) {
                if($input)
                {
                    $rec = DB::table('reports')->where('name','LIKE',"%$key%")->first('id');
                    $insertData[] = ['report_id' => $rec->id, 'employee_id' => $req->employee_id ];
                }
            }
            if($employee->exists())
            {
                $msg= 'Records updated successfully!';
                $employee->delete();
            }
            if(DB::table('user_report_access')->insert($insertData))
            {
                return $this->added($msg??'Records added successfully!');
            }

        } catch (\Throwable $e) {
            // throw $th;
            return $this->withError( $e->getMessage(), 500);
        }
        return $this->withError( code:PageController::BAD_REQUEST );
    }
    public function getReports()
    {
        return DB::table('reports')->get(['id','slug']);
    }
    public function getReportAccess($employee_id)
    {
        $empReports = DB::table('user_report_access')->where('employee_id',$employee_id)->pluck('report_id')->toArray();
        $allReports = $this->getReports();
        $output=[];
        foreach ($allReports as $report) {
            $output[$report->slug] = in_array($report->id, $empReports);
        }
        return ['codes'=> implode(',',$empReports), 'inputs'=> $output ];
    }
    public function getSummary( )
    {
        $output['centers'] = Center::where('company_id', Auth::user()->cID )->count();
        $output['loan_clients'] = DB::table('loan_disbursements as l')
        ->join('enrollments as e','e.id','l.enroll_id')
        ->where('e.company_id', Auth::user()->cID )
        ->count();
        return $output;
    }

    public function convertFile(Request $request) // todo pdf to jpeg
    {
        $pdf = base64_encode($request->doc->get());
        return generate('data:application/pdf,base64'.$pdf);
    }

    public function getChartData(Request $request,$type=null)
    {
        if($type==null) {
            return [
                'series' => [ 30, 70 ],
                'labels' => [ 'Disbursement', 'Collection' ]
            ];
        }
        if($type=='monthly-income')
        {
            $startMonth = (new DateTime())->modify('-11 month');
            $labels = [["Task", "Hours per Day"]];
            for ($i = 13; $i > 0; $i--) {
                $labels[] =[ $startMonth->format('M').'-'.$startMonth->format('y'), $i+1 ]; // Get the full month name
                $startMonth->modify('+1 month'); // Move to the next month
            }
            return [
                'labels' => $labels,//[ 'Disbursement', 'Collection' ],
            ];
        }
    }

    public function searchEnrolled(Request $request, $id = null)
    {
        $term = $request->term;
        $branch = $request->branch;
        $enroll = new Enrollment;
        $enroll = $enroll->where('company_id', Auth::user()->cID );

        if($id)
        {
            return EnrollmentResource::collection(Enrollment::whereId($id)->with( ['branch', 'documents'=> function($q){
                $q->whereIn('document_id', [5,6])->select('enroll_id', 'file_name', 'data');
            }])->get());
        }
        if( $request->process ) {  // this will always be filled in CGT section
            if( $branch ) {
                $enroll = $enroll->where('branch_id', $branch );
            }
            $process = $request->process;
            /*  pending -done
                cgt_entry - done
                cgt_revised - done
                approved - done
                reject - done
                forgery - done  */

            $status = [
                'approved' => 1,
                'reject'   => 2,
                'forgery'  => 3,
            ];

            if(in_array($process, ['approved','reject','forgery'])) {
                $stat = $status[$process];
                if($stat == 1) {
                    $enroll = $enroll->where('cgt_complete', true );
                }
                $enroll = $enroll->whereHas('cgt', function($q) use ($stat) {
                    $q->where('status', $stat )->select('id as cgt_id','enroll_id','revised');
                });
            }

            if( in_array($process, ['pending','cgt_entry','cgt_revised']) )
            {
                if( $process == 'pending' ) {
                    $enroll = $enroll->doesntHave('cgt');
                } else {
                    $enroll = $enroll->where(function($query) use ($process){
                        if($process=='cgt_revised') {
                            $query = $query->where('cgt_complete', false);
                        }
                        $query->whereHas('cgt', function($q) use ($process) {
                            $q->where('revised', $process =='cgt_revised');
                        });
                    });
                }
            }

            $enroll = $enroll->with([
                'cgt' => function($qu) {
                    $qu->select('id as cgt_id','enroll_id','revised');
                },
                'documents' => function($fn) {
                    $fn->whereIn('document_id', [5,6] )->select('enroll_id', 'data','document_id');
                }
            ]);

        } else { // for all other endpoints e.g enrollments
            if( $branch ) {
                $enroll = $enroll->where('branch_id', $branch );
            }
        }
        if($term) {
            $enroll = $enroll->where(function($q) use ($term)
            {
                $q->orWhere('applicant_name','like',"%$term%")
                ->orWhere('phone','like',"%$term%");
            });
        }

        return response()->json( $enroll->get(), 200 );
    }

    public function updateClientCgtStatus(Request $request)
    {
        // return $request->all();
        try {
            $record = ClientCGT::where('enroll_id', $request->enroll_id );
            if($record->exists())
            {
                $record->update([
                    'remarks'    => $request->remark,
                    'status'     => $request->status,
                    'updated_by' => auth()->user()->login_id? "emp_".auth()->user()->login_id: auth()->user()->id,
                ]);
            } else {
                throw new Exception('Upload CGT documents at first');
            }

            Enrollment::whereId($request->enroll_id)->update([
                'cgt_complete'  => $request->status == 1
            ]);

            return $this->added('Status updated successfully!');

        } catch (\Throwable $e ) {
            Log::info( 'Error in updating status: '.$e->getMessage() );
            return response()->json( $this->badResponse, 500 );
        }
    }
    public function previewDocument($client, $id)
    {
        $file = DB::table('client_documents')
        ->where('enroll_id', $client )
        ->where('document_id', $id )
        ->pluck('data');
        return response()->json($file);
    }

    public function addEnrollment(Request $req)
    {
        // DB::beginTransaction();
        try
        {
            DB::transaction(function () use ($req) {
            $enroll = Enrollment::create($data=[
                'branch_id'       => $req->branch_id ??'',
                'aadhaar'         => $req->aadhaar ??'',
                'applicant_name'  => $req->applicant_name ??'',
                'father_name'     => $req->father_name ??'',
                'verification_type'=> $req->verification_type ??'',
                'verification'    => $req->verification ??'',
                'relation'        => $req->relation ??'',
                'relative_name'   => $req->relative_name ??'',
                'gender'          => $req->gender ??'',
                'PAN'             => $req->PAN ??'',
                'postal_pin'      => $req->postal_pin ??'',
                'village'         => $req->village ??'',
                'district'        => $req->district ??'',
                'state'           => $req->state ??'',
                'date_of_birth'   => $req->date_of_birth ??'',
                'phone'           => $req->phone ??'',
                'group'           => $req->group ??'',
                'advance_details' => (bool)$req->advDetails ??'',
                'nominee_details' => (bool)$req->nomineeDetails ??'',
                'credit_report'   => (bool)$req->creditReport ??'',
                'company_id'      => Auth::user()->cID
            ]);

            if($enroll)
            {
                $addOns = [ 'enroll_id' => $enroll->id ];
                foreach($req->all() as $key => $input) {
                    if(!isset($data[$key]) && !in_array($key,['kyc','passbook'])) $addOns[$key] = $input;
                }
                foreach(['KYC'=> $req->kyc, 'Passbook'=> $req->passbook] as $key => $file ) {
                    if($file && $file!='null') {
                        $pre='';
                        $b64 = base64_encode($file->get());
                        switch($file->extension())
                        {
                            case 'jpg':case'jpeg':
                                $pre = 'data:image/jpeg,base64';
                                break;
                            case 'png':
                                $pre = 'data:image/png;base64,';
                                break;
                            case 'pdf':
                                $pre = 'data:application/pdf;base64,';
                                break;
                        }
                        ClientDocument::create([
                            'enroll_id' => $enroll->id,
                            'data'      => $pre.$b64,
                            'file_name' => $key.".".$file->extension()
                        ]);
                    }
                }

                if(EnrollmentAdditional::create($addOns)) {
                    $this->isGood['message']='Enrollment added successfully!';
                    return response()->json($this->isGood, 200);
                }
            }
            return response()->json($this->badResponse, 500 );
        });
        } catch( Exception $e ) {
            DB::rollback();
            $this->badResponse['message']=$e->getMessage();
            return response()->json($this->badResponse, 500 );
        }
    }

    public function createCenter(Request $req) {
        DB::beginTransaction();
        try {
            Center::create([
                'branch_id'      => $req->branch,
                'name'           => $req->center,
                'local_address'  => $req->localAddress,
                'district'       => $req->district,
                'staff'          => $req->staff,
                'meeting_days'   => $req->meetingDays,
                'meeting_time'   => $req->meetingTime,
                'formation_date' => $req->formationDate,
                'state'          => $req->state,
                'village'        => $req->village,
                'block'          => $req->block,
                'leader_name'    => $req->centerLeader,
                'leader_phone'   => $req->centerLeaderPhone,
                'associate_id'   => $req->advisor,
                'company_id'     => Auth::user()->cID,
            ]);

            $this->isGood['message']='Center successfully created!';
            return response()->json($this->isGood);

        } catch (\Throwable $th) {
            DB::rollback();
            $this->badResponse['message']=$th->getMessage();
            return response()->json($this->badResponse,500);
        }

    }

    public function getCenters(Request $req)
    {
        // return [['center_id'=>'001','center'=>'Lapata Ganj','a'=>'Kirchoff','lc'=>'LC','staff'=>'1901' ]];
        $table = DB::table('centers');
        if($req->search)
        {
            $table = $table->where('branch','like',"%$req->search%");
        }
        $records = $table->get([
            'center_id','center',
            DB::raw('select(\'dayName\') as dayName, select(\'LC\') as lc'), 'staff_id'
        ]);
        return $records;
    }

    public function accountLedger(Request $request)  // the ledger transation
    {
        return [
            [
                1,
                '003',
                date('d-m-Y'),
                'Journal',
                '20241101010026',
                'Collection Benipur',
                '29610',
                '0',
                '87257',
                'NO',
            ],
            [
                2,
                '014',
                date('d-m-Y'),
                'Journal',
                '20241101010027',
                'Collection Benipur',
                '29610',
                '0',
                '87257',
                'NO',
            ]
        ];
    }

    public function getArrearClients(Request $req)
    {
        return $req->all();
    }

    public function getEnrollmentDetails(Request $req,$id=null)
    {
        if($id)
        {
            // called as Eager loading, fetching all the related data defined as relationship in models
            return response()->json( Enrollment::with(['latestDocument','grt','otherInfo'])->find($id), 200 );
        }
        // return $req->all();
        $client= new Enrollment;
        if($req->branch)
        {
           $client = $client->where('branch_id',$req->branch);
        }
        if($req->center)
        {
           $client = $client->where('center_id',$req->center);
        }
        if($req->keyword)
        {
           $client = $client->where('applicant_name','LIKE',"%$req->keyword%");
        }
        $client = $client->without('latestDocument');
        return $client->get(['id','applicant_name as name']);

    }

    public function updateClientCGT( Request $request )
    {
        try {
            $docs = [];
            $docNames = [
                'first_day' => 'CGT_First',
                'second_day'=> 'CGT_Second'
            ];
            foreach ([
                    'first_day'  =>  $request->first_day,
                    'second_day' =>  $request->second_day
                ] as $name => $file
            ) {
                if($file)
                {
                    $prefix='';
                    switch($file->extension()) {
                        case 'jpg': case 'jpeg':
                            $prefix = 'data:image/jpeg;base64,';
                        break;
                        case 'png':
                            $prefix = 'data:image/png;base64,';
                        break;
                        case 'webp':
                            $prefix = 'data:image/webp;base64,';
                        break;
                    }
                    $docs[] = [
                        'document_id' => Document::where('name', $docNames[$name])->first('id')->id,
                        'enroll_id' => $request->enroll_id,
                        'data' => $prefix.base64_encode($file->get()),
                        'file_name' => strtoupper($name).".".$file->extension()
                    ];
                }
            }

            foreach( $docs as $doc ) {
                ClientDocument::create($doc); // as of now there's no chance to update whats already there so... only insert
            }

            $record = ClientCGT::where('enroll_id', $request->enroll_id );
            if($record->exists()) {
                $record->update(['revised' => true ]);
            } else {
                ClientCGT::create([
                    'enroll_id' => $request->enroll_id,
                    'revised'   => count($docs) == 2
                ]);
            }
            return $this->added('CGT uploaded!');

        } catch (\Throwable $th) {
            $this->badResponse['message'] = $th->getMessage();
            return response()->json($this->badResponse, 500 );
        }
    }
    public function getGRTClients(Request $req)  // client GRT home
    {
        $term = $req->name;
        if($req->branchID) {
            $enrollments = Enrollment::where('branch_id', $req->branchID);
        } else {
            $enrollments = new Enrollment;
        }
        if($term) {
            $enrollments->where(function($q) use ($term){
                $q->where('applicant_name','like',"%$term%")
                ->orWhere('aadhaar','like',"%$term%");
            });
        }

        return $enrollments->where('cgt_complete', true )->where('company_id', Auth::user()->cID )->doesntHave('grt')// The ones who haven't grt yet
        ->get([
            DB::raw('DATE_FORMAT(created_at, \'%d-%m-%Y\') as Date, applicant_name as Fullname,
            CONCAT(village, \'-\',district,\', \', state) as address, phone, "memID" as memberID, "SPEED_ENROLLMENT" as status, id, enrollments.*')
        ]);
    }

    public function updateClientGRT(Request $req)  // Client GRT-review
    {
        try
        {
           $prev = Enrollment::where('id', $req->id )
           ->update([
                'applicant_name' => $req->applicant_name,
                'aadhaar'        => $req->aadhaar,
                'verification_type'=> $req->verification_type,
                'verification'   => $req->verification,
                'center_id'      => $req->center,
                'district'       => $req->district,
            ]);

            $grt = [
                'enroll_id' => $req->id,
                'en_mode'   => 'SPEED_ENROLLMENT',
                'grt_date'  => now()
            ];

            foreach(['visit_photo' => $req->visit_photo, 'group_photo' => $req->group_photo ] as $name => $file )
            {
                if( $file == 'null') continue;
                $prefix='';
                switch($file->extension())
                {
                    case 'jpg': case 'jpeg':
                        $prefix = 'data:image/jpeg;base64,';
                    break;
                    case 'png':
                        $prefix = 'data:image/png;base64,';
                    break;
                    case 'webp':
                        $prefix = 'data:image/webp;base64,';
                    break;
                }
                $imageData = base64_encode($file->get());
                $grt[$name] = $prefix.$imageData;
            }
            $client = ClientGRT::where('enroll_id', $req->id );
            if($client->exists()) {
                $client->update($grt);
            } else {
                $client= ClientGRT::create($grt);
            }
            if( $prev && $req->document!= 'null')
            {
                $docName = Document::whereId($req->verification_type)
                    ->orWhere('name','like',"%$req->verification_type%")->first();
                if(blank($docName)) {
                    $docName = (object)['name' => $req->verification_type];
                }

                $fName = $req->applicant_name.'_'.$docName->name.".".$req->document->extension();
                $data = base64_encode($req->document->get());
                $pre='';
                switch ($req->document->extension()) {
                    case 'jpg':case 'jpeg':
                        $pre = 'data:image/jpeg;base64,';
                        break;
                    case 'pdf':
                        $pre = 'data:application/pdf;base64,';
                        break;
                    case 'png':
                        $pre = 'data:image/png;base64,';
                        break;
                }
                DB::table('client_documents')
                ->updateOrInsert(
                    [ 'file_name' => $fName, 'data' => $pre.$data, 'document_id'=> $docName->id ],
                    [ 'enroll_id' => $client->first()->enroll_id ]
                );
            }
            $this->isGood['message'] = 'Details successfully updated!';
            return response( $this->isGood, 200);

        } catch ( Exception $e )
        {
            Log::info($e->getMessage(),$e->getTrace());
            $this->badResponse['message'] = $e->getMessage();
            return response( $this->badResponse, 500);
        }
        // `nothing changed at all  ??`
    }

    public function createBranch(Request $req)  // Branches Master
    {
        // return response()->json($this->isGood, 200);
        try {
            Branch::create([
                'name' => $req->name,
                'address' => $req->address,
                'branch_manager_id' => $req->branch_manager_id,
                'gps_location' => $req->gps_location,
                'state_code' => $req->state_code,
                'branch_gst_num' => $req->branch_gst_num,
                'payout_month_and_year' => $req->payout_month_and_year,
                'setup_date' => $req->setup_date,
                'backdate_allowed' => (int)$req->backdate_allowed,
                'running_date' => $req->running_date,
                'dissolved_date' => $req->dissolved_date,
                'multi_loan_allowed' => (int)$req->multi_loan_allowed,
                'spml_allowed' => (int)$req->spml_allowed,
                'loan_product_id' => $req->loan_product_id,
                'bank_account' => $req->bank_account,
                'cash_account' => $req->cash_account,
                'branch_account' => $req->branch_account,
                'loan_charge_auto' => $req->loan_charge_auto,
                'cash_balance' => $req->cash_balance,
                'closing_enabled' => (int)$req->closing_enabled,
                'reporting_mail' => $req->reporting_mail,
                'aadhaar_verify' => (int)$req->aadhaar_verify,
                'reporting_phone_sms' => $req->reporting_phone_sms,
                'mobile_verify' => (int)$req->mobile_verify,
                'company_id' => auth()->user()->cID,
            ]);
            $this->isGood['message']='Branch successfully created!';
            return response()->json($this->isGood, 200);

        } catch (\Throwable $th) {

            $this->badResponse['message']=$th->getMessage();
            return response()->json($this->badResponse, 500);
        }

    }

    public function getBranches($id=null) // for select dropdowns only
    {
        if ($id) {
            return Branch::where('company_id', auth()->user()->cID)->whereId($id)
            ->first([
                'id','name',
                'company_id'
            ]);
        }
        return Branch::where('company_id', auth()->user()->cID)
        ->get([
            'id','name',
            'company_id'
        ]);
    }

    public function getBranchInfo($br_ID=null)  // for tabular-data
    {
        if($br_ID)
        {
            return Branch::whereId($br_ID)->where('company_id', auth()->user()->cID )->first();
        }
        return Branch::where('company_id', auth()->user()->cID )->get();
    }

    public function generateLoanID($encryptedId)
    {
        $previousLoans = ClientLoan::where('enroll_id', decrypt($encryptedId))->withTrashed(); // consider deleted loans too.

        $loanID = decrypt($encryptedId); // assigned is enroll_id
        if($previousLoans->exists())
        {
            // $previousLoans->delete();
            $prev = $previousLoans->orderBy('id', 'DESC')->first('loan_id')->loan_id;
            $hasLoan = LoanDisbursement::where('loan_id', $prev );
            if(!$hasLoan->exists())
            {
                $this->badResponse['message'] = 'Client already have registered a loan id and not paid yet!';
                return response()->json($this->badResponse );
            }
            list($enroll_id, $loan ) = explode('-', $prev);
            $loanID = "$enroll_id-".((int)$loan + 1);
        } else {
            $loanID = "$loanID-1";
        }
        $loan = ClientLoan::create([
            'enroll_id'  =>  decrypt($encryptedId),
            'loan_id'    =>  $loanID,
            'updated_by' =>  auth()->user()->login_id? "emp_".auth()->user()->login_id: auth()->user()->id,
        ]);

        $this->isGood['loan'] = $loan;
        return $this->added('Loan Id generated successfully');

    }

    public function viewLoanID($enroll_id)
    {
        return ClientLoanResource::collection(ClientLoan::where('enroll_id', $enroll_id)->withTrashed()->get());
    }
    public function speedLoanDisburse(Request $req)
    {
        try {
            if(LoanDisbursement::create([
                'enroll_id'         => $req->enroll_id,
                'loan_id'           => $req->loan_id,
                'loan_date'         => $req->loan_date,
                'loan_amount'       => $req->loan_amount,
                'loan_fee'          => $req->loan_fee,
                'insurance_fee'     => $req->insurance_fee,
                'gst'               => $req->gst,
                'loan_product_id'   => $req->loan_product,
                'funding_by'        => $req->funding_by,
                'policy'            => $req->policy,
                'utilization'       => $req->utilization,
                'first_installment' => $req->first_installment,
                'number_of_emis'    => $req->number_of_emis,
                'payment_mode'      => $req->payment_mode,
                'self_income'       => $req->self_income,
                'husband_income'    => $req->husband_income,
                'other_income'      => $req->other_income,
                'total_income'      => $req->total_income,
                'direct_income'     => $req->direct_income,
                'business_expense'  => $req->business_expense,
                'household_expense' => $req->household_expense,
                'loan_installment'  => $req->loan_installment,
                'total_expense'     => $req->total_expense
            ])){
                $this->isGood['message'] = 'Loan successfully disbursed!';
                return $this->isGood;
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            $this->badResponse['message']=$th->getMessage();
            return response()->json($this->badResponse,500);
        }
        return response()->json($this->badResponse, PageController::BAD_REQUEST );
    }

    public function generateLedgerReport(Request $req) // the populated table
    {
        return $req->all();
    }

    public function test(Request $req) // The eXCEL wala
    {
        return response()->download(public_path('aaa.txt'));
    }

    public function getClientLedger(Request $req) // while ledger generate from header
    {
        return Ledger::where('enroll_id', $req->client )->where('loan_id', $req->loan_id )->get();
    }

    // Filling the select inputs
    public function getOptions()
    {
        $output=[];

        $output['state'] = State::orderBy('name')->get('name')
            ->map(function($item){
                $item['label']=$item['value'] = $item['name'];
                unset($item['name']);
                return $item;
            });

        $output['district'] = District::orderBy('name')->get('name')
            ->map(function($item){
                $item['label']=$item['value'] = $item['name'];
                unset($item['name']);
                return $item;
            });
        $output['branches'] = Branch::orderBy('name')->where('company_id', Auth::user()->cID )->get([
            'id as value',
            'name as label'
        ]);
        $output['centers'] = Center::orderBy('name')->where('company_id', Auth::user()->cID )->get([
            'id as value',
            'name as label'
        ]);
        $output['clients'] = Enrollment::where('company_id', Auth::user()->cID )->get([
            'id as value',
            'applicant_name as label',
            'branch_id'
        ]);
        $output['documents'] = Document::all();

        return response()->json($output);

    }

    public function getStateCodes()
    {
        return DB::table('state_codes')
        ->get([
            'code as value',
            DB::raw('CONCAT(code,\': \',state) as label')
        ]);
    }

    public function getDocs()
    {
        $docs = DB::table('documents')->get();
        return $docs;
    }

    public function createAccountHead(Request $req)
    {
        try
        {
            if(
                AccountHead::create([
                    'name'=> $req->name,
                    'group_name'=> $req->group_name,
                    'type'=> $req->type,
                ])
            ) {
                $this->isGood['message'] = 'Head successfully created!';
                return response()->json($this->isGood ,200);
            }

        } catch (\Throwable $th) {
            //throw $th;
            $this->badResponse['message'] = $th->getMessage();
            return response($this->badResponse, 500);
        }
        return response( $this->badResponse, PageController::BAD_REQUEST );
    }

    public function createAccount(Request $request)
    {
        // return $request->all();
        if(Account::create([
            'name' => $request->name,
            'phone'  => $request->phone,
            'full_address' => $request->full_address,
            'ob_type'  => $request->ob_type,
            'ob_date'  => $request->ob_date,
            'ob_balance'  => $request->ob_balance,
            'ob_head'  => $request->ob_head,
            'ob_head_id'  => $request->head_id,
            'prefix'  => $request->prefix,
            'key_type' => $request->key_type
        ])) {
            return $this->added('Account created!');
        } else {
            return response()->json($this->badResponse, 500);
        }
    }

    public function getAccounts()
    {
        return Account::get(['id','name','ob_head_id', 'ob_head','key_type']);
    }

    public function getAccountHeads()
    {
        $accounts = AccountHead::get(['id','name','group_name','type']);
        return response()->json($accounts,200);
    }

    public function addLoanProduct(Request $request)
    {
        try {
            //$products = LoanProducts
            if(
                LoanProduct::create([
                    'name'          => $request->name,
                    'frequecy'      => $request->frequecy,
                    'flat'          => $request->flat,
                    'reducing'      => $request->reducing,
                    'installments'  => $request->installments,
                    'intro_date'    => $request->intro_date,
                    'removal_date'  => $request->removal_date,
                ])
            ) {
                return response()->json($this->isGood,200);
            }

        } catch (\Throwable $th) {
            $this->badResponse['message']=$th->getMessage();
            return response()->json($this->badResponse, 500);
        }
        return response()->json($this->badResponse, PageController::BAD_REQUEST);
    }

    public function getLoanProducts($id=null)
    {
        try {
            //$products = LoanProducts
            if($id)
            {
                return LoanProduct::find($id)->first();
            }
            return LoanProduct::all();

        } catch (\Throwable $th) {
            $this->badResponse['message']=$th->getMessage();
            return response()->json($this->badResponse, 500);
        }
    }

    public function getLoanProductsOptions() {
        return LoanProduct::get(['id as value','name as label']);
    }
    public function searchInLoan(Request $request,$id=null)
    {
        try
        {
            if($id===null) $id = $request->loan_id;
            return LoanDisbursement::where('loan_id', $id)->with('client')->get();
        } catch (\Throwable $th) {
            $this->badResponse['message']=$th->getMessage();
            return response()->json($this->badResponse, 500);
        }
    }

    public function addCrossSaleProducts(Request $request)
    {
        try
        {
            // return $request->all();
            foreach ($request->category as $row) {
                return $row; // temp coded
            }

        } catch (\Throwable $th) {
            $this->badResponse['message']=$th->getMessage();
            return response()->json($this->badResponse, 500);
        }
        return response()->json($this->badResponse, PageController::BAD_REQUEST);
    }
    // PrintDoc from profile menu
    public function completeClientInfo(Request $request)
    {
        $enrolled = Enrollment::whereId($request->client)->without('latestDocument')->get([
            'id','created_at','applicant_name as name','phone', DB::raw('CONCAT(village,\', \',district,\', \',state) as address')
        ]);
        $loanInfo = [
            [
                'prop_id' => '0001',
                'loan_id' => '1000',
                'disb_date' => '21-06-2024',
                'disb_amt' => '20000000',
                'paid_up' => '11',
                'current_emi' => '2500',
                'first_meeting_date' => '23/06/2022',
                'last_modified_date' => '09/09/2023',
                'p_out' => '0',
                'int_out' => '808',
            ]
        ];
        return ['targetInfo'=> $enrolled, 'loanInfo'=> $loanInfo];

    }

    public function printPassbook($clientID)
    {
        try {

            $record = 'testing';
            $enrollDetails = Enrollment::whereId($clientID)->with('branch')->first();
            $img = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path('favicon.png')));
            $view = view('reports.passbook', compact('record','img','enrollDetails'));
            $dompdf = generatePdf($view, null, false, true);
            return $dompdf->output();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getDisbursmentDetails($id)
    {
        return LoanDisbursement::where('enroll_id',$id)->with('client')->without('latestDocument')->first()??[];
    }

    public function updateAdditionEnrollmentInfo(AdditionalEnrollment $request)
    {
        DB::beginTransaction();
        try {
            // DB::transaction(function($request){
                if( $request->review )
                {
                //  Updating review column just for marking this as re-uploading the client-details after it was sent back
                    Enrollment::whereId($request->enroll_id)->update(['review' => true, 'sent_back' => false ]);
                }
                $record = EnrollmentAdditional::where('enroll_id',$request->enroll_id);
                if(!$record->exists()) {
                    try {
                        if(EnrollmentAdditional::create($request->validated())) {
                            return $this->added('Records added succesfully'); // expects application/json anyways
                        }
                    } catch (\Throwable $th) {
                        return $this->withError( $th->getMessage(), 500 ); // validation fails
                    }

                } else {
                    if( $record->update($request->validated())) // update
                    {
                        if( $request->kyc_doc!=='null' && $request->enroll_id )
                        { // enroll_id from `client_documents` here
                            $docName = Document::whereId($request->kyc_type)->pluck('name');
                            $fName = $request->applicant_name.'_'.$docName[0].".".$request->kyc_doc->extension();
                            $data = base64_encode($request->kyc_doc->get());
                            $pre='';
                            switch ($request->kyc_doc->extension()) {
                                case 'jpg':case 'jpeg':
                                    $pre = 'data:image/jpeg;base64,';
                                    break;
                                case 'pdf':
                                    $pre = 'data:application/pdf;base64,';
                                    break;
                                case 'png':
                                    $pre = 'data:image/png;base64,';
                                    break;
                            }
                            $clientDoc = ClientDocument::where('enroll_id', $request->enroll_id )
                            ->where('document_id', $request->kyc_type );

                            if($clientDoc->exists()) {
                                $clientDoc->update([
                                    'data' => $pre.$data
                                ]);
                            } else {
                                ClientDocument::create([
                                    'file_name'     => $fName,
                                    'data'          => $pre.$data,
                                    'document_id'   => $request->kyc_type ,
                                    'enroll_id'     => $request->enroll_id
                                ]);
                            }

                        }
                        return $this->updated();
                    }
                }
                return response( $this->badResponse, 400 ); // nothing changed

            // });
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info('error here', $th->getTrace());
            return $this->withError( $th->getMessage(), 500 );
        }
    }

    public function manageProduct(LoanProductRequest $request, $id=null)
    {
        try {

            if( $id==null || !LoanProduct::find($id)->exists()) {
                try {
                    if(LoanProduct::create($request->validated())) {
                        return $this->added('Records added succesfully'); // expects application/json
                    }
                } catch (\Throwable $th) {
                    return $this->withError( $th->getMessage(), 500 ); // validation fails
                }

            } else {
                if(LoanProduct::find($id)->update($request->validated())) // update attempt
                {
                    return $this->updated();
                }
            }
        } catch (\Throwable $th) {
            return $this->withError( $th->getMessage(), 500 );
        }
        return response( $this->badResponse, 400 );

    }

    public function getLoanProductDetails($id)
    {
        return LoanProduct::whereId($id)->first();
    }

    public function addAmountToLoanProduct(Request $request)
    {
        try {
            if(LoanProduct::where('id',$request->id)->update(['amount' => $request->amount]))
            {
                return $this->updated();
            }
        } catch (\Throwable $th) {
            return $this->withError( $th->getMessage(), 500 );
        }

        return response( $this->badResponse, 400 );
    }

    public function getBranchCollection($branchID)
    {
        $clients = Enrollment::where('branch_id', $branchID)->with([
            'loan' => function($q){
                $q->selectRaw('loan_amount as amount, enroll_id, id');
            }
        ])->get();
        $due_amount=0;
        foreach($clients as $row)
        {
            $due_amount += $row->loan->sum('amount');
        }
        $due_amount.=" ₹";
        return [(object)['total_client' => count($clients), 'due_amount'=> $due_amount ]];
    }
    public function getBranchCenters($id)
    {
        return Center::where('branch_id',$id)->get();
    }

    public function getCenterClients($id)
    {
        return Enrollment::where('center_id', $id )
        ->get(['id as value','applicant_name as label']);
    }

    public function getBranchClientInformation($id)
    {
        return EnrollmentBaseResource::collection(Enrollment::where('branch_id', $id )->get());;
    }
    public function getCenterClientInformation($id)
    {
        return EnrollmentBaseResource::collection(Enrollment::where('center_id', $id )->get());
    }

    public function getCenterLoans($id)
    {
        $enrolls = Enrollment::where('center_id', $id )->get(['id','applicant_name as name']);
        $names = [];
        foreach($enrolls as $row) {
            $names[$row->id] = $row->name;
        }
        $prevloans = LoanDisbursement::whereIn('enroll_id', $enrolls->pluck('id') )->pluck('loan_id');
        $output = [];
        $loans = ClientLoan::whereIn('enroll_id', $enrolls->pluck('id') )->whereNotIn('loan_id', $prevloans )->get();
        foreach( $loans as $row ){
            $output[] = [ 'value' => $row->loan_id, 'label' => $row->loan_id." ".$names[$row->enroll_id] ];
        }
        return $output;
    }
    public function getBranchEmployees( $branchID ) {
        return Employee::where('branch', $branchID)->get(['id as value',DB::raw('CONCAT(first_name, \' \', last_name) as label')]);
    }

    public function getCenterWorkingDay($id)
    {
        return Center::whereId($id)->first('meeting_days');
    }
    public function dayInit($branchID)
    {
        return [ 'todo day-init for '.$branchID ];
    }
    public function dayClose($branchID)
    {
        $today = strtolower(now()->format('l'));
        // first of all get the `ids` of clients of the branch
        $clients = Enrollment::where('branch_id', $branchID )->where('center_id', '<>', null )->pluck('id');
        // Check them for latest loan-id they generated in loan_clients
        $loanIDs = ClientLoan::whereIn('enroll_id', $clients->toArray())->pluck('loan_id');
        // Pull up all the loan's information
        $loans = LoanDisbursement::whereIn('loan_id', $loanIDs->toArray() )->with(['client' => function($q){
            $q->select('id', 'center_id');
        }])->get();
        foreach ($loans as $loan ) {
            // Log::info('with client: ', $loan->client->toArray());
            // Everything starts when today is the meeting day of center.
            if( $today == Center::whereId( $loan->client->center_id )->first('meeting_days')?->meeting_days )
            {
                if( !$loan->completed ) {

                    $loanProduct = LoanProduct::whereId( $loan->loan_product_id )->first();
                    $chargeToday = round((float) $loanProduct->amount / $loanProduct->installments, 2 );
                    $lastTransaction = Ledger::where('loan_id', $loan->loan_id );

                    $emiNum = 1;
                    $wasToday = false;

                    if($lastTransaction->exists()) {
                        $emiNum   = $lastTransaction->count() + 1;
                        $wasToday = $lastTransaction->orderBy('created_at', 'desc')->first();
                        $wasToday = now()->format('d') == date('d', strtotime($wasToday->created_at));
                    }

                    if(!$wasToday ) {

                        Ledger::create([
                            'enroll_id'         => $loan->enroll_id,
                            'loan_id'           => $loan->loan_id,
                            'emi_no'            => $emiNum,
                            'transaction_date'  => now(),
                            'pr_due'            => 0,
                            'int_due'           => 0,
                            'total_due'         => $chargeToday,
                            'pr_collected'      => 0,
                            'int_collected'     => 0,
                            'total_collected'   => $chargeToday,
                        ]);
                        $loan->update([ 'completed' => $emiNum == $loanProduct->installments ]);

                    } else {
                        return $this->withError('Day already closed!', PageController::BAD_REQUEST);
                    }
                }

            }
        }
        return $this->added('Day close process completed!');

    }

    public function getDesignations()
    {
        return Designation::get(['name','abbr']);
    }

    public function addEmployee(EmployeeRequest $request) {
        // return $request->all();
        try {
            if(Employee::create($request->validated()))
            {
                return $this->added();
            }
        } catch (\Throwable $e) {
            //throw $th;
            return $this->withError( $e->getMessage(), 500);
        }
        return $this->withError(code:PageController::BAD_REQUEST);
    }

    public function updateEmployee(Request $request) {
        // return $request->all();
        $record = Employee::whereId($request->id);
        if($record->exists())
        {
            $record->update([
                'emp_type' => $request->emp_type??'',
                'designation' => $request->designation??'',
                'first_name' => $request->first_name??'',
                'last_name' => $request->last_name??'',
                'phone' => $request->phone??'',
                'branch' => $request->branch??'',
                'access_branch' => $request->access_branch??'',
                'address' => $request->address??'',
                'login_id' => $request->login_id??'',
                'married' => $request->married??'',
                'gender' => $request->gender??'',
                'motorization' => $request->motorization??'',
                'dashboard' => $request->dashboard??'',
                'approval_limit' => $request->approval_limit??'',
                'dob' => $request->dob??'',
                'app_login' => $request->app_login??'',
                'exit_date' => $request->exit_date??'',
                'join_date' => $request->join_date??'',
                'email' => $request->email??'',
                'pan' => $request->pan??'',
                'aadhaar' => $request->aadhaar??'',
                'bank' => $request->bank??'',
                'bank_branch' => $request->bank_branch??'',
            ]);
            if($request->password){
                $record->update(['password'=> Hash::make($request->password)]);
            }
            return $this->updated();
        }
        return $this->withError(code:PageController::BAD_REQUEST);
    }

    public function getEmployees() {
        return Employee::all();
    }

    public function getEmployee($id) {
        return Employee::whereId($id)->first();
    }

    public function getAppraisalClients() { // Under `Enrollment` > `Credit Appraisals`

        // return DB::table('enrollments')->join('credit_appraisals ca','ca.enroll_id','e.id')->get();
        return Enrollment::where('approved', false )->where('sent_back', false )->get();
        /*
           sent back true tab hoga jab admin|AM|BM usko re-upload k liye waps krega instead of approve/reject
           approve k case me enrollments table me approved ko true mark kr dia jaega
           reject k case me entry delete krna hai ya nhi confirm nhi hua hai
        */
    }

    public function getClientsForAppraisal($id=null) // under `Manage Client`
    {
        if( $id ) {
            return EnrollmentResource::collection(Enrollment::whereId($id)->with(['branch','otherInfo','documents'=>function($q){
                $q->whereNotIn('document_id', [5,6,7])->select('enroll_id','file_name', 'data');
            }])->get());
        }
        return DB::table('enrollments as e')->join('branches','branches.id', 'e.branch_id')
        ->whereNotIn('e.id', DB::table('credit_appraisals')->pluck('enroll_id')->toArray()) // jinka check pahle nhi hua hai
        ->where('approved', false )
        ->orWhere('review', true ) // marks as `correction completed`
        ->get(['e.id','branches.name as branch_name','applicant_name' ]);

    }

    public function getReviewClients() // Under `Update CIS`
    {
        return Enrollment::where('sent_back', true )->whereHas('appraisal')->with('appraisal')->get();
    }
    public function updateClientAppraisalStatus( Request $request ) {

        try {
            $record = CreditAppraisal::where('enroll_id', $request->enroll_id );
            if($record->exists()) {
                $record->update([
                    'remarks' => $request->remark,
                    'status'  => $request->status
                ]);
            } else {
                CreditAppraisal::create([
                    'enroll_id'  => $request->enroll_id,
                    'status'     => $request->status,
                    'remarks'    => $request->remark,
                    'updated_by' => auth()->user()->id
                ]);
            }

            Enrollment::whereId($request->enroll_id)->update([
                'sent_back' => $request->status == 2,
                'approved'  => $request->status == 1
            ]);

            if( $request->status == 1 ) // generate loan_id as soon as credit is approved
            {
                $data = $this->generateLoanID( encrypt($request->enroll_id) );
                Log::info(json_encode($data));
                $loanID = $data['loan']->loan_id;
                $fileName = date('d_m_Y').'_Sanction_Letter.pdf';
                $view = view('reports.sanctionLetter', compact('loanID', 'fileName'));
                $dompdf = generatePdf($view, null, false, true);
                $content = $dompdf->output();
                $pdf = 'data:application/pdf;base64,'.base64_encode($content);
                $document = ClientDocument::create([
                    'enroll_id' => $request->enroll_id,
                    'document_id' => Document::where('name','like', '%sanction%')->first('id')->id,
                    'data'      => $pdf,
                    'file_name' => $fileName
                ]);
                $this->isGood['sanction_letter'] = $document;
            }
            return $this->added('Status updated successfully!');

        } catch (\Throwable $e ) {
            Log::info( 'Error in updating status: '.$e->getMessage() );
            return response()->json( $this->badResponse, 500 );
        }

    }

    public function getCollections()
    {
        $branches = Branch::where('company_id', auth()->user()->cID )->withCount(['centers','clients' => function($query){
            $query->where('center_id', '<>', null);
        }])->get();

        $clients = DB::table('loan_disbursements as ld')
            ->join('enrollments as en','en.id','ld.enroll_id')
            ->join('centers as c','en.center_id','c.id')
            ->join('loan_products as lp','lp.id','ld.loan_product_id')
            ->where('en.center_id', '<>', null )
            ->where('en.company_id', auth()->user()->cID )
            ->where('c.meeting_days', strtolower(now()->format('l')))
            ->get([
                'en.branch_id','enroll_id',
                DB::raw('lp.amount / installments as emi_amount')
            ]);

        $finalAmount = [];
        if($clients)
        {
            foreach( $clients as $client ) {
                if( isset($finalAmount["BR_$client->branch_id"]) ) {
                    $finalAmount["BR_$client->branch_id"] += $client->emi_amount;
                } else {
                    $finalAmount["BR_$client->branch_id"] = $client->emi_amount ;
                }
            }
        }

        foreach($branches as $branch) {
            if( isset($finalAmount["BR_$branch->id"])) {
                $branch->dues = round($finalAmount["BR_$branch->id"], 2)." ₹";
            } else {
                $branch->dues = "0 ₹";
            }
        }

        $loanProducts = $clients->pluck('loan_product_id')->unique()->toArray();
        $c = $clients->pluck('center_id')->unique()->toArray();

        Log::info(json_encode([
            'today' => now()->format('l'),
            'centers'=> implode(', ',$c),
            'clients'=> $clients,
            'total_clients'=> $clients->count(),
            'loanProducts' => implode(',', $loanProducts)
        ]), $finalAmount );

        return $branches;

    }

    public function downloadCDS($centerID) // during center collection view
    {
        $center = Center::whereId($centerID)->with('itsBranch')->first();
        //Log::info(json_encode($center->toArray()));
        $view = view('reports.collectionDemandSheet', compact('center'));
        $dompdf = generatePdf($view, null, false, true);
        return $dompdf->output();
    }

    public function getClientDocuments($clientID) {

        return ClientDocument::where('enroll_id', $clientID )
        ->with(['client' => function($q) {
            $q->select('applicant_name as name','id');
        }])->get();

    }

    public function getTrailBalance() {
        return DB::table('vouchers as v')
        ->join('accounts as a','a.id', 'v.account')
        ->join('account_heads as ah','ah.id', 'a.ob_head_id')
        ->get(['v.id','group_name','amount','ah.name as head_name','a.name as account_name', 'v.amount as cr_amount' ]);
    }

    public function addVoucher (VoucherRequest $request)
    {
        // return $request->all();
        try {
            if(Voucher::create($request->validated()))
            {
                return $this->added('Transaction successfully added!');
            }
            return response()->json($this->badResponse, PageController::BAD_REQUEST);

        } catch (\Throwable $e ) { // validation gonna throw exception
            Log::info('Failed Voucher:- ', [ $e->getMessage(), 'trace'=> $e->getTrace() ]);
            return $this->withError( 'Failed to add the transaction!', 500);
        }

    }

}
