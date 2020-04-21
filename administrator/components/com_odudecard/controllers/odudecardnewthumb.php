<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class odudecardsControllerodudecardnewthumb extends odudecardsController
{

	function __construct()
	{
		parent::__construct();

		$this->registerTask( 'add'  , 	'edit' );
	}
	function edit()
	{
		JRequest::setVar( 'view', 'odudecardnewthumb' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}


		
	function save()
	{
	
function createThumbSimple($source,$dest,$new_w,$new_h)
		{

			$x=0;
			$y=0;
			$size = getimagesize($source);
			$old_x = $size[0];
			$old_y = $size[1];

			$ratio1=$old_x/$new_w;
			$ratio2=$old_y/$new_h;
			if($ratio1>$ratio2)
			{
			$thumb_w=$new_w;
			$thumb_h=$old_y/$ratio1;
			}
			else
			{
			$thumb_h=$new_h;
			$thumb_w=$old_x/$ratio2;
			}

			$new_im = ImageCreatetruecolor($thumb_w,$thumb_h);
			$im = imagecreatefromjpeg($source);
			imagecopyresampled($new_im,$im,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
			imagejpeg($new_im,$dest,100);

		}

		
		$msg="Ecard Saved:</li>";

		
		$x=0;
		$title=$_REQUEST["title"];
		$cate=$_REQUEST["cat"];
		$type=$_REQUEST["type"];
		$desp=$_REQUEST["desp"];
		$twidth=$_REQUEST["twidth"];
		$owidth=$_REQUEST["owidth"];
		
		$tp=time();

    $file = JRequest::getVar('banner',null, 'files', 'array');
    jimport('joomla.filesystem.file');
	$filename = JFile::makeSafe($file['name']);
	$src = $file['tmp_name'];
	$dest = JPATH_ROOT.DS.'media'.DS.'ecard'.DS .$tp.'.jpg';
    $path=JPATH_ROOT.DS.'media'.DS.'ecard'.DS;

//if ( strtolower(JFile::getExt($filename) ) == 'jpg' || strtolower(JFile::getExt($filename) ) == 'JPG')
if ( $file['type']=='image/jpeg')
{
   if ( JFile::upload($src, $dest) )
   {


   $s=$dest;


   $d1=JPATH_ROOT.DS.'media'.DS.'ecard'.DS.'org_'.$tp.'.jpg';
   $sz1=$owidth;
   createThumbSimple($s,$d1,$sz1,0);

   $d2=JPATH_ROOT.DS.'media'.DS.'ecard'.DS.'thumb_'.$tp.'.jpg';
   $sz2=$twidth;
   createThumbSimple($s,$d2,$sz2,0);
   
    function cleanuserinput($dirty)
   {
		/*
		   if (get_magic_quotes_gpc())
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
	

    $user = JFactory::getUser();
                $db2 = JFactory::getDBO();
                $query2="insert into #__ecard_media(id,ddate,title,type,file,thumb,desp,effect,cat,published,username) values (null,now(),'".cleanuserinput($title)."','J','org_$tp.jpg','thumb_$tp.jpg','".cleanuserinput($desp)."','N','$cate',1,'$user->username')";
                $db2->setQuery($query2);
                $result = $db2->execute();


unlink($dest);


   }
   else
   {
     JError::raiseWarning( 0, JText::_('Error Saving picture'));
   }
}
else
{
    if($filename!="")
    JError::raiseWarning( 0, JText::_('Only JPG picture allowed'));
	//echo "only jpeg allowed";
}
		
		
	
  	//$model = $this->getModel('odudecardedit');

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
