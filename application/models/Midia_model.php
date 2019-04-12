<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midia_model extends CI_Model {


    public function do_upload($campo) {
        $config = array(
        'upload_path' => "./uploads/",
        'allowed_types' => "gif|jpg|png|jpeg",
        'overwrite' => TRUE,
        'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        'max_height' => "768",
        'max_width' => "1024"
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($campo)):
            return $this->upload->data();
        else:
            return $this->upload->display_errors();
        endif;
    }


}

/* End of file Midia_model.php */
/* Location: ./application/models/Midia_model.php */