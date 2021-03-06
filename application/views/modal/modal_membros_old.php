<!-- Bootstrap modal -->
<div class="modal fade" id="modal_membros" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-offset-1 col-md-8">
                                <div class="input-group">
                                    <select class="selectpicker form-control" name="voip[]" data-live-search="true">
                                        <option value="">------Selecione um usuario-----</option>
                                        <?php foreach($membros->result() as $membro) : ?>
                                        <option value="<?=$membro->id_usuario?>"><?=$membro->nome_usuario?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn blue" id="" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="membro">
                           <!-- <div id="membro"></div> -->
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