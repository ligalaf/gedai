
jQuery.validator.addMethod("cpf", function(value, element) {
  value = jQuery.trim(value);
  value = value.replace('.','');
  value = value.replace('.','');
  cpf = value.replace('-','');
  while(cpf.length < 11 ) cpf = "0"+ cpf;  
  var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
  var a = [];
  var b = new Number;
  var c = 11;
  for (i=0; i<11; i++){
    a[i] = cpf.charAt(i);
    if (i < 9) b += (a[i] * --c);
  }
  if ((x = b % 11) < 2) {
    a[9] = 0 
  } else { 
      a[9] = 11-x 
    }
  b = 0;
  c = 11;
  for (y=0; y<10; y++) b += (a[y] * c--);
  if ((x = b % 11) < 2) {
    a[10] = 0; 
  } else { 
    a[10] = 11-x; 
  }

  var retorno = true;
  if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

  return this.optional(element) || retorno;

}, "Informe um CPF válido");

$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');

function table(){

  $("#dividaTable").dataTable({
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
      {"bSortable": false}
    ],
    "order": [[ 0, "asc" ]]
  });
}

function listar(){
  $.ajax({
    type: "POST",
    url: "/call/administrativo/divida/listar.php",
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

function visualizar(id) {

  var idAlterar = id.value;
  document.getElementById('idAlterar').value = idAlterar;
  $("#modalAdd").modal();
  $.ajax({
    type: "POST",
    url: "/call/administrativo/divida/listarUnico.php",
    data: { idAlterar: idAlterar },
    dataType: "json",
    success: function(result) {
      $('#solicitante').val(result.razaosocial);
      $('#nome').val(result.nome);
      $('#cnpj').val(result.cnpj);
      $('#comprovante').attr("href", "/images/avatar/"+result.comprovante);
      $('#cpf').val(result.cpf);
      $('#cep').val(result.cep);
      $('#endereco').val(result.endereco);
      $('#numero').val(result.numero);
      $('#bairro').val(result.bairro);
      $('#complemento').val(result.complemento);
      $('#cidade').val(result.cidade);
      $('#estado').val(result.estado);
      $('#telefone').val(result.telefone);
      $('#email').val(result.email);
      $('#tipo').val(result.tipo);
      $('#valor').val(result.valor);
      $('#descricao').val(result.descricao);
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
function aprovar() {

  var idAlterar = document.getElementById('idAlterar').value;
  $.ajax({
    type: "POST",
    url: "/call/administrativo/divida/aprovar.php",
    data: { idAlterar: idAlterar },
    success: function(result) {
        if(result == 1){
        Messenger().post({
        message: 'Aprovado com Sucesso',
        type: 'success',
        showCloseButton: 'yes',
        closeButtonText: 'x',
        HideAfter: 2
      })
            var table = $("#dividaTable").dataTable();
            table.dataTable().fnDestroy();
            listar();
       $("#modalAdd").modal('hide');
       }

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


function rejeitar() {

  var idAlterar = document.getElementById('idAlterar').value;
  $.ajax({
    type: "POST",
    url: "/call/administrativo/divida/rejeitar.php",
    data: { idAlterar: idAlterar },
    success: function(result) {
        if(result == 1){
        Messenger().post({
        message: 'Aprovado com Sucesso',
        type: 'success',
        showCloseButton: 'yes',
        closeButtonText: 'x',
        HideAfter: 2
      })
            var table = $("#dividaTable").dataTable();
            table.dataTable().fnDestroy();
            listar();
       $("#modalAdd").modal('hide');
       }

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


$(document).ready(function(){
  listar();



});



