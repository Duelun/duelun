@extends('app')

@section('content')
<div class="container admin">
@include('admin_nav')

    <aside class="">
        <h2>Add supporter</h2>
        <div>
            <a href="{{ route('supporters.index')}}" class=""><button class="btn">Back</button></a>
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

        <form method="post" action="{{ route('supporters.store') }}">
            @csrf
            <div class="form-group">    
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name"/>
            </div>

            <div class="form-group">
                <label for="details">Details:</label>
                <input type="text" class="form-control" name="details"/>
            </div>

            <button type="submit" class="btn btn-primary-outline">Add supporter</button>
        </form>
    </aside>
</div>
@endsection
