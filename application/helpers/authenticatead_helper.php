<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function verificaServer(){
    $ips = array(
    "1" => "10.3.1.29",
    "2" => "10.3.1.25",
    "3" => "10.3.1.24"
    );
    foreach ($ips as $number => $ip) :
        if(fsockopen($ip, 3389, $numeroDoErro, $stringDoErro, 10)) :
            return $ip;
        else :
            return False;
        endif;
    endforeach;
}

function authenticate($user, $password) {
    // Active Directory server  : faz uma verificação para saber se o srv está ok.
    $ldap_host = verificaServer();

    // Active Directory DN
    $ldap_dn = "OU=SEFA-PA,DC=sefa,DC=pa,DC=gov,DC=br";

    // Active Directory user group
    //$ldap_user_group = "SEFA-PA";

    // Active Directory manager group
    //$ldap_manager_group = "Operador";

    // Domain, for purposes of constructing $user
    $ldap_usr_dom = "@sefa.pa.gov.br";

    // connect to active directory
    $ldap = ldap_connect($ldap_host);

    // verify user and password
    if($bind = @ldap_bind($ldap, $user . $ldap_usr_dom, $password)) {
        //echo $user;
        // valid
        // check presence in groups
        $filter = "(sAMAccountName=" . $user . ")";
        // limit attributes we want to look for
        $attr = array("displayName","mail");
        //$attr = array("memberof");
        // in my script I search based on e-mail, $email variable is passed from the form
        $result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
        // put search results into the array
        $entries = ldap_get_entries($ldap, $result);
        ldap_unbind($ldap); // ????


        if($entries["count"] > 0){
            $array_retorno = array(
              'displayname' => utf8_encode($entries[0]['displayname'][0]),
              'mail' => $entries[0]['mail'][0]
              );
              return $array_retorno;
         }

    } else {
        // invalid name or password
        return false;
    }
}
?>