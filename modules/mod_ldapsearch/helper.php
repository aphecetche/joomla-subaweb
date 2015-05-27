<?php

defined('_JEXEC') or die;

class modLDAPSearchHelper
{
/**
  * Returns the list of people of group
  */
  
  public function getItems($s1,$s2="")
  {
  
  	$items = array();

	$ds = ldap_connect("ldap.in2p3.fr");
 
	if (!$ds)	
	{			
	  return $items;
	}

	
	$ok = ldap_bind($ds);

	if (!$ok)
	{
  	return;
	}

# ldapsearch -x  -h ldap.in2p3.fr -b "ou=people,ou=subatech,o=in2p3,c=fr" 
# "(&(businessCategory=electronique)(|(businessCategory=chef*)))"


	$base_dn="ou=people,ou=subatech,o=in2p3,c=fr";

	$filter="(&(businessCategory=$s1)";
	
	if ( isset($s2) && strlen($s2)>0 )
	{
		$filter .= "(|(businessCategory=$s2)))";
	}
	else
	{
		$filter .= ')';
	}

#	print($filter);
	
#	$justthese=array("cn");

	$sr=ldap_search($ds, $base_dn, $filter);

	if (!$sr)
	{
	  return $items;
	}


	for ($entryID=ldap_first_entry($ds,$sr);
    	        $entryID!=false;
        	    $entryID=ldap_next_entry($ds,$entryID))
	{
    	$attr = ldap_get_attributes($ds,$entryID);

	    /* we take the first value of each attribute */
	    if ( $attr["cn"]["count"] ) 
	    {
			$items[] = array( "cn" => $attr["cn"][0],
      			"title" =>  ( in_array("title",$attr) ? $attr["title"][0] : "" ),
      			"roomNumber" => ( in_array("roomNumber",$attr) ? $attr["roomNumber"][0] : "" ),
      			"telephoneNumber" => ( in_array("telephoneNumber",$attr) ? $attr["telephoneNumber"][0] : "" ),
      			"mail" => ( in_array("mail",$attr) ? $attr["mail"][0] : "" ),
      			"jpegPhoto" => ( in_array("jpegPhoto",$attr) ? $attr["jpegPhoto"][0] : "" ),
);
		}
	}
    
    sort($items);
    
	ldap_close($ds);

	return $items;
	}  //end getItems

} // end class

?>