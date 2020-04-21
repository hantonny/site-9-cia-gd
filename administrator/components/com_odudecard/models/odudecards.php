<?php


defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class odudecardsModelodudecards extends JModelLegacy
{
	var $_data;
	
	function _buildQuery()
	{
		$cat = JRequest::getVar('cat','');
		$where = JRequest::getVar('where','');
		$filter_order = JRequest::getVar('filter_order','ordering');
		$filter_order_Dir = JRequest::getVar('filter_order_Dir','asc');
		
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
			$upquery="update #__ecard_cate set ordering=".$po." where cat=".$ci;
			$db->setQuery($upquery);
			$result = $db->execute();
			$db = JFactory::getDBO();
			$upquery="update #__ecard_cate set ordering=".$co." where cat=".$pi;
			$db->setQuery($upquery);
			$result = $db->execute();
			JFactory::getApplication()->enqueueMessage('Category Moved Up');
		}
		if($go=='down')
		{
			
			$db = JFactory::getDBO();
			$upquery="update #__ecard_cate set ordering=".$no." where cat=".$ci;
			$db->setQuery($upquery);
			$result = $db->execute();
			$db = JFactory::getDBO();
			$upquery="update #__ecard_cate set ordering=".$co." where cat=".$ni;
			$db->setQuery($upquery);
			$result = $db->execute();
			JFactory::getApplication()->enqueueMessage('Category Moved Down');
			
		}




		
		if($where=='' && $cat=='' )
			$query = ' select * from #__ecard_cate where subcat=\'0\'  order by '.$filter_order.' '.$filter_order_Dir.'';
		else if($cat=='' && $where!='')
			$query = ' select * from #__ecard_cate where name LIKE \'%'.$where.'%\'  order by '.$filter_order.' '.$filter_order_Dir.'';
		else
			$query = ' select * from #__ecard_cate where subcat=\''.$cat.'\'  order by '.$filter_order.' '.$filter_order_Dir.'';
		
		

		return $query;
	}

	function getData()
	{
		if (empty( $this->_data ))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList( $query );
		}

		return $this->_data;
	}
}