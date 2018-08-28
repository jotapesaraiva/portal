<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * This file is part of Auth_AD.

    Auth_AD is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Auth_AD is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Auth_AD.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * @package         Auth_AD
 * @subpackage      example
 * @author          Mark Kathmann <mark@stackedbits.com>
 * @version         0.4
 * @link            http://www.stackedbits.com/
 * @license         GNU Lesser General Public License (LGPL)
 * @copyright       Copyright © 2013 Mark Kathmann <mark@stackedbits.com>
 */

class Auth extends CI_Controller{
	function __construct() {
		parent::__construct();
		// this loads the Auth_AD library. You can also choose to autoload it (see config/autoload.php)
        $this->load->helper('funcoes_helper');
        // Load form validation library
		$this->load->library('Auth_AD');
        // Load database
        $this->load->model('login_database');
	}

	public function index(){
        $this->load->view('login');
    }

	public function login() {
		$username = strtolower($this->input->post('username'));
		$password = $this->input->post('password');

        $this->form_validation->set_rules('username', 'Usuário', 'trim|required');//|xss_clean');
        $this->form_validation->set_rules('password', 'Senha', 'trim|required');//|xss_clean');

        // $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // $this->form_validation->set_message('required', 'Entre com o %s');
        // read the form fields, lowercase the username for neatness
        if ($this->form_validation->run() == FALSE) {
            // if($this->auth_ad->is_authenticated()){
            //     redirect('welcome');
            //     echo "passou aqui!!!!";
            // } else {
                // $data = array('error_message' => 'Efetue o login para acessar o sistema');
                set_msg('loginErro','Efetue o login para acessar o sistema','erro');
                $this->load->view('login');
            // }
        } else {
            // check the login
            if($this->auth_ad->login($username, $password)) {
                $data = array(
                    'nome_usuario' => $this->session->userdata('displayname'),
                    'login_usuario' => $username,
                    'email_usuario' => $this->session->userdata('mail'),
                    'senha_usuario' => $password,
                    'status_usuario' => '1',
                    'id_permissao' => '1',
                    'id_cargo' => '1',
                    'celula_equipe' => $this->session->userdata('physicaldeliveryofficename')
                );
                $alterado = $this->login_database->registration_update($data);
                // echo 'OK';
                // the login was succesful, do your thing here
                // upon a succesful login the session will automagically contain some handy user data:
                // $this->session->userdata('cn') contains the common name from the AD
                // $this->session->userdata('username') contains the username as processed
                // $this->session->userdata('dn') contains the distinguished name from the AD
                // $this->session->userdata('logged_in') contains a boolean (true)
                set_msg('loginOk','Logado com sucesso no sistema !!!','sucesso');
                redirect('welcome');
            } else {
                // user could not be authenticated, whoops.
                // $data = array('error_message' => 'Usuário ou senha inserido errado');
                set_msg('loginErro','Usuário ou senha inserido errado','erro');
                $this->load->view('login');
            }
        }
	}

	public function logout() {
		// perform the logout
		if($this->session->userdata('logged_in')) {
			$data['name'] = $this->session->userdata('cn');
			$data['username'] = $this->session->userdata('username');
			$data['logged_in'] = true;
			$this->auth_ad->logout();

            // $data['error_message'] = 'Logout efetuado com sucesso !!!';
            set_msg('loginErro','Logout efetuado com sucesso !!!','erro');
            $this->load->view('login');
		} else {
			$data['logged_in'] = false;
            $this->load->view('login');
		}

		// now that the logout is done, you can add code for the next step(s) here
	}


      public function checkloginstatus() {

            // check if the user is already logged in
            if(!$this->auth_ad->is_authenticated()) {
               $this->load->view('login');

                // not logged in, do what you need to do here
                // you could, for example, send the user to the login form
            } else {
                //redirect('welcome');
                $username = $this->session->userdata('username');
                // already logged in, forward to the home page or some such
            }
        }

      public function useringroup($username, $groupname) {
            // check if the user is a member of a particular group (recursive search)
            if ($this->auth_ad->in_group($username, $groupname)) {
                echo "OK";
                // the user is a member of the group
            } else {
                echo "NOK";
                // nope, not a member
            }
        }

