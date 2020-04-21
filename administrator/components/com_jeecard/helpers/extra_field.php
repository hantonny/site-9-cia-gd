<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/

/*if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );*/
JHTML::_('behavior.tooltip');

jimport('joomla.filesystem.file');


//--------It's used for CALENDER CONTROL----------//
JHTML::_('behavior.calendar');
//-----------------------------------------------//
		
class extra_field {

/////// 

/*
 * field_type 	=   1 :- Text Field
 * 					2 :- Text Area
 * 					3 :- Check Box
 * 					4 :- Radio Button
 * 					5 :- Select Box (Single select)
 * 					6 :- Select Box (Multiple select) 
 * 					7 :- Select country box
 * 					8 :- Wysiwyg
 * 					9 :- File
 * 				   10 :- HR Tag
 * 				   11 :- Label
 * 				   12 :- Date
 * 				   13 :- Password
 * 
 * field_section = 	1 :- Product
 * 					2 :- Category
 * 					3 :- Form
 * 					4 :- E-mail
 * 					5 :- Confirmation
 * 					6 :- Userinformations
 * 					7 :- Customer Address 
 * 					8 :- Company Address 
 * 					9 :- Color sample
 *
 */

	var $_data = null;	
	var $_table_prefix = null;
	
	function __construct()
	{		
		global $context;		
		$mainframe = JFactory::getApplication();
	  	$this->_table_prefix = '#__jeajx_';				
	}
	function list_all_field_list($field_section="",$section_id="",$field_name="",$table="") {	
		$option = JRequest::getVar('option','','','string');
		$db = JFactory::getDbo();
		$uri = JURI::getInstance();
		$url= $uri->root();	
		
		$q = "SELECT * FROM ".$this->_table_prefix."fields where field_section='".$field_section."' and published=1  ORDER BY ordering";
		if($field_name!="")
		{
			$q .= "and field_name in ($field_name)";
		}
		$db->setQuery($q);
		$row_data=$db->loadObjectlist();
		/*echo '<pre>';
		print_r ($row_data);
		exit;*/
		$ex_field='';
		if(count($row_data)>0 && $table=="")
		$ex_field='<table class="admintable" border="0" >';
		
		for($i=0;$i<count($row_data);$i++)
		{
		 
			$type=$row_data[$i]->field_type;
			$ex_field .= '<tr>
			<td valign="top" align="right" class="key">
			<label for="name">
			'.$row_data[$i]->field_title.'	
			</label>
			</td><td >'; 

			
		$sql="select * from ".$this->_table_prefix."fields_data where fieldid='".$row_data[$i]->field_id."' and itemid='".$section_id."' and section='".$field_section."' ";
		
			$db->setQuery($sql);
			$data_value=$db->loadObject();
			//print_r($data_value->data_txt);
			switch ($type) {
		
				case 1: // 1 :- Text Field
						if($data_value)
						{
						if($data_value->data_txt)
						$text_value=$data_value->data_txt;
						else
						$text_value='';
						}
						else
						$text_value='';
						
			        	$ex_field .=$text_value;			        				
				        break;
				case 2: // 2 :- Text Area
						if($data_value)
						{
						if($data_value->data_txt)
						$textarea_value=$data_value->data_txt;
						else
						$textarea_value='';
						}
						else
						$textarea_value='';
						
			        	$ex_field .=$textarea_value;			
				        break;
				case 3: // 3 :- Check Box
				  		$q = "SELECT * from ".$this->_table_prefix."fields_value where field_id='".$row_data[$i]->field_id."' ";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->field_value,$chk_data))
						$ex_field .=$field_chk[$c]->field_value;
						else
						$checked='';
									        	
						}			
				        break;
				 case 4: // 4 :- Radio Button
				  		$q = "SELECT * from ".$this->_table_prefix."fields_value where field_id='".$row_data[$i]->field_id."' ";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->field_value,$chk_data))
						$ex_field .=$field_chk[$c]->field_value;
						
						}			
				        break;
				  case 5: // 5 :-Select Box (Single select)
				  		$q = "SELECT * from ".$this->_table_prefix."fields_value where field_id='".$row_data[$i]->field_id."' ";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						 
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->field_value,$chk_data))
						$ex_field .=$field_chk[$c]->field_value;
						 
						}			
						
						
				        break;
				    case 6: // 6 :- Select Box (Multiple select) 
				  		$q = "SELECT * from ".$this->_table_prefix."fields_value where field_id='".$row_data[$i]->field_id."' ";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						 
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->field_value,$chk_data))
						$ex_field .=$field_chk[$c]->field_value;
						
						
						}			
						 
				        break;    
				     case 7: // 5 :-Select Country box
				  		$q = "SELECT * from ".$this->_table_prefix."country";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->country_id,$chk_data))
						$ex_field .=$field_chk[$c]->country_name;
						 
						}			
						 
				        break;
				      case 8: // 8 :- Wysiwyg
				      	$editor = JFactory::getEditor();	
						if($data_value)
						{
						if($data_value->data_txt)
						$textarea_value=$data_value->data_txt;
						else
						$textarea_value='';
						}
						else
						$textarea_value='';
						
						$ex_field .=$textarea_value;
			        //	$ex_field .='<textarea class="'.$row_data[$i]->field_class.'"  name="'.$row_data[$i]->field_name.'"  id="'.$row_data[$i]->field_name.'" cols="'.$row_data[$i]->field_cols.'" rows="'.$row_data[$i]->field_rows.'" >'.$textarea_value.'</textarea>';
			        			
				        break;
				     case 9: // 2 :- Text Area
						if($data_value)
						{
						if($data_value->data_txt)
						$file_value=$data_value->data_txt;
						else
						$file_value='';
						}
						else
						$file_value='';
						
						//$dest = JPATH_ROOT.'/'.'components/'.$option.'/assets/images/'.$file_value;
						$dest=$url."components/".$option ."/assets/images/".$file_value;
						//$link = '<a href="'.$dest.'" ></a>';
			        	$ex_field .='<a href="'.$dest.'" >'.$file_value .'</a>';
						//'<img src="'.$ex_field.'" ></a>';
						
						
									
				        break;
					case 11: // 11 :- Label
				      		
						if($data_value)
						{
						if($data_value->data_txt)
						$label_value=$data_value->data_txt;
						else
						$label_value='';
						}
						else
						$label_value='';
						
						$ex_field .=$label_value;
			       
			        			
				        break;
					case 12: // 12 :- Date
				      		
						if($data_value)
						{
						if($data_value->data_txt)
						$date_value=$data_value->data_txt;
						else
						$date_value='';
						}
						else
						$date_value='';
						
						$ex_field .=$date_value;
			       
			        			
				        break;
					
					case 13: // 13 :- Password Field
						if($data_value)
						{
						if($data_value->data_txt)
						$password_value=$data_value->data_txt;
						else
						$password_value='';
						}
						else
						$password_value='';
						
			        	$ex_field .=$password_value;			        				
				        break;
					
			   
				}
			   $ex_field .= '</td><td valign="top">&nbsp; '.JHTML::tooltip($row_data[$i]->field_desc, $row_data[$i]->field_name, 'tooltip.png', '', '', false);
			   $ex_field .= '</td></tr>';
			   
			   
			  
			}if(count($row_data)>0 && $table=="")
			  $ex_field .= '</table>';
			 /*echo '<pre>';
			 print_r ($ex_field);
			 exit;*/
		 return $ex_field;
	}	 	 
	function list_all_field($field_section="",$hid="",$section_id=0,$field_name="",$table="") {	
		
		$db = JFactory::getDbo();
		$option = JRequest::getVar('option','','','string');
		$uri = JURI::getInstance();
		$url= $uri->root();		
	
		 $q = "SELECT * FROM ".$this->_table_prefix."fields WHERE field_section='".$field_section."' AND published=1 ORDER BY ordering";
		if($field_name!="")
		{
			$q .= "and field_name in ($field_name)";
		}
		$db->setQuery($q);
		$row_data=$db->loadObjectlist();
		$ex_field='';
		if(count($row_data)>0 && $table=="")
		$ex_field='<table class="admintable" border="0">';
		
		for($i=0;$i<count($row_data);$i++)
		{
		 
			if($row_data[$i]->is_required==1)
				$reqiure_field=' *';
			else
				$reqiure_field='';
			
			$type=$row_data[$i]->field_type;
			
			if($type==11 )
			{
				
				$ex_field .= '<tr>
			<td valign="top" class="key" colspan="2" align="center" >
			<label for="name" style="font-weight:bold">
			'.$row_data[$i]->field_title.'	
			</label>
			'; 
			}
			else if($type==10)
			{
				$ex_field .= '<tr>
			<td valign="top" class="key" colspan="2" align="center">
			
			';
			}
			else
			{
					$ex_field .= '<tr><td valign="top" class="key" colspan="2" align="center"> <label for="name">'.$row_data[$i]->field_title.'</label></td><td>';
			
			}
		 /*$sql="select * from ".$this->_table_prefix."fields_data where fieldid='".$row_data[$i]->field_id."' and itemid='".$section_id."' and section='".$field_section."' ";*/
		
		$sql="select * from ".$this->_table_prefix."fields_data where fieldid='".$row_data[$i]->field_id."' and hid='".$hid."' and section='".$field_section."' ";
		
			$db->setQuery($sql);
			$data_value=$db->loadObject();
			
			//print_r($data_value->data_txt);
			switch ($type) {
		
				case 1: // 1 :- Text Field
						if($data_value)
						{
						if($data_value->data_txt)
						$text_value=$data_value->data_txt;
						else
						$text_value='';
						}
						else
						$text_value='';
						
			        	$ex_field .='<input class="'.$row_data[$i]->field_class.'" type="text" maxlength="'.$row_data[$i]->field_maxlength.'"  name="'.$row_data[$i]->field_name.'"  id="'.$row_data[$i]->field_name.'" value="'.$text_value.'" size="32" />';			        				
				        break;
				case 2: // 2 :- Text Area
						if($data_value)
						{
						if($data_value->data_txt)
						$textarea_value=$data_value->data_txt;
						else
						$textarea_value='';
						}
						else
						$textarea_value='';
						
			        	$ex_field .='<textarea class="'.$row_data[$i]->field_class.'"  name="'.$row_data[$i]->field_name.'"  id="'.$row_data[$i]->field_name.'" cols="'.$row_data[$i]->field_cols.'" rows="'.$row_data[$i]->field_rows.'" >'.$textarea_value.'</textarea>';			
				        break;
				case 3: // 3 :- Check Box
				  		$q = "SELECT * from ".$this->_table_prefix."fields_value where field_id='".$row_data[$i]->field_id."' ";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->field_value,$chk_data))
						$checked=' checked="checked" ';
						else
						$checked='';
			        	$ex_field .='<input  class="'.$row_data[$i]->field_class.'" type="checkbox"  '.$checked.' name="'.$row_data[$i]->field_name.'[]"  id="'.$row_data[$i]->field_name."_".$field_chk[$c]->value_id.'" value="'.$field_chk[$c]->field_value.'" /> '.$field_chk[$c]->field_value.'<br />';
						}			
				        break;
				 case 4: // 4 :- Radio Button
				  		$q = "SELECT * from ".$this->_table_prefix."fields_value where field_id='".$row_data[$i]->field_id."' ";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->field_value,$chk_data))
						$checked=' checked="checked" ';
						else
						$checked='';
			        	$ex_field .='<input class="'.$row_data[$i]->field_class.'" type="radio" '.$checked.'  name="'.$row_data[$i]->field_name.'"  id="'.$row_data[$i]->field_name."_".$field_chk[$c]->value_id.'" value="'.$field_chk[$c]->field_value.'" /> '.$field_chk[$c]->field_value.'<br />';
						}			
				        break;
				  case 5: // 5 :-Select Box (Single select)
				  		$q = "SELECT * from ".$this->_table_prefix."fields_value where field_id='".$row_data[$i]->field_id."' ";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						$ex_field .='<select name="'.$row_data[$i]->field_name.'">';
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->field_value,$chk_data))
						$selected=' selected="selected" ';
						else
						$selected='';
			        	$ex_field .='<option value="'.$field_chk[$c]->field_value.'" '.$selected.' >'.$field_chk[$c]->field_value.'</option>';
						}			
						$ex_field .='</select>';
				        break;
				    case 6: // 6 :- Select Box (Multiple select) 
				  		$q = "SELECT * from ".$this->_table_prefix."fields_value where field_id='".$row_data[$i]->field_id."' ";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						$ex_field .='<select multiple size=10 name="'.$row_data[$i]->field_name.'[]">';
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->field_value,$chk_data))
						$selected=' selected="selected" ';
						else
						$selected='';
			        	$ex_field .='<option value="'.$field_chk[$c]->field_value.'" '.$selected.' >'.$field_chk[$c]->field_value.'</option>';
						}			
						$ex_field .='</select>';
				        break;    
				     case 7: // 5 :-Select Country box
				  		$q = "SELECT * from ".$this->_table_prefix."country";
						$db->setQuery($q);
						$field_chk=$db->loadObjectlist();
						$chk_data=@explode(",",$data_value->data_txt);
						$ex_field .='<select name="'.$row_data[$i]->field_name.'">';
						for($c=0;$c<count($field_chk);$c++)
						{
						if(@in_array($field_chk[$c]->country_id,$chk_data))
						$selected=' selected="selected" ';
						else
						$selected='';
			        	$ex_field .='<option value="'.$field_chk[$c]->country_id.'" '.$selected.' >'.$field_chk[$c]->country_name.'</option>';
						}			
						$ex_field .='</select>';
				        break;
				      case 8: // 8 :- Wysiwyg
				      	$editor = JFactory::getEditor();	
						if($data_value)
						{
						if($data_value->data_txt)
						$textarea_value=$data_value->data_txt;
						else
						$textarea_value='';
						}
						else
						$textarea_value='';
						
						$ex_field .=$editor->display($row_data[$i]->field_name,$textarea_value,'200','50','100','20','0');
			        //	$ex_field .='<textarea class="'.$row_data[$i]->field_class.'"  name="'.$row_data[$i]->field_name.'"  id="'.$row_data[$i]->field_name.'" cols="'.$row_data[$i]->field_cols.'" rows="'.$row_data[$i]->field_rows.'" >'.$textarea_value.'</textarea>';
			        			
				        break;
					case 9: // 1 :- Text Field
						if($data_value)
						{
						if($data_value->data_txt)
						$file_value=$data_value->data_txt;
						else
						$file_value='';
						}
						else
						$file_value='';
						
			        	$ex_field .='<input class="'.$row_data[$i]->field_class.'" type="file" maxlength="'.$row_data[$i]->field_maxlength.'"  name="'.$row_data[$i]->field_name.'"  id="'.$row_data[$i]->field_name.'" value="'.$file_value.'" size="32" />';
						
						$dest=$url."components/".$option ."/assets/images/".$file_value;
						//$link = '<a href="'.$dest.'" ></a>';
			        	$ex_field .='&nbsp;<a href="'.$dest.'" >'.$file_value .'</a>';
						
						$ex_field .= '<input class="'.$row_data[$i]->field_class.'" type="hidden" maxlength="'.$row_data[$i]->field_maxlength.'"  name="old_'.$row_data[$i]->field_name.'"  id="old_'.$row_data[$i]->field_name.'" value="'.$file_value.'" size="32" />';  						
											
						break;
					
					case 10: // 1 :- HR Field
						if($data_value)
						{
						if($data_value->data_txt)
						$hr_value=$data_value->data_txt;
						else
						$hr_value='';
						}
						else
						$hr_value='';
						
			        	$ex_field .='<hr class="none" name="none"  id="none" maxlength="0" title="none"/>';		        				
				        break;
					
					case 11: // 11 :- Label Field
						if($data_value)
						{
						if($data_value->data_txt)
						$label_value=$data_value->data_txt;
						else
						$label_value='';
						}
						else
						$label_value='';
						
			        	$ex_field .='';			        				
				        break;
						
					case 12: // 12 :- Date Field
						if($data_value)
						{
						if($data_value->data_txt)
						$date_value=$data_value->data_txt;
						else
						$date_value='';
						}
						else
						$date_value='';
						
						
			        	$ex_field .='<input type="text" class="'.$row_data[$i]->field_class.'" name="'.$row_data[$i]->field_name.'" id="'.$row_data[$i]->field_name.'" value="'.$date_value.'"/> <img class="calendar" src="templates/system/images/calendar.png" alt="calendar" id="intro_date_img" />';
						
							$ex_field .='<script type="text/javascript">
							Calendar.setup(
							  {
								inputField  : "'.$row_data[$i]->field_name.'",         // ID of the input field
								ifFormat    : "%d-%m-%Y",    // the date format
								button      : "intro_date_img"       // ID of the button
							  }
							);

						</script>';	
						    				
				        break;
						
					case 13: // 13 :- Password Field
						if($data_value)
						{
						if($data_value->data_txt)
						$password_value=$data_value->data_txt;
						else
						$password_value='';
						}
						else
						$password_value='';
						
			        	$ex_field .='<input class="'.$row_data[$i]->field_class.'" type="password" maxlength="'.$row_data[$i]->field_maxlength.'"  name="'.$row_data[$i]->field_name.'"  id="'.$row_data[$i]->field_name.'" value="'.$password_value.'" size="32" />';			        				
				        break;
						
				     }
					 
			
			 	if($type!=11 && $type!=10 )
				{
			   $ex_field .= '</td>
			   <td valign="top">&nbsp; '.JHTML::tooltip($row_data[$i]->field_desc, $row_data[$i]->field_name, 'tooltip.png', '', '', false);
			
			 }
		   
		   $ex_field .= '</td></tr>';
			   
		}

		return $ex_field;
	}
	
