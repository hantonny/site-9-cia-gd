	<div class="pure-g-r">
	<div class="pure-u-1" style="text-align:center;">
	<?php
	if($this->v=='o')
	if($this->cate_banner!="")
	echo "<img src=\"".JURI::base()."media/ecard/".$this->cate_banner."\" alt=\"".$this->cate_name."\"  />";

	?>
	</div>
	<div class="pure-u-1" style="text-align:center;">
	
			<div class=box>
				<div class=bar align="center">
						<?php 
					  if($this->v=='o')
					  echo $this->cate_name;
					   ?>
				</div>
				<?php echo JText::_('COM_ODUDECARD_ECARD_HELLO'); ?> <?php echo $this->RN;  ?>, <?php echo JText::_('COM_ODUDECARD_ECARD_YOU'); ?><br />
				<?php echo $this->code; ?><br>
				<?php
 		if($this->type=='J')
 		{
              if($setting->watermark=='1')
               {
                echo "<img src='".JURI::base()."components/com_odudecard/include/watermark.php?src=".JURI::base()."media/ecard/".$this->image."' alt='".$this->title."' border=1><br>";
              }
               else
               {
                   echo "<img src='".JURI::base()."media/ecard/".$this->image."' alt='".$this->title."' border=1><br>".$this->title;
             }

         }
         
		if($this->type=='F')
		echo "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\" width=\"".$setting->width."\" height=\"".$setting->height."\" id=".$this->title." align=\"middle\"><param name=\"allowScriptAccess\" value=\"sameDomain\" /><param name=\"movie\" value=".JURI::base()."media/ecard/".$this->image." /><param name=\"quality\" value=\"high\" /><embed src=".JURI::base()."media/ecard/".$this->image." quality=\"high\"  width=\"".$setting->width."\" height=\"".$setting->height."\" name=".$this->title." align=\"middle\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /></object><br>".$this->title;


    if($this->type=='Y')
    echo "<iframe src=\"http://www.youtube.com/embed/".$this->thumb."\" width=\"".$setting->tubewidth."\" height=\"".$setting->tubeheight."\" frameborder=\"0\"></iframe><br>".$this->title;

    if($this->type=='V')
    {
   
	$doc->addStyleSheet('components/com_odudecard/include/video-js.min.css');
$doc->addScript('components/com_odudecard/include/video.min.js');
    echo "<video id=\"example_video_1\" class=\"video-js vjs-default-skin\" controls preload=\"none\" width=\"".$setting->videowidth."\" height=\"".$setting->videoheight."\" data-setup=\"{}\"><source src=".JURI::base()."media/ecard/".$this->image." type='video/mp4' /> </video>";
		
		}
		?><br>
<?php
if($params->get( 'show_postedby')=='1')
{

 echo JText::_('COM_ODUDECARD_POSTED_BY'); ?>  :<a href='<?php echo JRoute::_('index.php?option=com_odudecard&controller=cardmylist&Itemid='.$mymenuitem.'&id='.$this->username); ?>' > <?php echo $this->username; ?> </a>

<br />
<?php 
}
?>
			</div>	
			
			<div class="pure-u-1" style="text-align:left;">
			<div class=bar align="center"><?php echo JText::_('COM_ODUDECARD_ECARD_SENDER'); ?></div>
<?php
  $dispatcher = JDispatcher::getInstance();
  $dispatcher->trigger('getProfilePic', array('email',$this->SE,'icon' ));
?>  <BR>
<?php echo JText::_('COM_ODUDECARD_ECARD_SENDER_NAME'); ?>: <?php echo $this->SN;  ?><br />
<?php echo JText::_('COM_ODUDECARD_ECARD_SENDER_EMAIL'); ?>: <?php echo $this->SE;  ?><br />
<?php echo JText::_('COM_ODUDECARD_ECARD_DATE'); ?>: <?php echo $this->clock;  ?><br />
<div class=bar align="center"><strong><?php echo $this->sub; ?></strong></div>
<pre><?php echo wordwrap($this->body);  ?></pre>
			</div>
	
	
	</div>
	</div>