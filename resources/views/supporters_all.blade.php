@extends('app')

@section('content')
<div class="container admin">
    @include('admin_nav')
    
    <aside class="">
        <h2>Supporters</h2>
        <div>
            <a href="{{ route('supporters.create')}}" class=""><button class="btn">New supporter</button></a>
        </div>  

        <table class="table">
            <thead>
                <tr>
                    <td>Order</td>
                    <td>Name</td>
                    <td>Details</td>
                    <td>Created</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @foreach($supporters as $supporter) 
                <tr>
                    <td>{{$supporter->sort_order}}</td>
                    <td>{{$supporter->name}}</td>
                    <td>{{$supporter->details}}</td>
                    <td>{{$supporter->created_at}}</td>
                    <td>
                        @if(!$supporter->is_first)
                        <form action="{{ route('supporters.moveUp', $supporter->id)}}" method="post">
                            @csrf
                            @method('POST')
                            <button class="btn small" type="submit"><i class="fas fa-arrow-up"></i></button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if(!$supporter->is_last)
                        <form action="{{ route('supporters.moveDown', $supporter->id)}}" method="post">
                            @csrf
                            @method('POST')
                            <button class="btn small" type="submit"><i class="fas fa-arrow-down"></i></button>
                            </form>
                        @endif
                    </td>
                    <td><a href="{{route('supporters.edit', $supporter->id)}}"><button class="btn">Edit</button></a></td>
                    <td><form action="{{ route('supporters.destroy', $supporter->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </aside>
</div>
@endsection
