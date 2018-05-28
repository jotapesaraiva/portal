 <!-- Bootstrap modal  -->
<div class="modal fade bs-modal-lg" id="modal_fornecedor_view" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab" aria-expanded="true"> Geral </a>
                        </li>
                        <li class="">
                            <a href="#tab_2" data-toggle="tab" aria-expanded="false"> Contatos </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form class="form-horizontal" id="form_1" role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nome: </label>
                                        <div class="col-md-3">
                                            <input name="nome_fornecedor" class="form-control" disabled="" type="text">
                                        </div>
                                        <label class="col-md-2 control-label">Email: </label>
                                        <div class="col-md-3">
                                            <input name="email" class="form-control" disabled="" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Website: </label>
                                        <div class="col-md-3">
                                            <input name="website" class="form-control" disabled="" type="text">
                                        </div>
                                        <label class="col-md-2 control-label">Endereço: </label>
                                        <div class="col-md-5">
                                            <textarea name="endereco" class="form-control" disabled="" row="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tipo de serviço: </label>
                                        <div class="col-md-3">
                                            <select class="selectpicker form-control" name="servico" disabled>
                                                <option value=""></option>
                                                    <?php foreach($servicos->result() as $servico) : ?>
                                                    <option value="<?=$servico->id_servico?>"><?=$servico->nome_servico?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </select>
                                        </div>
                                        <label class="col-md-2 control-label">Comentário :</label>
                                        <div class="col-md-5">
                                            <textarea name="comentario" class="form-control" disabled="" row="6"></textarea>
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
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="tab_2">
                            <form class="form-horizontal" id="form_2" role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                       <label class="col-md-2 control-label">Nome: </label>
                                       <div class="col-md-3">
                                           <input name="nome" class="form-control" disabled="" type="text">
                                       </div>
                                       <label class="col-md-2 control-label">Email: </label>
                                       <div class="col-md-3">
                                           <input name="email" class="form-control" disabled="" type="text">
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Cargo: </label>
                                        <div class="col-md-3">
                                            <input name="cargo" type="text" class="form-control" disabled="" >
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
                                    </div>
                                    <div id="view_link_add"></div>
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
<!-- /.modal-->


<!-- /* End of file modal_fornecedor_view.php */ -->
<!-- /* Location: ./application/views/modal/modal_fornecedor_view.php */ -->