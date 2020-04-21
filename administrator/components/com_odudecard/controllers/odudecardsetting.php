<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class odudecardsControllerodudecardsetting extends odudecardsController
{
	function __construct()
	{
		parent::__construct();

		$this->registerTask( 'add'  , 	'edit' );
	}
	function edit()
	{
		JRequest::setVar( 'view', 'odudecardsetting' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	function save()
	{
		$model = $this->getModel('odudecardsetting');

		if ($model->store($post)) {
			$msg = JText::_( 'New Setting Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Setting' );
		}

		$link = 'index.php?option=com_odudecard&controller=odudecardsetting&task=edit&cid[]=1';
		$this->setRedirect($link, $msg);
	}

	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_odudecard&controller=odudecardsetting', $msg );
	}
}