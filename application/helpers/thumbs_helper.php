<?php
if ( ! function_exists('create_thumb')) {
    //gera uma miniatura de uma imagem caso ela nao exista.
    function create_thumb($imagem=NULL, $largura=150, $altura=150){
        $CI =& get_instance();
        $CI->load->helper('file');
        $thumb = $largura.'x'.$altura.'_'.$imagem;

        $config = array(
            'image_library' => 'gd2',
            'source_image' => './uploads/'.$imagem,
            'new_image' => './uploads/thumbs/'.$thumb,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            // 'thumb_marker' => '_thumb',
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

    }
}

    function create_thumb2($imagem=NULL, $largura=150, $altura=150) {
        $CI =& get_instance();
        $CI->load->helper('file');
        $thumb = $largura.'x'.$altura.'_'.$imagem;
        $image_sizes = array('_avatar'=>array(75,75), '_thumb' => array(300, 200));
        // load library
        $CI->load->library('image_lib');
        foreach ($image_sizes as $key=>$resize) {
            $config = array(
                'image_library' => 'gd2',
                'source_image' => './uploads/'.$imagem,
                'new_image' => './uploads/thumbs/'.$thumb,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                // 'thumb_marker' => '_thumb',
                'width' => $largura,
                'height' => $altura
            );
            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();
            $CI->image_lib->clear();
        }
        $CI->load->library('image_lib', $config);
        $CI->image_lib->resize();
    }


?>