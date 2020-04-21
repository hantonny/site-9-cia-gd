<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class odudecardsControllerodudecard extends odudecardsController
{
	function __construct()
	{
		parent::__construct();

		$this->registerTask( 'add'  , 	'edit' );
	}
	function edit()
	{
		JRequest::setVar( 'view', 'odudecard' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	function save()
	{
		
 function cleanuserinput($dirty)
 {

/* 			 if (get_magic_quotes_gpc())
			 {
			 $clean = mysql_real_escape_string(stripslashes($dirty));
			 }
			 else
			 {
			 $clean = mysql_real_escape_string($dirty);
			 }

			  return $clean;
 */
  $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
			$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

			return str_replace($search, $replace, $dirty);
  }

  //$title=cleanuserinput($_REQUEST["name"]);
    $title=$_REQUEST["name"];
		$front=$_REQUEST["front"];
		$id=$_REQUEST["cat"];
		$subcat=$_REQUEST["subcat"];
		$old_banner=$_REQUEST["old_banner"];
		$old_bg=$_REQUEST["old_bg"];
		$keyword=$_REQUEST["keyword"];
    	$db = JFactory::getDBO();
		if($front=='Y')
		{
				$query="update #__ecard_cate set front='N'";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();

		}
		
		$query="update #__ecard_cate set name='$title',front='$front',subcat='$subcat',slug='',keyword='$keyword' where cat=$id";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();

		$msg="Category Updated</li>";
	
		$path=JPATH_ROOT.DS.'media'.DS.'ecard'.DS;
		if ((($_FILES["banner"]["type"] == "image/gif")	|| ($_FILES["banner"]["type"] == "image/jpeg")		|| ($_FILES["banner"]["type"] == "image/pjpeg")))
		  {
			  if ($_FILES["banner"]["error"] > 0)
			{
			$msg.="<li>Return Code: " . $_FILES["banner"]["error"] . "</li>";
			}
		  else
			{
				if (file_exists("$path" . $_FILES["banner"]["name"]))
				  {
				  $msg.="<li>".$_FILES["banner"]["name"] . " already exists so banner not updated.</li>";
				  }
				else
				  {
					  
					unlink("$path".$old_banner);
				  $msg.="<li>Old banner deleted: " .$old_banner."</li>";
	
				  move_uploaded_file($_FILES["banner"]["tmp_name"],
				  "$path" . $_FILES["banner"]["name"]);
				  $msg.="<li>Banner stored in: " . "$path" . $_FILES["banner"]["name"]."</li>";
				  
					$query="update #__ecard_cate set banner='".$_FILES["banner"]["name"]."' where cat=$id";
					$db = JFactory::getDBO();
					$db->setQuery($query);
					$result = $db->execute();
	
				  }
			}
		  }
		else
		  {
		  $msg.="<li>Invalid file -- banner not updated. Only JPEG / GIF format allowed.</li>";
		  }
		  	
		if ((($_FILES["bg"]["type"] == "image/gif")
		|| ($_FILES["bg"]["type"] == "image/jpeg")
		|| ($_FILES["bg"]["type"] == "image/pjpeg")))
		  {
		  if ($_FILES["bg"]["error"] > 0)
			{
			$msg.="<li>Return Code: " . $_FILES["bg"]["error"] . "</li>";
			}
		  else
			{
			if (file_exists("$path" . $_FILES["bg"]["name"]))
			  {
			  $msg.="<li>".$_FILES["bg"]["name"] . " already exists so banner not updated.</li> ";
			  }
			else
			  {
			
						  	unlink("$path".$old_bg);
			  			  $msg.="<li>Old background deleted: " .$old_bg."</li>";

			move_uploaded_file($_FILES["bg"]["tmp_name"],
			  "$path" . $_FILES["bg"]["name"]);
			  $msg.="<li>Background stored in: " . "$path" . $_FILES["bg"]["name"]."</li>";
			  
			  	$query="update #__ecard_cate set bg='".$_FILES["bg"]["name"]."' where cat=$id";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();


			  }
			}
		  }
		else
		  {
		  $msg.="<li>Invalid file -- Background not updated. Only JPEG / GIF format allowed.</li>";
		  }

		$link = 'index.php?option=com_odudecard';
		$this->setRedirect($link, $msg);
	}

	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_odudecard', $msg );
	}
}
