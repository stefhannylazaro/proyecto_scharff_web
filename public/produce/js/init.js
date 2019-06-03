$(document).ready(function(){
    $(window).scroll(function(){
      if ($(this).scrollTop() > 100) {
        $('.btn-up').fadeIn();
      } else {
        $('.btn-up').fadeOut();
      }

      var windowTop = $(document).scrollTop();
      var windowBottom = windowTop + window.innerHeight;//altura del navegador
      var elementPositionTop = $("#section-pink").offset().top;//parte superior del elemento
      var elementPositionBottom = elementPositionTop + $("#section-pink").height();//parte inferior del elemento
      var aux=1;
      
      // if(elementPositionTop > windowBottom)
      //   aux=0;
      //
      // if(elementPositionBottom < windowTop)
      //   aux=0
      //
      // if(aux)
      //   $('.btn-up img').attr('src','/produce/images/icon_up.png');//cambio color de la flecha
      // else
      //   $('.btn-up img').attr('src','/produce/images/icon_up_rosa.png');

      ///
      if(windowTop > elementPositionBottom) {
        $('.btn-up img').attr('src','/produce/images/icon_up_rosa.png');
      } else {
        $('.btn-up img').attr('src','/produce/images/icon_up.png');
      }
      ///
    });
    $('.btn-up').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 700);
        return false;
    });
    $('.btn-bottom').click(function(){
        $("html, body").animate({ scrollTop: $('header').height()-100 }, 1000);
        return false;
    });
});
