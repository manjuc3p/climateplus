<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load html2pdf library
require_once(APPPATH . 'libraries/html2pdf/html2pdf.php');

class Html2pdf_lib {

    public function __construct() {
        // CodeIgniter's constructor
    }

    // Method to convert HTML to PDF
    public function convert_html_to_pdf($htmlContent, $filename = 'output.pdf') {
        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en');
            $html2pdf->writeHTML($htmlContent);
            $html2pdf->Output($filename, 'D'); // 'I' for inline, 'D' for download
        } catch (HTML2PDF_exception $e) {
            echo $e;
        }
    }
}
?>