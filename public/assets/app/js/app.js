var app = function () {
    return {
        init: function () {
            var $form = $('#frmSearch');
            var $search = $('#generalSearch', $form);
            var $select = $('.select-pager', $form);

            $search.keyup(function (e) {
                if(e.keyCode == 13)
                {
                    $form.submit();
                }
            });
            $select.change(function () {
                $form.submit();
            });
        }
    }
}();


var banner = function () {
    return {
        init: function () {
            var $form = $('#frmBanner');

            $form.validate({
                // define validation rules
                rules: {
                    titulo: {
                        required: true
                    },
                    subtitulo: {
                        required: true
                    },
                    slug: {
                        required : true
                    },

                },
                messages: {
                    titulo: {
                        required: 'El campo titulo es obligatorio.'
                    },
                    subtitulo: {
                        required: 'El campo subtitulo es obligatorio'
                    },
                    slug: {
                        required: 'El campo slug es obligatorio.'
                    },
                    
                },

                //display error alert on form submit
                invalidHandler: function(event, validator) {
                    var alert = $form;
                    alert.removeClass('m--hide').show();
                },

                submitHandler: function (form) {
                    $form[0].submit(); // submit the form
                }
            });
        }
    }

}();



var servicio = function () {
    return {
        init: function () {
            var $form = $('#frmServicio');

            $form.validate({
                // define validation rules
                rules: {
                    titulo: {
                        required: true
                    },

                    orden: {
                        min: 0,
                        max: 99
                    }
                },
                messages: {
                    titulo: {
                        required: 'El campo titulo es obligatorio.'
                    },
                    orden: {
                        min: 'El campo orden minimo es 0',
                        max: 'El campo orden maximo es 99'
                    }
                },

                //display error alert on form submit
                invalidHandler: function(event, validator) {
                    var alert = $form;
                    alert.removeClass('m--hide').show();
                },

                submitHandler: function (form) {
                    $form[0].submit(); // submit the form
                }
            });
        }
    }

}();



var sucursal = function () {
    return {
        init: function () {
            var $form = $('#frmSucursal');

            $form.validate({
                // define validation rules
                rules: {
                    pais: {
                        required: true
                    },

                    ciudad: {
                        required:true
                    }
                },
                messages: {
                    titulo: {
                        required: 'El campo pais es obligatorio.'
                    },
                    ciudad: {
                        required: 'El campo ciudad es obligatorio.'
                    }
                },

                //display error alert on form submit
                invalidHandler: function(event, validator) {
                    var alert = $form;
                    alert.removeClass('m--hide').show();
                }

               /* submitHandler: function (form) {
                    $form[0].submit(); // submit the form
                }*/
            });
        }
    }

}();
