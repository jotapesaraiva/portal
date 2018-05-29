<!-- Bootstrap modal -->
<div class="modal fade" id="modal_modulos" role="dialog">
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
                            <?php foreach ($modulos->result() as $modulo): ?>
                            <label class="col-md-offset-1 col-md-8 uppercase"><?=$modulo->nome_modulo?> :</label>
                            <div class="col-md-3">
                                <input name="<?=$modulo->nome_modulo?>" type="checkbox" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
                            </div>
                            <?php endforeach ?>
    <!--                                      <label class="checkbox-inline">
                                     <input type="checkbox" id="inlineCheckbox1" value="option1"> Checkbox 1
                                 </label>
                                 <label class="checkbox-inline">
                                     <input type="checkbox" id="inlineCheckbox2" value="option2"> Checkbox 2
                                 </label>
                                 <label class="checkbox-inline">
                                     <input type="checkbox" id="inlineCheckbox3" value="option3"> Disabled
                                 </label> -->

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