<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="This theory that can be considered as the Theory Of Everything describes the model of the behavior of the entire Universe. According to the theory, there are two fundamental elements that process by the rules of Newtonian physics. The interaction of the two fundamental elements creates all physical phenomena. The operation of the system is simple, unified and independent of the energy and size range of system.">

    <link href="{{ asset('css/text_layer_builder.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script type="module" src="{{ asset('js/ui_utils.js') }}"></script>
    <script type="module" src="{{ asset('js/text_layer_builder.js') }}"></script>
    <script src="{{ asset('pdfjs/pdf.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?v=18" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.min.js" integrity="sha512-g4FwCPWM/fZB1Eie86ZwKjOP+yBIxSBM/b2gQAiSVqCgkyvZ0XxYPDEcN2qqaKKEvK6a05+IPL1raO96RrhYDQ==" crossorigin="anonymous"></script>

    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <script defer src="{{ asset('js/all.js') }}"></script>
</head>
<body style="background-image: url('{{url('storage/bg-img.jpg')}}');">
    <div id="app">
        @include('nav')



        <main class="">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success')}}
                </div>
            @endif

            @if(session()->get('error'))
                <div class="alert alert-error">
                    {{ session()->get('error')}}
                </div>
            @endif

            @yield('content')
        </main>
        @include('footer')

        @include('cookieConsent::index')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(window).on('load', function() {
            $("#pp_redir").on('click', function(e) {
                l('donate', $(this));
            });
            $("#forum_redir").on('click', function(e) {
                l('forum', $(this));
            });
        });

        function l(p, s) {
            $.ajax({
                url: `/api/lead_audit`,
                method: 'get',
                data: {
                    page: p
                },
                success: function(data) {

                }
            });
        }
    </script>
</body>
</html>
