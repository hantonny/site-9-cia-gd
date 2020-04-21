<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/ 

defined ( '_JEXEC' ) or die ( 'Restricted access' );
require_once(JPATH_COMPONENT.'/'.'helpers'.'/'.'thumbnail.php');

jimport ( 'joomla.application.component.controller' );
jimport('joomla.filesystem.file');
class contact_detailController extends JControllerForm 
{
	function __construct($default = array()) 
	{
		parent::__construct ( $default );
		$this->registerTask ( 'add', 'edit' );
		
	}
	function edit($key = NULL, $urlVar = NULL) 
	{
		
		JRequest::setVar ( 'view', 'contact_detail' );
		JRequest::setVar ( 'layout', 'default' );
		JRequest::setVar ( 'hidemainmenu', 1 );
		$model = $this->getModel ( 'contact_detail' );
		parent::display ();
	}
	function addcontact()
	{
		$post = JRequest::get('post','','','string');
		if(isset($post['check']))
		{
		
			$_SESSION['name'] = array();
			$_SESSION['email_contact'] = array();
			for($m=0;$m<count($post['check']);$m++)
			{
				 $name = 'name_'.$post['check'][$m];
				 $email_c = 'email_'.$post['check'][$m];
			//	 $_SESSION["email_contact"][] = $post["$name"];
		         $_SESSION["email_contact"][] = $post["$email_c"];
				
	
			}
			
		}
		$link = JRoute::_('index.php?option=com_jeecard&view=events&event_id=1&mydivid=1');
		?>
		<script language="javascript" type="text/javascript">
		window.parent.location= '<?php echo $link;?>';
		window.close();
		</script>
				
		<?php 
		exit;
		
		//$mainframe->redirect ( JRoute::_('index.php?option=' . $post['option'] . '&view=contact'), $msg );
		
	}
	function save($key = NULL, $urlVar = NULL) 
	{
		$mainframe = JFactory::getApplication();
		$option = JRequest::getWord ('option','','','string');
		$post = JRequest::get ( 'post' ); 
	
		$db = JFactory::getDbO();
		
		
		$userid = clone(JFactory::getUser());
		
		if($post['cid'])
		{
		  $sqluser="UPDATE #__jeecard_contact SET contact_name= '".$post["contact_name"]."',contact_email ='".$post["contact_email"]."',groupid=".$post['groupid']." WHERE cid=".$post['cid'] .' AND hostid='.$userid->id ;	
		}
		else	
		{	
			 $sqluser="INSERT INTO #__jeecard_contact VALUES('',".$userid->id.",'".$post["contact_name"]."','".$post["contact_email"]."',".$post["groupid"].")";	
		}
		
		
	 	$db->setQuery($sqluser);
	 	$temp = $db->query();
		
		if($temp)
		$msg = JText::_( 'CONTACT_ADDEDED_SUCCESSFULLY' );
		else
		$msg = JText::_( 'ERROR_IN_SAVING_CONTACT' );
		
		if($post['tmpl']=='component')
		$link = JRoute::_('index.php?option=' . $post['option'] . '&view=fetch_contact&tmpl=component');
		else
	 	$link = JRoute::_('index.php?option=' . $post['option'] . '&view=contact');
	 
		$mainframe->redirect ($link , $msg );
		
	}
	function remove() {
	
		
		$option = JRequest::getWord ('option','','','string');
				
		$cid = JRequest::getVar ('cid',0,'','array');
		
		
		
		if (! is_array ( $cid ) || count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'SELECT_AN_ITEM_TO_DELETE' ) );
		}
		
		$model = $this->getModel ( 'contact_detail' );
		if (! $model->delete ( $cid )) {
			echo "<script> alert('" . $model->getError ( true ) . "'); window.history.go(-1); </script>\n";
		}
		$msg = JText::_ ( 'CONTACT_DELETED_SUCCESSFULLY' );
		$this->setRedirect ( JRoute::_('index.php?option='.$option.'&view=contact'),$msg );
	}
	
	function cancel($key = NULL) {
		
		$option = JRequest::getWord ('option','','','string');
		$msg = JText::_ ( 'CONTACT_EDITING_CANCELLED' );
		$this->setRedirect ( JRoute::_('index.php?option='.$option.'&view=contact'),$msg );
	}

	
	

}
?>

