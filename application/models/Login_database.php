<?php defined('BASEPATH') OR exit('No direct script access aloowed');

Class Login_Database extends CI_Model {

//model construct function
public function __construct() {
    parent::__construct();

}
// Insert registration data in database
/*public function registration_insert($data) {
    $mysql_db = $this->load->database('default',true); //connected with mysql
    // Query to check whether username already exist or not
    $condition = "user_name =" . "'" . $data['user_name'] . "'";
    $mysql_db->select('*');
    $mysql_db->from('tbl_usuario');
    $mysql_db->where($condition);
    $mysql_db->limit(1);
    $query = $mysql_db->get();
    if ($query->num_rows() == 0) {

    // Query to insert data in database
    $mysql_db->insert('tbl_usuario', $data);
        if ($mysql_db->affected_rows() > 0) {
            return true;
        }
    } else {
            return false;
    }
}*/

// Insert registration data in database
public function registration_update($data) {
    $mysql_db = $this->load->database('default',true); //connected with mysql
    // Query to check whether username already exist or not
    $mysql_db->select('*');
    $mysql_db->from('tbl_usuario');
    $mysql_db->where('login_usuario', $data['login_usuario']);
    $mysql_db->limit(1);
    $query = $mysql_db->get();
    if ($query->num_rows() == 1) {
    // Query to insert data in database
    $update = array(
        'nome_usuario' => $data['nome_usuario'],
        'login_usuario' => $data['login_usuario'],
        'email_usuario' => $data['email_usuario'],
        'senha_usuario' => $data['senha_usuario'],
        'status_usuario' => '1',
        'id_cargo' => '1',
        'celula_equipe' => $data['celula_equipe']
    );
    $mysql_db->where('login_usuario', $data['login_usuario']);
    $mysql_db->update('tbl_usuario', $update);
        if ($mysql_db->affected_rows() > 0) {
            log_message('debug','Login_database model: Successful Update login for ' . $data['login_usuario'] .'');
            return true;
        }
    } else {
        // Query to insert data in database
        $mysql_db->insert('tbl_usuario', $data);
        log_message('debug', 'Login_database model: Successful Insert login for ' . $data['login_usuario'] .'');
        return false;
    }
}


// Read data using username
/*public function login($data) {
    $mysql_db = $this->load->database('default',true); //connected with mysql

    $condition = "user_name =" . "'" . $data['username'] . "' AND " . "user_password =" . "'" . $data['password'] . "'";
    $mysql_db->select('*');
    $mysql_db->from('tbl_usuario');
    $mysql_db->where($condition);
    $mysql_db->limit(1);
    $query = $mysql_db->get();

    if ($query->num_rows() == 1) {
        return true;
    } else {
        return false;
    }
}*/

// Read data from database to show data in admin page
public function read_user_information($username) {
    $mysql_db = $this->load->database('default',true); //connected with mysql

    $condition = "login_usuario =" . "'" . $username . "'";
    $mysql_db->select('*');
    $mysql_db->from('tbl_usuario');
    $mysql_db->where($condition);
    $mysql_db->limit(1);
    $query = $mysql_db->get();

    if ($query->num_rows() == 1) {

        return $query->result();
    } else {
        return false;
    }
}

}

?>

