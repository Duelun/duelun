@extends('app')

@section('content')
<div class="container admin">

@include('admin_nav')

<aside class="">
    <h2>Settings</h2>

    <form method="post" action="{{ route('settings.save') }}">
        @csrf
        <div class="form-group">    
            <label for="supporters_shown">Supporters shown:</label>
            <input type="number" class="form-control" name="supporters_shown" value="{{$settings->supporters_shown}}"/>
        </div>

        <div class="form-group">
            <label for="latest_shown">Latest shown:</label>
            <input type="number" class="form-control" name="latest_shown" value="{{$settings->latest_shown}}"/>
        </div>

        <button type="submit" class="btn btn-primary-outline">Save changes</button>
    </form>
</aside>
</div>
@endsection
