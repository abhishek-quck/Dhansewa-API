<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$fileName??''}}</title>
    <head>
    <style>
    body { margin: 20px 180px; }
    .d-flex{ display: flex;}
    .center {font-family: sans-serif;}
    .body:first-child { font: normal 12px/20px hindi; }
    table { font-family: hindi; border-collapse: collapse;width: 100%; }
    .header-table table td, th { border: 1px solid black;text-align: center;padding: 0px;height:40px }
    .head { margin-bottom: 20px; }
    .left { text-align: left;padding-left: 10px; }
    .header-table { width:70%;padding:8px; }
    .header-table table{ margin-top: 30px; }
    .header-ends { width:15%; border:1.5px solid; padding:8px; }
    .header-ends:last-of-type{display:flex;justify-content:center;align-items:center;}
    .blocks { display: flex; margin-top:8%; margin-left:5%; }
    .cell {border:1.5px solid black; height:15px; width:15px; }
    .header-table table tr td:nth-child(even){ width:10%;width:120px }
    .header-table table tr td:nth-child(odd){ border:0px }
    .box { height:auto;min-height:250px; width:50%; border: 1px solid; }
    .box:first-child .text-row {margin: 30px 40px}
    .row:nth-child(2) .box:nth-child(2) .text-row {margin:25px 40px}
    .row:first-child .box:nth-child(2) .text-row {margin:40px 60px}
    .row { margin-top: 5%; display: flex; width:100% }
    .row:nth-child(even){ margin-top: 40px; }
    .box:nth-child(even){ margin-left: 5%; }
    .text-row{display:flex;justify-content:space-between}
    .box-input {float:right;border-bottom:1px dashed;min-width:220px;max-width:300px;}
    .footer-table, .second-last-table, .Opera { margin-top:40px; }
    .footer-table td,.second-last-table td{ border:1px solid; }
    .footer-table tr:first-child{ height:90px; }
    .footer-table td span { width: 50%;margin-left:10px }
    .footer-table tr:last-child td {padding:6px}
    .footer-table:nth-child(2) td {padding:12px}
    .Opera {border:1px solid;width:35%;border-left:0px}
    .second-last-table {width:65%;}
    .second-last-table td {width:20%;padding: 14px;}
    .second-last-table:last-child {margin-bottom: 15px;}
    .header-table table tr:first-child td:nth-child(6) {width:50px!important}
    .table-last {margin-top:30px;border:1px solid}
    .table-last td{padding:15px}
    .item {height:50%;padding: 20px;}
    </style>
