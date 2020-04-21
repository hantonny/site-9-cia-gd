<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 defined('_JEXEC') or die('Restricted access'); ?>
<?php
require_once ( JPATH_ROOT .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );	  
$setting=getSetting();
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

		<table class="admintable">
        		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Ecard Type' ); ?>:
				</label>
			</td>
			<td>   <input type=hidden name=type value=J> JPEG E-Card for Auto Thumbnail

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
					//if($this->odudecard->cat==$subcategory->cat)
					//$check="selected=selected";

		
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
				<input class="text_area" type="text" name="title" id="title" size="32" maxlength="250"  />
			</td>
		</tr>
        		<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Ecard Large Picture' ); ?>:
				</label>
			</td>
			<td>
<input type="file" name="banner" id="banner" />

			</td>
		</tr>
        
		    
			<tr>
			<td width="100" align="right" class="key">
				<label for="name">
					<?php echo JText::_( 'Ecard text' ); ?>:
				</label>
			</td>
			<td>
			
				<textarea rows="5" cols="50" name="desp"  id="desp" class="text_area"></textarea>
			</td>
		</tr>
		
        
	</table>
	</fieldset>
</div>
<div class="clr"></div>
<input type="hidden" name="owidth" value="<?php echo $setting->large_width; ?>" />
<input type="hidden" name="twidth" value="<?php echo $setting->thumb_width; ?>" />
<input type="hidden" name="option" value="com_odudecard" />
<!-- Hidden field cat is set as same like in primary key at table -->
<input type="hidden" name="id" value="" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="odudecardnewthumb" />
</form>
