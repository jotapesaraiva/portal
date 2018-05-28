<!-- Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_unidade" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <input name="nome" placeholder="Nome do unidade" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Endereço :</label>
                            <div class="col-md-9">
                                <input name="endereco" placeholder="Endereço da unidade" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Unidade Responsavel :</label>
                            <div class="col-md-9">
                                <select class="bs-select form-control" name="unidade">
                                    <?php foreach($unidades->result() as $unidade) : ?>
                                      <option value="<?=$unidade->id_unidade?>"><?=$unidade->nome_unidade?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status :</label>
                            <div class="col-md-9">
                                <input name="status" type="checkbox" class="make-switch" data-on-text="&nbsp;Ativo&nbsp;&nbsp;" data-off-text="&nbsp;Desativado&nbsp;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Cidade :</label>
                            <div class="col-md-9">
                                <select class="bs-select form-control" name="cidade" data-live-search="true" data-size="8">
                                    <?php foreach($cidades->result() as $cidade) : ?>
                                      <option value="<?=$cidade->id_cidade?>"><?=$cidade->nome_cidade?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Horário de expediente :</label>
                            <div class="col-md-9">
                                <select class="bs-select form-control" name="expediente">
                                    <?php foreach($expedientes->result() as $expediente) : ?>
                                      <option value="<?=$expediente->id_expediente?>"><?=$expediente->nome_expediente?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contatos :</label>
                            <div class="col-md-9">
                                <select class="bs-select form-control"  name="contatos[]" multiple>
                                    <option>Mustard</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tecnicos :</label>
                            <div class="col-md-9">
                                <select class="bs-select form-control"  name="tecnicos[]" multiple>
                                    <option>Mustard</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Links :</label>
                            <div class="col-md-9">
                                <select class="bs-select form-control"  name="links[]" multiple>
                                    <option>Mustard</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
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
<!-- /.modal -->