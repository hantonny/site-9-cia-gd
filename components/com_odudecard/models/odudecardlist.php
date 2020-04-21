<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );


class odudecardModelodudecardlist extends JModelLegacy
{
	function getGreeting()
    {
        $db = JFactory::getDBO();
 		
		$q_cate = JRequest::getVar('cate', '0');
			$cate=getSpecificId($q_cate,'cate'); 

	   $query = "select id,title,type,file,desp,effect,cat,thumb from #__ecard_media where cat='$cate' order by ordering asc";
	   $db->setQuery( $query );
	   $greeting = $db->loadObjectList();
	 
	   return $greeting;

    }
	
	
		function getCategory()
    {
       		$q_cate = JRequest::getVar('cate', '0');
			$cate=getSpecificId($q_cate,'cate'); 

		   $db = JFactory::getDBO();
			$query = "select * from #__ecard_cate where cat='$cate'";
			$db->setQuery($query);
			$rows = $db -> loadObjectList();
			return $rows;
		
    }

	
	
	function getSetting()
	{
	$query = "select * from #__ecard_setting";

	
	   $ecardS = array();
	   	$db = JFactory::getDBO();
		$db->setQuery($query);
		$rows = $db -> loadObjectList();
			$ecardS['card_row']=$rows[0]->card_row;
			$ecardS['card_page']=$rows[0]->card_page;
			$ecardS['a1']=$rows[0]->a1;
			$ecardS['a2']=$rows[0]->a2;
			$ecardS['a3']=$rows[0]->a3;
			$ecardS['a4']=$rows[0]->a4;
			

			return $ecardS;

	}
	
		function pager($rowsPerPage,$maxPage,$numrows,$linku)
	{
	$output=" ";
		
	$pager=JRequest::getVar('pager', 'x');
	if($pager=='x')
	$pager=0;
	else
	$pager=($pager-1)*$rowsPerPage;
	
	$pagex=JRequest::getVar('pager', 'x');
	if($pagex=='x')
	$pageNum=1;
	else
	$pageNum=$pagex;
	
	//$self=$_SERVER['PHP_SELF'];
	$self="index.php";


if ($numrows==0)
$output="<span class='active_tnt_link'> ".JText::_('COM_ODUDECARD_ECARD_NO')." </span>";
else if ($numrows==1)
$output=" <span class='active_tnt_link'> 1 </span> ";
else
{
		$maxPage =ceil($numrows/$rowsPerPage);
		$pu=0;
		$pagei='';
		$prev='';
		$first='';
		$nexti='';
		$lasti='';
		
		if ($pageNum > 1)
		{
			$pagei = $pageNum - 1;
			$prev = " <a href=\"".$self."?pager=".$pagei."&".$linku."\">".JText::_('COM_ODUDECARD_ECARD_PREV')."</a> ";
			$first = " <a href=\"".$self."?pager=1&".$linku."\">".JText::_('COM_ODUDECARD_ECARD_FIRST')."</a> ";
		} 
		else
		{
			$prev  = "<span class='disabled_tnt_pagination'>".JText::_('COM_ODUDECARD_ECARD_PREV')."</span>";    // we're on page one, don't enable 'previous' link
			$first = "<span class='disabled_tnt_pagination'>".JText::_('COM_ODUDECARD_ECARD_FIRST')."</span>"; // nor 'first page' link
		}

				
					// print 'next' link only if we're not
					// on the last page
					if ($pageNum < $maxPage)
					{
						$pagei = $pageNum + 1;
						$nexti = "&nbsp; <a href=\"".$self."?pager=".$pagei."&".$linku."\">".JText::_('COM_ODUDECARD_ECARD_NEXT')."</a> ";
						$lasti = " <a href=\"".$self."?pager=".$maxPage."&".$linku."\">".JText::_('COM_ODUDECARD_ECARD_LAST')."</a> ";
					} 
					else
					{
						$nexti = "<span class='disabled_tnt_pagination'> ".JText::_('COM_ODUDECARD_ECARD_NEXT')."</span>";      // we're on the last page, don't enable 'next' link
						$lasti = " <span class='disabled_tnt_pagination'> ".JText::_('COM_ODUDECARD_ECARD_LAST')." </span>"; // no 'last page' link
					}
					
					// print the page navigation link
					$output.=$first ." ".$prev;		
					
					
					//Pages
					
						if($pageNum<=5)
						$pu=1;
						else
						$pu=$pageNum-5;
						  
					$upto=$pageNum+5;
					$output.=" ";
					if($upto>$maxPage)
					{
						for($i=$pu;$i<=($upto-($upto-$maxPage));$i++)
						{
							
							if($i==$pageNum)
							$output.=" <span class='active_tnt_link'> ".$i." </span> ";
							else
							$output.=" <a href=\"".$self."?pager=".$i."&".$linku."\"> ".$i." </a> ";
						}
					
					}
					else
					{
								
							for($i=$pu;$i<=$upto;$i++)
							{
								if($i==$pageNum)
								$output.=" <span class='active_tnt_link'> ".$i." </span> ";
								else
								$output.=" <a href=\"".$self."?pager=".$i."&".$linku."\"> ".$i." </a> ";
							}
					}
					
				$output.=$nexti." ".$lasti;

	}
	return '<div id="tnt_pagination">  '.$output.' </div> ';
	//return '<div id="tnt_pagination">  '.$output.' </div><a href="http://www.odude.com" target="_blank"><img src="components/com_odudecard/include/dot.gif" border="0" align="right"  title="Powered By ODude.com" alt="Powered By ODude.com" /></a>  ';
}


}
