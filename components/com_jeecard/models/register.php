<?php

/**

* @package  JE Ecard

* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.

* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php

* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com

**/



defined( '_JEXEC' ) or die( 'Restricted access' );



jimport('joomla.application.component.model');



class registerModelregister extends JModelLegacy
{

	var $_data = null;

	var $_total = null;

	var $_pagination = null;

	var $_table_prefix = null;



	function __construct()

	{

		parent::__construct();

		$mainframe = JFactory::getApplication();
		$context='';

		$context='hid';		

	  	$this->_table_prefix = '#__jeecard_';		



		



	}

	function &getData()

	{

	 	

		if ($this->_loadData())

		{

			

		}else  $this->_initData();



	   	return $this->_data;

		

		

	}


	function _loadData()

	{	

		if (empty($this->_data))

		{

			$query = $this->_buildQuery();

			$this->_db->setQuery($query);

			$this->_data = $this->_db->loadObject();

			 

			return (boolean) $this->_data;

			

			

		}

		

		return true;

}
function store($data)
	{ 
	
		$row = $this->getTable('register');
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
			if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return $row;
	}
	function _initData()
	{
		if (empty($this->_data))
		{
			$detail = new stdClass();
			$detail->r_id			= null;
			$detail->user_id		= null;
			$detail->fname		    = null;
			$detail->lname			= null;
			$detail->dob		    = null;
			$detail->sex			= null;
			$detail->password		= null;
			$this->_data= $detail;
			return (boolean) $this->_data;
			}
	}
	function _buildQuery()
	{
		$userid = clone(JFactory::getUser());	
		$query = ' SELECT r.*,u.* FROM '.$this->_table_prefix.'register AS r INNER JOIN #__users AS u ON u.id=r.user_id WHERE r.user_id='.$userid->id ;
		return $query;
	 }
	function getcountry()
	{
		$db= JFactory :: getDBO();
		$query = 'SELECT country_name as text, country_id as value FROM '.$this->_table_prefix.'country';
		$db->setQuery($query);
		$countrylist = $db->LoadObjectList();
		return $countrylist;
	}
	function getstate()
	{
		$db= JFactory :: getDBO();
		$query = 'SELECT state_name as text, state_id as value FROM '.$this->_table_prefix.'state';
		$db->setQuery($query);
		$statelist = $db->LoadObjectList();
		return $statelist;
	}
	function getAjaxstate($did)
	{
		$db= JFactory :: getDBO();
	 	$query = 'SELECT state_name as text, state_id as value FROM '.$this->_table_prefix.'state WHERE country_id='.$did;
		$db->setQuery($query);
		$statelist = $db->LoadObjectList();
		return $statelist;
	}
	
	function getuserdetail()
	{
		$userid = JRequest::getVar ('userid','','','int');
		$db= JFactory :: getDBO();
		$query = 'SELECT * FROM '.$this->_table_prefix.'userdetail WHERE user_id ='.$userid;
		$db->setQuery($query);
		$countrylist = $db->LoadObject();
		return $countrylist;
	}
}	

?>