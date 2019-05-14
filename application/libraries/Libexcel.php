<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//place library directory
require_once APPPATH."/third_party/PHPExcel.php";
class Libexcel extends PHPExcel {
   public function __construct() {
      parent::__construct();
   }
}
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
