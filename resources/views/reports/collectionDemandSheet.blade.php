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
    .table2 tbody td {
        padding: 6px 0 6px 2px;
    }
    .table2 tr:first-child {
        border-top: 0px!important;
    }

    </style>
</head>
</head>
<body>
    <div class="head">
        <center>
            <h1> DHANSEVA MICRO FOUNDATION </h1>
            E-162, 2nd Floor, Sector-63, Noida-201301
        </center>
    </div>
    <div class="body">
        <table class="table2">
            <tbody>
                <tr>
                    <td colspan="2">
                        <h2>
                            {{$center?->itsBranch->name ?? 'Benipur'}}
                        </h2>
                    </td>
                    <td colspan="2">
                        <h2>
                            {{$center->name?? "Sonki"}}
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td> CDS Date: NA  </td>
                    <td> Day: Wednesday  </td> <!--  CDS generated for day -->
                    <td> Time :9:00 AM  </td> <!--  CDS generated for the time -->
                    <td> Staff : {{ $center->staff ?? "BHOLA"}}  </td>
                </tr>
                <tr>
                    <td> L.C. :3  </td>
                    <td> Member :5  </td>
                    <td> T.Outstanding :99200  </td>
                    <td> NPA :0  </td>
                </tr>
                <tr>
                    <td> Branch ID :{{ $center->itsBranch->id ?? 3}}  </td>
                    <td> Center No. :{{ $center->id ?? 5 }}  </td>
                    <td> Receipt No : 99200  </td>
                    <td> Remarks :  </td>
                </tr>
                <tr>
                    <td colspan="4"> <h2> CENTER CDS </h2> </td>
                </tr>

            </tbody>

        </table>
        <table class="table2">
            <thead>
                <tr>
                    <th> <small> Loan No.</small> </th>
                    <th> <small> CLIENT NAME</small> </th>
                    <th> <small> MOBILE</small> </th>
                    <th> <small> LOAN AMT</small> </th>
                    <th> <small> DB DATE</small> </th>
                    <th> <small> CEMI/REMAIN</small> </th>
                    <th> <small> T.BALANCE</small> </th>
                    <th> <small> NPA </small> </th>
                    <th> <small> DUE AMOUNT </small> </th>
                    <th> <small> COLTD AMOUNT</small> </th>
                    <th> <small> SIGN </small> </th>
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
                    <td>  </td>
                    <td>  </td>
                </tr>
                <tr>
                    <td colspan="6"> TOTAL </td>
                    <td> 39205 </td>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="margin-top:20px!important">
        <strong ><em>This is computer Generated CDS audit is required:</em></strong>
    </div>

</body>
</html>
