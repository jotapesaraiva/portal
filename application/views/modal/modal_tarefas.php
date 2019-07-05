<!--Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_tarefas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" id="id" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nome :</label>
                            <div class="col-md-9">
                                <input name="nome" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Mensagem :</label>
                            <div class="col-md-9">
                                <textarea name="mensagem" placeholder=" Plano de Ação: Ramal: Email:" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Data Vencimento :</label>
                            <div class="col-md-9">
                                <div class="input-group date form_datetime">
                                    <input type="text" name="data_vencimento" class="form-control" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn default date-set" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                             <label class="control-label col-md-3"> Repetir :</label>
                             <div class="col-md-4">
                                 <select class="selectpicker form-control" name="vezes">
                                     <option value="">------Quantas vezes-----</option>
                                     <option value="1">1</option>
                                     <option value="2">2</option>
                                     <option value="3">3</option>
                                     <option value="4">4</option>
                                     <option value="5">5</option>
                                     <option value="6">6</option>
                                 </select>
                                 <span class="help-block"></span>
                             </div>
                             <div class="col-md-4 col-md-offset-1">
                                 <select class="selectpicker form-control" name="vezes">
                                     <option value="">------Períodos-----</option>
                                     <option value="minuto">Minuto</option>
                                     <option value="hora">Hora</option>
                                     <option value="dia">Dias</option>
                                     <option value="mes">Meses</option>
                                 </select>
                                 <span class="help-block"></span>
                             </div>
                        </div>
                         <div class="form-group">
                             <label class="control-label col-md-3">Grupo Responsavel :</label>
                             <div class="col-md-9">
                                 <select class="selectpicker form-control" name="grupo">
                                     <option value="">------Selecione o grupo-----</option>
                                     <?php foreach($grupos->result() as $grupo) : ?>
                                     <option value="<?=$grupo->id_grupo?>"><?=$grupo->nome_grupo?></option>
                                     <?php endforeach ?>
                                 </select>
                                 <span class="help-block"></span>
                             </div>
                         </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Mantis Solicitado :</label>
                            <div class="col-md-9">
                                <input name="mantis_solicitado" placeholder="" class="form-control mantis" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Mantis Notificado :</label>
                            <div class="col-md-9">
                                <input name="mantis" placeholder="" class="form-control mantis" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal


