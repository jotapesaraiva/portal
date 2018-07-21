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
                                        <label class="col-md-1 control-label">Nome: </label>
                                        <div class="col-md-5">
                                            <input name="nome_fornecedor" class="form-control" disabled="" type="text">
                                        </div>
                                        <label class="col-md-2 control-label">Email: </label>
                                        <div class="col-md-4">
                                            <input name="email" class="form-control" disabled="" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Website: </label>
                                        <div class="col-md-5">
                                            <input name="website" class="form-control" disabled="" type="text">
                                        </div>
                                        <label class="col-md-2 control-label">Tipo de serviço: </label>
                                        <div class="col-md-4">
                                            <select class="selectpicker form-control" name="servico" disabled>
                                                <option value=""></option>
                                                    <?php foreach($servicos->result() as $servico) : ?>
                                                    <option value="<?=$servico->id_servico?>"><?=$servico->nome_servico?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Endereço: </label>
                                        <div class="col-md-5">
                                            <textarea name="endereco" class="form-control" disabled="" row="6"></textarea>
                                        </div>
                                        <label class="col-md-2 control-label">Comentário :</label>
                                        <div class="col-md-4">
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
                                       <label class="col-md-1 control-label">Nome: </label>
                                       <div class="col-md-5">
                                           <input name="nome_contato" class="form-control" disabled="" type="text">
                                       </div>
                                       <label class="col-md-2 control-label">Email: </label>
                                       <div class="col-md-4">
                                           <input name="email_contato" class="form-control" disabled="" type="text">
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1">Telefone :</label>
                                        <div class="col-md-5">
                                            <input class="form-control" name="telefone_contato[]" id="phone_with_ddd" disabled="" type="text">
                                        </div>
                                        <label class="control-label col-md-2">Celular :</label>
                                        <div class="col-md-4">
                                            <input class="form-control" name="celular_contato[]" id="cell" disabled="" type="text">
                                        </div>
                                    </div>

                                    <div id="view_contato_add"></div>
                                    <hr>
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