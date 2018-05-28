<!-- Bootstrap modal -->
<div class="modal fade" id="modal_contato" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" role="form">
                    <input type="hidden" value="" id="contato" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nome :</label>
                            <div class="col-md-9">
                                <input name="nome" placeholder="Nome do contato" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email :</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="Email do contato" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Cargo :</label>
                            <div class="col-md-9">
                                <input name="cargo" placeholder="Cargo do contato" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fornecedor :</label>
                            <div class="col-md-9">
                                <select name="fornecedor" class="selectpicker form-control">
                                    <option value="">------Selecione uma Fornecedor-----</option>
                                    <?php foreach($fornecedores->result() as $fornecedor) : ?>
                                    <option value="<?=$fornecedor->id_fornecedor?>"><?=$fornecedor->nome_fornecedor?></option>
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
                                        <input style="padding: 6px 12px !important;" class="form-control" name="telefone[]" id="phone_with_ddd" placeholder="Numero do telefone" type="text">
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
                            <label class="control-label col-md-3">Comentario :</label>
                            <div class="col-md-9">
                                <textarea name="comentario" placeholder="Comentario" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->