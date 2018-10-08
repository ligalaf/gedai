$.validator.addMethod('cnpj', function(cnpj, element, param) {
  var $return, digitos, i, numeros, pos, resultado, soma, tamanho;
  $return = true;
  cnpj = cnpj.replace(/[^\d]+/g, '');
  if (cnpj === '') {
    $return = false;
  }
  if (cnpj.length !== 14) {
    $return = false;
  }
  if (cnpj === '00000000000000' || cnpj === '11111111111111' || cnpj === '22222222222222' || cnpj === '33333333333333' || cnpj === '44444444444444' || cnpj === '55555555555555' || cnpj === '66666666666666' || cnpj === '77777777777777' || cnpj === '88888888888888' || cnpj === '99999999999999') {
    $return = false;
  }
  tamanho = cnpj.length - 2;
  numeros = cnpj.substring(0, tamanho);
  digitos = cnpj.substring(tamanho);
  soma = 0;
  pos = tamanho - 7;
  i = tamanho;
  while (i >= 1) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) {
      pos = 9;
    }
    i--;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
  if (resultado !== parseInt(digitos.charAt(0))) {
    $return = false;
  }
  tamanho = tamanho + 1;
  numeros = cnpj.substring(0, tamanho);
  soma = 0;
  pos = tamanho - 7;
  i = tamanho;
  while (i >= 1) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) {
      pos = 9;
    }
    i--;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
  if (resultado !== parseInt(digitos.charAt(1))) {
    $return = false;
  }
  return $return;
});

$.validator.addMethod("cep", function(cep_value, element) {
  return this.optional(element) || /^\d{2}.\d{3}-\d{3}?$|^\d{5}-?\d{3}?$/.test( cep_value );
}, "Informe um CEP válido.");

// Validando Formulario de Login (Parte Cliente)
$("#form_login").validate({
    focusInvalid: true,
    rules: {
        user: {
            required: true,
            minlength: 6,
            email:true
        },
        senha: {
            required: true,
            minlength: 6   
        }             
    },
    messages: {
        user: {
            required: "O campo Email é obrigatório",
            minlength: "O campo Email não pode conter menos de 6 caracteres",
            email:"Digite um email valido.",
        },
        senha: {
            required: "O campo SENHA é obrigatório",
            minlength: "O campo SENHA não pode conter menos de 6 caracteres"
        }
    }
});

