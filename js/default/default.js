$('a').on('click',function(e){
  if(e.which == 1){
    //console.log($(this).attr("target"));
    var link = $(this).attr("href");
    if(link.indexOf(".php") != -1 && $(this).attr("target") != '_blank'){
      $('#loaderModal').fadeIn('fast');
    }
  }
});

$('#totalRecados').one('click',function(){
  listaRecados();
});

$('#deslogar').on('click',function(){
  $.ajax({
    type: "POST",
    url: "/call/default/deslogar.php",
    data: null,
    dataType: "html",
    success: function (result) {
      //console.log(result);
      if(result == 1){
        Messenger().post({
          message: 'Aguarde! Redirecionando para Página Principal.',
          type: 'success',
          showCloseButton:'yes',
          closeButtonText:'x',
          HideAfter:'1'
        });
        setTimeout(function(){
          window.location.href = '/index.php'; 
        }, 3000);
      }else{
        Messenger().post({
          message: 'Erro na chamada! contate um administrador.',
          type: 'error',
          showCloseButton:'yes',
          closeButtonText:'x',
          HideAfter:2
        })
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
});

$(document).ajaxStart(function(){
  $('#loaderModal').fadeIn('fast');
});

$(document).ajaxStop(function(){
  $('#loaderModal').hide();
});

$(document).ready(function(){

  listaTotalRecados();

  $.ajax({
    type: "POST",
    url: "/call/default/user_avatar.php",
    data: null,
    dataType: "json",
    success: function (result) {
      $("#nomeuser").html(result.nome);
      $("#fotouser").attr('src',result.foto);
      $("#nomeuserSideBar").html(result.nome);
      $("#grupoUsuarioSideBar").html(result.grupo);
      $("#fotouserSideBar").attr('src',result.foto);
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
  
});

function listaTotalRecados(){
  $.ajax({
    type: "POST",
    url: "/call/default/listaTotalRecados.php",
    data: null,
    dataType: "html",
    success: function (result) {
      $("#totalRecados").html(result);
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

function listaRecados(){
  $.ajax({
    type: "POST",
    url: "/call/default/listaRecados.php",
    data: null,
    dataType: "html",
    success: function (result) {
      $("#retornaRecados").html(result);
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