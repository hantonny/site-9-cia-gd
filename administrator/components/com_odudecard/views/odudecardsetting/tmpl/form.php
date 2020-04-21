<?php 
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 defined('_JEXEC') or die('Restricted access'); ?>
<?php
 require_once ( JPATH_SITE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
 
 $doc = JFactory::getDocument();
 $doc->addStyleSheet('../components/com_odudecard/template/default/default.css');
$setting=getSetting();
$u = JURI::getInstance();
/*
if(substr(decoct(fileperms(JPATH_ROOT.DS.'media'.DS.'ecard'.DS)),3)=='77')
echo "<b>Image Path</b> --- Images are stored inside ".JPATH_ROOT.DS.'media'.DS.'ecard'.DS;
else
echo JPATH_ROOT.DS.'media'.DS.'ecard'.DS." is <b>not writable</b>. <font color=red>Please set chomod 777</font>";

*/
$filename = JPATH_ROOT.DS.'media'.DS.'ecard'.DS;

if (is_dir($filename) && is_writable($filename)) {
    echo "<b>Image Path</b> --- Images are stored inside ".JPATH_ROOT.DS.'media'.DS.'ecard'.DS;
} else {
    echo JPATH_ROOT.DS.'media'.DS.'ecard'.DS." is <b>not writable or exists</b>. <font color=red>Please set chomod 777</font>";
}


//echo "<br><br><b>Facebook Iframe Convas URL </b> :  ".JURI::root()."index.php?option=com_odudecard&view=facebook&format=raw" ;

echo "<br><br><b>Default CSS File</b> : ".JPATH_SITE .DS.'components'.DS.'com_odudecard'.DS.'template'.DS.'default'.DS.'default.css' ;

echo "<br><br><b>Location of watermark.png</b> : ".JPATH_SITE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'watermark.png' ;
$odude_profile=JPATH_ROOT.DS.'components'.DS.'com_odudecard'.DS.'views'.DS.'facebook'.DS;
/*
if (!file_exists($odude_profile."view.raw.php"))
{
  echo "<br><BR><font color=red>ODude Ecard Facebook Apps Not installted. Get it from www.ODude.com</font>";
}
*/
?>

    


<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col width-60">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable"  width="500">
		
			<input name="version" id="version" value="1" type="hidden"> 
   
    <tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Enable EasySocial Point' ); ?>:
				</label>
			</td>
			<td>
			<input name="point"  id="point"  value="0" type="radio" checked > Disable (PRO)
			</td>
		</tr>
		<tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Member Restriction' ); ?>:
				</label>
			</td>
			<td>
			<input name="member_restrict" id="member_restrict" value="1" type="radio" <?php echo ($setting->member_restrict==1) ? "checked" : "" ?>> Enable <input name="member_restrict"  id="member_restrict"  value="0" type="radio" <?php echo ($setting->member_restrict==0) ? "checked" : "" ?>> Disable 
			</td>
		</tr>
		<tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'reCAPTCHA' ); ?>:
				</label>
			</td>
			<td>
			<input name="captcha"  id="captcha"  value="0" type="radio" checked> Disable (PRO)
			</td>
		</tr>
		    <tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'reCAPTCHA Site Key' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="captcha_key" id="captcha_key"  value="<?php echo $this->odudecard->captcha_key;?>" />
			</td>
		</tr>
		<tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'reCAPTCHA Secret Key' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="captcha_secret" id="captcha_secret"  value="<?php echo $this->odudecard->captcha_secret;?>" />
			</td>
		</tr>
		<tr>
		<tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Watermark' ); ?>:
				</label>
			</td>
			<td>
		<input name="watermark"  id="watermark"  value="0" type="radio" checked> Disable (PRO)
			</td>
		</tr>
		<tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Share / Bookmark' ); ?>:
				</label>
			</td>
			<td>
		<input name="share" id="share" value="1" type="radio" <?php echo ($setting->share==1) ? "checked" : "" ?>> Enable <input name="share"  id="share"  value="0" type="radio" <?php echo ($setting->share==0) ? "checked" : "" ?>> Disable 
			</td>
		</tr>
		<tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Multiple Email addresses' ); ?>:
				</label>
			</td>
			<td>
	<input name="import"  id="import"  value="0" type="radio" checked> Disable 
			</td>
		</tr>
		<tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Add no. of Receiver' ); ?>:
				</label>
			</td>
			<td>
		<input name="add_rec"  id="add_rec"  value="0" type="radio" checked> Disable (PRO)
			</td>
		</tr>
    <tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Days to expire' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="expire" id="expire" size="5" maxlength="3" value="<?php echo $this->odudecard->expire;?>" />
			</td>
		</tr>
		<tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'View Limit' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="viewlimit" id="viewlimit" size="10" maxlength="3" value="<?php echo $this->odudecard->viewlimit;?>" />
			</td>
		</tr>
		 <tr>
			<td width="200" align="right" class="key" valign=top>
				<label for="name">
					<?php echo JText::_( 'Layout' ); ?>:
				</label>
			</td>
			<td>
								
			<select name="a2" id="a2" class="text_area">	  
				  <?php
				  
				  $currency=$this->odudecard->a2; 
