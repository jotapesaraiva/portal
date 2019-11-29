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
                         <span class="caption-subject bold uppercase"> Fechamento de Turno </span>
                     </div>
                    </div>
                    <div class="portlet-body">

                        <?php echo form_open('fechamento/turno/abrir_mantis', array('id' => 'form','class' => 'form-horizontal')); ?>

                                <div class="form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">CPD</label>
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Ar-Condicionado</label>
                                                        <input name="ar_cpd" type="checkbox" class="col-md-10 make-switch" checked data-on-text="&nbsp;&nbsp;OK&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NOK&nbsp;&nbsp;">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Temperatura</label>
                                                        <input type="text" value="" name="temperatura_cpd" class="col-md-10 form-control input-line input-small" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Umidade</label>
                                                        <input type="text" value="" name="umidade_cpd" class="col-md-10 form-control input-line input-small" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Led's</label>
                                                        <input name="led" type="checkbox" class=" col-md-10 make-switch" checked data-on-text="&nbsp;&nbsp;OK&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NOK&nbsp;&nbsp;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Sala Nobreak</label>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Ar-Condicionado</label>
                                                    <input type="text" value="<?php echo set_value('ar_nobreak'); ?>" placeholder="Revezamento" name="ar_nobreak" class="col-md-10 form-control input-line input-small" />
                                                    <?php echo form_error('ar_nobreak');?>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Temperatura</label>
                                                            <input type="text" value="" name="temperatura_nobreak01" class="col-md-10 form-control input-line input-small" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Umidade</label>
                                                            <input type="text" value="" name="umidade_nobreak01" class="col-md-10 form-control input-line input-small" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Bateria</label>
                                                            <input type="text" value="" name="bateria01" class="col-md-10 form-control input-line input-small" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Temperatura</label>
                                                            <input type="text" value="" name="temperatura_nobreak02" class="col-md-10 form-control input-line input-small" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Umidade</label>
                                                            <input type="text" value="" name="umidade_nobreak02" class="col-md-10 form-control input-line input-small" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Bateria</label>
                                                            <input type="text" value="" name="bateria02" class="col-md-10 form-control input-line input-small" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Links Internet</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" placeholder="Nenhum alerta de link" name="links" rows="3"><?php echo $link; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Monitora</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" placeholder="Nenhum alerta de monitora" name="monitora" rows="3"><?php echo $monitora; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Servidores</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" placeholder="Nenhum alerta de servidor" name="servidores" rows="3"><?php echo $servidores; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Backups</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" placeholder="Nenhum backup falhou" name="backups" rows="3"><?php echo $backup; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Simples Nacional</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" placeholder="Nenhuma pendência" name="simplesNacional" rows="3"><?php echo $simplesNacional; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Atividades equipe:</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" placeholder="Nenhuma atividade"name="atividadesEquipe" rows="3"><?php echo $atividadeEquipe; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">OBS:</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" placeholder="Anotar alguma observação" name="obs" rows="3"><?php echo set_value('obs'); ?><?php echo $obs; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Turno</label>
                                            <div class="col-md-8">
                                                <select class="selectpicker form-control" name="turno" requerid>
                                                    <option value="" <?php echo set_select('turno', '', TRUE); ?>>------Selecione uma turno-----</option>
                                                    <option value="Madrugada" <?php echo set_select('turno', 'Madrugada'); ?>>Madrugada</option>
                                                    <option value="Manhã" <?php echo set_select('turno', 'Manhã'); ?>>Manhã</option>
                                                    <option value="Tarde" <?php echo set_select('turno', 'Tarde'); ?>>Tarde</option>
                                                    <option value="Noite" <?php echo set_select('turno', 'Noite'); ?>>Noite</option>
                                                </select>
                                                <?php echo form_error('turno'); ?>
                                            </div>
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

<!-- /* End of file turno.php */ -->
<!-- /* Location: ./application/views/fechamento/turno.php */ -->