<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class odudecardsModelodudecardcard extends JModelLegacy
{
	var $_data;

  var $_total = null;
 
  var $_pagination = null;
function __construct()
  {
        parent::__construct();
 
        global $mainframe, $option;
         $mainframe = JFactory::getApplication();
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
  }

	function _buildQuery()
	{
		$cat = JRequest::getVar('cat','');
		$where = JRequest::getVar('where','');
		$filter_order = JRequest::getVar('filter_order','ordering');
		$filter_order_Dir = JRequest::getVar('filter_order_Dir','asc');
		
		//****************
		$ci = JRequest::getVar('ci','0');
		$co = JRequest::getVar('co','0');
		$pi = JRequest::getVar('pi','0');
		$po = JRequest::getVar('po','0');
		$ni = JRequest::getVar('ni','0');
		$no = JRequest::getVar('no','0');
		$go = JRequest::getVar('go','0');
		
		
		
		
		
		if($go=='up')
		{
			$db = JFactory::getDBO();
			$upquery="update #__ecard_media set ordering=".$po." where id=".$ci;
			$db->setQuery($upquery);
			$result = $db->execute();
			$db = JFactory::getDBO();
			$upquery="update #__ecard_media set ordering=".$co." where id=".$pi;
			$db->setQuery($upquery);
			$result = $db->execute();
			JFactory::getApplication()->enqueueMessage('Ecard Moved Up');
		}
		if($go=='down')
		{
			
			$db = JFactory::getDBO();
			$upquery="update #__ecard_media set ordering=".$no." where id=".$ci;
			$db->setQuery($upquery);
			$result = $db->execute();
			$db = JFactory::getDBO();
			$upquery="update #__ecard_media set ordering=".$co." where id=".$ni;
			$db->setQuery($upquery);
			$result = $db->execute();
			JFactory::getApplication()->enqueueMessage('Ecard Moved Down');
			
		}




		
		if($where=='' && $cat=='' )
			$query = 'select * from #__ecard_media  order by '.$filter_order.' '.$filter_order_Dir.'';
		else if($cat=='' && $where!='')
			$query = 'select * from #__ecard_media  where title LIKE "%'.$where.'%" order by '.$filter_order.' '.$filter_order_Dir.'';
		else
			$query =  'select * from #__ecard_media  where cat='.$cat.' order by '.$filter_order.' '.$filter_order_Dir.'';
		
		
		
		
		
		
		//***************
		
	/* 	if(isset($_SESSION["query"]))
		{
			$query=$_SESSION["query"];
		}
		else
		{
			if($cat=='')
			$query = 'select * from #__ecard_media  where title LIKE "%'.$where.'%" order by '.$filter_order.' '.$filter_order_Dir.'';	
			else
			$query = 'select * from #__ecard_media  where cat='.$cat.' order by '.$filter_order.' '.$filter_order_Dir.'';
		}
		unset($_SESSION["query"]); */
		
		//echo $query;
		return $query;
	}

	 
	 function getData() 
  {
        if (empty($this->_data)) {
            $query = $this->_buildQuery();
            $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit')); 
        }
        return $this->_data;
  }

	 
	
	  function getTotal()
  {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);    
        }
        return $this->_total;
  }
  function getPagination()
  {
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
  }


}