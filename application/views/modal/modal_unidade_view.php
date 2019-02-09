 <!-- Bootstrap modal  -->
<div class="modal fade bs-modal-lg" id="modal_unidade_view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="tabbable-line boxless margin-bottom-20">
                    <ul class="nav nav-tabs">
                        <li class="">
                            <a href="#tab_1" data-toggle="tab" aria-expanded="true"> Geral </a>
                        </li>
                        <li class="">
                            <a href="#tab_2" data-toggle="tab" aria-expanded="false"> Link </a>
                        </li>
                        <li class="">
                            <a href="#tab_3" data-toggle="tab" aria-expanded="false"> Técnico </a>
                        </li>
                        <li class="active">
                            <a href="#tab_4" data-toggle="tab" aria-expanded="false"> Servidor </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab_1">
                            <form class="form-horizontal" id="form_1" role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Nome: </label>
                                        <div class="col-md-4">
                                            <input name="nome" class="form-control" disabled="" type="text">
                                        </div>
                                        <label class="col-md-2 control-label">Unidade responsável: </label>
                                        <div class="col-md-5">
                                            <select class="selectpicker form-control" name="unidade" disabled>
                                                <option value=""></option>
                                                <?php foreach($unidades->result() as $unidade) :?>
                                                  <option value="<?=$unidade->id_unidade?>"><?=$unidade->nome_unidade?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Cidade: </label>
                                        <div class="col-md-4">
                                            <select class="selectpicker form-control" name="cidade" disabled>
                                                <option value=""></option>
                                                <?php foreach($cidades->result() as $cidade) :?>
                                                <option value="<?=$cidade->id_cidade?>"><?=$cidade->nome_cidade?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <label class="col-md-2 control-label">Endereço: </label>
                                        <div class="col-md-5">
                                            <textarea name="endereco" class="form-control" disabled="" row="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Expediente: </label>
                                        <div class="col-md-4">
                                            <select class="selectpicker form-control" name="expediente" disabled>
                                                <option value=""></option>
                                                <?php foreach($expedientes->result() as $expediente) : ?>
                                                <option value="<?=$expediente->id_expediente?>"><?=$expediente->nome_expediente?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                            <div class="form-group">
                                                <input type="hidden" name="id_telefone[]"/>
                                                <label class="control-label col-md-2">Telefone :</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" name="telefone[]" id="phone_with_ddd" disabled="" type="text">
                                                </div>
                                            </div>
                                        <div id="view_telefone_add"></div>
                                        <hr>
                                            <div class="form-group">
                                                <input type="hidden" name="id_celular[]"/>
                                                <label class="control-label col-md-2">Celular :</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" name="celular[]" id="cell" disabled="" type="text">
                                                </div>
                                            </div>
                                        <div id="view_celular_add"></div>
                                        <hr>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">VoIP :</label>
                                                <div class="col-md-6">
                                                    <select class="selectpicker form-control" name="voip[]" disabled>
                                                        <option value=""> </option>
                                                        <?php foreach($voips->result() as $voip) : ?>
                                                        <option value="<?=$voip->id_telefone?>"><?=$voip->numero_telefone?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <div id="view_voip_add"></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="tab_2">
                            <form class="form-horizontal" id="form_2" role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Nome :</label>
                                        <div class="col-md-3">
                                                <select class="selectpicker form-control" name="link[]" disabled>
                                                    <option value=""> </option>
                                                    <?php foreach($links->result() as $link) : ?>
                                                    <option value="<?=$link->id_link?>"><?=$link->nome_link?></option>
                                                    <?php endforeach ?>
                                                </select>
                                        </div>
                                        <label class="col-md-2 control-label">Designação: </label>
                                        <div class="col-md-3">
                                            <input name="designacao" type="text" class="form-control" disabled="" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">IP Lan: </label>
                                        <div class="col-md-3">
                                            <input name="lan" type="text" class="form-control" disabled="" >
                                        </div>
                                        <label class="col-md-2 control-label">IP Wan: </label>
                                        <div class="col-md-3">
                                            <input name="wan" type="text" class="form-control" disabled="" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tipo de Acesso: </label>
                                        <div class="col-md-3">
                                              <select class="selectpicker form-control" name="acesso" disabled>
                                                    <option value=""> </option>
                                                  <?php foreach($acessos->result() as $acesso) : ?>
                                                  <option value="<?=$acesso->id_tipo_acesso?>"><?=$acesso->nome_tipo_acesso?></option>
                                                  <?php endforeach ?>
                                              </select>
                                        </div>
                                        <label class="col-md-2 control-label">Fornecedor: </label>
                                        <div class="col-md-3">
                                            <select class="selectpicker form-control" name="fornecedor" disabled>
                                                <option value=""> </option>
                                                <?php foreach($fornecedores->result() as $fornecedor) : ?>
                                                <option value="<?=$fornecedor->id_fornecedor?>"><?=$fornecedor->nome_fornecedor?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="view_link_add"></div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <form class="form-horizontal" id="form_3" role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id_tecnico"/>
                                        <label class="col-md-1 control-label">Nome: </label>
                                        <div class="col-md-5">
                                            <input type="text" name="nome_tecnico" class="form-control" disabled="" >
                                        </div>
                                        <label class="col-md-1 control-label">Telefone: </label>
                                        <div class="col-md-5">
                                            <input type="text" name="telefone_tecnico" class="form-control" disabled="" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Celular: </label>
                                        <div class="col-md-5">
                                            <input type="text" name="celular_tecnico" class="form-control" disabled="" >
                                        </div>
                                        <label class="col-md-1 control-label">VoIP: </label>
                                        <div class="col-md-5">
                                            <input type="text" name="voip_tecnico" class="form-control" disabled="" >
                                        </div>
                                    </div>
                                    <div id="view_tecnico_add"></div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane active" id="tab_4">
                            <form class="form-horizontal" id="form_4" role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id_servidor"/>
                                        <label class="col-md-1 control-label">Nome: </label>
                                        <div class="col-md-5">
                                            <input type="text" name="nome_servidor" class="form-control" disabled="" >
                                        </div>
                                        <label class="col-md-1 control-label">Telefone: </label>
                                        <div class="col-md-5">
                                            <input type="text" name="telefone_servidor" class="form-control" disabled="" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Celular: </label>
                                        <div class="col-md-5">
                                            <input type="text" name="celular_servidor" class="form-control" disabled="" >
                                        </div>
                                        <label class="col-md-1 control-label">VoIP: </label>
                                        <div class="col-md-5">
                                            <input type="text" name="voip_servidor" class="form-control" disabled="" >
                                        </div>
                                    </div>
                                    <div id="view_servidor_add"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Voltar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal