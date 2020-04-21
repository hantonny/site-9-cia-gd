<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class odudecardsControllerodudecardcatnew extends odudecardsController
{
	function __construct()
	{
		parent::__construct();

		$this->registerTask( 'add'  , 	'edit' );
	}

	function edit()
	{
		JRequest::setVar( 'view', 'odudecardcatnew' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	function save()
	{
		$model = $this->getModel('odudecard');

		if ($model->store($post)) {
			$msg = JText::_( 'New Setting Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Setting' );
		}
		$link = 'index.php?option=com_odudecard';
		$this->setRedirect($link, $msg);
	}
	function remove()
	{
			function getBanner($catid)
	{
	$query = "select * from #__ecard_cate where cat='".$catid."'";

	
	   $banner = array();
	   	$db = JFactory::getDBO();
		$db->setQuery($query);
		$rows = $db -> loadObjectList();

		if(count($rows)!=0)
		{
			
			$banner['name']=$rows[0]->name;
			$banner['banner']=$rows[0]->banner;
			$banner['bg']=$rows[0]->bg;
			$banner['cat']=$rows[0]->cat;
			$banner['front']=$rows[0]->front;
			$banner['subcat']=$rows[0]->subcat;
			return $banner;
			
		}
		else
		{
			return 'No Banner';		
		}

	}

		
		
		$path=JPATH_ROOT.DS.'media'.DS.'ecard'.DS;
		$cid = $_POST['cid']; 
   		for ($i=0; $i<count($cid); $i++)
		{
		$banner=getBanner($cid[$i]);
			
			$msg=$banner['name'].": Deleted with respective banner and background.";
			
				$query="delete from #__ecard_cate where cat=$cid[$i]";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();
				
				unlink("$path".$banner['bg']);
				unlink("$path".$banner['banner']);
				
				
				$query="update #__ecard_cate set subcat='0' where subcat=$cid[$i]";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();
				
				$query="update #__ecard_media set cat='0' where cat=$cid[$i]";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();
		}
		
		$this->setRedirect( 'index.php?option=com_odudecard', $msg );
	}

	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_odudecard', $msg );
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
			$query = ' select * from #__ecard_cate where subcat=\'0\'  order by '.$filter_order.' '.$filter_order_Dir.'';
		else if($cat=='' && $where!='')
			$query = ' select * from #__ecard_cate where name LIKE \'%'.$where.'%\'  order by '.$filter_order.' '.$filter_order_Dir.'';
		else
			$query = ' select * from #__ecard_cate where subcat=\''.$cat.'\'  order by '.$filter_order.' '.$filter_order_Dir.'';
			
			
			
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			echo $query;
			print_r($rows);
			
			
			for($k=0;$k<count($rows);$k++)
                 {
                 $rowx=$rows[$k];

                  $queryx="update #__ecard_cate set ordering=".$order[$k]." where cat=".$rowx->cat;
				          $dbx->setQuery($queryx);
			           	$result = $dbx->execute();
							
							echo $queryx."<br>";

                 }
		//$_SESSION["catquery"]=$query;
		$this->setRedirect( 'index.php?option=com_odudecard&cat='.$cat.'&where='.$where.'&filter_order='.$filter_order.'&filter_order_Dir='.$filter_order_Dir.'', $msg);
	}
	
	/*
	function saveorderUp()
	{

		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$order 	= JRequest::getVar( 'orderUp', array(0), 'post', 'array' );
		//print_r($order)."<br>";
		$cat = JRequest::getVar('cat','');
		$where = JRequest::getVar('where','');
		$filter_order = JRequest::getVar('filter_order','title');
		$filter_order_Dir = JRequest::getVar('filter_order_Dir','asc');
		
		

	  $msg = 'Category moved up';

	   $db = JFactory::getDBO();
	   $dbx =JFactory::getDBO();
			//$query = 'select * from #__ecard_cate  where name LIKE "%'.$where.'%" order by '.$filter_order.' '.$filter_order_Dir.'';
			
		
			if($where=='' && $cat=='' )
			$query = ' select * from #__ecard_cate where subcat=\'0\'  order by '.$filter_order.' '.$filter_order_Dir.'';
		else if($cat=='' && $where!='')
			$query = ' select * from #__ecard_cate where name LIKE \'%'.$where.'%\'  order by '.$filter_order.' '.$filter_order_Dir.'';
		else
			$query = ' select * from #__ecard_cate where subcat=\''.$cat.'\'  order by '.$filter_order.' '.$filter_order_Dir.'';
			
			
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			//echo $query;
			//print_r($rows);
			
			
			for($k=0;$k<count($rows);$k++)
                 {
                 $rowx=$rows[$k];

                  $queryx="update #__ecard_cate set ordering=".$order[$k]." where cat=".$rowx->cat;
				          $dbx->setQuery($queryx);
			           	$result = $dbx->execute();
							
							//echo $queryx."<br>";

                 }
		
		$this->setRedirect( 'index.php?option=com_odudecard&cat='.$cat.'&where='.$where.'&filter_order='.$filter_order.'&filter_order_Dir='.$filter_order_Dir.'', $msg);
	}
function saveorderDown()
	{

		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$order 	= JRequest::getVar( 'orderDown', array(0), 'post', 'array' );
		//print_r($order)."<br>";
		$cat = JRequest::getVar('cat','');
		$where = JRequest::getVar('where','');
		$filter_order = JRequest::getVar('filter_order','title');
		$filter_order_Dir = JRequest::getVar('filter_order_Dir','asc');
		
		

	  $msg = 'Category moved Down';

	   $db = JFactory::getDBO();
	   $dbx =JFactory::getDBO();
			//$query = 'select * from #__ecard_cate  where name LIKE "%'.$where.'%" order by '.$filter_order.' '.$filter_order_Dir.'';
		
			if($where=='' && $cat=='' )
			$query = ' select * from #__ecard_cate where subcat=\'0\'  order by '.$filter_order.' '.$filter_order_Dir.'';
		else if($cat=='' && $where!='')
			$query = ' select * from #__ecard_cate where name LIKE \'%'.$where.'%\'  order by '.$filter_order.' '.$filter_order_Dir.'';
		else
			$query = ' select * from #__ecard_cate where subcat=\''.$cat.'\'  order by '.$filter_order.' '.$filter_order_Dir.'';
			
	
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			echo $query;
			print_r($rows);
			
			
			for($k=0;$k<count($rows);$k++)
                 {
                 $rowx=$rows[$k];

                  $queryx="update #__ecard_cate set ordering=".$order[$k]." where cat=".$rowx->cat;
				          $dbx->setQuery($queryx);
			           	$result = $dbx->execute();
							
							echo $queryx."<br>";

                 }
		
		$this->setRedirect( 'index.php?option=com_odudecard&cat='.$cat.'&where='.$where.'&filter_order='.$filter_order.'&filter_order_Dir='.$filter_order_Dir.'', $msg);
	}
	*/
}