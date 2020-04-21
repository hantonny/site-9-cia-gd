<?php 
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 defined('_JEXEC') or die('Restricted access'); ?>
<?php

	function getCategory()
    {
       
		   $db = JFactory::getDBO();
			$query = "select * from #__ecard_cate order by name desc";
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			return $rows;
		
    }
	
	
?>
<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable" width="700" >
        <tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Ecard Type' ); ?>:
				</label>
			</td>
			<td>
				<?php 
				if($this->odudecard->type=='Y')
        echo "YouTube Video";
        else if($this->odudecard->type=='F')
        echo 'SWF FLASH Movie' ;
        else
        echo "Image File";
        
        ?>

			</td>
		</tr>
        	<tr>
			<td width="100" align="right" class="key">
				<label for="subcat">
					<?php echo JText::_( 'Category' ); ?>:
				</label>
			</td>
			<td>
			        <select name="cat" id="cat" class="text_area">
				          
                          <?php

		
		$subcat=getCategory();
		
					
		for( $j=0; $j<count($subcat); $j++ )
		{
			
			
		$subcategory = $subcat[$j];
							$check="";
					if($this->odudecard->cat==$subcategory->cat)
					$check="selected=selected";

		
		echo "\n\r<option value='".$subcategory->cat."' ".$check.">".$subcategory->name."</option>";
		
		}
						  ?>
				          

			            </select>

			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Ecard Title' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="title" id="title" size="32" maxlength="250" value="<?php echo $this->odudecard->title;?>" />
			</td>
		</tr>
		<?php 
				if($this->odudecard->type=='Y')
				{
			?>
        		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'YouTube URL' ); ?>:
				</label>
			</td>
			<td>
<?php echo $this->odudecard->file;?>
 <input name="largepic" type="hidden" id="largepic" value="<?php echo $this->odudecard->file;?>" />

			</td>
		</tr>
 	<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'YouTube ID' ); ?>:
				</label>
			</td>
			<td>
 <?php echo $this->odudecard->thumb;?>
   <input name="old_thumb" type="hidden" id="old_thumb" value="<?php echo $this->odudecard->thumb;?>" />
			</td>
		</tr>
		<?php
     }
     else
     {
      ?>
          	<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Ecard Large Picture' ); ?>:
				</label>
			</td>
			<td>
<input type="file" name="banner" id="banner" />
 <input name="largepic" type="hidden" id="largepic" value="<?php echo $this->odudecard->file;?>" /><?php echo $this->odudecard->file;?>

			</td>
		</tr>
 	<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Ecard Thumbnail Picture' ); ?>:
				</label>
			</td>
			<td>
  <input type="file" name="bg" id="bg" />
   <input name="old_thumb" type="hidden" id="old_thumb" value="<?php echo $this->odudecard->thumb;?>" /><?php echo $this->odudecard->thumb;?>
			</td>
		</tr>
     <?php
     }
    ?>
    			<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Text/CSS/Javascript above Ecard' ); ?>:
				</label>
			</td>
			<td>
			
				<textarea rows="5" cols="50" name="code"  id="code" class="text_area"><?php echo $this->odudecard->code;?></textarea>
			</td>
		</tr>
			<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'META Description' ); ?>:
				</label>
			</td>
			<td>
			
				<textarea rows="5" cols="50" name="desp"  id="desp" class="text_area"><?php echo $this->odudecard->desp;?></textarea>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="keyword" class="hasTip" title="Keywords for search engine.">
					<?php echo JText::_( 'Search Engine Keywords' ); ?>:
				</label>
			</td>
			<td>
  	<input class="text_area" type="text" name="keyword" id="keyword" size="20"  value="<?php echo $this->odudecard->keyword;?>" />
  	Enter words seperated with commas.
			</td>
		</tr>

			<tr>
			<td width="100" align="right" class="key">
				<label for="point" class="hasTip" title="Point requires to send.">
					<?php echo JText::_( 'Ecard Point' ); ?>:
				</label>
			</td>
			<td>
  	<input class="text_area" type="text" name="point" id="point" size="10" maxlength="8" value="<?php echo $this->odudecard->point;?>" />
  	<br>
   Point system will only work if 'EasySocial' component is installed. <br>
   User should have sufficient point to send the card. <br>
   Point equls ZERO 0 means its FREE to send card.
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
<input type="hidden" name="controller" value="odudecardedit" />
</form>
