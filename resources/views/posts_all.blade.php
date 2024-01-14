@extends('app')

@section('content')
<div class="container admin">
    @include('admin_nav')
    
    <aside class="">
        <h2>Posts</h2>
        <div>
            <a href="{{ route('posts.create')}}" class=""><button class="btn">New post</button></a>
        </div>  

        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Content</td>
                    <td>Release on</td>
                    <td>Created</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @foreach($posts as $post) 
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->content}}</td>
                    <td>{{$post->release_on}}</td>
                    <td>{{$post->created_at}}</td>
                    <td><a href="{{route('posts.edit', $post->id)}}"><button class="btn">Edit</button></a></td>
                    <td><form action="{{ route('posts.destroy', $post->id)}}" method="post">
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