$(document).ready(function(){

    $('#loaderModal').hide();

     $('#cep').focus(function(){
    $('#logradouro').val('Carregando...');
    $('#bairro').val('Carregando...');
    $('#cidade').val('Carregando...');
    $('#estado').val('Carregando...');
    $('#complemento').val('Carregando...');
  });

  $('#cep_editar').focus(function(){
    $('#logradouro_editar').val('Carregando...');
    $('#bairro_editar').val('Carregando...');
    $('#cidade_editar').val('Carregando...');
    $('#estado_editar').val('Carregando...');
    $('#complemento_editar').val('Carregando...');
  });

  $('#cep').focusout(function(){

    var cep = $('#cep').val();
    cep = cep.replace('-','');
    cep = cep.replace('_','');

    if (cep.length == 8){
      $.ajax({
        type: "POST",
        url: "https://viacep.com.br/ws/"+cep+"/json/",
        data: null,
        dataType: "json",
        success: function (result) {
          if(result.erro == true){
            Messenger().post({
              message: 'Erro! Possíveis Causas: CEP Inválido.',
              type: 'error',
              showCloseButton:'yes',
              closeButtonText:'x',
              HideAfter:2
            });
            $('#cep').val('');
          }
          $('#logradouro').val(result.logradouro);
          $('#bairro').val(result.bairro);
          $('#cidade').val(result.localidade);
          $('#estado').val(result.uf);
          $('#complemento').val(result.complemento);
        },
        error: function() {
          Messenger().post({
            message: 'Erro! Possíveis Causas: Serviço de Busca Indísponivel, Favor preencher Manualmente.',
            type: 'error',
            showCloseButton:'yes',
            closeButtonText:'x',
            HideAfter:2
          })
        }
      });
    }else{
      Messenger().post({
            message: 'Favor preencher o Campo CEP Corretamente.',
            type: 'error',
            showCloseButton:'yes',
            closeButtonText:'x',
            HideAfter:2
        })
    }
  });

  $('#cep_editar').focusout(function(){

    var cep = $('#cep_editar').val();
    cep = cep.replace('-','');
    cep = cep.replace('_','');

    if (cep.length == 8){
      $.ajax({
        type: "POST",
        url: "https://viacep.com.br/ws/"+cep+"/json/",
        data: null,
        dataType: "json",
        success: function (result) {
          if(result.erro == true){
            Messenger().post({
              message: 'Erro! Possíveis Causas: CEP Inválido.',
              type: 'error',
              showCloseButton:'yes',
              closeButtonText:'x',
              HideAfter:2
            });
            $('#cep_editar').val('');
          }
          $('#logradouro_editar').val(result.logradouro);
          $('#bairro_editar').val(result.bairro);
          $('#cidade_editar').val(result.localidade);
          $('#estado_editar').val(result.uf);
          $('#complemento_editar').val(result.complemento);
        },
        error: function() {
          Messenger().post({
            message: 'Erro! Possíveis Causas: Serviço de Busca Indísponivel, Favor preencher Manualmente.',
            type: 'error',
            showCloseButton:'yes',
            closeButtonText:'x',
            HideAfter:2
          })
        }
      });
    }else{
      Messenger().post({
            message: 'Favor preencher o Campo CEP Corretamente.',
            type: 'error',
            showCloseButton:'yes',
            closeButtonText:'x',
            HideAfter:2
        })
    }
  });

$("#cadastroFornecedor").validate({
    errorClass: 'error',
    focusInvalid: true,
    ignore: "",
    rules: {
      razao: {
        required: true,
        minlength: 10,
        maxlength: 150
      },
      nome: {
        required: true,
        minlength: 6,
        maxlength: 100
      },
      cnpj: {
        cnpj: true,
        required: true
      },
      ie: {
        required: true,
        minlength: 10,
        number: true
      },
      cep: {
        cep: true,
        required: true,
      },
      logradouro: {
        required: true,
        minlength: 5,
        maxlength: 150
      },
      numero: {
        required: true,
        maxlength: 6,
        number: true
      },
      bairro: {
        required: true,
        maxlength: 30
      },
      complemento: {
        required: false,
        maxlength: 30
      },
      cidade: {
        required: true,
        maxlength: 30
      },
      estado: {
        required: true,
      },
      telefone: {
        required: true
      },
      email: {
        required: true,
        email:true
      },
      foto: {
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

  });

    


$(document).ajaxStart(function(){
    $('#loaderModal').fadeIn('fast');
});

$(document).ajaxStop(function(){
    $('#loaderModal').hide();
});

function logar() {
    if ($("#form_login").valid()) {
        var data = $("#form_login").serializeArray();
        $.ajax({
            type: "POST",
            url: "/call/default/login.php",
            data: data,
            dataType: "html",
            success: function (result) {
              $('#loaderModal').hide();
                if(result == 1){
                    Messenger().post({
                        message: 'Logado com Sucesso! Redirecionando para Página Principal.',
                        type: 'success',
                        showCloseButton:'yes',
                        closeButtonText:'x',
                        HideAfter: 1
                    });
                    setTimeout(function(){
                        window.location.href = '/';
                    }, 3000);
                }else{
                    $('#retornochamada').html(result);
                }
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
    }
    return false;
}
function cadastrarsolicitacao() {
    
  if ($("#cadastroFornecedor").valid()) {
    var data = $("#cadastroFornecedor");

    $.ajax({
      type: "POST",
      url: "/call/cadastro/cadastrar.php",
      data:  new FormData(data[0]),
      dataType: "html",
      processData: false,
      cache: false,
      contentType: false,
      success: function (result) {
        if (result == 1) {
          Messenger().post({
            message: 'Solicitação Enviada com Sucesso! Aguarde um retorno pelo Email Cadastrado',
            type: 'success',
            showCloseButton:'yes',
            closeButtonText:'x',
            HideAfter:'1'
          });
          setTimeout(function(){
            $("#modalAdd").modal('toggle');
            $('#cadastroFornecedor').each(function(){ this.reset(); });
            $('.form-group').each(function(){ $(this).removeClass('has-success'); });
            $('.form-group').each(function(){ $(this).removeClass('has-error'); });
          }, 2000);
        }else{
          $("#retornocadastro").html(result);
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

$('#senha').on('keydown', function(e) {
    if (e.which == 13) {
        logar();
    }
});