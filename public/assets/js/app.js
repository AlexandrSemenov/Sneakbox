jQuery(document).ready(function(){

    $('.edit').on('click', function(){
        $('.edit-modal').modal('toggle');
    });

    /* записываем data-num в sessionStorage */
    $("input[type='submit']").on('click', function(){
        sessionStorage.setItem('collapse', $(this).data('num'));
    });

    /* получаем значение с sessionStorage */

    var collapse = sessionStorage.getItem('collapse');

    if(collapse != 'undefined')
    {
        $('.panel-collapse').removeClass('in');
        $(".panel-collapse[data-num="+collapse+"]").addClass('in');
    }

    /*слайдер страница товара*/
    $('.slider-items').slick({
        adaptiveHeight: true,
        prevArrow: '<div class="prev"></div>',
        nextArrow: '<div class="next"></div>'
    });




    /*----- Подгужаем боьлше полей для галереи -----*/
    //var index = 2;
    //$('.more-gallery-input').on('click', function(){
    //    if(index <= 8)
    //    {
    //        $('.gallery-input-block').append(
    //            "<div id='gallery-image-"+index+"' class='form-group'>"
    //            + "<lable id='gallery'>Фото " + index + "</lable>"
    //            + "<div v-if='!image'></div>"
    //            + "<div v-else>"
    //            + "<div class='image-wrapp'>"
    //            + "<div class='close-btn' v-on:click='removeImage'></div>"
    //            + "<img class='prev-image' v-bind:src='image' alt='preview-image'>"
    //            + "</div>"
    //            + "</div>"
    //            + "<input type='file' v-on:change='onFileChange' id='gallery' name='gallery[]'>"
    //            + "</div>");
    //        index++;
    //
    //        /* скрываем кнопку */
    //        (index == 9)? $('.more-gallery-input').css('display', 'none') : '';
    //    }
    //});

    /*----- End Подгужаем боьлше полей для галереи -----*/

    /*----- Редактируем галерею -----*/

    $('.gallery').on('change', function(){
        $(this).parent().find('.oldgallery').attr('value', $(this).parent().attr('data-img'));
    });

    /*----- END Редактируем галерею -----*/

    /*----- слайдер с ценами на главной странице -----*/
    function $_GET(key) {
        var val = window.location.search;
        val = val.match(new RegExp(key + '=([^&=]+)'));
        return val ? val[1] : false;
    }

    $( function() {
        $( "#slider-range" ).slider({
            min: 0,
            max: 10000,
            range: true,
            values: [$_GET('price_from')? $_GET('price_from'):"0", $_GET('price_till')? $_GET('price_till'):"2500"],
            slide: function( event, ui ) {
                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                $("#price_from").val(ui.values[0]);
                $("#price_till").val(ui.values[1]);
            }
        });
        $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
        $("#price_from").val($_GET('price_from')? $_GET('price_from'):"0");
        $("#price_till").val($_GET('price_till')? $_GET('price_till'):"2500");
    } );
    /*----- end слайдер с ценами -----*/
});

/*----- Подгружаем заглавное фото -----*/

var app = new Vue({
    el: '#main-image',
    data: {
        image: ''
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $('#main-image input').hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function (e){
            this.image = '';
            $('#main-image input').show().val('');
        }
    }
});

/*----- END Подгружаем заглавное фото -----*/

/*----- Подгружаем фото галереи -----*/


var galleryImage = new Vue({
    el: '#gallery-image-1',
    data: {
        image: ''
    },
    methods: {
        onFileChange: function(e){

            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-1 input').show().val('');
        }
    }
});


var galleryImage = new Vue({
    el: '#gallery-image-2',
    data: {
        image: ''
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-2 input').show().val('');
        }
    }
});

var galleryImage = new Vue({
    el: '#gallery-image-3',
    data: {
        image: ''
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-3 input').show().val('');
        }
    }
});

var galleryImage = new Vue({
    el: '#gallery-image-4',
    data: {
        image: ''
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-4 input').show().val('');
        }
    }
});

var galleryImage = new Vue({
    el: '#gallery-image-5',
    data: {
        image: ''
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-5 input').show().val('');
        }
    }
});

var galleryImage = new Vue({
    el: '#gallery-image-6',
    data: {
        image: ''
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-6 input').show().val('');
        }
    }
});

var galleryImage = new Vue({
    el: '#gallery-image-7',
    data: {
        image: ''
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-7 input').show().val('');
        }
    }
});

var galleryImage = new Vue({
    el: '#gallery-image-8',
    data: {
        image: ''
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-8 input').show().val('');
        }
    }
});

/*----- END Подгружаем фото галереи -----*/

/*----- Подгружаем фото галереи (страница редактирования)-----*/

var galleryImageEdit0 = new Vue({
    el: '#gallery-image-edit-0',
    data: {
        image: $('#gallery-image-edit-0').attr('data-img')
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-0 input[type="file"]').show().val('');
        }
    }
});

var galleryImageEdit1 = new Vue({
    el: '#gallery-image-edit-1',
    data: {
        image: $('#gallery-image-edit-1').attr('data-img')
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-1 input[type="file"]').show().val('');
        }
    }
});

var galleryImageEdit2 = new Vue({
    el: '#gallery-image-edit-2',
    data: {
        image: $('#gallery-image-edit-2').attr('data-img')
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-2 input[type="file"]').show().val('');
        }
    }
});

var galleryImageEdit3 = new Vue({
    el: '#gallery-image-edit-3',
    data: {
        image: $('#gallery-image-edit-3').attr('data-img')
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-3 input[type="file"]').show().val('');
        }
    }
});

var galleryImageEdit4 = new Vue({
    el: '#gallery-image-edit-4',
    data: {
        image: $('#gallery-image-edit-4').attr('data-img')
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-4 input[type="file"]').show().val('');
        }
    }
});

var galleryImageEdit5 = new Vue({
    el: '#gallery-image-edit-5',
    data: {
        image: $('#gallery-image-edit-5').attr('data-img')
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-5 input[type="file"]').show().val('');
        }
    }
});

var galleryImageEdit6 = new Vue({
    el: '#gallery-image-edit-6',
    data: {
        image: $('#gallery-image-edit-6').attr('data-img')
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-6 input[type="file"]').show().val('');
        }
    }
});

var galleryImageEdit7 = new Vue({
    el: '#gallery-image-edit-7',
    data: {
        image: $('#gallery-image-edit-7').attr('data-img')
    },
    methods: {
        onFileChange: function(e){
            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $(e.target).hide();
        },
        createImage: function(file){

            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-7 input[type="file"]').show().val('');
        }
    }
});

/*----- END Подгружаем фото галереи (страница редактирования)-----*/