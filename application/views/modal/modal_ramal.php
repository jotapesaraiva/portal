<!--Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_ramal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_telefone_voip"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Unidade : </label>
                            <input type="hidden" value="" name="id_unidade"/>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="unidade" data-live-search="true">
                                    <option value="">------Selecione uma Unidade-----</option>
                                    <?php foreach($unidades->result() as $unidade) :?>
                                      <option value="<?=$unidade->id_unidade?>"><?=$unidade->nome_unidade?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">VoIP :</label>
                            <input type="hidden" value="" name="id_telefone"/>
                            <div class="col-md-9">
                                <input name="voip" id="phone_with_ddd" placeholder="Numero do VoIP" class="form-control" type="text">
                                <span class="help-block"> (99) 9999-9999 </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">IP :</label>
                            <div class="col-md-9">
                                <input name="ip" class="form-control" id="ip_address" placeholder="Endereço IP do VoIP" type="text">
                                <span class="help-block"> 192.168.120.150 </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Setor :</label>
                            <div class="col-md-9">
                                <input name="setor" placeholder="Setor" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Equipamento :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="equipamento">
                                    <option value="">------Selecione o Equipamento-----</option>
                                    <?php foreach($equipamentos->result() as $equipamento) : ?>
                                    <option value="<?=$equipamento->id_tipo_equipamento_voip?>"><?=$equipamento->nome_tipo_equipamento_voip?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Categoria :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="categoria">
                                    <option value="">------Selecione o Categoria-----</option>
                                    <?php foreach($categorias->result() as $categoria) : ?>
                                    <option value="<?=$categoria->id_tipo_categoria_voip?>"><?=$categoria->nome_tipo_categoria_voip?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contexto :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="contexto" required>
                                    <option value="">------Selecione o Contexto-----</option>
                                    <?php foreach($contextos->result() as $contexto) : ?>
                                    <option value="<?=$contexto->id_tipo_contexto_voip?>"><?=$contexto->nome_tipo_contexto_voip?></option>
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