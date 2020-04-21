<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class odudecardsControllerodudecardnew extends odudecardsController
{
	function __construct()
	{
		parent::__construct();

		$this->registerTask( 'add'  , 	'edit' );
	}
	function edit()
	{
		JRequest::setVar( 'view', 'odudecardnew' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	function save()
	{
		            function cleanuserinput($dirty)
				   {

				   /* if (get_magic_quotes_gpc())
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
		$msg="Saving Ecard ...... :</li>";

		
		$x=0;
  //$title=cleanuserinput($_REQUEST["title"]);
  $title=$_REQUEST["title"];
		$cate=$_REQUEST["cat"];
		$type=$_REQUEST["type"];
 // $desp=cleanuserinput($_REQUEST["desp"]);
   $desp=$_REQUEST["desp"];
   $code=$_REQUEST["code"];
	
			$path=JPATH_ROOT.DS.'media'.DS.'ecard'.DS;
		if ((($_FILES["banner"]["type"] == "image/gif")	|| ($_FILES["banner"]["type"] == "image/jpeg")	|| ($_FILES["banner"]["type"] == "image/pjpeg")  || ($_FILES["banner"]["type"] == "application/x-shockwave-flash")))
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
	
					$x=1;
				  
					}
				}
		  }
			else
		  {
		  $msg.="<li>Invalid file -- Large picture not updated.[".$_FILES["banner"]["type"]."]</li>";

		  }
		  	if ((($_FILES["bg"]["type"] == "image/gif") || ($_FILES["bg"]["type"] == "image/jpeg")|| ($_FILES["bg"]["type"] == "image/pjpeg")))
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
			  
		  		
				if($x==1)
				{
					

					 move_uploaded_file($_FILES["banner"]["tmp_name"], "$path" . $_FILES["banner"]["name"]);
			  $msg.="<li>Large picture stored in: " . "$path" . $_FILES["banner"]["name"]." </li>";
			  
			  move_uploaded_file($_FILES["bg"]["tmp_name"], "$path" . $_FILES["bg"]["name"]);
			  $msg.="<li>Thumbnail stored in: " . "$path" . $_FILES["bg"]["name"]." </li>";
				$db = JFactory::getDBO();
				$user =& JFactory::getUser();
				$query="insert into #__ecard_media(id,ddate,title,type,file,thumb,desp,code,effect,cat,published,username) values(null,now(),'".cleanuserinput($title)."','$type','".$_FILES["banner"]["name"]."','".$_FILES["bg"]["name"]."','".cleanuserinput($desp)."','$code','N','$cate',1,'$user->username')";
			
				
				$db->setQuery($query);
				$result = $db->execute();
			//echo "<br>$query<br>";
			$msg.="<li>ECARD CREATED.</li>";
			
				}
				else
				{
					$msg.="<li>".$_FILES["banner"]["name"]." Either large or thumbnail having problem. Please check extenstion, type and filename. </li>";	
				}
			  
			  }
			}
		  }
		else
		  {
		  $msg.="<li>Invalid file -- Thumbnail not updated. </li>";
		  }

		
		
		$model = $this->getModel('odudecardedit');

		$link = 'index.php?option=com_odudecard&controller=odudecardcard';
		$this->setRedirect($link, $msg);
		//echo $msg;
}

	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_odudecard&controller=odudecardcard', $msg );
	}
}
