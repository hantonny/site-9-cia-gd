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
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
        	<tr>
			<td width="100" align="right" class="key">
				<label for="subcat">
					<?php echo JText::_( 'Category Under' ); ?>:
				</label>
			</td>
			<td>
			        <select name="subcat" id="subcat" class="text_area">
				          
                          <?php
		//$banner=getBanner($this->odudecard->cat);

		
		//if($banner['subcat']=='0')
		//echo "<option value=0 selected=selected>Primary</option><option value=0>---------------</option>";
		//else
		echo "<option value=0 >Primary</option><option value=0>---------------</option>";

		
		$subcat=getCategory();
				
		for( $j=0; $j<count($subcat); $j++ )
		{
		$subcategory = $subcat[$j];
		
					$check="";
					//if($banner['subcat']==$subcategory->cat)
					//$check="selected=selected";
		
		//if($subcategory->cat!=$this->odudecard->cat)
		echo "\n\r<option value='".$subcategory->cat."' ".$check.">".$subcategory->name."</option>";
		
		}
						  ?>
				          

			            </select>

			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Category' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="name" id="name" size="32" maxlength="250"  />
			</td>
		</tr>
        	<tr>
			<td width="100" align="right" class="key">
				
			</td>
			<td>
			Banner & Background can be added at the time of editing of categories.

			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_odudecard" />
<!-- Hidden field cat is set as same like in primary key at table -->
<input type="hidden" name="cat" value="" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="odudecardcatnew" />
</form>
