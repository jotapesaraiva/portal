<!--Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_contratos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" id="id_contrato" name="id_contrato"/>
                    <div class="form-body">
<!--                         <div class="form-group">
                            <label class="control-label col-md-3">Nome :</label>
                            <div class="col-md-9">
                                <input name="nome" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div> -->
                        <div id="help-block" class="form-group">
                            <label class="control-label col-md-3">Tipo :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="tipo">
                                    <option value="">------Selecione o Tipo-----</option>
                                    <?php foreach($tipos->result() as $tipo) : ?>
                                    <option value="<?=$tipo->id_tipo_contrato?>"><?=$tipo->nome_tipo_contrato?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Numero do Contrato :</label>
                            <div class="col-md-9">
                                <input name="numero" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Data Inicio :</label>
                            <div class="col-md-9">
                                <div class="input-group date date-picker">
                                    <input type="text" name="data_inicio" class="form-control" readonly>
                                    <input type="hidden" name="duracao" class="form-control duration" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Data Fim :</label>
                            <div class="col-md-9">
                                <div class="input-group date date-picker">
                                    <input type="text" name="data_fim" class="form-control" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Renovação :</label>
                            <div class="col-md-9">
                                <input name="renovacao" type="checkbox" class="make-switch" checked data-on-text="&nbsp;Sim&nbsp;&nbsp;" data-off-text="&nbsp;Não&nbsp;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Aviso :</label>
                            <div class="col-md-9">
                                <input name="aviso" placeholder="" class="form-control duration" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div id="help-block" class="form-group">
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


