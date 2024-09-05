<?php

namespace Common;

use Dompdf\Dompdf;

trait PDFGenerator
{
    private $defaultOptions=['isRemoteEnabled' => true];
    /**
     * Creates a Dompdf object and renders it ready for use
     * @param String                $html       The HTML to convert to a PDF
     * @param null|boolean|array    $aOptions   An array of options, null for the defaults, false if none required
     * @param boolean               $php        true if PHP enabled, false if not
     * @param boolean               $landscape        true if landscape, false if portrait
     */

}
