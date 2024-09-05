<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <head>
    <style>
    @page { margin: 30px 75px; }

    body { font-family: 'IBM Plex Sans', sans-serif; }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid black;
        text-align: center;
        padding: 0px;
    }
    .head {
        margin-bottom: 20px;
    }
    .left {
        text-align: left;
        padding-left: 10px;
    }
    .table2 tbody td {
        padding: 6px 0 6px 2px;
    }
    .table2 tr:first-child {
        border-top: 0px!important;
    }
    .tfoot {
        text-align: right;
        padding-right: 10px;
    }
    </style>
</head>
</head>
<body>
    <div class="head">
        <center>
            <h1> DHANSEVA MICRO FOUNDATION </h1>
        </center>
    </div>
    <div class="body">
        <table >
            <tbody>
                <tr>
                    <td colspan="3">
                        <h3>
                            {{"$enrollDetails->village, $enrollDetails->district, $enrollDetails->state, $enrollDetails->postal_pin"}}
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td> <h3 class="left"> GST/CIN: NA </h3> </td>
                    <td> <h3> {{ $enrollDetails->branch->name }}</h3> </td>
                    <td> <h3 class="left"> Phone: {{$enrollDetails->phone}}</h3> </td>
                </tr>
                <tr>
                    <td colspan="3"> <h3> LOAN PASSBOOK </h3> </td>
                </tr>
                <tr>
                    <td style="width:30%;" class="left">
                        <div>
                            <p> Loan ID: Something Only We Know </p>
                            <p> Client Name: {{ $enrollDetails->applicant_name }} </p>
                            <p> Address: Somewhere Only We Know </p>
                            <p> Center Name: Something Only We Know </p>
                        </div>
                    </td>
                    <td style="width:30%" class="left">
                        <div>
                            <p> Loan Cycle: '' </p>
                            <p> Loan Amount Disbursed: '' </p>
                            <p> Disbursement Date: '' </p>
                            <p> Center ID: '' </p>
                            <p> Client Phone: '' </p>
                        </div>
                    </td>
                    <td style="width:20%">
                        <div>
                            <p> Image Here </p>
                        </div>
                    </td>
                </tr>
            </tbody>

        </table>
        <table class="table2">
            <thead>
                <tr>
                    <th> <p>EMI</p> </th>
                    <th> <p>Date</p> </th>
                    <th> <p>INSTALLMENT</p> </th>
                    <th> <p>PRIN</p> </th>
                    <th> <p>INT</p> </th>
                    <th> <p>OTH</p> </th>
                    <th> <p>BALANCE</p> </th>
                    <th> <p>STAF SIGN.</p> </th>
                    <th> <p>C SIGN.</p> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> 1 </td>
                    <td> 15/09/2022 </td>
                    <td> 1450 </td>
                    <td> 795 </td>
                    <td> 655 </td>
                    <td> 0 </td>
                    <td> 39205 </td>
                    <td>  </td>
                    <td>  </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="position:relative;">
                        <img src="{{$img}}">
                        <b style="position:absolute;left:70px;top:70px">barCODE HerE</b>
                    </td>
                    <td colspan="2" class="tfoot">
                        DHANSEVA MICRO <br>
                        FOUNDATION:<br>
                        <small> Client Sign </small>
                    </td>
                    <td colspan="2" class="tfoot">
                        DHANSEVA MICRO <br>
                        FOUNDATION:<br>
                        <small> C.M Sign </small>
                    </td>
                    <td colspan="2" class="tfoot">
                        DHANSEVA MICRO <br>
                        FOUNDATION:<br>
                        <small> Authorised Signatory </small>
                    </td>
                </tr>
            </tfoot>
        </table>
        <strong><em>This is computer Generated Receipt:</em></strong>
    </div>

</body>
</html>
