<!--Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_ativo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" id="id_ativo" name="id_ativo"/>
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
                                <span class="help-block"></span>
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
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fabricante :</label>
                            <div class="col-md-9">
                                <input name="fabricante" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tipo :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="tipo">
                                    <option value="">------Selecione o tipo-----</option>
                                    <?php foreach($tipos->result() as $tipo) : ?>
                                    <option value="<?=$tipo->id_tipo_ativo?>"><?=$tipo->nome_tipo_ativo?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Patrimonio :</label>
                            <div class="col-md-9">
                                <input name="patrimonio" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contrato :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="contrato">
                                    <option value="">------Selecione o contrato-----</option>
                                    <?php foreach($contratos->result() as $contrato) : ?>
                                    <option value="<?=$contrato->id_contrato?>"><?=$contrato->nome_contrato?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fornecedor :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="fornecedor">
                                    <option value="">------Selecione o Fornecedor-----</option>
                                    <?php foreach($fornecedores->result() as $fornecedor) : ?>
                                    <option value="<?=$fornecedor->id_fornecedor?>"><?=$fornecedor->nome_fornecedor?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Equipe Responsavel :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="grupo">
                                    <option value="">------Selecione o Grupo-----</option>
                                    <?php foreach($grupos->result() as $grupo) : ?>
                                    <option value="<?=$grupo->id_grupo?>"><?=$grupo->nome_grupo?></option>
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