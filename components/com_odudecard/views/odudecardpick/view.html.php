<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

jimport( 'joomla.application.component.view');


class odudecardViewodudecardpick extends JViewLegacy
{
	function display($tpl = null)
	{

		$xid = JRequest::getVar('xid', 0, 'request', 'int');
		$model = $this->getModel();
		$view = $model->viewCard($xid);
        $card = $model->getCard($view['card']);
        $setting = $model->getSetting();
				$cate_detail = $model->getCategory();



	$tab="";
	$v="";
	if($view=='x')
	{
	$tab.=JText::_('COM_ODUDECARD_ECARD_WRONG_URL');
	}
	else
	{
	$code1=stripslashes($card['code']);
		
		$this->assignRef( 'RN',  $view['RN'] );
		$this->assignRef( 'SN',  $view['SN'] );
		$this->assignRef( 'SE',  $view['SE'] );
		$this->assignRef( 'clock',  $view['clock'] );
		$this->assignRef( 'body',  $view['body'] );
		$this->assignRef( 'image',  $card['image'] );
		$this->assignRef( 'thumb',  $card['thumb'] );
		$this->assignRef( 'title',  $card['title'] );
		$this->assignRef( 'type',  $card['type'] );
		$this->assignRef( 'code',  $code1 );
		$this->assignRef( 'cat',  $card['cate'] );
		$this->assignRef( 'notify',   $view['notify'] );
		$this->assignRef( 'sub',   $view['sub'] );
    $this->assignRef( 'username',  $card['username'] );
    $this->assignRef( 'point',  $card['point'] );
     $this->assignRef( 'IP',  $view['IP'] );
     $this->assignRef( 'count',  $view['count'] );
     $this->assignRef( 'extra',  $view['extra'] );
		
		$this->assignRef( 'from_email',  $setting['from_email'] );
		$this->assignRef( 'from_name',   $setting['from_name'] );
		$this->assignRef( 'msgsuffix',   $setting['subject_suffix'] );
		
		$this->assignRef( 'xid',  $xid );
		
		$this->assignRef( 'cate_name',  $cate_detail[0]->name );
		$this->assignRef( 'cate_banner',  $cate_detail[0]->banner );
		$this->assignRef( 'cate_bg',  $cate_detail[0]->bg );
			
			$this->assignRef( 'viewlimit',  $setting['viewlimit'] );
			$this->assignRef( 'a2',  $setting['a2'] );
			$this->assignRef( 'width',  $setting['width'] );
			$this->assignRef( 'height',  $setting['height'] );


		
		
		

		$v="o";
	}

		
		
		

		
 		$this->assignRef( 'id',  $tab );
		$this->assignRef( 'v',  $v );
	  
		parent::display($tpl);
	}
}
?>
                                                                                                
