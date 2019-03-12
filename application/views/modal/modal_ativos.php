<!--Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_fornecedor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" id="fornecedor" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nome :</label>
                            <div class="col-md-9">
                                <input name="nome" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Localização :</label>
                            <div class="col-md-9">
                                <input name="localizacao" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Numero de serie :</label>
                            <div class="col-md-9">
                                <input name="numero_serie" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Modelo :</label>
                            <div class="col-md-9">
                                <input name="modelo" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fabricante :</label>
                            <div class="col-md-9">
                                <input name="website" placeholder="Webiste do fornecedor" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tipo :</label>
                            <div class="col-md-9">
                                <input name="tipo" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Patrimonio :</label>
                            <div class="col-md-9">
                                <input name="patrimonio" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contrato :</label>
                            <div class="col-md-9">
                                <input name="contrato" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fornecedor :</label>
                            <div class="col-md-9">
                                <input name="fornecedor" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Grupo Responsavel :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="grupo">
                                    <option value="">------Selecione o Serviço-----</option>
                                    <?php foreach($grupos->result() as $grupo) : ?>
                                    <option value="<?=$grupo->id_grupo?>"><?=$grupo->nome_servico?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tecnico Responsavel :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="tecnico">
                                    <option value="">------Selecione o Serviço-----</option>
                                    <?php foreach($tecnicos->result() as $tecnico) : ?>
                                    <option value="<?=$tecnico->id_tecnico?>"><?=$tecnico->nome_tecnico?></option>
                                    <?php endforeach ?>
                                </select>
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