@extends('app')

@section('content')
<div class="container side">
    <div class="pane">
        <section>
            <h1>Documents</h1>

            <p class="text">You can find and access my work by clicking below. They are constantly updated and amanded.</p>
            <p class="text">The first two letters of the document title indicate the language of the document. The 'short' version is a two-page summary of the hypothesis.</p>
            <p class="text">If you think you found an error in one of the documents or you think the translation in one of the languages is incorrect, please let me know by <a href="{{url('/contact')}}">contacting me</a>.</p>
        </section>

        <section>

            @foreach($files['deu'] as $index => $file )
                <div class="file">
                    <a href="{{ url('/document/deu/'.$file) }}">{{$file}}</a>
                </div>
            @endforeach
        </section>

        <section>
            <h1>Other Publications</h1>

            <p class="text">In this section you can find my other work that is relevant to the base Duel Element Universe hypothesis.</p>
        </section>
        <section>
            @forelse($files['other'] as $index => $file )
                <div class="file">
                    <a href="{{ url('/document/other/'.$file) }}">{{$file}}</a>
                </div>
            @empty
                <p class="text">There is no publications yet.</p>
            @endforelse
        </section>
    </div>
    <div class="pane">
        @include('supporters')
    </div>


</div>
@endsection
