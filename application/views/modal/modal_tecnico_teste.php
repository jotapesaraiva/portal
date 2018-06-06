<!-- Bootstrap modal -->
<div class="modal fade" id="modal_tecnico" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" role="form">
                    <input type="hidden" value="" id="tecnico" name="id"/>
                    <input type="hidden" value="" id="array_antigo" name="id"/>
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Nome :</label>
                            <div class="col-md-9">
                                <select class="multi-select" name="nome" multiple="multiple" >
                                    <?php foreach($tecnicos->result() as $tecnico) : ?>
                                    <option value="<?=$tecnico->id_usuario?>"><?=$tecnico->nome_usuario?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Unidades :</label>
                            <div class="col-md-9">
                                <select class="multi-select" name="unidade[]" multiple="multiple" >
                                    <?php foreach($unidades->result() as $unidade) : ?>
                                    <option value="<?=$unidade->id_unidade?>"><?=$unidade->nome_unidade?></option>
                                    <?php endforeach ?>
                                </select>
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
