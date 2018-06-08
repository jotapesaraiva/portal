<!--Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_usuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" id="usuario" name="id_usuario"/>
                    <input type="hidden" value="" name="senha"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nome :</label>
                            <div class="col-md-9">
                                <input id="complete" name="nome" placeholder="Nome do unidade" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Login :</label>
                            <div class="col-md-9">
                                <input name="login" placeholder="Login do usuario" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email :</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="Email do usuario" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Sobreaviso :</label>
                            <div class="col-md-9">
                                <input name="sobreaviso" type="checkbox" class="make-switch" checked data-on-text="&nbsp;Sim&nbsp;&nbsp;" data-off-text="&nbsp;Não&nbsp;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Permissão : </label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="permissao" data-live-search="true">
                                    <option value="">------Selecione uma permissão-----</option>
                                    <?php foreach($permissaos->result() as $permissao) :?>
                                      <option value="<?=$permissao->id_permissao?>"><?=$permissao->nome_permissao?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Cargo : </label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="cargo" data-live-search="true">
                                    <option value="">------Selecione um cargo-----</option>
                                    <?php foreach($cargos->result() as $cargo) :?>
                                      <option value="<?=$cargo->id_cargo?>"><?=$cargo->nome_cargo?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Celula / Equipe :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="grupo" data-live-search="true">
                                    <option value="">------Selecione um grupo-----</option>
                                    <?php foreach($grupos->result() as $grupo) :?>
                                      <option value="<?=$grupo->id_grupo?>"><?=$grupo->nome_grupo?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div id="wrapper_telefone_add">
                        <div class="form-group">
                            <input type="hidden" class="group-input" name="id_telefone[]"/>
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
                            <input type="hidden" class="group-input" name="id_celular[]"/>
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
                        <div id="wrapper_voip_add">
                            <div class="form-group">
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
<!-- /.modal-->