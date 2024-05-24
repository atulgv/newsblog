@extends('pages.adminlayout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush
@section('admin-content')
<div class="section">
    <form
        @if ($title['button'] == 'Create')
            action="{{url('/')}}/admin/new-person" method="post"
        @else
            action="{{url('/')}}/admin/edit-person/{{$person[0]['person_id']}}" method="post"
        @endif
     class="form">
        @csrf

        <table class="form-section">
            <tr>
                <th colspan="2">
                    <h2>{{$title['title']}}</h2>
                </th>
            </tr>
            <tr>
                <th>
                    <label for="name">Name :</label>
                </th>
                <td>
                    <input type="text" id="name" name="name" placeholder="enter name" value="@if (!empty($person)) {{$person[0]['name']}} @endif">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="email">Email :</label>
                </th>
                <td>
                    <input type="email" id="email" name="email" placeholder="enter email" value="@if (!empty($person)) {{$person[0]['email']}} @endif">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="password">Password :</label>
                </th>
                <td>
                    <input type="password" id="password" name="password" placeholder="enter password" value="@if (!empty($person)) {{$person[0]['password']}} @endif">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="role">Role :</label>
                </th>
                <td>
                    <select name="role" id="role">
                        <option value="select role" selected disabled>Select role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">{{$title['button']}}</button>
                </td>
            </tr>
        </table>

        <div class="login-image">
            <img src="{{ asset('images/2.jpg') }}" alt="">
        </div>
    </form>
    @error('name')
        <div class="register-error1">
            <p>{{ $message }}</p>
        </div>
    @enderror
    @error('email')
        <div class="register-error2">
            <p>{{ $message }}</p>
        </div>
    @enderror
    @error('password')
        <div class="register-error3">
            <p>{{ $message }}</p>
        </div>
    @enderror
    @error('role')
        <div class="register-error4">
            <p>{{ $message }}</p>
        </div>
    @enderror
</div>
@endsection

@section('title')
Sign Up
@endsection
