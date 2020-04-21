<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

class odudecardsControllerodudecardcard extends odudecardsController
{
		function display($cachable = false, $urlparams = array())
	{
					
		
		JRequest::setVar( 'view', 'odudecardcard' );
		JRequest::setVar( 'layout', 'list'  );
		JRequest::setVar('hidemainmenu', 0);
		parent::display();
	}
	
	
	function __construct()
	{
		parent::__construct();

		$this->registerTask( 'add'  , 	'edit' );
	}
	function edit()
	{
		JRequest::setVar( 'view', 'odudecardnew' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}
	
	
	
	function remove()
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
		$card['thumb']=$rows[0]->thumb;
		return $card;
		}
		else
		{
		
		return 'No Card';	

		}
		}
		
		
		
		
		
		$path=JPATH_ROOT.DS.'media'.DS.'ecard'.DS;
		$cid = $_POST['cid']; 
   		for ($i=0; $i<count($cid); $i++)
		
		{
			
			$card=getcard($cid[$i]);
			
			$msg=$card['title'].": Deleted with respective picture and thumbnail.</li>";
			
				$query="delete from #__ecard_media where id=$cid[$i]";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();
				
				unlink("$path".$card['image']);
				unlink("$path".$card['thumb']);


		}

		
		
		
		$model = $this->getModel('odudecardedit');
		$this->setRedirect( 'index.php?option=com_odudecard&controller=odudecardcard', $msg );
	}
	
		function saveorder()
	{

		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$order 	= JRequest::getVar( 'order', array(0), 'post', 'array' );
		//print_r($order)."<br>";
		
		$cat = JRequest::getVar('cat','');
		$where = JRequest::getVar('where','');
		$filter_order = JRequest::getVar('filter_order','title');
		$filter_order_Dir = JRequest::getVar('filter_order_Dir','asc');
		
		

	  $msg = 'NEW ORDERING SAVED';

	   $db = JFactory::getDBO();
	   $dbx =JFactory::getDBO();
	   
	   if($where=='' && $cat=='' )
			$query = 'select * from #__ecard_media  order by '.$filter_order.' '.$filter_order_Dir.'';
		else if($cat=='' && $where!='')
			$query = 'select * from #__ecard_media  where title LIKE "%'.$where.'%" order by '.$filter_order.' '.$filter_order_Dir.'';
		else
			$query =  'select * from #__ecard_media  where cat='.$cat.' order by '.$filter_order.' '.$filter_order_Dir.'';
		
		
	   
		/* 	if($cat=='')
			$query = 'select * from #__ecard_media  where title LIKE "%'.$where.'%" order by '.$filter_order.' '.$filter_order_Dir.'';
			else
			$query = 'select * from #__ecard_media  where cat='.$cat.' order by '.$filter_order.' '.$filter_order_Dir.'';
		 */
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			echo $query."<br>";
			//print_r($rows);
			
			
			for($k=0;$k<count($rows);$k++)
                 {
                 $rowx=$rows[$k];

                  $queryx="update #__ecard_media set ordering=".$order[$k]." where id=".$rowx->id;
				          $dbx->setQuery($queryx);
			           	$result = $dbx->execute();
							
							echo $queryx."<br>";

                 }
			
			$_SESSION["query"]=$query;
			
			$this->setRedirect( 'index.php?option=com_odudecard&controller=odudecardcard&cat='.$cat.'&where='.$where, $msg);
	}
	function publish()
	{

		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1)
        {
			$msg = '';
			JError::raiseWarning(500, JText::_( 'SELECT ITEM PUBLISH' ) );
		} else
        {

             $query="update #__ecard_media set published=1 where id=".$cid[0];
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();


			$msg 	= JText::_( 'Ecard PUBLISHED');

   		}

		$this->setRedirect( 'index.php?option=com_odudecard&controller=odudecardcard', $msg );
	}
	function unpublish()
	{


 		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			$msg = '';
			JError::raiseWarning(500, JText::_( 'SELECT ITEM UNPUBLISH' ) );
		} else
         {

                $query="update #__ecard_media set published=0 where id=".$cid[0];
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();
            	$msg 	= JText::_( 'Ecard UNPUBLISHED');


		}

		$this->setRedirect( 'index.php?option=com_odudecard&controller=odudecardcard', $msg );
	}

}