@extends('layouts.app')

@section('content')
    <a href="{{ route('posts.create') }} " type="button" class="btn btn-success mb-2">Create Post</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Posted by</th>
                <th scope="col">Created at</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user ? $post->user->name : 'user not found' }}</td>
                    <td>{{ $post->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class='btn btn-info'>View</a>
                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class='btn btn-primary'>Edit</a>
                        <form style="display:inline" method="POST"
                            action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                            @csrf
                            @method('DELETE')
                            <script>
                                function confirmDelete() {
                                    var confirmation = confirm("Are you sure you want to delete this Post?");
                                    if (confirmation) {
                                        // If user clicks "OK", proceed with delete action
                                        alert("Post deleted.");
                                        // add code to delete the item here
                                    } else {
                                        // If user clicks "Cancel", do nothing
                                        alert("Delete action canceled.");
                                    }
                                }
                            </script>
                            <button class='btn btn-danger' onclick="confirmDelete()">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
@endsection
