<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__). '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
	
	function __construct()
	{
		// Call parent constructor
		parent::__construct();
	}
}
?>