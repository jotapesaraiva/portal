<?php
if ( ! function_exists('create_thumb')) {
    //gera uma miniatura de uma imagem caso ela nao exista.
    function create_thumb($imagem=NULL, $largura=150, $altura=150){
        $CI =& get_instance();
        $CI->load->helper('file');
        $thumb = $largura.'x'.$altura.'_'.$imagem;
        $thumbinfo = get_file_info('./uploads/thumbs/'.$thumb);
        if ($thumbinfo != FALSE):
            $retorno = base_url('uploads/thumbs/'.$thumb);
        else:
            $config = array(
                'image_library' => 'gd2',
                'source_image' => './uploads/'.$imagem,
                'new_image' => './uploads/thumbs/'.$thumb,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'thumb_marker' => '_thumb',
                'width' => $largura,
                'height' => $altura
            );
            // $CI->image_lib->initialize($config);
            $CI->load->library('image_lib',$config);
            if ($CI->image_lib->resize()):
                $CI->image_lib->clear();
                return TRUE;
            else:
                return $CI->image_lib->display_errors();
            endif;
        endif;
    }
}

?>