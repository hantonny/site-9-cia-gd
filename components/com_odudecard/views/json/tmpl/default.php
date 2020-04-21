<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 defined('_JEXEC') or die('Restricted access');
if(!defined('DS'))
{
   define('DS',DIRECTORY_SEPARATOR);
}
// Get the document object.
$document =& JFactory::getDocument();

// Set the MIME type for JSON output.
$document->setMimeEncoding('application/json');
$data = array();


function getCategory( )
    {
	$url=JURI::base().'images/ecard/'; 
	$q_id = JRequest::getVar('id', '0');
		$id=getSpecificId($q_id,'media');
	$liurl=JURI::base().'?option=com_odudecard&view=json&format=ajax&layout=ecard&id='; 
        $db = JFactory::getDBO();
		//$query = "select name,concat('$liurl',cat) as id,concat('$url',banner) as banner,subcat as bg from #__ecard_cate where subcat='$id' order by cat";
		$query = "select name,concat('$liurl',cat) as id,concat('$url',banner) as banner,subcat as bg from #__ecard_cate  order by subcat";
		$db->setQuery($query);
		$rows = $db -> loadObjectList();

		
		return $rows;
	
    }
	function getSub($params)
	{
	 		$db = JFactory::getDBO();
			$query = "select name,banner,bg,cat from #__ecard_cate where subcat='".$params."'";
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			return $rows;
	}
	
	

$catrows=getCategory();
//for( $i=0; $i<count($catrows); $i++ )
	//	{
			//$row = $catrows[$i];
		
		$data["Categories"]=$catrows;
		//echo "<a href=index.php?option=com_navneet&cate=".$row->cat.">".$row->name."</a><br>";
		
		
		//}
		
		
//mb_language('uni');
//mb_internal_encoding('UTF-8');

function jsonRemoveUnicodeSequences($struct) 
{
   return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($struct));
}		
		
//echo json_encode(array_map('base64_encode', $data));
		//echo stripslashes(json_encode($data));
		//echo stripslashes(json_encode(utf8_encode($data))); 
		//echo base64_encode(json_encode($data));
		//echo stripslashes(jsonRemoveUnicodeSequences($data));
		echo json_encode($data);
?>