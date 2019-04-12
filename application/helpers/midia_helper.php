<?php
if ( ! function_exists('do_upload')) {
    function do_upload($campo,$nome) {
        $CI =& get_instance();
        $config = array(
            'file_name'     => $nome.'.jpg',
            'upload_path'   => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite'     => TRUE,
            'max_size'      => "250000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height'    => "768",
            'max_width'     => "1024"
        );
        $CI->load->library('upload', $config);
        if ($CI->upload->do_upload($campo)):
            return $CI->upload->data();
        else:
            return $CI->upload->display_errors();
        endif;
    }
}
?>