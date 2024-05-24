@extends('pages.adminlayout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/data.css') }}">
@endpush
@section('admin-content')
    <div class="admin-main">
        <div class="admin-navbar">
            <div class="admin-navbar-title">Categories</div>
            <div class="admin-navbar-search">
                <form action="">
                    <input type="search" name="search" placeholder="Search Categories...">
                </form>
            </div>
            <a class="admin-navbar-button" href="{{url('/')}}/admin/show-new-category">New Category</a>
        </div>
        <table class="admin-table">
            <tr>
                <th>id</th>
                <th>Name </th>
                <th>Action</th>
            </tr>

            @if ($categories == null)
                {{'no data found'}}
            @else
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category['category_id'] }}</td>
                <td>{{ $category['name'] }}</td>
                <td>
                    <form action="{{url('/')}}/admin/show-edit-category/{{$category['category_id']}}">
                        <button>Edit</button>
                    </form>
                    <form action="{{url('/')}}/admin/delete-category/{{$category['category_id']}}" method="post">
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
