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

// if ( ! function_exists('image_upload')) {
//     function image_upload($name) {
//         $CI =& get_instance();
//         $CI->load->helper('file');
//         $name = str_replace(".", "_", $name);
//         $thumbinfo = get_file_info('./uploads/'.$name.'.jpg');
//         if ($thumbinfo != FALSE):
//             $retorno = base_url('uploads/'.$name.'.jpg');
//         else:
//             $retorno = base_url('uploads/no-image.jpg');
//         endif;
//         return $retorno;
//     }
// }

// if ( ! function_exists('thumbnail_upload')) {
//     function thumbnail_upload($name) {
//         $CI =& get_instance();
//         $CI->load->helper('file');
//         $name = str_replace(".", "_", $name);
//         $thumbinfo = get_file_info('./uploads/thumbs/'.$name.'.jpg');
//         if ($thumbinfo != FALSE):
//             $retorno = base_url('uploads/thumbs/'.$name.'.jpg');
//         else:
//             $retorno = base_url('uploads/thumbs/no-image.jpg');
//         endif;
//         return $retorno;
//     }

// }

?>