<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <?php echo $this->breadcrumbs->show(); ?>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <br>
        <!-- <h3 class="page-title"> Link
            <small>Tipo de acesso</small>
        </h3> -->
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12">
              <div id="msgs"></div>
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet light bordered">
                   <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Mensagem de rede </span>
                    </div>
                   </div>
                   <div class="portlet-body">
                        <?php echo form_open('dash/mensagem_rede/abrir_mantis', array('id' => 'form','class' => 'form-horizontal')); ?>
                        <?php echo form_hidden('id', $result->id); ?>
                        <div class="form-horizontal">
                            <div class="form-body">
                                <!-- div.form-group>label.col-md-2 control-label{Data Inicio}+input.col-md-10.form-control.input-line.input-small -->
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Usuário</label>
                                    <input type="text" value = "<?php echo set_value('usuario', $result->post_user); ?>" name="usuario" class="col-md-4h form-control input-line input-medium">
                                    <?php echo form_error('usuario');?>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Avaliador</label>
                                    <input type="text" value = "<?php echo set_value('avaliador', $result->approved_user); ?>" name="avaliador" class="col-md-10 form-control input-line input-medium">
                                    <?php echo form_error('avaliador');?>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Operador</label><!-- $result->received_user -->
                                    <input type="text" value = "<?php echo set_value('operador',$operador ); ?>" name="operador" class="col-md-10 form-control input-line input-medium">
                                    <?php echo form_error('operador');?>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Data Inicio</label>
                                    <input type="text" value = "<?php echo set_value('datai',$result->start_date); ?>" name="datai" class="col-md-10 form-control input-line input-small">
                                    <?php echo form_error('datai');?>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Data Fim</label>
                                    <input type="text" value = "<?php echo set_value('dataf',$result->stop_date); ?>" name="dataf" class="col-md-10 form-control input-line input-small">
                                    <?php echo form_error('dataf');?>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Tipo de Mensagem</label>
                                    <div class="col-md-10">
                                        <div class="margin-bottom-10">
                                            <label class="col-md-1" for="option1">Pop Up</label>
                                            <input type="checkbox" name="tipo[]" value="1" class="col-md-3 make-switch" <?php echo in_array('1', $tipo) ? "checked" : ""; ?> data-on-text="Sim" data-off-text="Não">
                                            <!-- <input id="option1" type="radio" name="radio1" value="option1" class="make-switch switch-radio1">  -->
                                        </div>
                                        <div class="margin-bottom-10">
                                            <label class="col-md-1" for="option2">T.S.</label>
                                            <input type="checkbox" name="tipo[]" value="2" class="col-md-3 make-switch" <?php echo in_array('2', $tipo) ? "checked" : ""; ?> data-on-text="Sim" data-off-text="Não">
                                            <!-- <input id="option2" type="radio" name="radio1" value="option2" class="make-switch switch-radio1"> -->
                                        </div>
                                        <div class="margin-bottom-10">
                                            <label class="col-md-1" for="option3">Login</label>
                                            <input type="checkbox" name="tipo[]" value="3" class="col-md-3 make-switch" <?php echo in_array('3', $tipo) ? "checked" : ""; ?> data-on-text="Sim" data-off-text="Não">
                                            <!-- <input id="option3" type="radio" name="radio1" value="option3" class="make-switch switch-radio1">  -->
                                        </div>
                                    </div>
                                    <?php echo form_error('tipo[]');?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Destinatário</label>
                                    <div class="col-md-2">
                                        <select class="selectpicker form-control" name="meio[]" multiple>
                                            <option value="">------Selecione uma Unidade-----</option>
                                            <?php foreach($meios as $meio) :?>
                                              <option value="<?=$meio->id?>"><?=utf8_decode($meio->local)?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Imediato</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" name="imediato" class="make-switch" data-on-text="Sim" data-off-text="Não">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Título</label>
                                    <input type="text" value = "<?php echo set_value('titulo',$titulo); ?>" name="titulo" class="col-md-10 form-control input-line input-medium">
                                    <?php echo form_error('titulo');?>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Conteúdo</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" placeholder="Conteúdo da mensagem" name="conteudo" rows="10"><?php echo set_value('conteudo',$result->msg); ?></textarea>
                                        <?php echo form_error('conteudo');?>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Assinatura</label>
                                    <input type="text" value = "<?php echo set_value('assinatura',$assinatura); ?>" name="assinatura" class="col-md-10 form-control input-line input-medium">
                                    <?php echo form_error('assinatura');?>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <?php echo form_submit(array('class'=> 'btn green', 'id' => 'submit', 'value' => 'Enviar')); ?>
                                            <?php echo form_button(array('type' => 'button', 'class' => 'btn default', 'content' => 'Cancelar', 'onClick' => "window.location.href='".base_url('dashboard/producao')."'")); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php echo form_close(); ?>

                   </div>
               </div>
           </div>
        </div>
    </div>
</div>

<!-- /* End of file copiar.php */ -->
<!-- /* Location: ./application/views/msg/copiar.php */ -->