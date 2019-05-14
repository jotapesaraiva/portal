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
                                <input name="nome_fornecedor" placeholder="Nome do fornecedor" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email :</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="Email do fornecedor" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Endereço :</label>
                            <div class="col-md-9">
                                <input name="endereco" placeholder="Endereço do fornecedor" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Website :</label>
                            <div class="col-md-9">
                                <input name="website" placeholder="Webiste do fornecedor" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tipo de serviço :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="servico">
                                    <option value="">------Selecione o Serviço-----</option>
                                    <?php foreach($servicos->result() as $servico) : ?>
                                    <option value="<?=$servico->id_servico?>"><?=$servico->nome_servico?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div id="wrapper_telefone_add">
                        <div class="form-group">
                            <input type="hidden" value="" name="id_telefone[]"/>
                            <label class="control-label col-md-3">Telefone :</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <input style="padding: 6px 12px !important;" class="form-control" name="telefone[]" id="0800" placeholder="Numero do telefone" type="text">
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn blue" id="add_telefone" type="button" tabindex="-1">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div id="wrapper_celular_add">
                        <div class="form-group">
                            <input type="hidden" value="" name="id_celular[]"/>
                            <label class="control-label col-md-3">Celular :</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <input style="padding: 6px 12px !important;" class="form-control" name="celular[]" id="cell" placeholder="Numero do celular" type="text">
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn blue" id="add_celular" type="button" tabindex="-1">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Comentário :</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="comentario" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status :</label>
                            <div class="col-md-9">
                                <input name="status" type="checkbox" class="make-switch" checked data-on-text="&nbsp;Ativo&nbsp;&nbsp;" data-off-text="&nbsp;Desativado&nbsp;">
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