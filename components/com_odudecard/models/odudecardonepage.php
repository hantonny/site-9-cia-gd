<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );


class odudecardModelodudecardonepage extends JModelLegacy
{
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
		$card['point']=$rows[0]->point;
		$card['user']=$rows[0]->username;
		$card['keyword']=$rows[0]->keyword;

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
			$ecardS['card_row']=$rows[0]->card_row;
			$ecardS['card_page']=$rows[0]->card_page;
			$ecardS['a1']=$rows[0]->a1;
			$ecardS['a2']=$rows[0]->a2;
			$ecardS['a3']=$rows[0]->a3;
			$ecardS['a4']=$rows[0]->a4;
			

			return $ecardS;

	}


}
