<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        esta_logado();
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $script['footerinc'] = '
            <script src="'. base_url() .'assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
            <script src="'. base_url() .'assets/custom/usuarios_lista.js" type="text/javascript"></script>
            <script src="'. base_url() .'assets/global/plugins/jquery-mask-plugin-master/dist/jquery.mask.js" type="text/javascript"></script>
            <script src="'. base_url() .'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
            <script src="'. base_url() .'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>';
        $script['script'] = '
            <script src="' . base_url() . 'assets/custom/form-input-mask.js" type="text/javascript"></script>';

        $css['headerinc'] = '
            <link href="'. base_url() .'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="'. base_url() .'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
            <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">';

        $session['username'] = $this->session->userdata('username');
        $usuarios = $this->auth_ad->get_all_users();
        $permissaos = $this->usuario_model->listar_permissao();
        $cargos = $this->usuario_model->listar_cargo();
        $grupos = $this->usuario_model->listar_grupo();
        $voips = $this->voip_model->listar_ramal();

        $dados = array('permissaos' => $permissaos, 'cargos' => $cargos, 'grupos' => $grupos, 'usuarios' => $usuarios,'voips' => $voips);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Usuários</span>', '/usuarios;');
        $this->breadcrumbs->push('<span>Lista de usuários</span>', '/usuarios/lista');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('usuarios/listar_usuarios');
        $this->load->view('modal/modal_usuarios',$dados);

        $this->load->view('template/footer',$script);
    }

    public function listar_usuarios() {
          $entries = $this->auth_ad->get_all_users();
          echo json_encode($entries);
    }

    public function usuarios_list() {
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $usuarios = $this->usuario_model->listar_usuarios();

       $data = array();

       foreach($usuarios->result() as $usuario) {
           $row = array();
           $row[] = $usuario->id_usuario;
           $row[] = $usuario->nome_usuario;
           $row[] = $usuario->login_usuario;
           $row[] = $usuario->email_usuario;
           //$row[] = $usuario->sobreaviso_usuario;
           if ($usuario->sobreaviso_usuario == '1') {
            $row[] = '<span class="label label-sm label-info"> Sim. </span>';
           } else {
            $row[] = '<span class="label label-sm label-danger"> Não. </span>';
           }
           $row[] = $usuario->nome_permissao;
           $row[] = $usuario->nome_cargo;
           $row[] = $usuario->nome_grupo;
           if ($usuario->status_usuario == '1') {
            $row[] = '<span class="label label-sm label-info"> Ativo. </span>';
           } else {
            $row[] = '<span class="label label-sm label-danger"> Desativado. </span>';
           }
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$usuario->id_usuario."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$usuario->id_usuario."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $usuarios->num_rows(),
           "recordsFiltered" => $usuarios->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function teste() {
      // $exist = $this->telefonia_model->listar_telefone('(91) 3323-3853');
      $id_telefone = $this->telefonia_model->id_telefone('(91) 3323-3853');
      vd($id_telefone);
    }
    //FIXME: Falta finalizar o ADD VOIP!
    public function usuarios_add() {
      $this->usuarios_validate();

      if($this->input->post('status') == 'on') {
        $status = '1';
      } else {
        $status = '0';
      }
      if($this->input->post('sobreaviso') == 'on') {
        $sobreaviso = '1';
      } else {
        $sobreaviso = '0';
      }

       $data = array(
               'nome_usuario'       => $this->input->post('nome'),
               'login_usuario'      => $this->input->post('login'),
               'email_usuario'      => $this->input->post('email'),
               // 'celula_equipe'      => $this->input->post('equipe'),
               'senha_usuario'      => $this->input->post('senha'),
               'sobreaviso_usuario' => $sobreaviso,
               'status_usuario'     => $status,
               'id_permissao'          => $this->input->post('permissao'),
               'id_cargo'           => $this->input->post('cargo'),
               'id_grupo'           => $this->input->post('grupo')
           );
       $insert = $this->usuario_model->save_usuario($data);

       if(!empty($this->input->post('telefone'))) {
         foreach ($this->input->post('telefone') as $tel) {
           if(!empty($tel)) {
             $telefone = array (
                             'numero_telefone'            => $tel,
                             'id_tipo_categoria_telefone' => 1
                         );
             $exist = $this->telefonia_model->listar_telefone($tel);
             if($exist->num_rows() != 1) {
                $id_telefone = $this->telefonia_model->salvar_telefone($telefone);
             } else {
                $id_telefone = $this->telefonia_model->id_telefone($tel);
             }
             $usuario_telefone = array (
                                   'id_telefone' => $id_telefone,
                                   'id_usuario'  =>  $insert
                                 );
             $this->usuario_model->salvar_usuario_telefone($usuario_telefone);
           }
         }
       }

       if(!empty($this->input->post('celular[]'))) {
         foreach($this->input->post('celular[]') as $cel) {
           if(!empty($cel)){
             $celular = array (
                'numero_telefone' => $cel,
                'id_tipo_categoria_telefone' => 2,
             );
             $id_celular = $this->telefonia_model->salvar_telefone($celular);
             $usuario_celular = array (
               'id_telefone' => $id_celular,
               'id_usuario' =>  $insert,
             );
             $this->usuario_model->salvar_usuario_telefone($usuario_celular);
           }
         }
       }
       echo json_encode(array("status" => TRUE));
    }

    public function usuarios_edit($id) {
       $usuario = $this->usuario_model->edit_usuario($id);

       $telefone = $this->usuario_model->edit_usuario_telefone($id,1);

       $celular = $this->usuario_model->edit_usuario_telefone($id,2);

       $data = array('usuario' => $usuario, 'telefone' => $telefone, 'celular' => $celular);
       echo json_encode($data);
    }
    //FIXME: Falta finalizar o UPDATE VOIP!
    public function usuarios_update() {
       $this->usuarios_validate();
      if($this->input->post('status') == 'on') {
        $status = '1';
      } else {
        $status = '0';
      }
      if($this->input->post('sobreaviso') == 'on') {
        $sobreaviso = '1';
      } else {
        $sobreaviso = '0';
      }

       $data = array(
              'nome_usuario'       => $this->input->post('nome'),
              'login_usuario'      => $this->input->post('login'),
              'email_usuario'      => $this->input->post('email'),
              // 'celula_equipe'      => $this->input->post('equipe'),
              'senha_usuario'      => $this->input->post('senha'),
              'sobreaviso_usuario' => $sobreaviso,
              'status_usuario'     => $status,
              'id_permissao'       => $this->input->post('permissao'),
              'id_cargo'           => $this->input->post('cargo'),
              'id_grupo'           => $this->input->post('grupo')
           );
       $this->usuario_model->update_usuario(array('id_usuario' => $this->input->post('id_usuario')), $data);

        //#######################TELEFONE##########################//
        if(!empty($this->input->post('telefone'))) {
           for($i = 0; $i < count($this->input->post('telefone')); $i++) {
              if(!empty($this->input->post('telefone')[$i])) {
                 $telefone_where = array (
                           'numero_telefone' => $this->input->post('telefone')[$i],
                           'id_tipo_categoria_telefone' => 1,
                 );
                 if($this->input->post('id_telefone')[$i] != "") {
                    $telefone_dados = array (
                          'id_telefone' => $this->input->post('id_telefone')[$i],
                          'id_usuario' => $this->input->post('id_usuario'),
                    );
                 $this->telefonia_model->update_telefone(array ('id_telefone' => $this->input->post('id_telefone')[$i]), $telefone_where);
                 $this->usuario_model->update_usuario_telefone(array ($this->input->post('id')), $telefone_dados);
                 } else {
                    $exist = $this->telefonia_model->listar_telefone($this->input->post('telefone')[$i]);
                    if($exist->num_rows() != 1) {
                       $id_telefone = $this->telefonia_model->salvar_telefone($telefone_where);
                    } else {
                       $id_telefone = $this->telefonia_model->id_telefone($this->input->post('telefone')[$i]);
                    }
                    $usuario_telefone = array (
                          'id_telefone' => $id_telefone->id_telefone,
                          'id_usuario' =>  $this->input->post('id_usuario')
                    );
                    // vd($usuario_telefone);
                    $this->usuario_model->salvar_usuario_telefone($usuario_telefone);
                }
              } else {
               // echo "array com value vazio";
              }
           }
       }
       //#######################CELULAR##########################//
       if(!empty($this->input->post('celular'))) {
          for($i = 0; $i < count($this->input->post('celular')); $i++) {
              if(!empty($this->input->post('celular')[$i])) {
                 $celular_where = array (
                           'numero_telefone' => $this->input->post('celular')[$i],
                           'id_tipo_categoria_telefone' => 2,
                 );
                 if($this->input->post('id_celular')[$i] != "") {
                    $celular_dados = array (
                          'id_telefone' => $this->input->post('id_celular')[$i],
                          'id_usuario' => $this->input->post('id_usuario'),
                    );
                 $this->telefonia_model->update_telefone(array ('id_telefone' =>  $this->input->post('id_celular')[$i]), $celular_where);
                 $this->usuario_model->update_usuario_telefone(array ($this->input->post('id')), $celular_dados);
                 } else {
                    $id_celular = $this->telefonia_model->salvar_telefone($celular_where);
                    $usuario_telefone = array (
                          'id_telefone' => $id_celular,
                          'id_usuario' =>  $this->input->post('id_usuario'),
                    );
                    $this->usuario_model->salvar_usuario_telefone($usuario_telefone);
              }
          } else {
           // echo "array com value vazio";
          }
        }
       }

       echo json_encode(array("status" => TRUE));
    }
    // FIXME: Falta finalizar o delete VOIP!
    public function usuarios_delete($id) {

      $telefones = $this->usuario_model->listar_usuario_telefone($id);
      $this->usuario_model->delete_usuario_telefone($id);
      $this->usuario_model->delete_usuario($id);
      foreach($telefones->result() as $telefone) {
        $this->telefonia_model->delete_telefone($telefone->id_telefone);
      }

       // $this->usuario_model->delete_usuario($id);
       echo json_encode(array("status" => TRUE));
    }

    private function usuarios_validate() {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = TRUE;

            if($this->input->post('nome') == '') {
                $data['inputerror'][] = 'nome';
                $data['error_string'][] = 'O campo nome é obrigatorio';
                $data['status'] = FALSE;
            }

            // if($this->input->post('email') == '') {
            //     $data['inputerror'][] = 'email';
            //     $data['error_string'][] = 'O campo email é obrigatorio';
            //     $data['status'] = FALSE;
            // }

            // if($this->input->post('login') == '') {
            //     $data['inputerror'][] = 'login';
            //     $data['error_string'][] = 'O campo login é obrigatorio';
            //     $data['status'] = FALSE;
            // }

            if($this->input->post('permissao') == '') {
                $data['inputerror'][] = 'permissao';
                $data['error_string'][] = 'O campo permissao é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('cargo') == '') {
                $data['inputerror'][] = 'cargo';
                $data['error_string'][] = 'O campo cargo é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('grupo') == '') {
                $data['inputerror'][] = 'grupo';
                $data['error_string'][] = 'O campo grupo é obrigatorio';
                $data['status'] = FALSE;
            }

            if($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }

        public function pesquisa_ad(){
          $this->load->view('teste/ad');
        }


        public function teste_ad($query = NULL) {
            $ldap_server = "10.3.1.30";
            $auth_user = "dokuwiki@sefa.pa.gov.br";
            $auth_pass = "wikidoku";
            $usuario = $query;

            // Set the base dn to search the entire directory.
            $base_dn = "OU=SEFA-PA,DC=sefa,DC=pa,DC=gov,DC=br";

            // Show People
            $filter = "(&(objectClass=user)(objectCategory=person)(cn=*)(displayname=$usuario*))";

            //Usuarios sem grupo (apenas domain users):
            //$filter = '(&(objectCategory=user)(objectClass=user)(!memberOf=*))'

            //Usuarios sem e-mail
            //$filter = '(objectcategory=person)(!mail=*)'

            //Usuarios com e-mail
            //$filter = '(objectcategory=person)(mail=*)'

            //Usuarios que nunca fizeram logon no dominio
            //$filter = '(&(&(objectCategory=person)(objectClass=user))(|(lastLogon=0)(!(lastLogon=*))))'

            //Usuários Criados depois de 09/10/2011
            //$filter = '(objectCategory=user)(whenCreated>=20111009000000.0Z)'; //Obs: troque o data por uma data da sua necessidade

            //Usuários que precisam mudar a senha no próximo logon
            //$filter = '(objectCategory=user)(pwdLastSet=0)';

            //Usuários cuja senha nunca expira
            //$filter = '(objectcategory=user)(userAccountControl:1.2.840.113556.1.4.803:=65536)';

            //Usuarios Ativos
            // $filter = "(&(objectClass=user)(objectCategory=person)(!userAccountControl:1.2.840.113556.1.4.803:=2))";

            //Usuarios Desabilitados
            //$filter = '(&(objectCategory=person)(objectClass=user)(userAccountControl:1.2.840.113556.1.4.803:=2))';

            $req_attrs = array(
                            // 'cn',
                            // 'dn',
                            'displayname',
                            // 'dn',
                            'mail',
                            // 'department',
                            // 'sn',
                            // 'givenname',
                            'samaccountname'
                            // 'description',
                            // 'lastlogontimestamp',
                            // 'physicaldeliveryofficename'
                        );

            // connect to server
            if (!($connect=@ldap_connect($ldap_server))) {
              die("1: Could not connect to ldap server");
            }

            // bind to server
            if (!($bind=@ldap_bind($connect, $auth_user, $auth_pass))) {
              die("2: Unable to bind to server");
            }

            // search active directory
            if (!($search=@ldap_search($connect, $base_dn, $filter, $req_attrs))) {
              die("3: Unable to search ldap server");
            }

            $number_returned = ldap_count_entries($connect,$search);
            $info = ldap_get_entries($connect, $search);

            // echo "The number of entries returned is ". $number_returned."<p>";
            // vd($info);

            // for ($i=0; $i<$info["count"]; $i++) {
            // echo "Name is: ". $info[$i]["name"][0]."<br>";
            // echo "Name: ". $info[$i]["displayname"][0]."<br>";
            // echo "Email: ". $info[$i]["mail"][0]."<br>";
            // echo "Fone: ". $info[$i]["telephonenumber"][0]."<br>";
            // echo "CONTA AD.: ". $info[$i]["samaccountname"][0]."<br>";
            // echo "GRUPO.: ". $info[$i][""][0]."<p>";//aqui "OU AD" do usuário que tem o mesmo nome do grupo
              // $row[$i] = $info[$i]["displayname"][0];
              // $info[$i]["mail"][0];
              // $row[$i] =  $info[$i]["samaccountname"][0];
            // }
            $data = array();
            foreach ($info as $key => $value) {
              $row = array();
              $row[]     = $info[$key]["displayname"][0];
              $row[]   = $info[$key]["samaccountname"][0];
              $data[] = $row;
            }
            vd($data);
            // echo json_encode($data);
            ldap_close($connect);

          // $this->load->view('teste/ad');
        }


        public function teste_newAD()
        {
          // Servidor Active Directory
          $phpAD["ldap_server"] = "10.3.1.25";

          // Usuario e senha necessário dominio
          $phpAD["auth_user"] = "dokuwiki@sefa.pa.gov.br";
          $phpAD["auth_pass"] = "wikidoku";

           // Unidade organizacional
           //$phpAD["ldap_dn"] = "OU=Matriz Tecnica,DC=empresa,DC=org, DC=br";//GEO
           $phpAD["ldap_dn"] = "OU=SEFA-PA,DC=sefa,DC=pa,DC=gov,DC=br";

           // OU padrão
           $phpAD["ldap_default_ou"] = "SEFA-PA";

           // Dominio Active directory
           $phpAD["ad_domain_name"] = "sefa.pa.gov.br";

           set_time_limit(0);

           // Base do dominio para procura.
           $base_dn = $phpAD["ldap_dn"];

           // Conectando ao servidor
           if (!($connect=@ldap_connect($phpAD["ldap_server"])))
           die("Could not connect to ldap server");

           // Autenticando
           if (!($bind=@ldap_bind($connect, $phpAD["auth_user"], $phpAD["auth_pass"])))
           die("Unable to bind to server");

           $filtro = "(&(objectClass=user)(objectCategory=person)(displayname=*))";

           // $mostrar = array("displayname","samaccountname","useraccountcontrol","userprincipalname","distinguishedname");
           $mostrar = array("displayname","samaccountname","useraccountcontrol","distinguishedname");

           // Busca no active directory $busca = ldap_search($ds, $ldap_dn, $filtro/*, $attributes*/);
           if (!($busca=@ldap_search($connect, $base_dn, $filtro, $mostrar)))
           die("Não foi possível realizar busca no Active Directory");

          $info = ldap_get_entries($connect, $busca);
          // vd($info);
          //Salva todos os usuarios em um vetor
           foreach ($info as $Key => $Value )
           {
            $Name     = $info[$Key]["displayname"][0];
            $Account  = $info[$Key]["samaccountname"][0];
            $State   = $info[$Key]["useraccountcontrol"][0];
            // $Mail   = $info[$Key]["userprincipalname"][0];

            $org    = $info[$Key]["distinguishedname"][0];

            $State   = dechex($State);
            $State     = substr($State,-1,1);//verifica contas desabilitadas

            // $Value = $Name."^".$Account."^".$State."^".$Mail."^".$org;
            $Value = $Name."^".$Account."^".$State."^".$org;

            if ( $Name != "" && $State != 2)
            $USERs[]=$Value;
           }
           if ( count($USERs) > 0 )
           sort($USERs);

           if ( count($USERs) == 0 )
           {
              echo "Não foi econtrado nenhum usuário";
           }

           //Verifica todos departamentos na OU como financeiro, RH, TI...
           for ($i=0;$i<=count($USERs)-1;$i++)
           {
            $Value  = $USERs[$i];
            $Splitted = explode("^",$Value);

            $Name     = $Splitted[0];
            $Account   = $Splitted[1];
            $State    = $Splitted[2];
            // $Mail     = $Splitted[3];
            $org         = $Splitted[3];

            $org_array = explode(",",$org);
            $org = substr($org_array[2],3,(strlen($org_array[2])));
            $temp[$i] = $org;

            $org2 = array_unique($temp);

          //Lista os usuarios por departamento
              foreach( $org2 as $mostra ){
                  echo"<br>".$mostra;
                   for ($i=0;$i<=count($USERs)-1;$i++)
                   {
                    $Value  = $USERs[$i];
                    $Splitted = explode("^",$Value);

                    $Name     = $Splitted[0];
                    $Account   = $Splitted[1];
                    $State    = $Splitted[2];
                    // $Mail     = $Splitted[3];
                      $org      = $Splitted[3];
                                  $org_array = explode(",",$org);
                     $org = substr($org_array[2],3,(strlen($org_array[2])));
                     $temp[$i] = $org;
                     if ($org == $mostra)
                       echo "<br>--".$Name;
                   }
               }
           }
        }

        public function ajaxPro() {
          $query = $this->input->get('query');
          $this->load->library('auth_ad');
          $data = $this->auth_ad->search_ad($query);
          // $this->db->like('name', $query);
          // $data = $this->db->get("tags")->result();
          echo json_encode( $data);
        }



}