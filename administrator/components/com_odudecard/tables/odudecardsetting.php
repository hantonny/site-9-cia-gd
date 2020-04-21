<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class Tableodudecardsetting extends JTable
{
	var $id = null;

	var $from_email = null;
	var $from_name = null;
	var $subject_suffix = null;
	var $card_row = 0;
	var $card_page = 0;
	
	var $viewlimit='';
	var $a2='';
	var $width='';
	var $height='';
	
	
	var $add_rec  = 0;
	var $import = 0;
	var $share = 0;
	var $watermark = 0;
	var $captcha = 0;
	var $member_restrict  = 0;
	var $point = 0;
	var $expire = 0;
	var $ffmpeg  = null;
	var $tubewidth = null;
	var $tubeheight = null;
	var $videowidth  = null;
	var $videoheight = null;
	var $large_width = null;
	var $thumb_width = null;
	
	
	
	
	function Tableodudecardsetting(& $db) {
		parent::__construct('#__ecard_setting', 'id', $db);
	}
}