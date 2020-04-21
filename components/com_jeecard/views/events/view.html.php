<?php
/**
* @package   JE Ecard
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
* Visit : http://www.joomlaextensions.co.in/
**/  

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );
 
class eventsViewevents extends JViewLegacy
{
	function __construct( $config = array())
	{
		 parent::__construct( $config );
	}
	
	function display($tpl = null)
	{	
		$mainframe = JFactory::getApplication();
		$context='';
		$uri	= JFactory::getURI();
		$allevents  = $this->get( 'Data');
		$category	= $this->get('category');
		$myid		= JRequest::getVar('myid', null, '', 'int');
		$event_id=JRequest::getVar('event_id','','','int');
		$limit_guests = array();
		$style	= $this->get('style');
		$limit_guests[]   = JHTML::_('select.option', '0', JText::_('Select one'));
		for($i=1;$i<11;$i++)
		{
			$limit_guests[]   = JHTML::_('select.option', $i,$i);
		//$limit_guests[]   = JHTML::_('select.option', '0', JText::_('NO'));
		}
		$lists['no_limit'] 		= JHTML::_('select.genericlist',$limit_guests, 'no_limit', 'class="" size="1" ', 'value', 'text' );
		$state_combo = array();
		$state_combo[]   = JHTML::_('select.option', '0', JText::_('Select State'));
		$state_combo[]   = JHTML::_('select.option', 'AL',JText::_('AL'));
		$state_combo[]   = JHTML::_('select.option', 'AK', JText::_('AK'));
		$state_combo[]   = JHTML::_('select.option', 'AZ',JText::_('AZ'));
		$state_combo[]   = JHTML::_('select.option', 'AR', JText::_('AR'));
		$state_combo[]   = JHTML::_('select.option', 'CA',JText::_('CA'));
		$state_combo[]   = JHTML::_('select.option', 'CO', JText::_('CO'));
		$state_combo[]   = JHTML::_('select.option', 'CT',JText::_('CT'));
		$state_combo[]   = JHTML::_('select.option', 'DE', JText::_('DE'));
		$state_combo[]   = JHTML::_('select.option', 'DC',JText::_('DC'));
		$state_combo[]   = JHTML::_('select.option', 'FL', JText::_('FL'));
		$state_combo[]   = JHTML::_('select.option', 'AL',JText::_('AL'));
		$state_combo[]   = JHTML::_('select.option', 'GA', JText::_('GA'));
		$state_combo[]   = JHTML::_('select.option', 'HI',JText::_('HI'));
		$state_combo[]   = JHTML::_('select.option', 'ID', JText::_('ID'));
		$state_combo[]   = JHTML::_('select.option', 'IL',JText::_('IL'));
		$state_combo[]   = JHTML::_('select.option', 'IN', JText::_('IN'));
		$state_combo[]   = JHTML::_('select.option', 'KS',JText::_('KS'));
		$state_combo[]   = JHTML::_('select.option', 'KY', JText::_('KY'));
		$state_combo[]   = JHTML::_('select.option', 'LA',JText::_('LA'));
		$state_combo[]   = JHTML::_('select.option', 'ME', JText::_('ME'));
		$state_combo[]   = JHTML::_('select.option', 'MD',JText::_('MD'));
		$state_combo[]   = JHTML::_('select.option', 'MA', JText::_('MA'));
		$state_combo[]   = JHTML::_('select.option', 'MI',JText::_('MI'));
		$state_combo[]   = JHTML::_('select.option', 'MN', JText::_('MN'));
		$state_combo[]   = JHTML::_('select.option', 'MS',JText::_('MS'));
		$state_combo[]   = JHTML::_('select.option', 'MO', JText::_('MO'));
		$state_combo[]   = JHTML::_('select.option', 'MT',JText::_('MT'));
		$state_combo[]   = JHTML::_('select.option', 'NE', JText::_('NE'));
		$state_combo[]   = JHTML::_('select.option', 'NV',JText::_('NV'));
		$state_combo[]   = JHTML::_('select.option', 'NH', JText::_('NH'));
		$state_combo[]   = JHTML::_('select.option', 'NJ',JText::_('NJ'));
		$state_combo[]   = JHTML::_('select.option', 'NM', JText::_('NM'));
		$state_combo[]   = JHTML::_('select.option', 'NY',JText::_('NY'));
		$state_combo[]   = JHTML::_('select.option', 'NC', JText::_('NC'));
		$state_combo[]   = JHTML::_('select.option', 'ND',JText::_('ND'));
		$state_combo[]   = JHTML::_('select.option', 'OH', JText::_('OH'));
		$state_combo[]   = JHTML::_('select.option', 'OK',JText::_('OK'));
		$state_combo[]   = JHTML::_('select.option', 'OR', JText::_('OR'));
		$state_combo[]   = JHTML::_('select.option', 'PA',JText::_('PA'));
		$state_combo[]   = JHTML::_('select.option', 'RI', JText::_('RI'));
		$state_combo[]   = JHTML::_('select.option', 'SC',JText::_('SC'));
		$state_combo[]   = JHTML::_('select.option', 'SD', JText::_('SD'));
		$state_combo[]   = JHTML::_('select.option', 'TN',JText::_('TN'));
		$state_combo[]   = JHTML::_('select.option', 'TX', JText::_('TX'));
		$state_combo[]   = JHTML::_('select.option', 'UT',JText::_('UT'));
		$state_combo[]   = JHTML::_('select.option', 'VT', JText::_('VT'));
		$state_combo[]   = JHTML::_('select.option', 'VA',JText::_('VA'));
		$state_combo[]   = JHTML::_('select.option', 'WA', JText::_('WA'));
		$state_combo[]   = JHTML::_('select.option', 'WV',JText::_('WV'));
		$state_combo[]   = JHTML::_('select.option', 'WI', JText::_('WI'));
		$state_combo[]   = JHTML::_('select.option', 'WY',JText::_('WY'));
		$state_combo[]   = JHTML::_('select.option', 'ON',JText::_('ON'));
		$state_combo[]   = JHTML::_('select.option', 'PE', JText::_('PE'));
		$state_combo[]   = JHTML::_('select.option', 'QC',JText::_('QC'));
		$state_combo[]   = JHTML::_('select.option', 'SK', JText::_('SK'));
		$state_combo[]   = JHTML::_('select.option', 'YT',JText::_('YT'));
		
		$lists['state'] 	= JHTML::_('select.genericlist',$state_combo, 'state', 'class="" size="1" ', 'value', 'text' );
	/*	$reply_style = array();
		$reply_style[]   = JHTML::_('select.option', '0', JText::_('Default'));
		$reply_style[]   = JHTML::_('select.option', '1',JText::_('Write Your Own'));
		$reply_style[]   = JHTML::_('select.option', '2', JText::_('Blackjack'));
		$reply_style[]   = JHTML::_('select.option', '3',JText::_('California'));
		$reply_style[]   = JHTML::_('select.option', '4', JText::_('Casual'));
		$reply_style[]   = JHTML::_('select.option', '5',JText::_('Fashionista'));
		$reply_style[]   = JHTML::_('select.option', '6', JText::_('Football'));
		$reply_style[]   = JHTML::_('select.option', '7',JText::_('Formal'));
		$reply_style[]   = JHTML::_('select.option', '8', JText::_('Interwebs'));
		$reply_style[]   = JHTML::_('select.option', '9',JText::_('Happy Hour'));
		$reply_style[]   = JHTML::_('select.option', '10', JText::_('Hoops'));
		$reply_style[]   = JHTML::_('select.option', '11',JText::_('J adore Le French'));
		$reply_style[]   = JHTML::_('select.option', '12', JText::_('Moods'));
		$reply_style[]   = JHTML::_('select.option', '13',JText::_('Natural'));
		$reply_style[]   = JHTML::_('select.option', '14', JText::_('Netiquette'));
		$reply_style[]   = JHTML::_('select.option', '15',JText::_('Road Trip'));
		$reply_style[]   = JHTML::_('select.option', '16', JText::_('Shakespeare'));
		$reply_style[]   = JHTML::_('select.option', '17',JText::_('Smiley'));
		$reply_style[]   = JHTML::_('select.option', '18', JText::_('Varsity'));
		$reply_style[]   = JHTML::_('select.option', '19', JText::_('Vegas, Baby!'));
		$lists['reply_style'] 	= JHTML::_('select.genericlist',$reply_style, 'reply_style', 'class="" size="1" ', 'value', 'text' );
		*/
		$event_title = array();
		$event_title[]   = JHTML::_('select.option',JText::_('12:00 AM') , JText::_('12:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('12:30 AM') , JText::_('12:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('01:00 AM') , JText::_('01:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('01:30 AM') , JText::_('01:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('02:00 AM') , JText::_('02:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('02:30 AM') , JText::_('02:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('03:00 AM') , JText::_('03:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('03:30 AM') , JText::_('03:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('04:00 AM') , JText::_('04:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('04:30 AM') , JText::_('04:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('05:00 AM') , JText::_('05:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('05:30 AM') , JText::_('05:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('06:00 AM') , JText::_('06:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('06:30 AM') , JText::_('06:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('07:00 AM') , JText::_('07:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('07:30 AM') , JText::_('07:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('08:00 AM') , JText::_('08:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('08:30 AM') , JText::_('08:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('09:00 AM') , JText::_('09:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('09:30 AM') , JText::_('09:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('10:00 AM') , JText::_('10:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('10:30 AM') , JText::_('10:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('11:00 AM') , JText::_('11:00 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('11:30 AM') , JText::_('11:30 AM'));
		$event_title[]   = JHTML::_('select.option',JText::_('12:00 PM') , JText::_('12:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('12:30 PM') , JText::_('12:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('01:00 PM') , JText::_('01:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('01:30 PM') , JText::_('01:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('02:00 PM') , JText::_('02:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('02:30 PM') , JText::_('02:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('03:00 PM') , JText::_('03:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('03:30 PM') , JText::_('03:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('04:00 PM') , JText::_('04:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('04:30 PM') , JText::_('04:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('05:00 PM') , JText::_('05:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('05:30 PM') , JText::_('05:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('06:00 PM') , JText::_('06:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('06:30 PM') , JText::_('06:30 PM'));
		
		$event_title[]   = JHTML::_('select.option',JText::_('07:00 PM') , JText::_('07:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('07:30 PM') , JText::_('07:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('08:00 PM') , JText::_('08:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('08:30 PM') , JText::_('08:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('09:00 PM') , JText::_('09:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('09:30 PM') , JText::_('09:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('10:00 PM') , JText::_('10:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('10:30 PM') , JText::_('10:30 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('11:00 PM') , JText::_('11:00 PM'));
		$event_title[]   = JHTML::_('select.option',JText::_('11:30 PM') , JText::_('11:30 PM'));
		$lists['event_time'] 	= JHTML::_('select.genericlist',$event_title, 'event_time', 'class="" size="1" onchange="eventtitle(this.id,\'time_span\')" ', 'value', 'text' );
		$sel_style = array();
		$sel_style=@array_merge($sel_style,$style);
		$lists['style'] 	= JHTML::_('select.genericlist',$style,  'id', 'class="inputtext" onchange="choose_style(this.value)" style="width:165px;"  ', 'value', 'text'); 
		$sel_category = array();
		$sel_category[]  = JHTML::_('select.option', '0 ', JText::_( 'SELECT_EVENT_TYPE'));
		$category=@array_merge($sel_category,$category);
		$lists['category'] 	= JHTML::_('select.genericlist',$category,  'catid', 'class="inputtext" ', 'value', 'text'); 
		if($myid)
		{
			$tpl="detail";
		}
		$this->assignRef('lists',$lists); 
		$this->assignRef('allevents',$allevents); 
		parent::display($tpl);
  }
}
 
?>
