<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

jimport( 'joomla.application.component.view');


class odudecardViewodudecardpre extends JViewLegacy
{
	function display($tpl = null)
	{
		require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	 
		$q_id = JRequest::getVar('id', '0');
		$id=getSpecificId($q_id,'media');
	  
		$model = $this->getModel();
		
        $greeting = $model->getCard($id);
		$setting = $model->getSetting();
		$cate_detail = $model->getCategory();
		$captcha= JRequest::getVar('captcha', 0, 'post', 'string');
		$eorm= JRequest::getVar('eorm', 0, 'post', 'string');
		$this->assignRef( 'captcha',  $captcha );
		$this->assignRef( 'eorm',  $eorm );
        $this->assignRef( 'cate_name',  $cate_detail[0]->name );
		  $this->assignRef( 'cate_banner',  $cate_detail[0]->banner );
		    $this->assignRef( 'cate_bg',  $cate_detail[0]->bg );
			
		
			$this->assignRef( 'a2',  $setting['a2'] );
		

 
 		if($greeting['type']=='J')
		$card="<img src='".JURI::base()."media/ecard/".$greeting['image']."' alt='".$greeting['title']."' border=1><br>";

		$this->assignRef( 'card',  $card );
 		$this->assignRef( 'effect',  $greeting['effect'] );
 		$this->assignRef( 'image',  $greeting['image'] );
 		$this->assignRef( 'thumb',  $greeting['thumb'] );
 		$this->assignRef( 'cate',  $greeting['cate'] );
		$cate_alias=getEcardAlias($greeting['cate'],'cate');
		$this->assignRef( 'cate_alias',$cate_alias   );
 		$this->assignRef( 'title',  $greeting['title'] );
 		$this->assignRef( 'point',  $greeting['point'] );
 			$this->assignRef( 'type',  $greeting['type'] );
 		$send=JRequest::getVar('send', 0, 'request');
 		
 		$this->assignRef( 'send',  $send );

 
			  
		parent::display($tpl);
	}
}
?>
                                                                                                
