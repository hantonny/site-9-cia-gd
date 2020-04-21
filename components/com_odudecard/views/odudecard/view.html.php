<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class odudecardViewodudecard extends JViewLegacy
{
	function display($tpl = null)
	{
		
		
  	$mymenuitem = JRequest::getVar('Itemid', 0, 'request', 'int');
   
 	  $model = $this->getModel();
   
		$cate_detail = $model->getCategory();
		
		$this->assignRef( 'cat',  $cate_detail[0]->cat );
		$this->assignRef( 'cat_alias',  $cate_detail[0]->slug );
		
parent::display($tpl);
		
		}

 
			  
		
	}
	

