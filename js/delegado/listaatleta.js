

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
    url: "/call/delegado/listaratleta.php",
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





$(document).ready(function(){
  listar();

  

});



function visualizar(id) {

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
      $('#declaracao').attr("href", "/images/declaracao/"+result.Declaracao);
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

