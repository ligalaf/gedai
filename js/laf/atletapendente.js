

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
      {"bSortable": false}
    ],
    "order": [[ 0, "asc" ]]
  });
}

function listar(){
  $.ajax({
    type: "POST",
    url: "/call/laf/atleta/listarpendente.php",
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
  preencheunid();

  //Guarda o form em uma variável
  var form = $("#cadastrousuario");

  // Validando Formulario de Cadastro de Grupo (Parte Cliente)
  $("#cadastrousuario").validate({
    errorClass: 'error',
    focusInvalid: true,
    ignore: "",
    rules: {
      nome: {
        required: true,
        minlength: 4
      },

      tipo: {
        required: true
      },
        unidade: {
        required: true
      },

      email: {
        required: true,
        email: true
      },

      senha: {
        required: true,
        minlength: 8
      },

      foto: {
        required: true,
        extension: "jpeg|jpg|png|gif|bmp",
        filesize: 2000000
      },

      bloqueado: {
        required: true
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


  $("#editarusuario").validate({
    errorClass: 'error',
    focusInvalid: true,
    ignore: "",
    rules: {
      nome_editar: {
        required: true,
        minlength: 4
      },


      senha_editar: {
        required: true,
        minlength: 8
      },

      foto_editar: {
        extension: "jpeg|jpg|png|gif|bmp",
        filesize: 2000000
      },

      bloqueado_editar: {
        required: true
      },
       tipo_editar: {
        required: true
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

  $("#olho").mousedown(function() {
    $("#senha").attr("type", "text");
    $("#olho").attr("style", "cursor: pointer;");
    $("#olho").find('i').removeClass("fa fa-eye-slash");
    $("#olho").find('i').addClass("fa fa-eye");
  });

  $("#olho").mouseup(function() {
    $("#senha").attr("type", "password");
    $("#olho").find('i').removeClass("fa fa-eye");
    $("#olho").find('i').addClass("fa fa-eye-slash");
  });

  $("#olho_editar").mousedown(function() {
    $("#senha_editar").attr("type", "text");
    $("#olho_editar").attr("style", "cursor: pointer;");
    $("#olho_editar").find('i').removeClass("fa fa-eye-slash");
    $("#olho_editar").find('i').addClass("fa fa-eye");
  });

  $("#olho_editar").mouseup(function() {
    $("#senha_editar").attr("type", "password");
    $("#olho_editar").find('i').removeClass("fa fa-eye");
    $("#olho_editar").find('i').addClass("fa fa-eye-slash");
  });

});

  function limpaModalAlterar(){
    $('.form-group').each(function () { $(this).removeClass('has-success'); });
    $('.form-group').each(function () { $(this).removeClass('has-error'); });
  }

function preencheridAlterar(id) {

  var idAlterar = id.value;
  document.getElementById('idAlterar').value = idAlterar;
  $.ajax({
    type: "POST",
    url: "/call/laf/usuario/listarUnico.php",
    data: { idAlterar: idAlterar },
    dataType: "json",
    success: function(result) {
      $('#nome_editar').val(result.nome);
      $('#email_editar').val(result.email);
      $('#senha_editar').val(result.senha);
      $('#avatar_editar').attr("src", "/images/avatar/"+result.foto);
      $('#bloqueado_editar').val(result.bloqueado);
      $('#tipo_editar').val(result.tipo);
      $('#unidade_editar').val(result.unidade);
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


function alterar() {

  if ($("#editarusuario").valid()) {
    var data = $("#editarusuario");

    $.ajax({
      type: "POST",
      url: "/call/laf/usuario/alterar.php",
      data: new FormData(data[0]),
      dataType: "html",
      processData: false,
      cache: false,
      contentType: false,
      success: function(result) {
        if(result == 1){
          Messenger().post({
            message: 'Alterado com Sucesso!',
            type: 'success',
            showCloseButton:'yes',
            closeButtonText:'x',
            HideAfter:'1'
          });
          setTimeout(function(){
            $('#modalEditar').modal('toggle');
            $('#editarusuario').each(function() { this.reset(); });
            $('.form-group').each(function () { $(this).removeClass('has-success'); });
            $('.form-group').each(function () { $(this).removeClass('has-error'); });
            var table = $("#usuarioTable").dataTable();
            table.dataTable().fnDestroy();
            listar();
          }, 1000);
        }else{
          $("#retornocadastro").html(result);
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
      $('#foto_editar').attr("href", "/images/foto/"+result.Foto);
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

function aprovar() {

  var idAlterar = document.getElementById('idAlterar').value;
  $.ajax({
    type: "POST",
    url: "/call/laf/atleta/aprovar.php",
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
            var table = $("#atletaTable").dataTable();
            table.dataTable().fnDestroy();
            listar();
       $("#modalConfirmar").modal('hide');
       $("#modalAprovar").modal('hide');

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
function reprovar() {

  var idAlterar = document.getElementById('idAlterar').value;
  $.ajax({
    type: "POST",
    url: "/call/laf/atleta/reprovar.php",
    data: { idAlterar: idAlterar },
    success: function(result) {
        if(result == 1){
        Messenger().post({
        message: 'Reprovado com Sucesso',
        type: 'success',
        showCloseButton: 'yes',
        closeButtonText: 'x',
        HideAfter: 2
      })
            var table = $("#atletaTable").dataTable();
            table.dataTable().fnDestroy();
            listar();
       $("#modalAprovar").modal('hide');
       $("#modalRejeitar").modal('hide');

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