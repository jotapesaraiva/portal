<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
        echo "TESTE";
        $diarios = $this->fitas_model->fitas_mensal_cofre_library_dataprotector();
        vd($diarios);
    }

    public function diario() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/backup/diario.js" type="text/javascript"></script>';
        $script['script'] = '';
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Fitas</span>', '/backup/fitas');
        $this->breadcrumbs->push('<span>Diário</span>', '/backup/fitas/diario');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $data['pagina'] = 'diario';

        $this->load->view('backup/fitas/diario', $data);

        $this->load->view('template/footer',$script);

    }

    public function mensal() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/backup/mensal.js" type="text/javascript"></script>';
        $script['script'] = '';
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Fitas</span>', '/backup/fitas');
        $this->breadcrumbs->push('<span>Mensal</span>', '/backup/fitas/mensal');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $data['pagina'] = 'mensal';

        $this->load->view('backup/fitas/mensal', $data);

        $this->load->view('template/footer',$script);
    }

    public function poor() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/backup/poor.js" type="text/javascript"></script>';
        $script['script'] = '';
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Fitas</span>', '/backup/fitas');
        $this->breadcrumbs->push('<span>Poor</span>', '/backup/fitas/poor');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/fitas/poor');

        $this->load->view('template/footer',$script);
    }

    public function table_lc($value) {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        if($value == 'diario') {
            $resultado = $this->fitas_model->diario_library_cofre();
        } else{
            $resultado = $this->fitas_model->mensal_library_cofre();
        }

        $data = array();
        foreach ($resultado->result_array() as $key => $value) {
            $row = array();

            $row[] = $key+1;//id
            $row[] = $value['Label'];//label
            $row[] = $this->porcentagem($value['Porcentagem']);//porcentagem
            $row[] = $value['ProtectionDate']; //protecao
            $row[] = $this->robo($value['Location']);//robo
            $row[] = substr($value['Location'], -3, 2);//slot
            $row[] = $this->local($value['Location']);//local
            $row[] = utf8_encode($value['Porcentagem']);//retirar
            $data[] = $row;
        }
        $output = array (
            "draw"            => $draw,
            "recordsTotal"    => $resultado->num_rows(),
            "recordsFiltered" => $resultado->num_rows(),
            "data"            => $data,
        );
        echo json_encode($output);
    }

    public function local($value) {
        $Slot = substr($value, -3, 2);
        if ($Slot <= 9):
            return "EI";
        elseif (($Slot > 9) AND ($Slot <=21)):
            return "ES";
        elseif (($Slot > 21) AND ($Slot <=33)):
            return "DI";
        else:
            return "DS";
        endif;
    }

    public function robo($value) {
        $Robo = strstr($value, "IBM");
        if ($Robo != ""):
            return "IBM";
        else:
            return "HP";
        endif;
    }
    public function porcentagem($value) {
        if ($value == '100' OR $value >= '80'){
            $progressBar = 'danger';
            $ariaValueNow = '100';
            $width = '100';
        } else if ($value >='70') {
            $progressBar = 'warning';
            $ariaValueNow = '80';
            $width = '80';
        } else if ($value >='30') {
            $progressBar = 'success';
            $ariaValueNow = '30';
            $width = '30';
        } else {
            $progressBar = 'info';
            $ariaValueNow = '10';
            $width = '10';
        }
            return "   <div class='progress progress-striped active'>
                            <div class='progress-bar progress-bar-".$progressBar."' role='progressbar' aria-valuenow='".$ariaValueNow."' aria-valuemin='0' aria-valuemax='100' style='width: ".$width."%'>
                                <span style='font-weight: bold;'>".$value."%</span>
                            </div>
                        </div>";
    }

    public function table_cl($value) {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        if($value == 'diario'){
            $resultado = $this->fitas_model->diario_cofre_library();
        } else {
            $resultado = $this->fitas_model->mensal_cofre_library();
        }

        $data = array();
        foreach ($resultado->result_array() as $key => $value) {
            $row = array();

            $row[] = $key+1;//id
            $row[] = $value['Label'];//label
            $row[] = $value['ProtectionDate2']; //protecao
            if ($value['ProtectionDate'] <= date('Y-m-d')):
                    $row[] = "<span class='label label-danger'</span> Retirar do Vault";
            else:
                    $row[] = "<span class='label label-success'</span> Manter no Vault";
            endif;

            $data[] = $row;
        }
        $output = array (
            "draw"            => $draw,
            "recordsTotal"    => $resultado->num_rows(),
            "recordsFiltered" => $resultado->num_rows(),
            "data"            => $data,
        );
        echo json_encode($output);
    }

    public function table_poor() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $poors = $this->fitas_model->fitas_poor();

        $data = array();
        foreach ($poors->result_array() as $key => $value) {
            $row = array();

            $row[] = $key+1;//id
            $row[] = utf8_encode($value['ocorrencia']);//label
            $row[] = utf8_encode($value['label']);//porcentagem
            $row[] = utf8_encode($value['pool']); //protecao
            $row[] = utf8_encode($value['drive']); //protecao
            $row[] = utf8_encode($value['data_session'].$value['session']); //protecao

            $data[] = $row;
        }
        $output = array (
            "draw"            => $draw,
            "recordsTotal"    => $poors->num_rows(),
            "recordsFiltered" => $poors->num_rows(),
            "data"            => $data,
        );
        echo json_encode($output);
    }

}

/* End of file Fitas.php */
/* Location: ./application/controllers/backup/Fitas.php */