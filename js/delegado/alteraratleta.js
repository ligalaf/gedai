

function table(){

  $("#atletaTable").dataTable({

    responsive: true,
    bPaginate: true,
    "ordering": true,
    "info": true,
    searching: true,
    "language": {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "thousands": ".",
      "decimal": ",",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    },
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"]
    ],
    "aoColumns": [
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": true},
      {"bSortable": false}
    ],
    "order": [[ 0, "asc" ]]
  });
}

function listar(){
  $.ajax({
    type: "POST",
    url: "/call/delegado/alteraratleta.php",
    data: null,
    dataType: "html",
    success: function (result) {
      $("#corpo").html(result);
      table();
    },
    error: function() {
      Messenger().post({
        message: 'Erro na chamada! contate um administrador.',
        type: 'error',
        showCloseButton:'yes',
        closeButtonText:'x',
        HideAfter:2
      })
    }
  });
}
function preencheunid(){
  $.ajax({
    type: "POST",
    url: "/call/laf/unidade/listar.php",
    data: null,
    dataType: "html",
    success: function (result) {
      $("#unidade").html(result);
      $("#unidade_editar").html(result);
    },
    error: function() {
      Messenger().post({
        message: 'Erro na chamada! contate um administrador.',
        type: 'error',
        showCloseButton:'yes',
        closeButtonText:'x',
        HideAfter:2
      })
    }
  });
}
function ValidaFormAtleta(){

 var form = $("#editarusuario");

  // Validando Formulario de Cadastro de Grupo (Parte Cliente)
  $("#editarusuario").validate({
    errorClass: 'error',
    focusInvalid: true,
    ignore: "",
    rules: {
      foto_editar: {
        required: true,
        extension: "jpeg|jpg|png|gif|bmp|pdf"
      }

    },

    errorPlacement: function(error, element) { // render error placement for each input type
      var parent = $(element).parent().parent('.form-group');
      parent.removeClass('has-success').addClass('has-error');
    },

    highlight: function(element) { // hightlight error inputs
      var parent = $(element).parent().parent('.form-group');
      parent.removeClass('has-success').addClass('has-error');
    },

    success: function(label, element) {
      var parent = $(element).parent().parent('.form-group');
      parent.removeClass('has-error').addClass('has-success');
    }

  });


}





$(document).ready(function(){
  listar();
  ValidaFormAtleta();
  

});



function alterar(id) {

  var idAlterar = id.value;
  document.getElementById('idAlterar').value = idAlterar;
  $("#modalAprovar").modal();
  $.ajax({
    type: "POST",
    url: "/call/laf/atleta/listarUnicoPendente.php",
    data: { idAlterar: idAlterar },
    dataType: "json",
    success: function(result) {
      $('#nome_editar').val(result.nome);
      $('#ra_editar').val(result.RA);
      $('#rg_editar').val(result.RG);
      $('#email_editar').val(result.Email);
      $('#curso_editar').val(result.Curso);
      $('#ano_editar').val(result.Ano);
      $('#semestre_editar').val(result.Semestre);
      $('#turno_editar').val(result.Turno);
      $('#unidade_editar').val(result.Unidade);
      $('#celular_editar').val(result.Celular);
      $("#modalEditar").modal();
    },
    error: function() {
      Messenger().post({
        message: 'Erro na chamada! contate um administrador.',
        type: 'error',
        showCloseButton: 'yes',
        closeButtonText: 'x',
        HideAfter: 2
      })
    }
  });
}

function salvar() {
    
  if ($("#editarusuario").valid()) {
    var data = $("#editarusuario");

    $.ajax({
      type: "POST",
      url: "/call/delegado/alteraratletaupdate.php",
       data:  new FormData(data[0]),
      dataType: "html",
       processData: false,
      cache: false,
      contentType: false,
      success: function (result) {
        if (result == 1){
          Messenger().post({
                        message: 'Alterado com sucesso!',
                        type: 'success',
                        showCloseButton:'yes',
                        closeButtonText:'x',
                        HideAfter: 1
                    });
                    setTimeout(function(){
                        window.location.href = '/views/delegado/atleta.php';
                    }, 3000);
        }
      },
      error: function() {
        Messenger().post({
          message: 'Erro na chamada! contate um administrador.',
          type: 'error',
          showCloseButton:'yes',
          closeButtonText:'x',
          HideAfter:2
        })
      }
    });
  }else{
    Messenger().post({
      message: 'Revise o(s) Campos em Vermelho.',
      type: 'error',
      showCloseButton:'yes',
      closeButtonText:'x',
      HideAfter:2
    });
    return false;
  }
}