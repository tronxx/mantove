$( "#btn_imprimir").click(function() {
  alert( "Handler for .click() called." );
});

window.onload = function() {
 console.log("Ya se cargó la página");
}

function manda_imprimir() {
	idpoligas_z = $('#idpoligas').value();
	fecha_z = $('#fecha').value();
	$.ajax({
            type: "POST",
            url: "impripol.php",
            dataType: "json",
            data: {idpoligas:idpoligas_z, fecha:fecha_z},
            success : function(data){
                if (data.code == "200"){
                    alert("Success: " +data.msg);
                } else {
                    $(".display-error").html("<ul>"+data.msg+"</ul>");
                    $(".display-error").css("display","block");
                }

            }
    });


}