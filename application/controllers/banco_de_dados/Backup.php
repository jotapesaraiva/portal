<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/backup/historico.js" type="text/javascript"></script>';
        $script['script']    = '';
        $css['headerinc']    = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $session['username'] = $this->session->userdata('username');
        $data['files']       = $this->table();

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Banco de Dados</span>', 'banco_de_dados;');
        $this->breadcrumbs->push('<span>Backup</span>', '/banco_de_dados/backup');


        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('banco_de_dados/backup', $data);

        $this->load->view('template/footer',$script);
    }


    public function manual($dado) {
       $this->output->enable_profiler(FALSE);
       // Needed helpers
       $this->load->helper('download');
       $this->load->helper('file');
       $this->db = $this->load->database($dado, TRUE);
       $this->load->dbutil();
       // Backup the DB
       $prefs = array(
           'format' => 'zip',              // gzip, zip, txt
           'filename' => 'dbbackup.sql',   // File name - NEEDED ONLY WITH ZIP FILES
           'newline' => "\r\n"             // Newline character used in backup file
       );
       $backup = $this->dbutil->backup($prefs);

       $db_name = 'backup-on-'. date("Y-m-d-H_i_s") .'.zip';
       $save = '/var/www/html/portal/backups/'.$db_name;
       // Load the file helper and write the file to your server
       write_file($save, $backup);
       // if(!write_file($save, $backup)){
       //    set_msg('msgOk','Erro ao salvar backup no servidor.','erro');
       //    redirect('banco_de_dados/backup/index');
       // }
       // Load the download helper and send the file to your desktop
       force_download($db_name, $backup);
       sleep(2);
       set_msg('msgOk','Backup realizado com sucesso !!!','sucesso');
       redirect('banco_de_dados/backup/index');
       // $this->redirect_to(site_url('banco_de_dados/backup/index'));
       // redirect(site_url('index'), 'refresh');
       // echo "OK";
    }

    // public function redirect_to($location){
    //   if(!headers_sent())
    //     header("Location: {$location}");
    //   else
    //     echo "<script>window.location.href='{$location}';</script>";
    //   exit;
    // }

    public function file_download($file_name) {
        $this->load->helper('download');
        $this->load->helper('file');
        force_download('/var/www/html/portal/backups/'.$file_name,null);
    }

    public function file_delete($file_name) {
      $path = APPPATH.'../backups/'.$file_name;
      unlink($path);
      // set_msg('msgOk','Arquivo excluido com sucesso !!!','sucesso');
      redirect('banco_de_dados/backup');
    }


    public function table() {
        $iterator = new FilesystemIterator('/var/www/html/portal/backups');
        $html = "";
        foreach($iterator as $fileInfo){
            if($fileInfo->isFile()) {//Arquigo
                $cTime = new DateTime();
                $cTime->setTimestamp($fileInfo->getMTime());
                // echo "<b>File Name:</b> ". $fileInfo->getFileName() . " <b>File Created:</b> " . $cTime->format('d-m-Y h:i:s') . " <b>File Size:</b> ". FileSizeConvert($fileInfo->getSize()) ." ".anchor($this->delet_file($fileInfo->getFileName()),'Excluir arquivo')." <br/>\n";
                // echo "<b>File Name:</b> ". $fileInfo->getFileName() . " <b>File Created:</b> " . $cTime->format('d-m-Y h:i:s') . " <b>File Size:</b> ". FileSizeConvert($fileInfo->getSize()) ." ".anchor($this->delet_file($fileInfo->getFileName()),'Excluir arquivo')." <br/>\n";
                $html .= "<tr>\n";
                $html .= "<td>". $fileInfo->getFileName() . "</td>\n";
                $html .= "<td>". $cTime->format('d-m-Y h:i:s') . "</td>\n";
                $html .= "<td>". FileSizeConvert($fileInfo->getSize()) . "</td>\n";
                //$html .= "<td>". anchor('','Excluir') ." / ".anchor('','Download')."</td>\n";
                $html .= "<td>
                          <a class='btn green btn-outline sbold' href='".base_url()."banco_de_dados/backup/file_download/".$fileInfo->getFileName()."' title='Download'><i class='fa fa-download'></i></a>
                          <a class='btn red-mint btn-outline sbold' href='".base_url()."banco_de_dados/backup/file_delete/".$fileInfo->getFileName()."' title='Excluir'><i class='glyphicon glyphicon-trash'></i></a></td>";
                $html .= "</tr>\n";
            }
            if($fileInfo->isDir()) {//Diretorio
                $cTime = new DateTime();
                $cTime->setTimestamp($fileInfo->getMTime());
                echo "<b>File Name:</b> ". $fileInfo->getFileName() . " <b>dir Modified:</b> " . $cTime->format('d-m-Y h:i:s') . " <b>File Size:</b> ". FileSizeConvert($fileInfo->getSize()) . " <br/>\n";
            }
        }
        return $html;
    }

}

/* End of file backup.php */
/* Location: ./application/controllers/banco_de_dados/backup.php */