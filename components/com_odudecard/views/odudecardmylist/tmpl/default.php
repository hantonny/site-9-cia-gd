<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access');
if(!defined('DS')){
   define('DS',DIRECTORY_SEPARATOR);
}
//jimport('joomla.html.parameter');
$doc =JFactory::getDocument();
$doc->setMetaData( 'generator', 'ODude.com Ecard' );

//JHTML::stylesheet('default.css', 'components/com_odudecard/include/');

//$doc->addStyleSheet('components/com_odudecard/include/default.css');

require_once ( JPATH_BASE .DS.'components'.DS.'com_odudecard'.DS.'include'.DS.'lib.php' );
//JHTML::_('behavior.framework');
//JHTML::_('behavior.modal');
$mainframe = JFactory::getApplication();
$temp=$this->a2;
$doc->addStyleSheet('components/com_odudecard/template/'.$temp.'/'.$temp.'.css');
$doc->addStyleSheet('components/com_odudecard/template/pure-min.css');
$doc->addStyleSheet('components/com_odudecard/template/grids-responsive-min.css');
?>
<style type="text/css">
.box {
	border: 1px solid #BBDDFF;
	width:100%;
}

</style>
   <div id=card2>
   <center>
<?php 

	$doc = JFactory::getDocument();
  //$doc->setTitle($this->cate_name);
  
  $q_id = JRequest::getVar('id', '0');
		$id=getSpecificId($q_id,'media');
  if($id=='0')
  {
   $user = JFactory::getUser();
   $id=$user->username;
   
  }
  
 //$dispatcher = JDispatcher::getInstance(); 
 //$dispatcher->trigger('getProfilePic', array('username',$id,'icon' )); 
 echo '<br>'.$id;
$doc->setTitle($id." :: ".JText::_('COM_ODUDECARD_MY_ECARD'));
?>         </center>    </div>
<div class=box>
  <div class=bar align="center"><?php echo JText::_('COM_ODUDECARD_MY_ECARD'); ?></div>

<?php 
echo $this->listCard;
								
?>
</div>
  <br />
<?php 
echo $this->pagination;
								
?><br />
       <center>
         <!-- odude_ecard_footer --> 
         <?php
        
        $zone = "odude_footer";
        $modules =& JModuleHelper::getModules($zone);
        $i=0;
        foreach ($modules as $module)
        {
              echo "<div id=\"roundme\" class=\"odude_round_corner\"><div class=\"odude_form_heading\">";
        echo "<h3>".$modules[$i]->title."</h3>";
        
              echo JModuleHelper::renderModule($module);
              echo "</div></div><br>";
              $i++;
        }
       
       
       
       ?>
       </center>