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
                                            case 'backup': ?>
                                            <?php  echo form_open('alertas/enviar/abrir_mantis', array('class' => 'form-horizontal'));?>
                                             <div class="form-body">
                                                <?php echo form_hidden('projeto', $projeto);?>
                                                <?php echo form_hidden('categoria', $categoria);?>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Alerta</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="alerta" class="form-control" placeholder="Alerta" value="<?php echo $status; ?>"> </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Sessão</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="sessao" class="form-control" placeholder="Origem" value="<?php echo $sessao; ?>"> </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Plano de Ação</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="plano" class="form-control" placeholder="Plano de Ação" value="<?php echo $plano; ?>"> </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Mode</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="mode" class="form-control" placeholder="Responsavel" value="<?php echo $mode; ?>"> </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Log do Erro</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="log" rows="3"><?php echo $log; ?></textarea>
                                                    </div>
                                                </div>
                                        <?php break;
                                            case 'link':?>
                                            <?php  echo form_open('alertas/enviar/abrir_mantis_link', array('class' => 'form-horizontal'));?>
                                             <div class="form-body">
                                                <?php echo form_hidden('projeto', $projeto);?>
                                                <?php echo form_hidden('categoria', $categoria);?>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Alerta</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="alerta" class="form-control" placeholder="Alerta" value="<?php echo $status; ?>"> </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Plano de Ação</label>
                                                      <div class="col-md-8">
                                                          <textarea class="form-control" name="plano" rows="3"><?php echo $plano; ?></textarea>
                                                      </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">IP</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="mode" class="form-control" placeholder="Responsavel" value="<?php echo $mode; ?>"> </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Ticket</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="ticket" class="form-control" placeholder="Responsavel" value="<?php echo $ticket; ?>"> </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Inicio do Chamado</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="text" name="inicio_chamado" class="form-control" placeholder="Responsavel" value="<?php echo $inicio_chamado; ?>"> </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Posicionamento</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="log" rows="3"><?php echo $log; ?></textarea>
                                                    </div>
                                                </div>
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
                                                <?php echo form_button(array('type' => 'button', 'class' => 'btn default', 'content' => 'Cancelar', 'onClick' => "window.location.href='https://producaoh.sefa.pa.gov.br/portal/welcome'")); ?>
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
