<script>
    var min = parseInt({!! json_encode($range->min) !!});
    var max = parseInt({!! json_encode($range->max) !!});

    /*----- Фильтр с диапазоном цен на главной странице -----*/
    function $_GET(key) {
        var val = window.location.search;
        val = val.match(new RegExp(key + '=([^&=]+)'));
        return val ? val[1] : false;
    }

    $( function() {
        $( "#slider-range" ).slider({
            min: min,
            max: max,
            range: true,
            values: [$_GET('price_from')? $_GET('price_from'): min, $_GET('price_till')? $_GET('price_till'): max],
            slide: function( event, ui ) {
                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                $("#price_from").val(ui.values[0]);
                $("#price_till").val(ui.values[1]);
            }
        });
        $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
        $("#price_from").val($_GET('price_from')? $_GET('price_from'): min);
        $("#price_till").val($_GET('price_till')? $_GET('price_till'): max);
    } );
    /*----- end слайдер с ценами -----*/
</script>