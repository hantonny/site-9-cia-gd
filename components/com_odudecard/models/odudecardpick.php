<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );
require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );

class odudecardModelodudecardpick extends JModelLegacy
{
	
	function viewCard($xid)
	{
		$view = array();
		$db = JFactory::getDBO();
		$query =  "select * from #__ecard_view where id='".$xid."'";
		$db->setQuery($query);
		$rows = $db -> loadObjectList();
		
		if(count($rows)!=0)
		{
		
		$view['status']=$rows[0]->status;
		$view['notify']=$rows[0]->notify;
		$view['clock']=$rows[0]->clock;
		$view['SN']=$rows[0]->SN;
		$view['SE']=$rows[0]->SE;
		$view['RN']=$rows[0]->RN;
		$view['RE']=$rows[0]->RE;
		$view['sub']=$rows[0]->sub;
		$view['card']=$rows[0]->card;
		$view['body']=$rows[0]->body;
			$view['IP']=$rows[0]->IP;
		$view['count']=$rows[0]->count;
		$view['extra']=$rows[0]->extra;

		return $view;
		}
		else
		{
		
		return 'x';	

		}
		
	}
	
	function getCard($cardid)
	{
		$card = array();
		$db = JFactory::getDBO();
		$query =  "select * from #__ecard_media where id='".$cardid."'";
		$db->setQuery($query);
		$rows = $db -> loadObjectList();
		
		if(count($rows)!=0)
		{
		
		$card['effect']=$rows[0]->effect;
		$card['cate']=$rows[0]->cat;
		$card['title']=$rows[0]->title;
		$card['image']=$rows[0]->file;
		$card['type']=$rows[0]->type;
		$card['desp']=$rows[0]->desp;
		$card['code']=$rows[0]->code;
		$card['thumb']=$rows[0]->thumb;
		$card['username']=$rows[0]->username;
		$card['point']=$rows[0]->point;


		return $card;
		}
		else
		{
		
		return 'No Card';	

		}
		
	}
	
				function getCategory()
    {
       		$q_cate = JRequest::getVar('cate', '0');
			$cate=getSpecificId($q_cate,'cate'); 

		   $db = JFactory::getDBO();
			$query = "select * from #__ecard_cate where cat='$cate'";
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			return $rows;
		
    }

	
	function getSetting()
	{
	$query = "select * from #__ecard_setting";

	
	   $ecardS = array();
	   	$db = JFactory::getDBO();
		$db->setQuery($query);
		$rows = $db -> loadObjectList();
			$ecardS['from_name']=$rows[0]->from_name;
			$ecardS['from_email']=$rows[0]->from_email;
			$ecardS['subject_suffix']=$rows[0]->subject_suffix;
			$ecardS['viewlimit']=$rows[0]->viewlimit;
			$ecardS['a2']=$rows[0]->a2;
			$ecardS['width']=$rows[0]->width;
			$ecardS['height']=$rows[0]->height;


			return $ecardS;

	}


}
