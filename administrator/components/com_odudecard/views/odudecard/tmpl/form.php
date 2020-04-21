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
			$query = "select * from #__ecard_cate where subcat='0' order by name desc";
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			return $rows;
		
    }
	
	function getBanner($catid)
	{
	$query = "select * from #__ecard_cate where cat='".$catid."'";

	
	   $banner = array();
	   	$db = JFactory::getDBO();
		$db->setQuery($query);
		$rows = $db -> loadObjectList();

		if(count($rows)!=0)
		{
			
			$banner['name']=$rows[0]->name;
			$banner['banner']=$rows[0]->banner;
			$banner['bg']=$rows[0]->bg;
			$banner['cat']=$rows[0]->cat;
			$banner['front']=$rows[0]->front;
			$banner['subcat']=$rows[0]->subcat;
			return $banner;
			
		}
		else
		{
			return 'No Banner';		
		}

	}

?>
<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div class="col width-40">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable" width="700">
        	<tr>
			<td width="200" align="right" class="key">
				<label for="subcat">
					<?php echo JText::_( 'Category Under' ); ?>:
				</label>
			</td>
			<td>
			        <select name="subcat" id="subcat" class="text_area">
				          
                          <?php
		$banner=getBanner($this->odudecard->cat);

		
		if($banner['subcat']=='0')
		echo "<option value=0 selected=selected>Primary</option><option value=0>---------------</option>";
		else
		echo "<option value=0 >Primary</option><option value=0>---------------</option>";

		
		$subcat=getCategory();
				
		for( $j=0; $j<count($subcat); $j++ )
		{
		$subcategory = $subcat[$j];
		
					$check="";
					if($banner['subcat']==$subcategory->cat)
					$check="selected=selected";
		
		if($subcategory->cat!=$this->odudecard->cat)
		echo "\n\r<option value='".$subcategory->cat."' ".$check.">".$subcategory->name."</option>";
		
		}
						  ?>
				          

			            </select>

			</td>
		</tr>
		<tr>
			<td width="200" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Category' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="name" id="name" size="32" maxlength="250" value="<?php echo $this->odudecard->name;?>" />
			</td>
		</tr>
        	<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Banner' ); ?>:
				</label>
			</td>
			<td>
				<input type="file" name="banner" id="banner" />
                <?php echo $this->odudecard->banner;?>
                <input name="old_banner" type="hidden" id="old_banner" value="<?php echo $this->odudecard->banner;?>" />

			</td>
		</tr>
        	<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Background' ); ?>:
				</label>
			</td>
			<td>
								    <input type="file" name="bg" id="bg" />
				        <input name="old_bg" type="hidden" id="old_bg" value="<?php echo $this->odudecard->bg;?>" /><?php echo $this->odudecard->bg;?>

            </td>
		</tr>
        <tr>
			<td width="100" align="right" class="key">
				<label for="Frontpage">
					<?php echo JText::_( 'Highlighted' ); ?>:
				</label>
			</td>
			<td>
            <?php
                        
						if($banner['front']=='N')
						echo "<input name=front type=radio id=Y value=Y />Yes<input type=radio name=front id=N value=N  checked=checked />No";
						else
						echo "<input name=front type=radio id=Y value=Y checked=checked />Yes<input type=radio name=front id=N value=N />No";
						
						?>
            
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
	</table>
	</fieldset>
</div>
<div class="clr"></div>
<input type="hidden" name="option" value="com_odudecard" />
<!-- Hidden field cat is set as same like in primary key at table -->
<input type="hidden" name="cat" value="<?php echo $this->odudecard->cat; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="odudecard" />
</form>

<div class="col width-60">
			<fieldset class="adminform">
				<legend>Banner Image & Background Picture</legend>

				<table class="admintable" width="500">
				<tr>
					<td width="100%" valign="top" background="<?php  echo JURI::root().'media/ecard/'.$this->odudecard->bg ?>">
                        <?php
						if($banner['banner']!="")
						echo '<img src="'.JURI::root().'media/ecard/'.$this->odudecard->banner.'"> ..<br />';
						else
						echo "No Banner";
						?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />

					</td>
				</tr>
				</table>
			</fieldset>
		</div>
