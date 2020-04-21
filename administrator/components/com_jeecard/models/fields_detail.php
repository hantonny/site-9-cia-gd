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


class fields_detailModelfields_detail extends JModelLegacy{
	
	var $_id = null;
	var $_data = null;
	var $_table_prefix = null;
	var $_fielddata = null;
	
	function __construct() {
		parent::__construct();
		$this->_table_prefix = '#__jeajx_';		
	  	$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
		
	}
	
	function setId($id) {
		$this->_id		= $id;
		$this->_data	= null;
	}

	function &getData()	{
	
		if ($this->_loadData())	{
			
		}else  $this->_initData();
	
	   	return $this->_data;
	}
	
	function _loadData(){
	
		if (empty($this->_data)){
			$query = 'SELECT * FROM '.$this->_table_prefix.'fields  WHERE field_id = '. $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}
	
	function field_data(){
		$query = 'SELECT * FROM '.$this->_table_prefix.'fields_value  WHERE field_id = '. $this->_id; 
		$this->_db->setQuery( $query );
		$this->_fielddata = $this->_db->loadObjectList();
		return $this->_fielddata;		 
	}
	
	function _initData(){
		if (empty($this->_data)){
			
			$detail = new stdClass();
			$detail->field_id				= 0;
			$detail->field_title			= null;
			$detail->wysiwyg				= null;
			$detail->field_type				= 0;
			$detail->field_name				= null;
			$detail->field_desc				= null;
			$detail->field_class			= null;
			$detail->field_section			= 0;
			$detail->field_maxlength 		= 20;
			$detail->field_cols 			= 0;
			$detail->field_rows 			= 0;
			$detail->is_required			= 0;
			$detail->radio_cols				= 1;
			$detail->field_show_in_front	= 0;
			$detail->label_fontsize	= 12;
			$detail->label_bgcolor	= null;
			$detail->label_textcolor	= null;
			//$detail->title_show_on_top		= 0;
			$detail->published				= 1;
			$this->_data		 			= $detail;
			return (boolean) $this->_data;
		}
		return true;
	}
	
  	function store($data) {
		$row = $this->getTable('fields_detail');
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
	
	function field_save($id,$post) {
		$extra_name=$post["extra_name"];
		$extra_value=$post["extra_value"];
		$value_id=$post["value_id"];
		$query="select value_id from ".$this->_table_prefix."fields_value where  field_id=".$id;
		$this->_db->setQuery( $query );
		$filed_data_id = $this->_db->loadObjectList();
		if(count($filed_data_id)>0)	{
			$fid=array();		
			foreach ($filed_data_id as $f) {
				$fid[] = $f->value_id;
			}
			$del_fid= array_diff($fid,$value_id);			
			if(count($del_fid)>0){
				$this->field_delete($del_fid,'value_id');
			}
			
		}
		for($j=0;$j<count($extra_name);$j++){
			if($value_id[$j]==""){
				$query="insert into ".$this->_table_prefix."fields_value (field_id,field_name,field_value) value ( '".$id."','".$extra_name[$j]."','".$extra_value[$j]."' ) ";
			} else {
				$query="update  ".$this->_table_prefix."fields_value set field_name='".$extra_name[$j]."',field_value='".$extra_value[$j]."' where value_id='".$value_id[$j]."' ";	
			}
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}	
	}
	
	function field_delete($id,$field){
		$id = implode( ',', $id );
		$query = 'DELETE FROM '.$this->_table_prefix.'fields_value WHERE '.$field.' IN ( '.$id.' )';
		$this->_db->setQuery( $query );
		if(!$this->_db->query()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
	}
	
	function delete($cid = array())	{
		if (count( $cid )){
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM '.$this->_table_prefix.'fields WHERE field_id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}

	function publish($cid = array(), $publish = 1) {
		if (count( $cid )){
			$cids = implode( ',', $cid );
			$query = 'UPDATE '.$this->_table_prefix.'fields'
				. ' SET published = ' . intval( $publish )
				. ' WHERE field_id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}
	
	function getFormdata()
	{
		$query = "SELECT id as value, name as text FROM  ".$this->_table_prefix."form ";
		$this->_formdata = $this->_getList( $query );
		return $this->_formdata;
	}
		
}
?>