function extra_field_save($data,$field_section,$hid="")	{ 
		$option = JRequest::getVar('option','','','string');
		
		$uri = JURI::getInstance();
		$url= $uri->root();	
		
		$db = JFactory::getDbo();		
		$q = "SELECT * from ".$this->_table_prefix."fields where field_section in (".$field_section.")  ";
		
		$db->setQuery($q);
		$row_data=$db->loadObjectlist();
		
		
		
		$sql="delete from ".$this->_table_prefix."fields_data where section='".$field_section."' and hid ='".$hid."' ";
		$db->setQuery($sql);
		$db->query();
		
		
		for($i=0;$i<count($row_data);$i++)
		{
			$row_data[$i]->field_name;
			$file = JRequest::getVar($row_data[$i]->field_name, '', 'files', 'array' );//Get File name, tmp_name
			$src=$file['tmp_name'];
			$data_file = $row_data[$i]->field_type;
			if($data_file==9)
			{
				if($file['name']!="")
				{
					if($data["old_".$row_data[$i]->field_name])
					{
						$dest_del = JPATH_ROOT.'/'.'components/'.$option.'/assets/images/'.$data["old_".$row_data[$i]->field_name]; //specific path of the file
						unlink($dest_del);
					}
					$src=$file['tmp_name'];
					$file['name'] = time().'_'.$file['name'];
					$dest = JPATH_ROOT.'/'.'components/'.$option.'/assets/images/'.$file['name']; //specific path of the file
					JFile::upload($src,$dest);	
					$data_txt=$file['name'];
				}
				else
				{
					$dest_del = JPATH_ROOT.'/'.'components/'.$option.'/assets/images/'.$data["old_".$row_data[$i]->field_name];
					$data_txt=$data["old_".$row_data[$i]->field_name];
				}
						
			} else if($row_data[$i]->field_type==2 || $row_data[$i]->field_type==8) {
				$data_txt	= JRequest::getVar( $row_data[$i]->field_name, '', 'post', 'string', JREQUEST_ALLOWRAW );
				
			}
			else
			{
				if(isset($data[$row_data[$i]->field_name]))
					$data_txt= $data[$row_data[$i]->field_name];
				else
					$data_txt='';
			
				if(is_array($data_txt))
				{
					$data_txt=implode(",",$data_txt);
				}			
				$sect=explode(",",$field_section);
			}
						
			if(count($sect)==0)
			{
				$sql="insert into ".$this->_table_prefix."fields_data (fieldid,data_txt,section,hid) value ('".$row_data[$i]->field_id."','".$data_txt."','".$field_section."','".$hid."')";
			}
			else
			{
				for($h=0;$h<count($sect);$h++)
				{ 
					$sql="insert into ".$this->_table_prefix."fields_data (fieldid,data_txt,section,hid) value ('".$row_data[$i]->field_id."','".$data_txt."','".$sect[$h]."','".$hid."')";		 	
				}
			}
			$db->setQuery($sql);
			$db->query();
		}   
	}
	
		
}
?>
