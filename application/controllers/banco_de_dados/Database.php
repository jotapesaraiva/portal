<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //$this->load->dbutil();
        //$this->oracle_db=$this->load->database('oracle',true);
        //$this->mysql_db=$this->load->database('default',true);
        //$this->myutil = $this->load->dbutil('oracle', TRUE);
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/logout');
        }
    }
     public function index() {
        //$data['teste'] = $this->link_model->listar();
        // $this->load->view('sistema');//, $data);
     }

     public function teste() {
        echo date_default_timezone_get();
        echo "<br>";
        $this->db = $this->load->database('portalm', TRUE);
        $this->load->dbutil();
        if ($this->dbutil->database_exists('test')) {
                echo "OK";
        }
        $dbs = $this->dbutil->list_databases();

        foreach($dbs as $db) {
            echo $db . "<br>";
        }
     }

     public function configuracao(){
        $CI = &get_instance();
        $CI->load->database();
        // echo $CI->db->database;

        $db = array();
        $active_group = '';
        include(APPPATH.'config/database.php');

        $script['footerinc'] = '';
        $script['script']    = '';
        $css['headerinc']    = '';
        $session['username'] = $this->session->userdata('username');

        $dados['default_hostname'] = $db['default']['hostname'];
        $dados['default_database'] = $db['default']['database'];
        $dados['default_username'] = $db['default']['username'];
        $dados['default_password'] = $db['default']['password'];
        $dados['default_dbdriver'] = $db['default']['dbdriver'];

        $dados['portalm_hostname'] = $db['portalm']['hostname'];
        $dados['portalm_database'] = $db['portalm']['database'];
        $dados['portalm_username'] = $db['portalm']['username'];
        $dados['portalm_password'] = $db['portalm']['password'];
        $dados['portalm_dbdriver'] = $db['portalm']['dbdriver'];

        $dados['portalmoni_hostname'] = $db['portalmoni']['hostname'];
        $dados['portalmoni_database'] = $db['portalmoni']['database'];
        $dados['portalmoni_username'] = $db['portalmoni']['username'];
        $dados['portalmoni_password'] = $db['portalmoni']['password'];
        $dados['portalmoni_dbdriver'] = $db['portalmoni']['dbdriver'];

        // $dados['oracle_hostname'] = $db['oracle']['hostname'];
        // $dados['oracle_database'] = $db['oracle']['database'];
        // $dados['oracle_username'] = $db['oracle']['username'];
        // $dados['oracle_password'] = $db['oracle']['password'];
        // $dados['oracle_dbdriver'] = $db['oracle']['dbdriver'];
        $dados['oracle_hostname'] = '';
        $dados['oracle_database'] = '';
        $dados['oracle_username'] = '';
        $dados['oracle_password'] = '';
        $dados['oracle_dbdriver'] = '';

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('banco_de_dados/configuracao', $dados);
        // $this->load->view('modal/modal_tecnico', $dados);

        $this->load->view('template/footer',$script);
     }

     public function backup($dado){
        $this->output->enable_profiler(TRUE);
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
        $save = '/var/www/html/portal/file/'.$db_name;
        // Load the file helper and write the file to your server
        write_file($save, $backup);
        // Load the download helper and send the file to your desktop
        force_download($db_name, $backup);
        echo "backup ok !!!";
     }

     public function view_path() {
         $this->load->helper('directory'); //load directory helper
         $dir = APPPATH. "file/";
         $map = directory_map($dir);
         echo "<select name='yourfiles'>";
        function show_dir_files($in,$path) {
            foreach ($in as $k => $v) {
                 if (!is_array($v)) {
                 echo "<option>". $path,$v ."</option>";
                 } else {
                    print_dir($v,$path.$k.DIRECTORY_SEPARATOR);
                }
            }
         }
         show_dir_files($map,'');  // call the function
         echo "</select>";

     }

     // backup files in directory
     function files() {
        $opt = array(
          'src' => '', // dir name to backup
          'dst' => 'backup/files' // dir name backup output destination
        );
        // Codeigniter v3x
        $this->load->library('recurseZip_lib', $opt);
        $download = $this->recursezip_lib->compress();
        /* Codeigniter v2x
        $zip    = $this->load->library('recurseZip_lib', $opt);
        $download = $zip->compress();
        */
        redirect(base_url($download));
     }


     public function timezone(){
        $timezones =  DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        foreach ($timezones as $timezone) {
           echo $timezone;
           echo "</br>";
        }
     }
    //Get Browser Information in CodeIgniter
     public function browser() {
        $this->load->library('user_agent');
        echo " You are using : ". $this->agent->browser(). "; Version # ". $this->agent->version();
        echo "; Sistema Operacional ". $this->agent->platform();
     }

     public function view_file() {
        $this->load->helper('directory'); //load directory helper
        $map = directory_map('/var/www/html/portal/backups'); // returns array with content of the folder
        //var_dump($map); // returns array('1'=>'index.php','2'=>'style.css')
        //$dir_map = directory_map('../folder_name/', 2); // return content of the folder with 2 levels deep
        //$dir_map = directory_map('../folder_name/', FALSE, TRUE); // return content of the folder with hidden files
     function print_dir($in,$depth) {
         foreach ($in as $k => $v) {
             if (!is_array($v))
                 echo "<p>",str_repeat("&nbsp;&nbsp;&nbsp;",$depth)," ",$v," [file]</p>";
             else
                 echo "<p>",str_repeat("&nbsp;&nbsp;&nbsp;",$depth)," <b>",$k,"</b> [directory]</p>",print_dir($v,$depth+1);
         }
     }
     print_dir($map,0);

     function print_dir2($in){
         foreach ($in as $k => $v) {
             if (!is_array($v))
                 echo "[file]: ",$v,"\n";
             else
                 echo "[directory]: ",$k,"\n",print_dir($v);
         }
     }

     function print_dir3($in,$path) {
         foreach ($in as $k => $v) {
             if (!is_array($v))
                 echo "[file]: ",$path,$v,"\n";
             else
                 echo "[directory]: ",$path,$k,"\n",print_dir($v,$path.$k.DIRECTORY_SEPARATOR);
         }
     }

     function print_dir4($in,$path) {
         $buff = '';
         foreach ($in as $k => $v) {
             if (!is_array($v))
                 $buff .= "[file]: ".$path.$v."\n";
             else
                 $buff .= "[directory]: ".$path.$k."\n".print_dir($v,$path.$k.DIRECTORY_SEPARATOR);
         }
         return $buff;
     }
     }

     public function teste_file() {
         $iterator = new FilesystemIterator('/var/www/html/portal/backups');
         foreach($iterator as $fileInfo){
             if($fileInfo->isFile()){//Arquigo
                 $cTime = new DateTime();
                 $cTime->setTimestamp($fileInfo->getMTime());
                 echo "<b>File Name:</b> ". $fileInfo->getFileName() . " <b>File Created:</b> " . $cTime->format('d-m-Y H:i:s') /*$cTime->format('d-m-Y h:i:s')*/ . " <b>File Size:</b> ". FileSizeConvert($fileInfo->getSize()) ." <br/>\n";
             }
             if($fileInfo->isDir()){//Diretorio
                 $cTime = new DateTime();
                 $cTime->setTimestamp($fileInfo->getMTime());
                 echo "<b>File Name:</b> ". $fileInfo->getFileName() . " <b>dir Modified:</b> " . $cTime->format('d-m-Y H:i:s') . " <b>File Size:</b> ". FileSizeConvert($fileInfo->getSize()) . " <br/>\n";
             }
         }
     }


     public function delet_file($arquivo) {
         // Script para deletar arquivos
         // unlink -> função do php para deletar arquivo
        // $this->load->helper('directory'); //load directory helper
        // $map = directory_map('/var/www/html/portal/backups'); // returns array with content of the folder
        if($arquivo){
            if(file_exists($arquivo)){
            unlink($arquivo);
            echo("<font color=\"green\">" .$arquivo . " deletado com sucesso!!");
        }else{
            echo("<font color=\"red\">" . $arquivo . " não existe!</font>");
        }
        }else{
            echo"Especifique o nome do arquivo.";
        }
     }

     private function getFiles($basename = true) {
         $files = glob(APPPATH. '/logs/log-*.php');
         $files = array_reverse($files);
         $files = array_filter($files, 'is_file');
         if ($basename && is_array($files)) {
             foreach ($files as $k => $file) {
                 $files[$k] = basename($file);
             }
         }
         return array_values($files);
     }

}