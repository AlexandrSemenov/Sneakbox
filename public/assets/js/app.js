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


    /*----- Редактируем галерею -----*/

    $('.gallery').on('change', function(){
        $(this).siblings(".oldgallery").attr('value', $(this).parents(".image-item").attr('data-img'));
    });

    /*----- END Редактируем галерею -----*/

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
            $('#main-image .file-upload label').hide();
            $('#main-image input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function (e){
            this.image = '';
            $('#main-image .file-upload label').show();
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
            $('#gallery-image-1 .file-upload label').hide();
            $('#gallery-image-1 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-1 .file-upload label').show();
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
            $('#gallery-image-2 .file-upload label').hide();
            $('#gallery-image-2 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-2 .file-upload label').show();
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
            $('#gallery-image-3 .file-upload label').hide();
            $('#gallery-image-3 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-3 .file-upload label').show();
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
            $('#gallery-image-4 .file-upload label').hide();
            $('#gallery-image-4 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-4 .file-upload label').show();
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
            $('#gallery-image-5 .file-upload label').hide();
            $('#gallery-image-5 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-5 .file-upload label').show();
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
            $('#gallery-image-6 .file-upload label').hide();
            $('#gallery-image-6 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-6 .file-upload label').show();
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
            $('#gallery-image-7 .file-upload label').hide();
            $('#gallery-image-7 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-7 .file-upload label').show();
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
            $('#gallery-image-8 .file-upload label').hide();
            $('#gallery-image-8 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-8 .file-upload label').show();
        }
    }
});

/*----- END Подгружаем фото галереи -----*/


/*-------------------------------------------------------------------------------------------*/

var galleryImageEditMain = new Vue({
    el: '#gallery-image-edit-main',
    data: {
        image: $('#gallery-image-edit-main').attr('data-img')
    },
    methods: {
        onFileChange: function(e){

            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $('#gallery-image-edit-main .file-upload label').hide();
            $('#gallery-image-edit-main input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-main .file-upload label').show();
        }
    }
});

/*----- Подгружаем фото галереи (страница редактирования)-----*/

var galleryImageEdit0 = new Vue({
    el: '#gallery-image-edit-0',
    data: {
        image: $('#gallery-image-edit-0').attr('data-img'),
    },
    methods: {
        onFileChange: function(e){

            var file = e.target.files;
            (!file.length)? false : this.createImage(file[0]);
            $('#gallery-image-edit-0 .file-upload label').hide();
            $('#gallery-image-edit-0 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-0 .file-upload label').show();
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
            $('#gallery-image-edit-1 .file-upload label').hide();
            $('#gallery-image-edit-1 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-1 .file-upload label').show();
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
            $('#gallery-image-edit-2 .file-upload label').hide();
            $('#gallery-image-edit-2 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-2 .file-upload label').show();
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
            $('#gallery-image-edit-3 .file-upload label').hide();
            $('#gallery-image-edit-3 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-3 .file-upload label').show();
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
            $('#gallery-image-edit-4 .file-upload label').hide();
            $('#gallery-image-edit-4 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-4 .file-upload label').show();
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
            $('#gallery-image-edit-5 .file-upload label').hide();
            $('#gallery-image-edit-5 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-5 .file-upload label').show();
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
            $('#gallery-image-edit-6 .file-upload label').hide();
            $('#gallery-image-edit-6 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-6 .file-upload label').show();
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
            $('#gallery-image-edit-7 .file-upload label').hide();
            $('#gallery-image-edit-7 input').hide();
        },
        createImage: function(file){

            var reader = new FileReader();
            var vm = this;

            reader.onload = function(e){
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(){
            this.image = '';
            $('#gallery-image-edit-7 .file-upload label').show();
        }
    }
});

/*----- END Подгружаем фото галереи (страница редактирования)-----*/