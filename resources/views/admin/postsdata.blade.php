@extends('pages.adminlayout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/data.css') }}">
@endpush
@section('admin-content')
    <div class="admin-main">
        <div class="admin-navbar">
            <div class="admin-navbar-title">Posts</div>
            <div class="admin-navbar-search">
                <form action="">
                    <select name="search-item" id="search-item">
                        <option value="" selected disabled>Select one</option>
                        <option value="title">Title</option>
                        <option value="description">Description</option>
                    </select>
                    <input type="search" name="search" placeholder="Search users...">
                </form>
            </div>
            <a class="admin-navbar-button" href="{{url('/')}}/admin/show-new-post">New Post</a>
        </div>
        <table class="admin-table">
            <tr>
                <th>id</th>
                <th>title</th>
                <th>slug</th>
                <th>description</th>
                <th>image</th>
                <th>person</th>
                <th>category</th>
                <th>Action</th>
            </tr>
            @if ($posts == null)
                {{'no data found'}}
            @else
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post['post_id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['slug'] }}</td>
                <td>{{ $post['description'] }}</td>
                <td>{{ $post['image'] }}</td>
                <td>{{ $post['person']['name'] }}</td>
                <td>{{ $post['category']['name'] }}</td>
                <td>
                    <form action="{{url('/')}}/admin/show-edit-post/{{$post['post_id']}}">
                        <button>Edit</button>
                    </form>
                    <form action="{{url('/')}}/admin/delete-post/{{$post['post_id']}}" method="post">
                        @csrf
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>
@endsection

@section('title')
    Admin
@endsection
