<?php


    //gera uma miniatura de uma imagem caso ela nao exista.
    function thumb($imagem=NULL, $largura=100, $altura=75, $geratag=TRUE){
        $CI =& get_instance();
        $CI->load->helper('file');
        $thumb = $largura.'x'.$altura.'_'.$imagem;
        $thumbinfo = get_file_info('./uploads/thumbs/'.$thumb);
        if ($thumbinfo != FALSE):
            $retorno = base_url('uploads/thumbs/'.$thumb);
        else:
            $CI->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/'.$imagem;
            $config['new_image'] = './uploads/thumbs/'.$thumb;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $largura;
            $config['height'] = $altura;
            $CI->image_lib->initialize($config);
            if ($CI->image_lib->resize()):
                $CI->image_lib->clear();
                $retorno = base_url('uploads/thumbs/'.$thumb);
            else:
                $retorno = FALSE;
            endif;
        endif;
        if ($geratag && $retorno != FALSE) $retorno = '<img src=" '.$retorno.' " alt="" />';
        return $retorno;
    }
 ?>