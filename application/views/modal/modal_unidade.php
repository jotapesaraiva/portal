<!--Bootstrap modal -->
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
                    <input type="hidden" id="unidade" name="id_unidade"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nome :</label>
                            <div class="col-md-9">
                                <input name="nome" placeholder="Nome do unidade" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Endereço :</label>
                            <div class="col-md-9">
                                <input name="endereco" placeholder="Endereço da unidade" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Unidade Responsavel : </label>
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
                            <label class="control-label col-md-3">Status :</label>
                            <div class="col-md-9">
                                <input name="status" type="checkbox" class="make-switch" checked data-on-text="&nbsp;Ativo&nbsp;&nbsp;" data-off-text="&nbsp;Desativado&nbsp;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Cidade :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="cidade" data-live-search="true">
                                    <option value="">------Selecione uma Cidade-----</option>
                                    <?php foreach($cidades->result() as $cidade) :?>
                                    <option value="<?=$cidade->id_cidade?>"><?=$cidade->nome_cidade?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Horário de expediente :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="expediente" required>
                                    <option value="">------Selecione um horário de expediente-----</option>
                                    <?php foreach($expedientes->result() as $expediente) : ?>
                                    <option value="<?=$expediente->id_expediente?>"><?=$expediente->nome_expediente?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div id="wrapper_telefone_add">
                        <div class="form-group">
                            <input type="hidden" name="id_telefone[]"/>
                            <label class="control-label col-md-3">Telefone :</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <input style="padding: 6px 12px !important;" class="form-control" name="telefone[]" id="phone_with_ddd" placeholder="Numero do telefone" type="text">
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn blue" id="add_telefone" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div id="wrapper_celular_add">
                        <div class="form-group">
                            <input type="hidden" name="id_celular[]"/>
                            <label class="control-label col-md-3">Celular :</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-icon">
                                        <input style="padding: 6px 12px !important;" class="form-control" name="celular[]" id="cell" placeholder="Numero do celular" type="text">
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn blue" id="add_celular" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div id="wrapper_voip_add">
                            <div class="form-group">
                                <input type="hidden" value="" name="id_voip[]"/>
                                <label class="control-label col-md-3">VoIP :</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-icon">
                                            <select class="selectpicker form-control" name="voip[]" data-live-search="true">
                                                <option value="">------Selecione um VoIP-----</option>
                                                <?php foreach($voips->result() as $voip) : ?>
                                                <option value="<?=$voip->id_telefone?>"><?=$voip->numero_telefone?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn blue" id="add_voip" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="wrapper_link_add">
                            <div class="form-group">
                                <label class="control-label col-md-3">Link :</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="selectpicker form-control" name="link[]">
                                            <option value="">------Selecione um Link-----</option>
                                            <?php foreach($links->result() as $link) : ?>
                                            <option value="<?=$link->id_link?>"><?=$link->nome_link?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <span class="input-group-btn">
                                            <button class="btn blue" id="add_link" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Comentário :</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="comentario" rows="3"></textarea>
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