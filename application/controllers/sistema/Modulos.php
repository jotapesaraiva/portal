<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('modulos_model');
    }

    public function index()
    {
        $this->output->enable_profiler(FALSE);

        $css['headerinc'] = '
            <link href="'.base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        ';
        $script['script'] = '';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/sistema/modulos.js"></script>
        ';

        $session['username'] = $this->session->userdata('username');
        $data['modulo'] = $this->listar();

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
        $this->breadcrumbs->push('<span>Consulta</span>', '/sistema/consulta');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('sistema/modulos',$data);

        $this->load->view('template/footer',$script);
    }


    public function listar()
    {

        $modulos = $this->modulos_model->listar_modulos();
        $html = '';
        foreach ($modulos as $key => $value) {
            $html .= '<div class="form-body">';
            $html .=  '<div class="form-group">';
            $html .=    '<label class="control-label col-md-3 bold uppercase">'.$value['aplicacao'].' :</label>';
            $html .=   '<div class="col-md-9 text-center">';
            if($value['status'] == '1'){
                    $html .= '<input name="'.$value['aplicacao'].'" type="checkbox" checked class="make-switch" data-size="small">';

            } else {
                    $html .= '<input name="'.$value['aplicacao'].'" type="checkbox" class="make-switch" data-size="small">';
            }
            $html .=   '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
        // return $modulos;
    }

    public function modulos_update() {

        $modulos = $this->modulos_model->listar_modulos();
        foreach ($modulos as $value) {
            if($this->input->post($value['aplicacao']) == 'on'){
                $status = '1';
            } else {
                $status = '0';
            }
            $this->modulos_model->update_modulos(array('id' => $value['id']),array('status' => $status ) );
        }
        echo json_encode(array("status" => TRUE));
    }

}

/* End of file Modulos.php */
/* Location: ./application/controllers/sistema/Modulos.php */