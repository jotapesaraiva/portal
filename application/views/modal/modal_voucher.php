<!-- Bootstrap modal -->
<div class="modal fade" id="modal_voucher" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="<?php echo $usuario; ?>" name="usuario"/>
                    <input type="hidden" value="" name="id_historico"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Data</label>
                            <div class="col-md-9">
                                <div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                    <input type="text" name="data" class="form-control" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Voucher :</label>
                            <div class="col-md-9">
                                <input name="voucher" placeholder="Número do voucher" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Motorista :</label>
                            <div class="col-md-9">
                                <input name="motorista" placeholder="Nome do motorista" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Prefixo :</label>
                            <div class="col-md-9">
                                <input name="prefixo" placeholder="Prefixo do motorista" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Valor :</label>
                            <div class="col-md-9">
                                <input name="valor" placeholder="Valor da corrida" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Observação :</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="observacao" rows="3"></textarea>
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