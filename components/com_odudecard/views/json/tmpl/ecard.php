<?php 
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access');
// Get the document object.
$document =& JFactory::getDocument();
 
// Set the MIME type for JSON output.
$document->setMimeEncoding('application/json');

$category = JRequest::getVar('id', 0, 'request', 'int');	
$data = array();
$r = array();
function getEcardList($category)
    {
	$url=JURI::base().'images/ecard/';
        $db = JFactory::getDBO();
		$query = "select id,title,desp,concat('$url',file) as file,concat('$url',thumb) as thumb from #__ecard_media where cat='$category' and published=1 and type='J' and point='0' order by ordering asc";
		$db->setQuery($query);
		$rows = $db -> loadObjectList();
	
		return $rows;
	
    }

$ecardrows=getEcardList($category);

for( $i=0; $i<count($ecardrows); $i++ )
		{
			//$category = $ecardrows[$i];
			$r["Ecards"]=$ecardrows;
			
			//$id=$category->id;
			//$title=$category->title;
			//$file=$category->file;
			//$thumb=$category->thumb;
			//$desp=$category->desp;
			
			//$r["Ecards"] [$i]=  array($id,$title,$file,$thumb,$desp);
				  
				  
		}

		
		
//echo stripslashes(json_encode($r));	
if(json_encode($r)=="[]")
echo '                                                                                                
{"Ecards":[]}';
else
echo json_encode($r);	
//print_r($r);
 ?>
 
 
 