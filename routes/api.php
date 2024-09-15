<?php

use App\Http\Controllers\Api\{AuthController,PageController};
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Route};

Route::get('/', function () {
   phpinfo();
});

Route::get('/user', function (Request $request) {
    return [
        'request_user' => $request->user(),
        'auth_user' => Auth::user(),
        'auth_user_facade' => auth()->user()
    ];
})->middleware('auth:sanctum');

Route::controller(AuthController::class)
    ->group(function () {
    Route::post('/login',  'login' );
    Route::post('/update-profile', 'updateProfile' );
    Route::post('/register', 'register');
});

Route::get('/get-companies', [ PageController::class, 'getCompanies' ]);

Route::middleware('auth:sanctum')
->controller(PageController::class)
->group(function(){

    Route::post('/set-company', function(Request $req){
        if(auth()->user()->login_id) {
            $user = Employee::whereId(auth()->user()->id);
            $user->update(['cID' => $req->id]);
            return auth()->user();
        } else {
            User::whereId( auth()->user()->id )->update([
                'cID'   => $req->id,
                'cName' => $req->name
            ]);
        }
        return auth()->user();
    });

    Route::get('/permitted-menus', 'getMenus');
    Route::get('/get-collections', 'getCollections');

    Route::get('/users', 'getUsers');
    Route::get('/reports', 'getReports');
    Route::get('/documents','getDocs');
    Route::get('/designations','getDesignations');
    Route::get('/get-center', 'getCenters');
    Route::get('/get-state-codes','getStateCodes');
    Route::get('/list-permissions', 'permissionsList');

    Route::get('/collections/{type?}', 'getChartData');
    Route::get('/get-options/{only?}','getOptions');
    Route::get('/permissions/{userID?}', 'getPermissions');
    Route::get('/report-access/{employee_id}', 'getReportAccess');
    Route::get('/summary', 'getSummary');
    Route::get('/get-clients-for-appraisal/{id?}', 'getClientsForAppraisal'); // for `Admin` side
    Route::get('/get-review-clients', 'getReviewClients');
    Route::post('/add-enrollment', 'addEnrollment');
    Route::post('/add-client-cgt', 'updateClientCGT');
    Route::post('/convert-file', 'convertFile');
    Route::post('/get-enrollment-details/{id?}', 'getEnrollmentDetails');
	Route::post('/get-account-ledger', 'accountLedger');
    Route::post('/search-enrolled/{id?}/{docID?}', 'searchEnrolled');
    Route::post('/update-client-appraisal-status', 'updateClientAppraisalStatus');
    Route::post('/update-client-cgt-status', 'updateClientCgtStatus');
    Route::post('/upload-client-passbook', 'updateClientPassbook');
    Route::post('/act-on-passbook', 'actOnClientPassbook');

    Route::post('/update-permissions', 'updatePermissions');
    Route::post('/update-report-access', 'updateReportAccess');

    Route::post('/add-center', 'createCenter');
    Route::post('/get-arrear-clients', 'getArrearClients');
    Route::post('/get-GRT-clients', 'getGRTClients');
    Route::post('/update-client-details', 'updateClientGRT');

    Route::get('/get-disbursement-details/{id?}', 'getDisbursmentDetails');
    Route::post('/create-branch', 'createBranch');
    Route::post('/get-client-information', 'completeClientInfo');
    Route::get('/initiate-client-loan/{enroll_id}', 'generateLoanID');
    Route::get('/view-client-loan/{enroll_id}', 'viewLoanID');
    Route::post('/speed-loan-disburse', 'speedLoanDisburse');
    Route::post('/search-in-loan', 'searchInLoan');
    Route::post('/get-client-ledger', 'getClientLedger');

    Route::get('/get-branches/{branch_id?}','getBranches');
    Route::get('/get-branch-info/{branch_id?}','getBranchInfo');
    Route::get('/preview-document/{clientID}/{id}','previewDocument');
    Route::get('/print-passbook/{clientID}','printPassbook');
    Route::get('/test','test');
    Route::post('/add-sale-products', 'addCrossSaleProducts');

    Route::get('/get-account-heads','getAccountHeads');
    Route::post('/create-account-head', 'createAccountHead');
    Route::get('/get-accounts', 'getAccounts');
    Route::post('/create-account', 'createAccount');

    Route::get('/get-client-documents/{clientID}', 'getClientDocuments');
    Route::get('/get-loan-products/{id?}','getLoanProducts');
    Route::get('/get-product-details/{id}','getLoanProductDetails');
    Route::get('/loan-products-options','getLoanProductsOptions');
    Route::get('/get-loan-details/{loanId?}', 'getLoanDetails');
    Route::post('add-amount-on-loan-product','addAmountToLoanProduct');
    Route::post('/manage-product/{id?}','manageProduct');
    Route::post('/update-additional-enroll-information','updateAdditionEnrollmentInfo');
    Route::post('/put-sanction-letter', 'saveSanctionLetter');

    Route::get('/day-close/{branch_id}', 'dayClose');
    Route::get('/day-initialize/{branch_id}', 'dayInit');
    Route::get('/download-cds/{center_id}', 'downloadCDS');
    Route::get('/get-branch-collection/{branch_id?}','getBranchCollection');
    Route::get('/get-branch-centers/{branch_id?}','getBranchCenters');
    Route::get('/get-center-clients/{center_id?}','getCenterClients');
    Route::get('/get-branch-client-info/{branch_id?}','getBranchClientInformation');
    Route::get('/get-center-client-info/{center_id?}','getCenterClientInformation');
    Route::get('/get-center-loans/{center_id?}','getCenterLoans');
    Route::get('/get-center-working-days/{center_id?}','getCenterWorkingDay');

    Route::get('employees', 'getEmployees');
    Route::get('get-branch-employees/{branch_id}', 'getBranchEmployees');
    Route::get('get-employee/{id}', 'getEmployee');
    Route::post('add-employee', 'addEmployee');
    Route::post('update-employee/{id}', 'updateEmployee');

    Route::get('trial-balance', 'getTrailBalance');
    Route::post('add-voucher', 'addVoucher');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // should be in sanctum radar
});
