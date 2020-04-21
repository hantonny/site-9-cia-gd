<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class Tableodudecard extends JTable
{
	var $cat = null;

	var $name = null;
	var $subcat = 0;
	
	var $front='N';
	
	var $banner='';
	var $bg='';
	var $slug='';
	function Tableodudecard(& $db) {
		parent::__construct('#__ecard_cate', 'cat', $db);
	}
}