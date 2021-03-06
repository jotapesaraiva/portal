<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidade extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
        $css['headerinc'] = '
            <link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/jquery-mask-plugin-master/dist/jquery.mask.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/localidades/unidades.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/html/input-telefone.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/html/input-celular.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/html/input-voip.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/html/input-link.js" type="text/javascript"></script>
            ';
        $script['script'] = '
            <script src="'.base_url().'assets/custom/form-input-mask.js" type="text/javascript"></script>';

        $unidades = $this->unidade_model->listar_unidade();
        $expedientes = $this->unidade_model->listar_expediente();
        $cidades = $this->unidade_model->listar_cidade();
        //$servidores = $this->usuarios_model->listar_servidores(); "servidores" => $servidores,
        //$tecnicos = $this->usuarios_model->listar_tecnicos(); "tecnicos" => $tecnicos,
        $acessos = $this->link_model->listar_acesso();
        $fornecedores = $this->fornecedor_model->listar_fornecedor();
        $links =  $this->link_model->listar_link();
        $voips = $this->voip_model->listar_ramal();
        $dados = array("unidades" => $unidades, "expedientes" => $expedientes, "cidades" => $cidades, "links" => $links, "voips" => $voips, "fornecedores" => $fornecedores, "acessos" => $acessos/*, "telefones" => $telefones, "celulares" =>$celulares*/);

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Localidades</span>', '/localidades');
        $this->breadcrumbs->push('<span>Unidades</span>', '/localidades/unidades');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('localidades/unidades');
        $this->load->view('modal/modal_unidade', $dados);
        $this->load->view('modal/modal_unidade_view');

        $this->load->view('template/footer', $script);
    }

    public function unidades_list() {
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $unidades = $this->unidade_model->listar_unidade();

       $data = array();

       foreach($unidades->result() as $unidade) {
           $row = array();
           // $row[] = $unidade->id_unidade;
           $row[] = $unidade->nome_unidade;
           // $row[] = $unidade->endereco_unidade;
           // $row[] = $unidade->nome_cidade;
           // $row[] = $unidade->nome_expediente;
           $telefones = $this->unidade_model->listar_unidade_telefone($unidade->id_unidade,1);
           if($telefones == null){
              $row[] = "";
           } else {
             $tel = '';
             foreach($telefones->result() as $telefone){
              $tel .= $telefone->numero_telefone. '<br>';
             }
           $row[] = $tel;
           }
           //*****************************************   CELULARES   ***********************************************
/*           $celulares = $this->unidade_model->listar_unidade_telefone($unidade->id_unidade,2);
           if($celulares == null){
              $row[] = "";
           } else {
             $cel = '';
             foreach($celulares->result() as $celular){
              $cel .= $celular->numero_telefone. '<br>';
             }
           $row[] = $cel;
           }*/
           //*************************************   VOIP   ***************************************************
           $voips = $this->unidade_model->listar_unidade_telefone($unidade->id_unidade,4);
           if($voips == null){
            $row[] = "";
           } else {
             $VoIP = '';
             foreach($voips->result() as $voip){
              $VoIP .= substr($voip->numero_telefone,-4). '<br>';
             }
             $row[] = $VoIP;
           }
           //***************************************   LINKS   *************************************************
           $links = $this->unidade_model->listar_link($unidade->id_unidade);
           if($links == null){
              $row[] = "";
           } else {
             $Link = '';
             foreach($links->result() as $link){
              $Link .= $link->ip_lan_link. '<br>';
             }
           $row[] = $Link;
           }

           if($links == null){
              $row[] = "";
           } else {
             $Link = '';
             foreach($links->result() as $link){
              $Link .= $link->designacao_link. '<br>';
             }
           $row[] = $Link;
           }
           //*****************************************   TECNICOS   ***********************************************
            $tecnicos = $this->unidade_model->listar_unidade_usuario($unidade->id_unidade,6);
            if($tecnicos == null){
               $row[] = "";
            } else {
              $Tecnico = '';
              foreach($tecnicos->result() as $tecnico){
               $Tecnico .= $tecnico->nome_usuario. '<br>';
              }
              $row[] = $Tecnico;
            }
           //***************************************   SERVIDORES   *************************************************
           $servidores = $this->unidade_model->listar_unidade_usuario($unidade->id_unidade,16);
           if($servidores == null){
              $row[] = "";
           } else {
             $Servidor = '';
             foreach($servidores->result() as $servidor){
              $Servidor .= $servidor->nome_usuario. '<br>';
             }
             $row[] = $Servidor;
           }
           //***************************************   UNIDADES   *************************************************
           if ($unidade->status_unidade == '1'){
            $row[] = '<span class="label label-sm label-info"> Ativo. </span>';
           } else {
            $row[] = '<span class="label label-sm label-danger"> Desativado. </span>';
           }
           if(acesso_admin()):
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Editar" onclick="edit_person('."'".$unidade->id_unidade."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Deletar" onclick="delete_person('."'".$unidade->id_unidade."'".')"><i class="glyphicon glyphicon-trash"></i></a>
                     <a class="btn blue btn-outline sbold" href="javascript:void(0)" title="Info" onclick="view_person('."'".$unidade->id_unidade."'".')"><i class="glyphicon glyphicon-info-sign"></i></a>';
          else:
             $row[] = '<a class="btn blue btn-outline sbold" href="javascript:void(0)" title="Info" onclick="view_person('."'".$unidade->id_unidade."'".')"><i class="glyphicon glyphicon-info-sign"></i></a>';
          endif;
           $data[] = $row;
       }

       $output = array (
           "draw" => $draw,
           "recordsTotal" => $unidades->num_rows(),
           "recordsFiltered" => $unidades->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function unidades_add() {
      $this->unidades_validate();

      if($this->input->post('status') == 'on') {
        $status = '1';
      } else {
        $status = '0';
      }
      if($this->input->post('unidade') == '') {
        $id_unidade_responsavel = NULL;
      } else {
        $id_unidade_responsavel = $this->input->post('unidade');
      }

       $data = array (
               'nome_unidade' => $this->input->post('nome'),
               'endereco_unidade' => $this->input->post('endereco'),
               'id_unidade_responsavel' => $id_unidade_responsavel,
               'status_unidade' => $status,
               'id_cidade' => $this->input->post('cidade'),
               'id_expediente' => $this->input->post('expediente'),
/*               'id_voip' => $this->input->post('voip'),
               'id_link' => $this->input->post('link'),*/
               'comentario_unidade' => $this->input->post('comentario'),
           );
       $insert_unidade = $this->unidade_model->save_unidade($data);

       if(!empty($this->input->post('telefone'))) {
         foreach ($this->input->post('telefone') as $tel) {
           if(!empty($tel)){
             $telefone = array (
                 'numero_telefone' => $tel,
                 'id_tipo_categoria_telefone' => 1,
             );
             $id_telefone = $this->telefonia_model->salvar_telefone($telefone);
             //var_dump($telefone);
             $unidade_telefone = array (
               'id_telefone' => $id_telefone,
               'id_unidade' =>  $insert_unidade
             );
             $this->unidade_model->salvar_unidade_telefone($unidade_telefone);
             //var_dump($unidade_telefone);
           } else {
            // se o campo estiver vazio não faça nada.
           }
         }
       }
       // foreach para percorre o array do input e criar o values do insert correto
       //var_dump($this->input->post('celular'));
       if(!empty($this->input->post('celular'))) {
         foreach($this->input->post('celular') as $cel) {
           if(!empty($cel)) {
             $celular = array (
                'numero_telefone'            => $cel,
                'id_tipo_categoria_telefone' => 2
             );
             $id_celular = $this->telefonia_model->salvar_telefone($celular);
             // var_dump($celular);
             $unidade_celular = array (
               'id_telefone' => $id_celular,
               'id_unidade'  =>  $insert_unidade
             );
             $this->unidade_model->salvar_unidade_telefone($unidade_celular);
             // var_dump($unidade_celular);
           } else {
             // se o campo estiver vazio não faça nada.
           }
         }
       }

       if(!empty($this->input->post('voip[]'))) {
         foreach($this->input->post('voip[]') as $voip) {
           if(!empty($voip)){
             $unidade_voip = array (
               'id_telefone' => $voip,
               'id_unidade' =>  $insert_unidade,
             );
             $this->unidade_model->salvar_unidade_telefone($unidade_voip);
           }
         }
       }

       echo json_encode(array("status" => TRUE));
    }

    public function unidades_edit($id) {
       $unidade  = $this->unidade_model->listar_unidade($id);
       $link     = $this->unidade_model->editar_link($id);
       $voip     = $this->unidade_model->edit_unidade_telefone($id,4);
       $telefone = $this->unidade_model->edit_unidade_telefone($id,1);
       $celular  = $this->unidade_model->edit_unidade_telefone($id,2);
       // var_dump($voip->result_array());
       $data = array(
        'unidade'  => $unidade->row(),
        'link'     => $link->result_array(),
        'voip'     => $voip->result_array(),
        'telefone' => $telefone->result_array(),
        'celular'  => $celular->result_array()
      );

       echo json_encode($data);
    }


    public function unidade_view($id) {
        $unidade  = $this->unidade_model->listar_unidade($id);
        $link     = $this->unidade_model->listar_link($id);

        $tecnicos  = $this->unidade_model->listar_unidade_usuario($id,6);
        $tecnico = array();
        foreach ($tecnicos->result() as $tec) {
        if($tec->id_usuario == null) {
            $row = array(
                'id_tecnico' => '',
                'nome_tecnico' => '',
                'celular_tecnico' => '',
                'telefone_tecnico' => '',
                'voip_tecnico' => ''
            );
        } else {
            $celulares = $this->usuario_model->list_usuario_telefone($tec->id_usuario,2);
            if($celulares[0]['telefone'] == NULL) {
                $cel = "";
            } else {
                  $cel = $celulares[0]['telefone'];
                  // $cel = "";
                  // vd($celulares);
                  // foreach($celulares as $celular) {
                  //  $cel .= $celular->numero_telefone. ', ';
                  // }
            }
            $telefones = $this->usuario_model->list_usuario_telefone($tec->id_usuario,1);
            if($telefones[0]['telefone'] == NULL) {
                $tel = "";
            } else {
                  $tel = $telefones[0]['telefone'];
                  // $tel = "";
                  // // vd($telefones);
                  // foreach($telefones as $telefone) {
                  //  $tel .= $telefone->numero_telefone. ', ';
                  // }
            }
            $voips = $this->usuario_model->list_usuario_telefone($tec->id_usuario,3);
            if($voips[0]['telefone'] == NULL) {
                $vp = "";
            } else {
                  $vp = $voips[0]['telefone'];
                  // $vp = "";
                  vd($voips);
                  // foreach($voips as $voip) {
                  //  $vp .= $voip->numero_telefone. ', ';
                  // }
            }
            $row = array(
                'id_tecnico' => $tec->id_usuario,
                'nome_tecnico' => $tec->nome_usuario,
                'celular_tecnico' => $cel,
                'telefone_tecnico' => $tel,
                'voip_tecnico' => $vp
            );
        }
        $tecnico[] = $row;
        }

      $servidores = $this->unidade_model->listar_unidade_usuario($id,16);
      $servidor = array();
      foreach ($servidores->result() as $serv) {
      if($serv->id_usuario == null) {
          $row = array(
              'id_servidor' => '',
              'nome_servidor' => '',
              'celular_servidor' => '',
              'telefone_servidor' => '',
              'voip_servidor' => ''
          );
      } else {
          $celulares = $this->usuario_model->list_usuario_telefone($serv->id_usuario,2);
          if($celulares[0]['telefone'] == NULL) {
              $cel = "";
          } else {
                $cel = $celulares[0]['telefone'];
                // $cel = "";
                // // vd($celulares);
                // foreach($celulares as $celular) {
                //  $cel .= $celular->numero_telefone. ', ';
                // }
          }
          $telefones = $this->usuario_model->list_usuario_telefone($serv->id_usuario,1);
          if($telefones[0]['telefone'] == NULL) {
              $tel = "";
          } else {
                $tel = $telefones[0]['telefone'];
                // $tel = "";
                // // vd($telefones);
                // foreach($telefones as $telefone) {
                //  $tel .= $telefone->numero_telefone. ', ';
                // }
          }
          $voips = $this->usuario_model->list_usuario_telefone($serv->id_usuario,3);
          if($voips[0]['telefone'] == NULL) {
              $vp = "";
          } else {
                $vp = $voips[0]['telefone'];
                // $vp = "";
                // // vd($voips);
                // foreach($voips as $voip) {
                //  $vp .= $voip->numero_telefone. ', ';
                // }
          }
          $row = array(
              'id_servidor' => $serv->id_usuario,
              'nome_servidor' => $serv->nome_usuario,
              'celular_servidor' => $cel,
              'telefone_servidor' => $tel,
              'voip_servidor' => $vp
          );
      }
      $servidor[] = $row;
      }
      $voip     = $this->unidade_model->edit_unidade_telefone($id,4);
      $telefone = $this->unidade_model->edit_unidade_telefone($id,1);
      $celular  = $this->unidade_model->edit_unidade_telefone($id,2);

      $data = array(
        'unidade'  => $unidade->row(),
        'link'     => $link->result_array(),
        'tecnico'  => $tecnico,
        'servidor' => $servidor,
        'voip'     => $voip->result_array(),
        'telefone' => $telefone->result_array(),
        'celular'  => $celular->result_array());
      // vd($data);
      echo json_encode($data);
    }


    public function unidades_update() {
       $this->unidades_validate();
       //
       //#######################TELEFONE##########################//
       //
       for ($i=0; $i < count($this->input->post('id_telefone')); $i++) {
            if($this->input->post('id_telefone')[$i] == '' and $this->input->post('telefone')[$i] != ''){
                    //ADD vd('PASSOU AQUI 1');
                    $telefone_where = array (
                              'numero_telefone' => $this->input->post('telefone')[$i],
                              'id_tipo_categoria_telefone' => 1,
                    );
                    $id_telefone = $this->telefonia_model->salvar_telefone($telefone_where);
                    $unidade_telefone = array (
                          'id_telefone' => $id_telefone,
                          'id_unidade' =>  $this->input->post('id_unidade'),
                    );
                    $this->unidade_model->salvar_unidade_telefone($unidade_telefone);
            }elseif($this->input->post('id_telefone')[$i] != '' and $this->input->post('telefone')[$i] != ''){
                    //UPDATE vd('PASSOU AQUI 2');
                    $telefone_where = array (
                              'numero_telefone' => $this->input->post('telefone')[$i],
                              'id_tipo_categoria_telefone' => 1,
                    );
                   // $telefone_dados = array (
                   //       'id_telefone' => $this->input->post('id_telefone')[$i],
                   //       'id_unidade' => $this->input->post('id_unidade'),
                   // );
                    $this->telefonia_model->update_telefone(array ('id_telefone' => $this->input->post('id_telefone')[$i]), $telefone_where);
                    // $this->unidade_model->update_unidade_telefone(array ($this->input->post('id_unidade')), $telefone_dados);
            }elseif($this->input->post('id_telefone')[$i] != '' and $this->input->post('telefone')[$i] == ''){
                    //DELETE vd('PASSOU AQUI 3');
                    $id_unidade = $this->input->post('id_unidade');
                    $id_telefone = $this->input->post('id_telefone')[$i];
                    $this->unidade_model->delete_unidade_telefone_e($id_telefone,$id_unidade);
                    $this->telefonia_model->delete_telefone($id_telefone);
            }elseif($this->input->post('id_telefone')[$i] == '' and  $this->input->post('telefone')[$i] == ''){
                    //NADA vd('PASSOU AQUI 4');
            }
           // vd('NÂO PASSOU PELO IF');
       }
       //
       //#######################CELULAR##########################//
       //
       for ($i=0; $i < count($this->input->post('id_celular')); $i++) {
            if($this->input->post('id_celular')[$i] == '' and $this->input->post('celular')[$i] != ''){
                    //ADD vd('PASSOU AQUI 1');
                    $celular_where = array (
                              'numero_telefone' => $this->input->post('celular')[$i],
                              'id_tipo_categoria_telefone' => 2,
                    );
                    $id_celular = $this->telefonia_model->salvar_telefone($celular_where);
                    $unidade_celular = array (
                          'id_telefone' => $id_celular,
                          'id_unidade' =>  $this->input->post('id_unidade'),
                    );
                    $this->unidade_model->salvar_unidade_telefone($unidade_celular);
            }elseif($this->input->post('id_celular')[$i] != '' and $this->input->post('celular')[$i] != ''){
                    //UPDATE vd('PASSOU AQUI 2');
                    $celular_where = array (
                              'numero_telefone' => $this->input->post('celular')[$i],
                              'id_tipo_categoria_telefone' => 2,
                    );
                       // $celular_dados = array (
                       //       'id_telefone' => $this->input->post('id_celular')[$i],
                       //       'id_unidade' => $this->input->post('id_unidade'),
                       // );
                    $this->telefonia_model->update_telefone(array ('id_telefone' => $this->input->post('id_celular')[$i]), $celular_where);
                    // $this->unidade_model->update_unidade_telefone(array ($this->input->post('id_unidade')), $celular_dados);
            }elseif($this->input->post('id_celular')[$i] != '' and $this->input->post('celular')[$i] == ''){
                    //DELETE vd('PASSOU AQUI 3');
                    $id_celular = $this->input->post('id_celular')[$i];
                    $id_unidade = $this->input->post('id_unidade');
                    $this->unidade_model->delete_unidade_telefone_e($id_celular,$id_unidade);
                    $this->telefonia_model->delete_telefone($id_celular);
            }elseif($this->input->post('id_celular')[$i] == '' and  $this->input->post('celular')[$i] == ''){
                    //NADA vd('PASSOU AQUI 4');
            }
           // vd('NÂO PASSOU PELO IF');
       }
       //
       //#######################VOIP##########################//
       //
       for ($i=0; $i < count($this->input->post('id_voip')); $i++) {
            if($this->input->post('id_voip')[$i] == '' and $this->input->post('voip')[$i] != ''){
                    //ADD vd('PASSOU AQUI 1');
                    $unidade_voip = array (
                          'id_telefone' => $this->input->post('voip')[$i],
                          'id_unidade' =>  $this->input->post('id_unidade')
                    );
                    $this->unidade_model->salvar_unidade_telefone($unidade_voip);
            }elseif($this->input->post('id_voip')[$i] != '' and $this->input->post('voip')[$i] != ''){
                    //UPDATE vd('PASSOU AQUI 2');
                    // $select_numero = $this->telefonia_model->select_telefone($this->input->post('voip')[$i]);
                       $celular_dados = array (
                             'id_telefone' => $this->input->post('voip')[$i],
                             'id_unidade' => $this->input->post('id_unidade'),
                       );
                    // vd($celular_dados);
                    $this->unidade_model->delete_unidade_telefone_e($this->input->post('id_voip')[$i],$this->input->post('id_unidade'));
                    $this->unidade_model->salvar_unidade_telefone($celular_dados);
            }elseif($this->input->post('id_voip')[$i] != '' and $this->input->post('voip')[$i] == ''){
                    //DELETE vd('PASSOU AQUI 3');
                    $this->unidade_model->delete_unidade_telefone_e($this->input->post('id_voip')[$i],$this->input->post('id_unidade'));
                    // $this->telefonia_model->delete_telefone($id_voip); //--> não se pode deletar o voip pode esta relacionado com um usuario.
            }elseif($this->input->post('id_voip')[$i] == '' and  $this->input->post('voip')[$i] == ''){
                    //NADA vd('PASSOU AQUI 4');
            }
           // vd('NÂO PASSOU PELO IF');
       }
       //
       //#######################UNIDADE##########################//
       //
      if($this->input->post('status') == 'on') {
        $status = '1';
      } else {
        $status = '0';
      }
      if($this->input->post('unidade') == ''){
        $id_unidade_responsavel = NULL;
      } else {
        $id_unidade_responsavel = $this->input->post('unidade');
      }

       $data = array(
               'nome_unidade' => $this->input->post('nome'),
               'endereco_unidade' => $this->input->post('endereco'),
               'id_unidade_responsavel' => $id_unidade_responsavel,
               'status_unidade' => $status,
               'id_cidade' => $this->input->post('cidade'),
               'id_expediente' => $this->input->post('expediente'),
               'comentario_unidade' => $this->input->post('comentario'),
           );
       $this->unidade_model->update_unidade(array('id_unidade' => $this->input->post('id_unidade')), $data);

       echo json_encode(array("status" => TRUE));
    }

    public function unidades_delete($id) {
        //deletar a relação unidade usuario (tecnicos e colaboradores)
        $this->unidade_model->delete_unidade_usuario($id);
        //deletar a relação unidade telefone
       $this->unidade_model->delete_unidade_telefone($id);
       $this->unidade_model->delete_unidade($id);
       $telefones = $this->unidade_model->listar_unidade_telefone($id,1);
       foreach ($telefones->result() as $telefone) {
         $this->telefonia_model->delete_telefone($telefone->id_telefone);
       }
       echo json_encode(array("status" => TRUE));
    }

    public function unidade_telefone_delete($id_telefone,$id_unidade,$tipo) {
      $this->unidade_model->delete_unidade_telefone_e($id_telefone,$id_unidade);
      if($tipo != 'voip') {
        $this->telefonia_model->delete_telefone($id_telefone);
      }
      echo json_encode(array("status" => TRUE));
    }




    public function listar_voip() {
       $data = $this->voip_model->listar_ramal();
       echo json_encode($data->result());
    }
    public function listar_link() {
        $data =  $this->unidade_model->listar_link();
        echo json_encode($data->result());
    }
    public function listar_acesso(){
        $data = $this->link_model->listar_acesso();
        echo json_encode($data->result());
    }
    public function listar_fornecedor(){
        $data = $this->fornecedor_model->listar_fornecedor();
        echo json_encode($data->result());
    }



    private function unidades_validate(){
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = TRUE;

            if($this->input->post('nome') == '') {
                $data['inputerror'][] = 'nome';
                $data['error_string'][] = 'O campo nome é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('endereco') == '') {
                $data['inputerror'][] = 'endereco';
                $data['error_string'][] = 'O campo endereço é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('cidade') == '') {
                $data['inputerror'][] = 'cidade';
                $data['error_string'][] = 'Selecione uma cidade';
                $data['status'] = FALSE;
            }

            if($this->input->post('expediente') == '') {
                $data['inputerror'][] = 'expediente';
                $data['error_string'][] = 'Selecione um horário';
                $data['status'] = FALSE;
            }

            if($data['status'] === FALSE)
            {
                echo json_encode($data);
                exit();
            }
        }


}

/* End of file Unidade.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp34749/var/www/html/portal/frontend/controllers/Unidade.php */