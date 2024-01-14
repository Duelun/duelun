@extends('app')

@section('content')
<div class="container admin">
@include('admin_nav')

    <aside class="">
        <h2>Create post</h2>
        <div>
            <a href="{{ route('posts.index')}}" class=""><button class="btn">Back</button></a>
        </div> 

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif

        <form method="post" action="{{ route('posts.store') }}">
            @csrf
            <div class="form-group">    
                <label for="content">Content:</label>
                <input type="text" class="form-control" name="content"/>
            </div>

            <div class="form-group">
                <label for="release_on">Release on:</label>
                <input type="date" class="form-control" name="release_on"/>
            </div>

            <button type="submit" class="btn btn-primary-outline">Add post</button>
        </form>
    </aside>
</div>
@endsection
