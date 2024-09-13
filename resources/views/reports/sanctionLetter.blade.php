New! Keyboard shortcuts … Drive keyboard shortcuts have been updated to give you first-letters navigation
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$fileName}}</title>
    <head>
    <style>
    @page { margin: 30px 75px; }
    @font-face {
        font-family: "hindi";
        src: url('hindi.ttf');
    }
    .body:first-child { font: normal 12px/20px hindi; }
    table { font-family: hindi; border-collapse: collapse;width: 100%; }
    td, th { border: 1px solid black;text-align: center;padding: 0px; }
    .head { margin-bottom: 20px; }
    .left { text-align: left;padding-left: 10px; }
    .header-table { width:70%;padding:8px; }
    .header-table table{
        margin-top: 40px;
    }
    .header-ends {
        width:15%;
        border:1.5px solid;
        padding:8px;
    }
    .header-ends:last-of-type{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .blocks {
        display: flex;
        margin-top:8%;
        margin-left:5%;
    }
    .cell {
        border:1.5px solid black;
        height:15px;
        width:15px;
    }
    tr td:nth-child(even){
        width:10%
    }
    tr td:nth-child(odd){
        border:0px
    }
    /* .info-container { display: flex; } */
    .row {
        margin-top: 15px;
        display: flex;
        width:100%
    }
    .row:nth-child(even){
        margin-top: 40px;
    }
    .box {
        height:350px;
        width:40%;
        border: 1px solid;
    }
    .box:nth-child(even){
        margin-left: 4%;
    }
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
                            <tr>
                                <td> बीमा </td>
                                <td></td>
                                <td> नहीं </td>
                                <td></td>
                                <td> पुनर्भुगतान आवृति % साप्ताहिक </td>
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
                            घर का पता
                            वर्षों की संख्या
                        </td>
                        <td>
                            व्यवसाय का पता
                            वर्षों की संख्या
                        </td>
                    </tr>
                    <tr>
                        <td>
                            व्यवसाय की प्रकृति
                            वर्षों की संख्या
                        </td>
                        <td>
                            लोन लेने का उद्देश्य
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="page2">
            <div class="" >
                <div class="">
                    <table>
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
                    <div class="Opera" >
                        <div>
                            आय जानकारी ( जांच की गई ):
                        </div>
                        <div>
                            बी.एम. हस्ताक्षर .................
                        </div>
                    </div>
                </div>
            </div>
            <table class="" >
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
            <div>
                <p> <b> घोषड़ा : </b> मैं पुष्टि करता/करती हूँ की:- </p>
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
                        <p>  </p>
                    </li>
                    <li>
                        <p>  </p>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <table >
        <tbody>

            <tr>
                <td colspan="3"> <h3> LOAN ID:  {{$loanID}} </h3> </td>
            </tr>

        </tbody>

    </table>
    <strong><em>This is computer Generated Receipt:</em></strong>

</body>
</html>
