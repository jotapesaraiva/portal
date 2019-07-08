var href = window.location.href;
function projeto_selecionada() {
 var the_value = document.getElementById("equipe").value;
     $.ajax({
             url : href+'/alertas/enviar/projeto/'+the_value,
             dataType: "json",
            success: function( data ) {
                $("#projeto").empty();
                $.each(data, function (index, item) {
                        $("#projeto")
                            .append($("<option></option>")
                                .attr("value", item.ID)
                                .text(item.NAME));
                    });
                // $('#projeto').selectpicker('refresh');
            }
    });
}

function categoria_selecionada() {
 var value_projeto = document.getElementById("projeto").value;
     $.ajax({
             url : href+'/alertas/enviar/categoria/'+value_projeto,
             dataType: "json",
            success: function( data ) {
                console.table(data)
                $("#categoria").empty();
                $.each(data, function (index, item) {
                        $("#categoria")
                        .append($("<option></option>")
                            .attr("value", item.PROJECT_ID)
                            .text(item.CATEGORY));
                    });
                // $('#categoria').selectpicker('refresh');
            }
    });
}