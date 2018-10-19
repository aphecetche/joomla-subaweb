<?php

defined('_JEXEC') or die;

function containsAtLeastOneDigit($var) {
    return !preg_match('/\d/',$var);
}

class modLDAPSearchHelper
{
    /**
     * Returns the list of people of group
     */

    public function getItems($s1,$s2="")
    {

        $items = array();

        $ldaphost="ldaps://ccdirectory.in2p3.fr";
        $ds = ldap_connect($ldaphost);

        if (!$ds)	
        {			
            return $items;
        }

        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

        $ok = ldap_bind($ds);

        if (!$ok)
        {
            return $items;
        }

        # ldapsearch -x -H ldaps://ccdirectory.in2p3.fr -b "ou=people,dc=in2p3,dc=fr" 
        # "(&(businessCategory=electronique)(|(businessCategory=chef*)))"

        $base_dn="ou=people,dc=in2p3,dc=fr";

        $filter="(&(businessCategory=$s1)(ou=UMR6457)";

        if ( isset($s2) && strlen($s2)>0 )
        {
            $filter .= "(|(businessCategory=$s2)))";
        }
        else
        {
            $filter .= ')';
        }

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
                $cn = $attr["cn"][0];
                $parts = explode(" ",$cn);
                $name = implode(" ",array_filter($parts,"containsAtLeastOneDigit"));
                $items[] = array( "cn" => $name,
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
