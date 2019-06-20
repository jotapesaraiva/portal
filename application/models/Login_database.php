<?php defined('BASEPATH') OR exit('No direct script access aloowed');

Class Login_Database extends CI_Model {

// Insert registration data in database
/*public function registration_insert($data) {
    $this->db = $this->load->database('default',true); //connected with mysql
    // Query to check whether username already exist or not
    $condition = "user_name =" . "'" . $data['user_name'] . "'";
    $this->db->select('*');
    $this->db->from('tbl_usuario');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 0) {

    // Query to insert data in database
    $this->db->insert('tbl_usuario', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    } else {
            return false;
    }
}*/

// Insert registration data in database
public function registration_update($data) {
    // $this->db = $this->load->database('default',true); //connected with mysql
    // Query to check whether username already exist or not
    $this->db->select('*');
    $this->db->from('tbl_usuario');
    $this->db->where('login_usuario', $data['login_usuario']);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
    // Query to insert data in database
    $update = array(
        'nome_usuario' => $data['nome_usuario'],
        'login_usuario' => $data['login_usuario'],
        'email_usuario' => $data['email_usuario'],
        'senha_usuario' => $data['senha_usuario']
    );
    $this->db->where('login_usuario', $data['login_usuario']);
    $this->db->update('tbl_usuario', $update);
        if ($this->db->affected_rows() > 0) {
            log_message('debug','Login_database model: Successful Update login for ' . $data['login_usuario'] .'');
            return true;
        }
    } else {
        // Query to insert data in database
        $this->db->insert('tbl_usuario', $data);
        log_message('debug', 'Login_database model: Successful Insert login for ' . $data['login_usuario'] .'');
        return false;
    }
}


// Read data using username
/*public function login($data) {
    $this->db = $this->load->database('default',true); //connected with mysql

    $condition = "user_name =" . "'" . $data['username'] . "' AND " . "user_password =" . "'" . $data['password'] . "'";
    $this->db->select('*');
    $this->db->from('tbl_usuario');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
        return true;
    } else {
        return false;
    }
}*/

// Read data from database to show data in admin page
public function read_user_information($username) {
    // $this->db = $this->load->database('default',true); //connected with mysql

    $condition = "login_usuario =" . "'" . $username . "'";
    $this->db->select('*');
    $this->db->from('tbl_usuario');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {

        return $query->result();
    } else {
        return false;
    }
}

    public function numero_grupo($nome_group) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('id_grupo');
        $this->db->from('tbl_grupos');
        $this->db->where('nome_grupo',$nome_group);
        $query = $this->db->get();
        return $query->row();
    }

    public function status_user($usuario) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('status_usuario');
        $this->db->from('tbl_usuario');
        $this->db->where('login_usuario',$usuario);
        $query = $this->db->get();
        return $query->row();
    }

}

?>

