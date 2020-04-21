<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class odudecardsControllerodudecardedit extends odudecardsController
{
	function __construct()
	{
		parent::__construct();

		$this->registerTask( 'add'  , 	'edit' );
	}

	function edit()
	{
		JRequest::setVar( 'view', 'odudecardedit' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	function save()
	{                 function cleanuserinput($dirty)
                             {

                             /* if (get_magic_quotes_gpc())
                             {
                             $clean = mysql_real_escape_string(stripslashes($dirty));
                             }
                             else
                             {
                             $clean = mysql_real_escape_string($dirty);
                             }

                              return $clean; */
							   $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
			$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

			return str_replace($search, $replace, $dirty);
			

                              }
		
				$msg="Editing Ecard ..... :</li>";

		
		$x=0;
		$cardid=$_REQUEST["id"];
  //$title=cleanuserinput($_REQUEST["title"]);
    $title=$_REQUEST["title"];
		$desp=$_REQUEST["desp"];
		$keyword=$_REQUEST["keyword"];
		$code=$_REQUEST["code"];
		$cate=$_REQUEST["cat"];
		$largepic=$_REQUEST["largepic"];
		$old_thumb=$_REQUEST["old_thumb"];
		$point=$_REQUEST["point"];
		$db = JFactory::getDBO();
		
		$query="update #__ecard_media set title=".$db->quote($title).",desp=".$db->quote($desp).",keyword=".$db->quote($keyword).",code=".$db->quote($code).",cat='$cate',point='".$point."' where id=$cardid";
				
				$db->setQuery($query);
				$result = $db->execute();

			$msg.="<li>Greetings Card Updated: $title</li>";
		
		$path=JPATH_ROOT.DS.'media'.DS.'ecard'.DS;
		//echo JPATH_ROOT;
		//echo '<hr>'.$query.'<hr>'.$_REQUEST["banner"];
		if ((($_FILES["banner"]["type"] == "image/gif")
		|| ($_FILES["banner"]["type"] == "image/jpeg")
		|| ($_FILES["banner"]["type"] == "image/pjpeg")))
		  {
		  if ($_FILES["banner"]["error"] > 0)
			{
			$msg.="<li>Return Code: " . $_FILES["banner"]["error"] . "</li>";
			}
		  else
			{
			if (file_exists("$path" . $_FILES["banner"]["name"]))
			  {
			  $msg.="<li>".$_FILES["banner"]["name"] . " already exists so large picture not updated.</li> ";
			  }
			else
			  {

			  $x=1;
			  unlink("$path".$largepic);
			  $msg.="<li>Old picture deleted: " .$largepic."</li>";

			  
			  move_uploaded_file($_FILES["banner"]["tmp_name"],
			  "$path" . $_FILES["banner"]["name"]);
			  $msg.="<li>Large picture stored in: " . "$path" . $_FILES["banner"]["name"]." </li>";

				$query="update #__ecard_media set file='".$_FILES["banner"]["name"]."' where id=$cardid";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();

			  
			  }
			}
		  }
		else
		  {
		  $msg.="<li>Invalid file -- Large picture not updated.</li>";
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
			  $msg.="<li>".$_FILES["bg"]["name"] . " already exists so thumbnail not updated.</li> ";
			  }
			else
			  {
			  
		  		
				//if($x==1)
				//{
					
				unlink("$path".$old_thumb);
			  $msg.="<li>Old thumbnail deleted: " .$old_thumb."</li>";

			  
			  move_uploaded_file($_FILES["bg"]["tmp_name"],
			  "$path" . $_FILES["bg"]["name"]);
			 $msg.="<li>Thumbnail stored in: " . "$path" . $_FILES["bg"]["name"]." </li>";
				
				$query="update #__ecard_media set thumb='".$_FILES["bg"]["name"]."' where id=$cardid";
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$result = $db->execute();


				
				
				//}
				//else
				//{
				//	echo "<li>".$_FILES["banner"]["name"]." Either large or thumbnail having problem. Please check extenstion, type and filename. </li>";	
				//}
			  
			  }
			}
		  }
		else
		  {
		  $msg.="<li>Invalid file -- Thumbnail not updated.</li>";
		  }



		$link = 'index.php?option=com_odudecard&controller=odudecardcard';
		$this->setRedirect($link, $msg);
		
}

	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_odudecard&controller=odudecardcard', $msg );
	}
}
