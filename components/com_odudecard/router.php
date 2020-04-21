<?php
 /**
 * @package ODude ECard
 * @author ODude.com
 * @copyright (C) 2014 ODude Network. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

 
//error_reporting(0);
function odudecardBuildRoute(&$query)
{
       $segments = array();

	  
       if( isset($query['controller']) )
       {
                $segments[] = $query['controller'];
                unset( $query['controller'] );
       };
          if( isset($query['view']) )
       {
                $segments[] = $query['view'];
                unset( $query['view'] );
       };

	   if(isset( $query['cate'] ))
       {
                $segments[] = $query['cate'];
                unset( $query['cate'] );
       };
	     if( isset($query['id']) )
       {
                $segments[] = $query['id'];
                unset( $query['id'] );
       };
	       if( isset($query['notify']) )
       {
                $segments[] = $query['notify'];
                unset( $query['notify'] );
       };
	    if( isset($query['xid']) )
       {
                $segments[] = $query['xid'];
                unset( $query['xid'] );
       };
	  
	     if( isset($query['opt']) )
       {
                $segments[] = $query['opt'];
                unset( $query['opt'] );
       };
	   /*
	       if( isset($query['Itemid']) )
       {
                $segments[] = $query['Itemid'];
                unset( $query['Itemid'] );
       };
*/

       //unset( $query['view'] );
       return $segments;
}


function odudecardParseRoute($segments)
{
       $vars = array();
	   
       // Count segments
       $count = count( $segments );
if($segments[0]=='odudecardlist')
{
   //$cate   = explode( ':', $segments[$count-1] );
   $vars['controller'] = 'odudecardlist';
   $vars['cate']   = $segments[1];
    $vars['opt']   =  $segments[2];
	//if(isset($segments[3]))
	//$vars['Itemid']   =  $segments[3];

}
else if($segments[0]=='card_list')
{
   //$cate   = explode( ':', $segments[$count-1] );
   $vars['controller'] = 'odudecardlist';
   $vars['cate']   = $segments[1];
    $vars['opt']   =  $segments[2];
	//if(isset($segments[3]))
	//$vars['Itemid']   =  $segments[3];

}
else if($segments[0]=='odudecardmylist')
{
   $vars['controller'] = 'odudecardmylist';
    
    if(isset($segments[1]))
    $vars['id']   =  $segments[1];
   

}
else if($segments[0]=='cardmylist')
{
   $vars['controller'] = 'odudecardmylist';
    
    if(isset($segments[1]))
    $vars['id']   =  $segments[1];
   

}

else if($segments[0]=='odudecardshow')
{
   $cate   = explode( ':', $segments[$count-2] );
    $vars['cate']   = $cate[0];
   //$vars['cate']   = (int) $cate[0];
   $vars['controller'] = 'odudecardshow';
   $id   = explode( ':', $segments[$count-1] );
   //$vars['id']   = (int) $id[0];
    $vars['id']   = $id[0];

}
else if($segments[0]=='card_show')
{
   $cate   = explode( ':', $segments[$count-2] );
    $vars['cate']   = $cate[0];
  // $vars['cate']   = (int) $cate[0];
   $vars['controller'] = 'odudecardshow';
   $id   = explode( ':', $segments[$count-1] );
    $vars['id']   = $id[0];
   //$vars['id']   = (int) $id[0];

}
else if($segments[0]=='card_onepage')
{
   $cate   = explode( ':', $segments[$count-2] );
    $vars['cate']   = $cate[0];
  // $vars['cate']   = (int) $cate[0];
   $vars['controller'] = 'odudecardonepage';
   $id   = explode( ':', $segments[$count-1] );
  // $vars['id']   = (int) $id[0];
   $vars['id']   = $id[0];

}
else if($segments[0]=='odudecardcreate')
{
   $vars['cate']   = $segments[1];
   $vars['controller'] = 'odudecardcreate';
   
  
}
else if($segments[0]=='create_ecard')
{
   $vars['cate']   = $segments[1];
   $vars['controller'] = 'odudecardcreate';
   
  
}
else if($segments[0]=='odudetubecreate')
{
   $vars['cate']   = $segments[1];
   $vars['controller'] = 'odudetubecreate';
   
  
}
else if($segments[0]=='create_youtube')
{
   $vars['cate']   = $segments[1];
   $vars['controller'] = 'odudetubecreate';
   
  
}
else if($segments[0]=='odudevideocreate')
{
   $vars['cate']   = $segments[1];
   $vars['controller'] = 'odudevideocreate';
   
  
}
else if($segments[0]=='create_video') 
{
   $vars['cate']   = $segments[1];
   $vars['controller'] = 'odudevideocreate';
   
  
}

else if($segments[0]=='odudecardpick')
{
   $cate   = explode( ':', $segments[$count-3] );
    $vars['cate']   = $cate[0];
  // $vars['cate']   = (int) $cate[0];
   $vars['controller'] = 'odudecardpick';
   $xid   = explode( ':', $segments[$count-1] );
   $vars['xid']   = (int) $xid[0];
   $notify   = explode( ':', $segments[$count-2] );
   $vars['notify']   = $notify[0];


}

else if($segments[0]=='cardpick')
{
   $cate   = explode( ':', $segments[$count-3] );
   //$vars['cate']   = (int) $cate[0];
    $vars['cate']   = $cate[0];
   $vars['controller'] = 'odudecardpick';
   $xid   = explode( ':', $segments[$count-1] );
   $vars['xid']   = (int) $xid[0];
   $notify   = explode( ':', $segments[$count-2] );
   $vars['notify']   = $notify[0];


}
else if($segments[0]=='facebook')
{

   $vars['cate'] = $segments[1];
   $vars['view'] = 'facebook';
    $vars['format'] = 'raw';
    if(isset($segments[2]))
    $vars['id']=$segments[2];



}
else if($segments[0]=='odudemenu')
{
 $vars['controller'] = 'odudemenu';
}
else if($segments[0]=='odudecardpre')
{
 $vars['controller'] = 'odudecardpre';
}
else if($segments[0]=='cardpreview')
{
 $vars['controller'] = 'odudecardpre';
}
else if($segments[0]=='odudecardsend')
{
 $vars['controller'] = 'odudecardsend';
}
else if($segments[0]=='cardsend')
{
 $vars['controller'] = 'odudecardsend';
}
else
{
   $cate   = explode( ':', $segments[$count-1] );
  // $vars['cate']   = (int) $cate[0];
    $vars['cate']   = $cate[0];
	
}
//print_r($segments);
//print_r($vars);
return $vars;


}



?>
