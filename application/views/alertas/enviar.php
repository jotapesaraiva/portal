<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
        <br>
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
                         <span class="caption-subject bold uppercase"> Abertura de Mantis </span>
                     </div>
                    </div>
                    <div class="portlet-body">

                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body form">

                                        <?php
                                        switch ($form) {
                                                case 'modelo_cprojeto': ?>
                                                <?php  echo form_open('alertas/enviar/abrir_mantis', array('class' => 'form-horizontal'));?>
                                                 <div class="form-body">
                                                    <?php echo form_hidden('id', $id);?>
                                                    <?php echo form_hidden('alerta', $alerta);?>
                                                    <?php echo form_hidden('tabela', $tabela);?>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Detalhe do Alerta</label>
                                                        <div class="col-md-8">
                                                                <textarea class="form-control" name="detalhe" rows="15"><?php echo $detalhe; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Abrir Mantis</label>
                                                        <div class="col-md-8">
                                                                <select name="projeto" id="projeto" class="form-control">
                                                                    <option>Selecione o projeto</option>
                                                                    <?php echo $projetos; ?>
                                                                </select>
                                                        </div>
                                                    </div>

                                        <?php break;
                                            case 'modelo_sprojeto': ?>
                                            <?php  echo form_open('alertas/enviar/abrir_mantis', array('class' => 'form-horizontal'));?>
                                             <div class="form-body">
                                                <?php echo form_hidden('id', $id);?>
                                                <?php echo form_hidden('alerta', $alerta);?>
                                                <?php echo form_hidden('tabela', $tabela);?>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Detalhe do Alerta</label>
                                                    <div class="col-md-8">
                                                            <textarea class="form-control" name="detalhe" rows="15"><?php echo $detalhe; ?></textarea>
                                                    </div>
                                                </div>

                                                <?php echo form_hidden('projeto', $projeto);?>

                                        <?php break;
                                            case 'link':?>
                                            <?php  echo form_open('alertas/enviar/abrir_mantis', array('class' => 'form-horizontal'));?>
                                             <div class="form-body">
                                                <?php echo form_hidden('id', $id);?>
                                                <?php echo form_hidden('alerta', $alerta);?>
                                                <?php echo form_hidden('tabela', $tabela);?>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Detalhe do Alerta</label>
                                                    <div class="col-md-8">
                                                            <textarea class="form-control" name="detalhe" rows="15"><?php echo $detalhe; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Ticket</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="ticket" class="form-control" value="<?php echo $ticket; ?>"> </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Inicio do Chamado</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="inicio_chamado" class="form-control" value="<?php echo $inicio_chamado; ?>"> </div>
                                                    </div>
                                                </div>

                                                <?php echo form_hidden('projeto', $projeto);?>

                                        <?php break;
                                            default:?>
                                            TESTE
                                            <?php
                                                break;
                                        }?>

                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <?php echo form_submit(array('class'=> 'btn green','id' => 'submit', 'value' => 'Enviar')); ?>
                                                <?php echo form_button(array('type' => 'button', 'class' => 'btn default', 'content' => 'Cancelar', 'onClick' => "window.location.href='".base_url('dashboard/producao')."'")); ?>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </form> -->
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <!-- END SAMPLE FORM PORTLET-->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
