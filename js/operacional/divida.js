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

  $("#formdiv").validate({
    errorClass: 'error',
    focusInvalid: true,
    ignore: "",
    rules: {
      cpf: {
        required: true,
        cpf: true
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
  });
 

function verificar() {
    
  if ($("#formdiv").valid()) {
   var data = $("#formdiv");

    $.ajax({
      type: "POST",
      url: "/call/operacional/verificar_cpf.php",
       data:  new FormData(data[0]),
      dataType: "html",
       processData: false,
      cache: false,
      contentType: false,
      success: function (result) {
        $("#retorno").html(result);
        $('#cep').mask('99999-999');
        $('#telefone').mask('(99)99999-9999');
         ValidaFormDivida();
         var cpf = document.getElementById("cpf").value;
         $("#cpf").prop("readonly", true);
         document.getElementById("cpf2"). value = cpf;
        
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
      message: 'CPF Invalido.',
      type: 'error',
      showCloseButton:'yes',
      closeButtonText:'x',
      HideAfter:2
    });
    return false;
  }
}


function ValidaFormDivida(){

 var form = $("#formpessoa");

  // Validando Formulario de Cadastro de Grupo (Parte Cliente)
  $("#formpessoa").validate({
    errorClass: 'error',
    focusInvalid: true,
    ignore: "",
    rules: {
      nome: {
        required: true,
        minlength: 6
      },

      email: {
        required: true,
        email: true
      },

      cep: {
        required: true,
        minlength: 8
      },
      endereco: {
        required: true
    
      },
      cidade: {
        required: true
    
      },
      bairro: {
        required: true
    
      },
       estado: {
        required: true
    
      },
       complemento: {
        required: true
    
      },
       numero: {
        required: true

    
      },
       telefone: {
        required: true,
        minlength:14

      },
      valor: {
        required: true

      },
      desc: {
        required: true,
        minlength: 20

      },

       doc: {
        required: true,
        extension: "jpeg|jpg|png|gif|bmp|pdf",
        filesize: 4000000
      },
      complemento: {
        required: false
   
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

function EnviaNotificacao() {
    
  if ($("#formpessoa").valid()) {
    var data = $("#formpessoa");

    $.ajax({
      type: "POST",
      url: "/call/operacional/negativacao.php",
       data:  new FormData(data[0]),
      dataType: "html",
       processData: false,
      cache: false,
      contentType: false,
      success: function (result) {
        if (result == 1){
          Messenger().post({
                        message: 'Notificação Enviada Com Sucesso!Você terá um retorno em breve!',
                        type: 'success',
                        showCloseButton:'yes',
                        closeButtonText:'x',
                        HideAfter: 1
                    });
                    setTimeout(function(){
                        window.location.href = '/views/operacional/divida.php';
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

function validacep(){

//Nova variável "cep" somente com dígitos.
var cep = $('#cep').val().replace(/\D/g, '');

                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");



$.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.uf);
                           
                            } //end if.
                        });





}