
$(document).ready(function(){

  $.ajax({
            type: "POST",
            url: "/call/default/permissao.php",
            dataType: "html",
            success: function (result) {

                    $('#menu').html(result);
                
            },
            error: function() {
                Messenger().post({
                    message: 'Erro na chamada contate um Administrador!',
                    type: 'error',
                    showCloseButton:'yes',
                    closeButtonText:'x',
                    HideAfter:2
                });
            }            
        }); 

   
  });

