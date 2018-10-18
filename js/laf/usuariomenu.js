
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





$(document).ready(function(){

    $("#editarusuariomenu").validate({
    errorClass: 'error',
    focusInvalid: true,
    ignore: "",
    rules: {
      nome_editar_menu: {
        required: true,
        minlength: 4
      },


      senha_editar_menu: {
        required: true,
        minlength: 8
      },

      foto_editar_menu: {
        extension: "jpeg|jpg|png|gif|bmp"
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

  $("#olho_editar_menu").mousedown(function() {
    $("#senha_editar_menu").attr("type", "text");
    $("#olho_editar_menu").attr("style", "cursor: pointer;");
    $("#olho_editar_menu").find('i').removeClass("fa fa-eye-slash");
    $("#olho_editar_menu").find('i').addClass("fa fa-eye");
  });

  $("#olho_editar_menu").mouseup(function() {
    $("#senha_editar_menu").attr("type", "password");
    $("#olho_editar_menu").find('i').removeClass("fa fa-eye");
    $("#olho_editar_menu").find('i').addClass("fa fa-eye-slash");
  });

  $("#olho_editar").mousedown(function() {
    $("#senha_editar_menu").attr("type", "text");
    $("#olho_editar_menu").attr("style", "cursor: pointer;");
    $("#olho_editar_menu").find('i').removeClass("fa fa-eye-slash");
    $("#olho_editar_menu").find('i').addClass("fa fa-eye");
  });

  $("#olho_editar").mouseup(function() {
    $("#senha_editar_menu").attr("type", "password");
    $("#olho_editar_menu").find('i').removeClass("fa fa-eye");
    $("#olho_editar_menu").find('i').addClass("fa fa-eye-slash");
  });

});

  function limpaModalAlterar(){
    $('.form-group').each(function () { $(this).removeClass('has-success'); });
    $('.form-group').each(function () { $(this).removeClass('has-error'); });
  }



function preencheridAlterarMenu(id) {

  var idAlterar = document.getElementById('idAlterarmenu').value;
  $.ajax({
    type: "POST",
    url: "/call/laf/usuario/listarUnico.php",
    data: { idAlterar: idAlterar },
    dataType: "json",
    success: function(result) {
      $('#nome_editar_menu').val(result.nome);
      $('#senha_editar_menu').val(result.senha);
      $('#avatar_editar_menu').attr("src", "/images/avatar/"+result.foto);
      $("#modalEditarMenu").modal();
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

function excluir() {

  if ($("#excluiusuario").valid()) {
    var data = $("#excluiusuario").serializeArray();

    $.ajax({
      type: "POST",
      url: "/call/usuario/excluir.php",
      data: data,
      dataType: "html",
      success: function(result) {
        $("#retornocadastro").html(result);
        $('#modalExcluir').modal('toggle');
        var table = $("#usuarioTable").dataTable();
        table.dataTable().fnDestroy();
        listar();
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
  return false;
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
            $('#modalEditarMenu').modal('toggle');
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

function alterarmenu() {

  if ($("#editarusuariomenu").valid()) {
    var data = $("#editarusuariomenu");

    $.ajax({
      type: "POST",
      url: "/call/laf/usuario/alterarMenu.php",
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
            $('#modalEditarMenu').modal('toggle');
            $('#editarusuariomenu').each(function() { this.reset(); });
            $('.form-group').each(function () { $(this).removeClass('has-success'); });
            $('.form-group').each(function () { $(this).removeClass('has-error'); });
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
