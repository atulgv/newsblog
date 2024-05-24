@extends('pages.adminlayout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/data.css') }}">
@endpush
@section('admin-content')
    <div class="admin-main">
        <div class="admin-navbar">
            <div class="admin-navbar-title">Comments</div>
            <div class="admin-navbar-search">
                <form action="">
                    <input type="search" name="search" placeholder="Search Comments...">
                </form>
            </div>
        </div>
        <table class="admin-table">
            <tr>
                <th>id</th>
                <th>content </th>
                <th>person</th>
                <th>post</th>
                <th>Action</th>
            </tr>

            @if ($comments == null)
                {{'no data found'}}
            @else
            @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment['comment_id'] }}</td>
                <td>{{ $comment['content'] }}</td>
                <td>{{ $comment['person']['name'] }}</td>
                <td>{{ $comment['post']['title'] }}</td>
                <td>
                    <form action="{{url('/')}}/admin/delete-comment/{{$comment['comment_id']}}" method="post">
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
