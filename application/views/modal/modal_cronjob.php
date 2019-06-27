<!-- Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_cronjob" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Minuto: </label>
                            <div class="col-md-9">
                                <input class="add-minute form-control" type="text" placeholder="0-59 or *">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Hora: </label>
                            <div class="col-md-9">
                                <input class="add-hour form-control" type="text" placeholder="0-23 or *">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Dia da Semana: </label>
                            <div class="col-md-9">
                                <input class="add-dayweek form-control" type="text" placeholder="0-6 or *">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Dia do Mês: </label>
                            <div class="col-md-9">
                                <input class="add-daymonth form-control" type="text" placeholder="0-31 or *">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Mês: </label>
                            <div class="col-md-9">
                                <input class="add-month form-control" type="text" placeholder="0-12 or *">
                                <span class="help-block"></span>
                            </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3">Comando para excução</label>
                        <div class="col-md-9">
                            <textarea class="add-command form-control" rows="3"></textarea>
                        </div>
                        <p>Digite um comando da CLI válido para ser executado no sistema com as permissões de usuários atuais ou faça referência a um script externo para execução.</p>
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
