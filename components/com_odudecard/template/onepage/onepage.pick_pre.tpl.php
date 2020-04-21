	
  <style type="text/css">
.box {
	background-image: url(<?php echo JURI::root() ?>media/ecard/<?php echo $catid->bg ?>);
	width:100%;
}

</style>
	<div class="pure-g-r">
	<div class="pure-u-1" style="text-align:center;">
	<?php

	if($catid->banner!="")
	echo "<img src=\"".JURI::base()."media/ecard/".$catid->banner."\" alt=\"".$catid->name."\"  />";

	?>
	</div>
	<div class="pure-u-1" style="text-align:center;">
	
			<div class=box>
				<div class=bar align="center">
						<?php 
					 
					  echo $catid->name;
					   ?>
				</div>
				<?php echo JText::_('COM_ODUDECARD_ECARD_HELLO'); ?> <?php echo $name[0];  ?>, <?php echo JText::_('COM_ODUDECARD_ECARD_YOU'); ?><br />
				<?php echo $cardid['code']; ?><br>
				<?php
 		if($cardid['type']=='J')
 		{
              if($setting->watermark=='1')
               {
                echo "<img src='".JURI::base()."components/com_odudecard/include/watermark.php?src=".JURI::base()."media/ecard/".$cardid['image']."' alt='".$cardid['title']."' border=1><br>";
              }
               else
               {
                   echo "<img src='".JURI::base()."media/ecard/".$cardid['image']."' alt='".$cardid['title']."' border=1><br>".$cardid['title'];
             }

         }
         
		if($cardid['type']=='F')
		echo "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\" width=\"".$setting->width."\" height=\"".$setting->height."\" id=".$cardid['title']." align=\"middle\"><param name=\"allowScriptAccess\" value=\"sameDomain\" /><param name=\"movie\" value=".JURI::base()."media/ecard/".$cardid['image']." /><param name=\"quality\" value=\"high\" /><embed src=".JURI::base()."media/ecard/".$cardid['image']." quality=\"high\"  width=\"".$setting->width."\" height=\"".$setting->height."\" name=".$cardid['title']." align=\"middle\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /></object><br>".$cardid['title'];


    if($cardid['type']=='Y')
    echo "<iframe src=\"http://www.youtube.com/embed/".$cardid['thumb']."\" width=\"".$setting->tubewidth."\" height=\"".$setting->tubeheight."\" frameborder=\"0\"></iframe><br>".$cardid['title'];

    if($cardid['type']=='V')
    {
   
	$doc->addStyleSheet('components/com_odudecard/include/video-js.min.css');
$doc->addScript('components/com_odudecard/include/video.min.js');
    echo "<video id=\"example_video_1\" class=\"video-js vjs-default-skin\" controls preload=\"none\" width=\"".$setting->videowidth."\" height=\"".$setting->videoheight."\" data-setup=\"{}\"><source src=".JURI::base()."media/ecard/".$cardid['image']." type='video/mp4' /> </video>";
		
		}
		?><br>
<?php
if($params->get( 'show_postedby')=='1')
{

 echo JText::_('COM_ODUDECARD_POSTED_BY'); ?>  :<a href='<?php echo JRoute::_('index.php?option=com_odudecard&controller=cardmylist&Itemid='.$mymenuitem.'&id='.$cardid['username']); ?>' > <?php echo $cardid['username']; ?> </a>

<br />
<?php 
}
?>
			</div>	
			
			<div class="pure-u-1" style="text-align:left;">
			<div class=bar align="center"><?php echo JText::_('COM_ODUDECARD_ECARD_SENDER'); ?></div>
<?php
  $dispatcher = JDispatcher::getInstance();
  $dispatcher->trigger('getProfilePic', array('email',$SE,'icon' ));
?>  <BR>
<?php echo JText::_('COM_ODUDECARD_ECARD_SENDER_NAME'); ?>: <?php echo $SN;  ?><br />
<?php echo JText::_('COM_ODUDECARD_ECARD_SENDER_EMAIL'); ?>: <?php echo $SE;  ?><br />
<?php echo JText::_('COM_ODUDECARD_ECARD_DATE'); ?>: 
<?php 
if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $clock))
{
echo $clock;
}
else
{
echo JFactory::getDate()->Format('Y-m-d');
}

  ?>

<br />
<div class=bar align="center"><strong><?php echo $sub; ?></strong></div>
<pre><?php echo wordwrap($body);  ?></pre>
			</div>
	
	
	</div>
	</div>