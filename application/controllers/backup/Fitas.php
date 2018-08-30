<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
        $diarios = $this->fitas_model->fitas_mensal_cofre_library_dataprotector();
        vd($diarios);
    }

    public function diario() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/fitas.js" type="text/javascript"></script>';
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

        $diario_lc = $this->fitas_model->diario_library_cofre();
        $diario_cl = $this->fitas_model->diario_cofre_library();

        $data['library_cofre'] =  $this->table_Library_cofre($diario_lc);
        $data['cofre_library'] = $this->table_cofre_library($diario_cl);

        $this->load->view('backup/fitas/diario', $data);

        $this->load->view('template/footer',$script);

    }

    public function mensal() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/fitas.js" type="text/javascript"></script>';
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

        $mensal_lc = $this->fitas_model->mensal_library_cofre();
        $mensal_cl = $this->fitas_model->mensal_cofre_library();

        $data['library_cofre'] = $this->table_Library_cofre($mensal_lc);;
        $data['cofre_library'] = $this->table_cofre_library($mensal_cl);

        $this->load->view('backup/fitas/mensal', $data);

        $this->load->view('template/footer',$script);
    }

    public function poor() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/fitas.js" type="text/javascript"></script>';
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


        $data['fitas_poor'] = $this->table_poor();

        $this->load->view('backup/fitas/poor', $data);

        $this->load->view('template/footer',$script);
    }

    public function table_Library_cofre($variaveis) {
        $html = "";
        $contador = 1;
        foreach($variaveis as $variavel){
                    $Robo = $variavel['Location'];
                    $Slot = substr($Robo, -3, 2);
                    $Robo = strstr($Robo, "IBM");
                    if ($Robo != ""):
                        $Robo = "IBM";
                    else:
                        $Robo = "HP";
                    endif;

                    if ($Slot <= 9):
                        $Local = "EI";
                    elseif (($Slot > 9) AND ($Slot <=21)):
                        $Local = "ES";
                    elseif (($Slot > 21) AND ($Slot <=33)):
                        $Local = "DI";
                    else:
                        $Local = "DS";
                    endif;
                $Porcentagem = $variavel['Porcentagem'];
                $html .= "<tr>\n";
                $html .= "  <td>".$contador++."</td>\n";
                $html .= "  <td>".$variavel['Label']."</td>\n";
                if ($Porcentagem == '100' OR $Porcentagem >= '80'){
                    $html .= "  <td>
                                    <div class='progress progress-striped active'>
                                        <div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>
                                            <span style='font-weight: bold;'>".$variavel['Porcentagem']."%</span>
                                        </div>
                                    </div>
                                </td>\n";
                } else if ($Porcentagem >='70') {
                    $html .= "  <td>
                                    <div class='progress progress-striped active'>
                                        <div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100' style='width: 80%'>
                                            <span style='font-weight: bold;'>".$variavel['Porcentagem']."%</span>
                                        </div>
                                    </div>
                                </td>\n";
                } else if ($Porcentagem >='30') {
                    $html .= "  <td>
                                    <div class='progress progress-striped active'>
                                        <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='30' aria-valuemin='0' aria-valuemax='100' style='width: 30%'>
                                            <span style='font-weight: bold;'>".$variavel['Porcentagem']."%</span>
                                        </div>
                                    </div>
                                </td>\n";
                } else {
                    $html .= "  <td>
                                    <div class='progress progress-striped active'>
                                        <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 10%'>
                                            <span style='font-weight: bold;'>".$variavel['Porcentagem']."%</span>
                                        </div>
                                    </div>
                                </td>\n";
                }
                $html .= "  <td>".$variavel['ProtectionDate']."</td>\n";
                $html .= "  <td>".$Robo."</td>\n";
                $html .= "  <td>".$Slot."</td>\n";
                $html .= "  <td>".$Local."</td>\n";
                if ($Porcentagem == '100'){
                    $html .= "<td><span class='label label-danger'</span> Retirar da Library </td>\n";
                } else {
                    $html .= "<td><span class='label label-success'</span> Manter na Library </td>\n";
                }
                $html .= "</tr>\n";
        }
        return $html;
    }

    public function table_cofre_library($variaveis) {
               $html = "";
            $contador = 1;
            foreach($variaveis as $variavel){
                $data_fita = $variavel['ProtectionDate'];
                $data_corrente = date('Y-m-d');
                $html .= "<tr>\n";
                $html .= "  <td>".$contador++."</td>\n";
                $html .= "  <td>".$variavel['Label']."</td>\n";
                $html .= "  <td>".$variavel['ProtectionDate2']."</td>\n";
                if ($data_fita <= $data_corrente){
                    $html .= "<td><span class='label label-danger'</span> Retirar do Vault </td>\n";
                } else {
                    $html .= "<td><span class='label label-success'</span> Manter no Vault </td>\n";
                }
                $html .= "</tr>\n";
            }
            return $html;
    }

    public function table_poor() {
            $poors = $this->fitas_model->fitas_poor();
            $html = "";
            $contador = 1;

            foreach ($poors as $poor) {
            // while ($poor = mysqli_fetch_assoc($rs)) {
                $html .= "<tr>\n";
                $html .= "  <td>".$contador++."</td>\n";
                $html .= "  <td>".utf8_encode($poor['ocorrencia'])."</td>\n";
                $html .= "  <td>".utf8_encode($poor['label'])."</td>\n";
                $html .= "  <td>".utf8_encode($poor['pool'])."</td>\n";
                $html .= "  <td>".utf8_encode($poor['drive'])."</td>\n";
                $html .= "  <td>".utf8_encode($poor['data_session'].$poor['session'])."</td>\n";
                $html .= "  <td>
                                <div class='btn-group'>
                                    <a class='btn btn-link dropdown-toggle' data-toggle='dropdown' href='#'><span class='caret'></span></a>
                                    <ul class='dropdown-menu'>
                                    <a href='?m=analise&f=backup&a=fitas_poor_alterar&id=".$poor['id']."'><i class='icon-pencil'></i> Editar</a>
                                    <a href='?m=analise&f=backup&a=fitas_poor_deletar&id=".$poor['id']."'><i class='icon-trash'></i> Deletar</a>
                                    </ul>
                                </div>
                            </td>";
                $html.= "</tr>";
            }
        return $html;
    }
}

/* End of file Fitas.php */
/* Location: ./application/controllers/backup/Fitas.php */