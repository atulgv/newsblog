@extends('pages.adminlayout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/data.css') }}">
@endpush
@section('admin-content')
    <div class="admin-main">
        <div class="admin-navbar">
            <div class="admin-navbar-title">Users</div>
            <div class="admin-navbar-search">
                <form action="{{url('/')}}/admin/search-person">
                    <select name="search-item" id="search-item">
                        <option value="" selected disabled>Select one</option>
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                    </select>
                    <input type="search" name="search" placeholder="Search users...">
                </form>
            </div>
            <a class="admin-navbar-button" href="{{url('/')}}/admin/show-new-person">New User</a>
        </div>
        <table class="admin-table">
            <tr>
                <th>id</th>
                <th>Name </th>
                <th>email</th>
                <th>role</th>
                <th>status</th>
                <th>Action</th>
            </tr>

            @if ($persons == null)
                {{'no data found'}}
            @else
            @foreach ($persons as $person)
            <tr>
                <td>{{ $person['person_id'] }}</td>
                <td>{{ $person['name'] }}</td>
                <td>{{ $person['email'] }}</td>
                <td>{{ $person['role'] }}</td>
                <td>
                    @if ($person['status'] == true)
                    <div class="greenstatus">online</div>
                    @else
                    <div class="redstatus">offline</div>
                    @endif
                </td>
                <td>
                    <form action="{{url('/')}}/admin/show-edit-person/{{$person['person_id']}}">
                        <button>Edit</button>
                    </form>
                    <form action="{{url('/')}}/admin/delete-person/{{$person['person_id']}}" method="post">
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
