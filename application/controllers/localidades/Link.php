<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

    public function __construct() {
        parent::__construct();
        esta_logado();
    }

     public function index() {
           $script['footerinc'] = '
               <script src="'.base_url().'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
               <script src="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
               <script src="'.base_url().'assets/custom/localidades/link.js" type="text/javascript"></script>
               <script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
               <script src="'.base_url().'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>';
           $script['script'] = '';

           $css['headerinc'] = '
               <link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
               <link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
               <link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
               <link href="'.base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />';

             $unidades = $this->unidade_model->listar_unidade();
             $velocidades = $this->link_model->listar_velocidade();
             $acessos = $this->link_model->listar_acesso();
             $fornecedores = $this->fornecedor_model->listar_fornecedor();
             $dados = array("fornecedores" => $fornecedores, "unidades" => $unidades, "velocidades" => $velocidades, "acessos" => $acessos);
             $session['username'] = $this->session->userdata('username');

             $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
             $this->breadcrumbs->push('<span>Localidades</span>', '/localidades');
             $this->breadcrumbs->push('<span>links</span>', '/localidades/links');

             $this->load->view('template/header',$css);
             $this->load->view('template/navbar',$session);
             $this->load->view('template/sidebar');

             $this->load->view('localidades/links');
             $this->load->view('modal/modal_link', $dados);

             $this->load->view('template/footer',$script);
         }

         public function link_list() {
            // Datatables Variables
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));

            $links = $this->link_model->listar_link();

            $data = array();

            foreach($links->result() as $link) {
                $row = array();
                // $row[] = $link->id_link;
                $row[] = $link->nome_link;
                $row[] = $link->nome_unidade;
                $row[] = $link->ip_lan_link;
                $row[] = $link->ip_wan_link;
                $row[] = $link->designacao_link;
                $row[] = $link->nome_tipo_velocidade .' Kbps';
                $row[] = $link->nome_tipo_acesso;
                $row[] = $link->nome_fornecedor;
                if ($link->backup_link == '1'){
                 $row[] = '<span class="label label-sm label-success"> Sim. </span>';
                } else {
                 $row[] = '<span class="label label-sm label-warning"> Não. </span>';
                }
                if ($link->status_link == '1'){
                 $row[] = '<span class="label label-sm label-info"> Ativo. </span>';
                } else {
                 $row[] = '<span class="label label-sm label-danger"> Desativado. </span>';
                }
                if(acesso_admin()):
                $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Editar" onclick="edit_person('."'".$link->id_link."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                          <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Deletar" onclick="delete_person('."'".$link->id_link."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
                else:
                   $row[] = 'Sem permissão';
                endif;
                $data[] = $row;
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $links->num_rows(),
                "recordsFiltered" => $links->num_rows(),
                "data" => $data,
            );
            echo json_encode($output);
         }

         public function link_add() {
            $this->link_validate();
            if($this->input->post('status') == 'on') {
              $status = '1';
            } else {
              $status = '0';
            }
            if($this->input->post('backup') == 'on'){
              $backup = '1';
            } else {
              $backup = '0';
            }
            $data = array (
                    'nome_link' => $this->input->post('nome_link'),
                    'ip_lan_link' => $this->input->post('ip_lan'),
                    'ip_wan_link' => $this->input->post('ip_wan'),
                    'designacao_link' => $this->input->post('designacao'),
                    'status_link' => $status,
                    'backup_link' => $backup,
                    'id_tipo_velocidade' => $this->input->post('velocidade'),
                    'id_tipo_acesso' => $this->input->post('acesso'),
                    'id_unidade' => $this->input->post('unidade'),
                    'id_fornecedor' => $this->input->post('fornecedor'),
                );
            //var_dump($data);
            $insert = $this->link_model->save_link($data);
            echo json_encode(array ("status" => TRUE));
         }

         public function link_edit($id) {
            $data = $this->link_model->edit_link($id);
            echo json_encode($data);
         }

         public function link_update() {
            $this->link_validate();
            if($this->input->post('status') == 'on') {
              $status = '1';
            } else {
              $status = '0';
            }
            if($this->input->post('backup') == 'on'){
              $backup = '1';
            } else {
              $backup = '0';
            }
            $data = array (
                    'nome_link' => $this->input->post('nome_link'),
                    'ip_lan_link' => $this->input->post('ip_lan'),
                    'ip_wan_link' => $this->input->post('ip_wan'),
                    'designacao_link' => $this->input->post('designacao'),
                    'status_link' => $status,
                    'backup_link' => $backup,
                    'id_tipo_velocidade' => $this->input->post('velocidade'),
                    'id_tipo_acesso' => $this->input->post('acesso'),
                    'id_unidade' => $this->input->post('unidade'),
                    'id_fornecedor' => $this->input->post('fornecedor'),
                );
            // var_dump($data);
            $this->link_model->update_link(array ('id_link' => $this->input->post('id')), $data);
            echo json_encode(array ("status" => TRUE));
         }

         public function link_delete($id) {
            $this->link_model->delete_link($id);
            echo json_encode(array("status" => TRUE));
         }

         private function link_validate() {
             $data = array();
             $data['error_string'] = array ();
             $data['inputerror'] = array ();
             $data['status'] = TRUE;

             if($this->input->post('nome_link') == '') {
                 $data['inputerror'][] = 'nome_link';
                 $data['error_string'][] = 'O campo nome é obrigatorio';
                 $data['status'] = FALSE;
             }

             if($this->input->post('ip_lan') == '') {
                 $data['inputerror'][] = 'ip_lan';
                 $data['error_string'][] = 'O campo ip é obrigatorio';
                 $data['status'] = FALSE;
             }

             if($this->input->post('velocidade') == '') {
                 $data['inputerror'][] = 'velocidade';
                 $data['error_string'][] = 'Selecione uma empresa';
                 $data['status'] = FALSE;
             }

             if($this->input->post('acesso') == '') {
                 $data['inputerror'][] = 'acesso';
                 $data['error_string'][] = 'Selecione uma empresa';
                 $data['status'] = FALSE;
             }

             if($this->input->post('unidade') == '') {
                 $data['inputerror'][] = 'unidade';
                 $data['error_string'][] = 'Selecione uma empresa';
                 $data['status'] = FALSE;
             }

             if($this->input->post('fornecedor') == '') {
                 $data['inputerror'][] = 'fornecedor';
                 $data['error_string'][] = 'Selecione uma empresa';
                 $data['status'] = FALSE;
             }

             if($data['status'] === FALSE) {
                 echo json_encode($data);
                 exit();
             }
         }
}

/* End of file Link.php */
/* Location: ./application/controllers/Link.php */