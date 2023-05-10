<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        var _token = $('meta[name=csrf-token').attr('content');
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <b>
                {{ config('app.name', 'Laravel') }}
                </b>
            </a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</div>
<script>
    function chart(){
        $.ajax({
            url:"{{route('chart')}}",
            type:'GET',
            dataType:'json',
            success:function(response){
                console.log(response);
                $('#chart-container').html(response.html);
            }
        });
    }
    $(function(){
        chart();
        $('#collapseExample').addClass('collapsing');
        
        $(document).on('mouseenter','.product_title', function(){
            var form = $('.form');
            if(form.prop('readonly')) {
                $('.btn-edit').show();
            }
            $('.btn-cancel').show();
        });
        
        $(document).on('click', '.btn-edit', function(){
            $('.form').removeClass('readonly');
            $('.form').attr('readonly',false);
            $('.btn-edit').hide();
        });

        $(document).on('click', '.btn-cancel', function(){
            $('.form').addClass('readonly');
            $('.form').attr('readonly',true);
            $('.btn-edit').hide();
            $('.btn-cancel').hide();
        });

        $(document).on('click', '.chart-btn', function(){
            $(window).scrollTop(0);
        });

        $(window).scroll(function(e){ 
            var $el = $('#search-box'); 
            var isPositionFixed = ($el.css('position') == 'fixed');
            if ($(this).scrollTop() > 50 && !isPositionFixed){ 
                $el.css({'position': 'fixed', 'top': '0px'}); 
            }
            if ($(this).scrollTop() < 50 && isPositionFixed){
                $el.css({'position': 'absolute', 'top': '50px'}); 
            } 
        });
    });
</script>
</body>
</html>
