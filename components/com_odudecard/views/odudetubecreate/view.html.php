<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

jimport( 'joomla.application.component.view');
require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	  

class odudecardViewodudetubecreate extends JViewLegacy
{
	function display($tpl = null)
	{
			
			$q_cate = JRequest::getVar('cate', '0');
			$cate=getSpecificId($q_cate,'cate');
		
	    require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	  
      $setting=getSetting();
     	
     	$categoryDetil=getCategoryDetail($cate);

				
        $this->assignRef( 'cate_name',  $categoryDetil->name );
		  $this->assignRef( 'cate_banner',  $categoryDetil->banner );
		    $this->assignRef( 'cate_bg',  $categoryDetil->bg );
		    $this->assignRef( 'cate',  $cat );
			
	
		$this->assignRef( 'a2',  $setting->a2);
	

 
 	 
			  
		parent::display($tpl);
	}
}
?>
                                                                                                