</head>
</head>
<body>
    <div class="head">
        <center class="center">
            <h1> DHANSEVA MICRO FOUNDATION </h1>
            E-162, 2nd Floor, Sector-63, Noida-201301
        </center>
    </div>
    <div class="body">
        <div class="page1">
            <div style="width:100%;height:150px;display:flex" >
                <div class="header-ends">
                    <div style="margin:4px;height:100%;width:100%">
                        <div class="blocks">
                            <div style="width:70%;">
                                नया केंद्र
                            </div>
                            <div class="cell"></div>
                        </div>
                        <div class="blocks">
                            <div style="width:70%;">
                                जोड़ा गया
                            </div>
                            <div class="cell"></div>
                        </div>
                        <div class="blocks">
                            <div style="width:70%;">
                                नवीनीकरण
                            </div>
                            <div class="cell"></div>
                        </div>
                    </div>
                </div>
                <div class="header-table">
                    <table>
                        <tbody>
                            <tr>
                                <td>ब्रांच</td>
                                <td></td>
                                <td>ऋण राशि</td>
                                <td></td>
                                <td>तिथि</td>
                                <td></td>
                            </tr>
                            <tr height="30">

                            </tr>
                            <tr>
                                <td> बीमा </td>
                                <td></td>
                                <td> नहीं </td>
                                <td></td>
                                <td> पुनर्भुगतान आवृति / <br> साप्ताहिक </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="header-ends">
                    फ़ोटो
                </div>
            </div>
            <div class="info-container">
                <div class="row">
                    <div class="box">
                        <div class="text-row">
                            <div class="label">नाम और आईडी</div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> सेंटर नं. </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> सेंटर मीटिंग का दिन </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> सेंटर का पता</div>
                            <div class="box-input"></div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="text-row">
                            <div class="label"> ऋण चक्र </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> ग्राहक आईडी </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> ऋण आईडी </div>
                            <div class="box-input"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="box">
                        <div class="text-row">
                            <div class="label"> उधारकर्ता नाम </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> पति / पिता का नाम </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> जन्म दिवस </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> आश्रितो की संख्या </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> मोबाइल </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> के.वाई.सी / यू आई डी / ड्राइविंग लाइसेंस / वोटर आईडी / अन्य</div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> आधार कार्ड नंबर </div>
                            <div class="box-input"></div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="text-row">
                            <div class="label"> सहउधारकर्ता नाम </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> पिता का नाम </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> जन्म दिवस </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> जाति: सामान्य/ एस.सी/ एस.टी/ ओबीसी </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> धर्म: हिंदू/ मुस्लिम/ सिख/ ईसाई/ अन्य </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> मोबाइल नं </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> के.वाई.सी / यू आई डी / ड्राइविंग लाइसेंस / वोटर आईडी / अन्य </div>
                            <div class="box-input"></div>
                        </div>
                        <div class="text-row">
                            <div class="label"> आधार कार्ड नंबर </div>
                            <div class="box-input"></div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="footer-table">
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <span> घर का पता <b>:</b> </span>
                                <span> वर्षों की संख्या <b>:</b> </span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <span> व्यवसाय का पता <b>:</b></span>
                                <span> वर्षों की संख्या <b>:</b> </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <span> व्यवसाय की प्रकृति <b>:</b></span>
                                <span> वर्षों की संख्या <b>:</b> </span>
                            </div>
                        </td>
                        <td>
                            <span> लोन लेने का उद्देश्य </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="page2">
            <div class="" >
                <div class="d-flex">
                    <table class="second-last-table">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    आय
                                </td>
                                <td colspan="2">
                                    खर्च
                                </td>
                            </tr>
                            <tr>
                                <td> स्वयं </td>
                                <td> </td>
                                <td> व्यवसाय खर्च </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td> पति / पिता </td>
                                <td></td>
                                <td> घर खर्च</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td> अन्य </td>
                                <td></td>
                                <td> ऋण किस्त </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td> कुल आय </td>
                                <td></td>
                                <td> कुल खर्च </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td> प्रयोछ आय </td>
                                <td></td>
                                <td> कुल संपत्ति की कीम</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="Opera">
                        <div class="item">
                            <b> आय जानकारी ( जांच की गई ):</b>
                        </div>
                        <div class="item">
                            <b> बी.एम. हस्ताक्षर .......................................... </b>
                        </div>
                    </div>
                </div>
            </div>
            <table class="footer-table" >
                <tbody>
                    <tr>
                        <td> क्रमांक </td>
                        <td> अन्य ऋण जानकारी </td>
                        <td> राशि </td>
                        <td> अवधि </td>
                        <td> बकाया कार्यकाल </td>
                        <td> बकाया राशि </td>
                        <td> चूक मे भुगतान </td>
                    </tr>
                    <tr>
                        <td> 1 </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td> 2 </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td> 3 </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                </tbody>
            </table>
            <div style="margin-top:20px">
                <p> <b> घोषड़ा :  मैं पुष्टि करता/करती हूँ की:- </b> </p>
                <ol>
                    <li>
                        <p> मेरी घरेलु वर्षिक आय 1,00,000 (ग्रामीण छेत्रो के लिए) / 1,60,000 (शहरी छेत्रो के लिए) से कम है | </p>
                    </li>
                    <li>
                        <p> मैं एक से अधिक श्रसल की सदस्य नहीं हूं,और 1 से अधिक माइक्रोफाइनेंस लोन नहीं लिया है| </p>
                    </li>
                    <li>
                        <p> लोन को मिला कर मेरा कुल बकाया लोन 1,00,000 से कम है (मेडिकल व शिक्षा अतिरिक्त)</p>
                    </li>
                    <li>
                        <p> मैं इस बात से अवगत हूं कि कंपनी मेरा फाइनेंशियल डेटा क्रेडिट ब्यूरोज से चेक कर सकती है</p>
                    </li>
                    <li>
                        <p> मैंने अपने / सह उधारकर्ता के खाते में पैसा ट्रांसफर (RTGS/NEFT) के लिए अपने और सह उधारकर्ता का के.वाई.सी प्रूफ और बैंक खाते की जानकारी दे दी गई है |</p>
                    </li>
                    <li>
                        <p> ब्याज दर आरबीआई के दिशानिर्देशो के अनुसार लगायी गयी है और प्रोसेसिंग फीस है |</p>
                    </li>
                </ol>
            </div>
            <table style="margin-top:30px">
                <tbody>
                    <tr>
                        <td> उधारकर्ता के हस्ताक्षर  .................................................. </td>
                        <td> सह उधारकर्ता के हस्ताक्षर ..................................................</td>
                    </tr>
                </tbody>
            </table>
            <table class="table-last">
                <tbody>
                    <tr>
                        <td> गृह निरीक्षण  .................................................. </td>
                        <td> ब्रांच से दूरी ..................................................</td>
                        <td> सेंटर से दूरी ..................................................</td>
                    </tr>
                    <tr>
                        <td colspan="2"> F.O के हस्ताक्षर ...............................................</td>
                        <td colspan="2"> ब्रांच मैनेजर के हस्ताक्षर..................................................</td>
                    </tr>
                    <tr>
                        <td colspan="2"> (नाम और आईडी) </td>
                        <td> (नाम और आईडी) </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <table >
        <tbody>

            <tr>
                <td colspan="3"> <h3> LOAN ID:  {{$loanID??''}} </h3> </td>
            </tr>

        </tbody>

    </table>
    <strong><em>This is computer Generated Receipt:</em></strong>

</body>
</html>
