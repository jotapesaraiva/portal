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
                            <label class="control-label col-md-3">Tipo :</label>
                            <div class="col-md-9">
                                <input name="localizacao" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Numero do Contrato :</label>
                            <div class="col-md-9">
                                <input name="numero_serie" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Data Inicio :</label>
                            <div class="col-md-9">
                                <div class="input-group date date-picker">
                                    <input type="text" name="data" class="form-control" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Duração :</label>
                            <div class="col-md-9">
                                <input name="fabricante" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Renovação :</label>
                            <div class="col-md-9">
                                <input name="tipo" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Aviso :</label>
                            <div class="col-md-9">
                                <input name="patrimonio" placeholder="" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fornecedor :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="fornecedor">
                                    <option value="">------Selecione o Serviço-----</option>
                                    <?php foreach($fornecedores->result() as $fornecedor) : ?>
                                    <option value="<?=$fornecedor->id_fornecedor?>"><?=$fornecedor->nome_fornecedor?></option>
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


