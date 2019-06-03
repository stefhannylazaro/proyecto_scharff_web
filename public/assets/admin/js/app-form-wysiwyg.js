var App = (function () {
	'use strict';

  App.textEditors = function( ){

    //Summernote
    $('.editor1').summernote({
      height: 300
    });
    $('.editor2').summernote({
      height: 100
    });

  };

  return App;
})(App || {});
