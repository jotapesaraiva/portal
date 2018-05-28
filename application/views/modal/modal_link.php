<!--Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_link" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nome :</label>
                            <div class="col-md-9">
                                <input name="nome_link" placeholder="Nome do Link" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">IP Lan:</label>
                            <div class="col-md-9">
                                <input name="ip_lan" placeholder="Endereço IP Lan do Link" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">IP Wan:</label>
                            <div class="col-md-9">
                                <input name="ip_wan" placeholder="Endereço IP Wan do Link" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Designação :</label>
                            <div class="col-md-9">
                                <input name="designacao" placeholder="Designação do Link" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status :</label>
                            <div class="col-md-9">
                                <input name="status" type="checkbox" class="make-switch" checked data-on-text="&nbsp;Ativo&nbsp;&nbsp;" data-off-text="&nbsp;Desativado&nbsp;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Link Backup :</label>
                            <div class="col-md-9">
                                <input name="backup" type="checkbox" class="make-switch" data-on-text="&nbsp;Sim&nbsp;&nbsp;" data-off-text="&nbsp;Não&nbsp;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Velocidade :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="velocidade">
                                    <option value="">------Selecione a Velocidade-----</option>
                                    <?php foreach($velocidades->result() as $velocidade) : ?>
                                    <option value="<?=$velocidade->id_tipo_velocidade?>"><?=$velocidade->nome_tipo_velocidade?> Kbps</option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tipo de Acesso :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="acesso">
                                    <option value="">------Selecione o tipo de acesso-----</option>
                                    <?php foreach($acessos->result() as $acesso) : ?>
                                    <option value="<?=$acesso->id_tipo_acesso?>"><?=$acesso->nome_tipo_acesso?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Unidades :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="unidade" data-live-search="true">
                                    <option value="">------Selecione uma Unidade-----</option>
                                    <?php foreach($unidades->result() as $unidade) : ?>
                                    <option value="<?=$unidade->id_unidade?>"><?=$unidade->nome_unidade?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fornecedor :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="fornecedor" data-live-search="true">
                                    <option value="">------Selecione uma Fornecedor-----</option>
                                    <?php foreach($fornecedores->result() as $fornecedor) : ?>
                                    <option value="<?=$fornecedor->id_fornecedor?>"><?=$fornecedor->nome_fornecedor?></option>
                                    <?php endforeach ?>
                                </select>
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
<!-- /.modal-->