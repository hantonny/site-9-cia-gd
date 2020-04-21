<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/  

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class fieldsModelfields extends JModelLegacy {
	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	var $_table_prefix = null;
	
	function __construct() {
		parent::__construct();

		global $context;
		$mainframe = JFactory::getApplication();
		$context='field_id';
	  	$this->_table_prefix = '#__jeajx_';			
		$limit			= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0 );
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);

	}
	
	function getData(){		
		if (empty($this->_data)) {
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
			
		return $this->_data;
	}
	
	function getTotal()	{
		if (empty($this->_total)) {
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}
	
	function getPagination() {
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}
	
	function _buildQuery(){
		$orderby	= $this->_buildContentOrderBy();
		$field_section = JRequest::getVar('field_section','0','','int');
		$search = JRequest::getVar('field_search','','','string');
		if($search!="") {
			$where="where f.field_section=".$field_section." AND f.field_title='".$search."' OR  f.field_name='".$search."' ".$orderby;
		} else {
			$where="where f.field_section=".$field_section.' '.$orderby;
		}
		if($field_section!="0"){
			$query = ' SELECT f.*,frm.name as frmname '
			. ' FROM '.$this->_table_prefix.'fields AS f left join '.$this->_table_prefix.'form AS frm 
			on frm.id=f.field_section '.$where ;
		} else {
			$query = ' SELECT f.*,frm.name as frmname '
			. ' FROM '.$this->_table_prefix.'fields AS f left join '.$this->_table_prefix.'form AS frm 
			on frm.id=f.field_section '.$orderby;
		}
		return $query;
	}
	
	function _buildContentOrderBy()	{
		global $context;
		$mainframe = JFactory::getApplication();
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'field_id' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );		
		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;			
		return $orderby;
	}
	
	function getFormdata()
	{
		$query = "SELECT id as value, name as text FROM  ".$this->_table_prefix."form ";
		$this->_formdata = $this->_getList( $query );
		return $this->_formdata;
	}
}	
?>