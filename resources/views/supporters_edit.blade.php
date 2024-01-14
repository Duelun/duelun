@extends('app')

@section('content')
<div class="container admin">
@include('admin_nav')

<aside class="">
    <h2>Edit supporter</h2>
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

    <form method="post" action="{{ route('supporters.update', $supporter->id) }}">
          @method('PATCH')
          @csrf
          <div class="form-group">    
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name" value="{{$supporter->name}}"/>
          </div>

          <div class="form-group">
              <label for="details">Details:</label>
              <input type="text" class="form-control" name="details" value="{{$supporter->details}}"/>
          </div>

          <button type="submit" class="btn btn-primary-outline">Update supporter</button>
      </form>
</aside>
</div>
@endsection
