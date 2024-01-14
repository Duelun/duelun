@extends('app')

@section('content')

<div class="container reader">

    <div class="pane">
        <h2>Table of Contents</h2>

        <div class="toc-container">
            @unless(empty($file['contents']))
                @foreach($file['contents'] as $header)
                <div class="toc-row level-{{$header->header_level}}">
                    @if($header->header_level == 3)
                        <p class="toc-header">{{ $header->header }} </p>
                    @else 
                        <p class="toc-header" data-page='{{$header->page}}'>{{ $header->header }} </p>
                        <div class="dots"></div>
                        <span class="toc-page_num">{{$header->page}}</span>
                    @endif
                </div>
                @endforeach
            @endunless
        </div>
    </div>

    <div class="pane">
        <div class="controllers top">
            <button class="prev"><i class="fas fa-chevron-left"></i></button>
            <div class="page-control">
                <div class="page-counter">
                    <span><input type="text" class="page_num" maxlength="4" size="4"></span> / <span class="page_count"></span></span>
                </div>
                <button class="go">Go</button>
            </div>
            <button class="next"><i class="fas fa-chevron-right"></i></button>
        </div>

        <div class="loader">Loading...</div>

        <div class="reader-wrapper">
            
            <canvas id="the-canvas"></canvas>
            
        </div>

        <div class="controllers bottom">
            <button class="prev"><i class="fas fa-chevron-left"></i></button>
            <div class="page-control">
                <div class="page-counter">
                    <span><input type="text" class="page_num" maxlength="4" size="4"></span> / <span class="page_count"></span></span>
                </div>
                <button class="go">Go</button>
            </div>
            <button class="next"><i class="fas fa-chevron-right"></i></button>
        </div>

    </div>
    
    
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';
    var url = '{{$file["path"]}}';
    const file_name = '{{$file["name"]}}';
    
</script>
<script type="module" src="{{ asset('js/app.js') }}" defer></script>
<script>
    function sendToBeacon() {
        $.ajax({
            url: '/api/beacon',
            method: 'get',
            success: function(data) {
                
            }
        });
    }

    $(window).on('load', function() {
        setInterval(sendToBeacon, 60000);
    });
</script>