      public function listar_usuarios() {
            $entries = $this->auth_ad->get_all_users();
            echo json_encode($entries);
            /*echo '<pre>';
            echo 'Numero de usuarios no AD: ';
            print_r($entries['count']);
            echo  '</pre>';*/
            // echo "Total de usuarios no AD: ". $entries['count'] . "<p>";
            // for ($i=0; $i<$entries["count"]; $i++) {
            //     echo "Username: ". $entries[$i]["samaccountname"][0]."<br>";
            //     if($entries[$i]["displayname"][0] != ""){
            //         echo "Display nome : ". $entries[$i]["displayname"][0]."<br>";
            //     }
            //     echo "Escritorio: ". $entries[$i]["department"][0]."<br>";
            //     $timestamp = $entries[$i]["lastlogontimestamp"][0];
            //     echo "Último logon no AD: ". date('d-m-Y H:i:s', ($timestamp/ 10000000) - 11676009600) ."<br>";
            //     if($entries[$i]["mail"][0] == "")
            //     echo "Telephone number is: ". $entries[$i]["mail"][0] ."<p>";
            // }
/*            if ($entries['count'] > 0) {
                    $odd = 0;
                    foreach ($entries[0] AS $key => $value){
                        if (0 === $odd%2){
                            $ldap_columns[] = $key;
                        }
                        $odd++;
                    }
                    echo '<table class="data">';
                    echo '<tr>';
                    $header_count = 0;
                    foreach ($ldap_columns AS $col_name){
                        if (0 === $header_count++){
                            echo '<th class="ul">';
                        }else if (count($ldap_columns) === $header_count){
                            echo '<th class="ur">';
                        }else{
                            echo '<th class="u">';
                        }
                        echo $col_name .'</th>';
                    }
                    echo '</tr>';
                    for ($i = 0; $i < $entries['count']; $i++){
                        echo '<tr>';
                        $td_count = 0;
                        foreach ($ldap_columns AS $col_name){
                            if (0 === $td_count++){
                                echo '<td class="l">';
                            }else{
                                echo '<td>';
                            }
                            if (isset($entries[$i][$col_name])){
                                $output = NULL;
                                if ('lastlogon' === $col_name || 'lastlogontimestamp' === $col_name){
                                    //$output = date('D M d, Y @ H:i:s', ($entries[$i][$col_name][0] / 10000000) - 11676009600);
                                    $output = date('d-m-Y H:i:s', ($entries[$i][$col_name][0] / 10000000) - 11676009600);
                                }else{
                                    $output = $entries[$i][$col_name][0];
                                }
                                echo $output .'</td>';
                            }
                        }
                        echo '</tr>';
                    }
                    echo '</table>';
                }*/

        }

        // public function searchad($username) {
        //     //$username = $_GET['name_startsWith'];

        //     $username = $this->input->get('name_startsWith');
        //     // $user_search = $this->auth_ad->search_ad($username, array('samaccountname'));
        //     $user_search = $this->auth_ad->auto_search($username);
        //     $data = array();
        //     for ($i=0; $i<$user_search["count"]; $i++) {
        //         $row[] = $user_search[$i]["samaccountname"][0];
        //         $data[] = $row;
        //     }
        //     if($i == 0){
        //         echo "No matches found!";
        //     }
        //     // return json data;
        //     echo json_encode($data);
        //     // echo json_encode($user_search['count']);
        // }

      public function info_user($username) {
            $info_full = $this->auth_ad->get_all_user_data($username);
            // vd($info_full);
            echo ('mail: '.$info_full['mail'][0]);
        }

        public function pesquisar($username) {
            // $result = $this->auth_ad->search_ad($username, array('dn'),TRUE);
            $entries = $this->auth_ad->auto_search($username);
            // vd($entries);
            // echo json_encode($entries);
            $ad_users = "";
            for ($x=0; $x<$entries['count']; $x++) {
                if (!empty($entries[$x]['givenname'][0]) &&
                     !empty($entries[$x]['mail'][0]) &&
                     !empty($entries[$x]['samaccountname'][0]) &&
                     !empty($entries[$x]['sn'][0]) &&
                     'Shop' !== $entries[$x]['sn'][0] &&
                     'Account' !== $entries[$x]['sn'][0]){

                    // $ad_users[strtoupper(trim($entries[$x]['samaccountname'][0]))] = array('email' => strtolower(trim($entries[$x]['mail'][0])),'first_name' => trim($entries[$x]['givenname'][0]),'last_name' => trim($entries[$x]['sn'][0]));
                    $ad_users .= '<ul>
                                   <li>'.strtoupper(trim($entries[$x]['samaccountname'][0])).'</li>
                                </ul>';
                }
            }
            // vd($ad_users);
            echo $ad_users;
            // echo json_encode($ad_users);
        }


}