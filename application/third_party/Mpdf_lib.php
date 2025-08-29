<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpdf_lib {
    public function __construct() {
        require_once APPPATH . 'libraries/mpdf/vendor/autoload.php'; // Load mPDF
    }

    public function load() {
        return new \Mpdf\Mpdf();
    }
}
?>