<!-- Bootstrap modal -->
<div class="modal fade bs-modal-lg" id="modal_perfil" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" role="form">
                    <div class="form-body">
                        <input type="hidden" id="id_perfil" name="id_perfil"/>
                        <div class="form-group">
                            <label class="control-label col-md-2">Grupo :</label>
                            <div class="col-md-9">
                                <select class="selectpicker form-control" name="grupo" data-live-search="true">
                                    <option value="">------Selecione uma Unidade-----</option>
                                    <?php foreach($grupos->result() as $grupo) : ?>
                                    <option value="<?=$grupo->id_grupo?>"><?=$grupo->nome_grupo?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                           <label class="control-label col-md-2">Modulos :</label>
                           <div class="col-md-10">
                               <select class="multi-select" id="modulo" name="modulo[]" multiple="multiple" >
                                <?php foreach ($modulos->result() as $modulo): ?>
                                     <option value="<?=$modulo->id_modulo?>"><?=$modulo->nome_modulo?></option>
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