if ($handle = opendir(JPATH_ROOT."/components/com_odudecard/template/"))
 {
    $blacklist = array('.', '..', 'somedir', 'index.html','pure-min.css','grids-responsive-min.css');
    while (false !== ($file = readdir($handle))) 
	{
        if (!in_array($file, $blacklist)) 
		{
		?>
		<option value="<?php echo $file; ?>" <?php if ($currency==$file) echo 'selected="selected"';?>><?php echo $file; ?></options>
		<?php
           // echo "$file\n";
        }
    }
    closedir($handle);
}
?>
</select>
				
	<hr>
      </td>
		</tr>
			<tr>
			<td width="100" align="right" class="key" valign=top>
				<label for="name">
					<?php echo JText::_( 'JPEG Large Width' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="large_width" id="large_width" size="10" maxlength="4" value="<?php echo $this->odudecard->large_width;?>" />
			Eg. 535   &nbsp;<hr>
      </td>
		</tr>
			<tr>
			<td width="100" align="right" class="key" valign=top>
				<label for="name">
					<?php echo JText::_( 'JPEG Thumbnail Width' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="thumb_width" id="thumb_width" size="10" maxlength="4" value="<?php echo $this->odudecard->thumb_width;?>" />
			Eg. 120   &nbsp;<hr>
      </td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Flash size Width' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="width" id="width" size="10" maxlength="4" value="<?php echo $this->odudecard->width;?>" />
			Eg. 535   &nbsp;
      </td>
		</tr>
			<tr>
			<td width="100" align="right" class="key" valign=top>
				<label for="name">
					<?php echo JText::_( 'Flash size Height' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="height" id="height" size="10" maxlength="4" value="<?php echo $this->odudecard->height;?>" />
				Eg. 278<hr>
      </td>
		</tr>
		<tr>
			<td width="100" align="right" valign=top class="key">
				<label for="name">
					<?php echo JText::_( 'YouTube Video Size' ); ?> Width<br><br>YouTube Video Size Height:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="tubewidth" id="tubewidth" size="10" maxlength="4" value="<?php echo $this->odudecard->tubewidth;?>" />
			Eg. 535   &nbsp;
				<input class="text_area" type="text" name="tubeheight" id="tubeheight" size="10" maxlength="4" value="<?php echo $this->odudecard->tubeheight;?>" /> 
				Eg. 278<hr>

      </td>
		</tr>
			<tr>
			<td width="100" align="right" valign=top class="key">
				<label for="name">
					<?php echo JText::_( 'MP4,M4v Video Size' ); ?> Width <br><br>MP4,M4v Video Size Height
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="videowidth" id="videowidth" size="10" maxlength="4" value="<?php echo $this->odudecard->videowidth;?>" />
			Eg. 535   &nbsp;
				<input class="text_area" type="text" name="videoheight" id="videoheight" size="10" maxlength="4" value="<?php echo $this->odudecard->videoheight;?>" />Eg. 278 
				<br>(Fixed Thumbnail size = 120x90)<hr>

      </td>
		</tr>
     <tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'FFMPEG path' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="ffmpeg" id="ffmpeg" size="32" maxlength="250" value="<?php echo $this->odudecard->ffmpeg;?>" />
			 <br>Eg. /usr/bin/ffmpeg or C:\wamp\bin\ffmpeg.exe
      </td>
		</tr>
    
       
        
        		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Card Per Row' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="card_row" id="card_row" size="32" maxlength="250" value="<?php echo $this->odudecard->card_row;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Card Per Page' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="card_page" id="card_page" size="32" maxlength="250" value="<?php echo $this->odudecard->card_page;?>" />
			</td>
		</tr>
        		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'From Email' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="from_email" id="from_email" size="32" maxlength="250" value="<?php echo $this->odudecard->from_email;?>" />
			</td>
		</tr>
        		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'From Name' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="from_name" id="from_name" size="32" maxlength="250" value="<?php echo $this->odudecard->from_name;?>" />
			</td>
		</tr>
        		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Subject Suffix' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="subject_suffix" id="subject_suffix" size="32" maxlength="250" value="<?php echo $this->odudecard->subject_suffix;?>" />
			</td>
		</tr>

	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_odudecard" />
<!-- Hidden field cat is set as same like in primary key at table -->
<input type="hidden" name="id" value="<?php echo $this->odudecard->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="odudecardsetting" />
</form>

<div class="box">
  <fieldset class="adminform" >
  <legend>Current Settings Preview</legend>

			
				<div class="menu">

				  <div class="bar" align="center">Categories</div>
				  <ul>
				    <li>Sample 1</li>
                    <li><a href="#">Sample 2</a></li>
			      </ul>
    </div>
				<p>&nbsp;</p>
  </fieldset>
            </div>
