   /*********************************************************************
   *********************************************************************/
   var celular = 0;
   var max_fields = 3; //maximum input boxes allowed
   var i=100;
   //Adiciona dinamicamente celular não voips da unidade
   $("#add_celular").click(function(e) { //on add input button click
       e.preventDefault();
       i++;
       if(celular < max_fields) { //max input box allowed
           celular++; //text box increment
           var a = '';
           a += '<div class="form-group all" id="remove_field_'+i+'">';
               a += '<input type="hidden" id="celular_'+i+'" value="" name="id_celular[]"/>';
               a += '<label class="control-label col-md-3">Celular :</label>';
               a += '<div class="col-md-9">';
                   a += '<div class="input-group">';
                       a += '<input class="form-control" name="celular[]" placeholder="Numero do celular" data-mask="(00) 00000-0000" type="text">';
                       a += '<span class="input-group-btn">';
                           a += '<button class="btn red remove_field" id="'+i+'" type="button">';
                               a += '<i class="fa fa-minus"></i>';
                           a += '</button>';
                       a += '</span>';
                   a += '</div>';
               a += '</div>';
           a += '</div>';
           $("#wrapper_celular_add").append(a);
       }
   });
   $("#wrapper_celular_add").on("click",".remove_field", function(e) { //user click on remove text
       var button_id = $(this).attr("id");
       var id_celular = $('#celular_'+button_id).val();
       var id_unidade = $('#unidade').val();
       if(id_celular != '') {
           var result = delete_telefone(id_celular,id_unidade,'celular');
           if(result) {
               e.preventDefault();
               $('#remove_field_'+button_id+'').remove();
               celular--;
           }
       } else {
           e.preventDefault();
           $('#remove_field_'+button_id+'').remove();
           celular--;
       }
   });

   function delete_telefone(id_telefone,id_unidade,tipo) {
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : href+"/unidade_telefone_delete/"+id_telefone+"/"+id_unidade+"/"+tipo,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                alert("excluido com sucesso!!!!");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao deletar dados'+jqXHR.responseText);
            }
        });
        return true;
    }
}