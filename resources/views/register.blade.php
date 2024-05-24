@extends('pages.layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush
@section('content')
<div class="section">
    <form action="{{url('/')}}/register" method="post" class="form">
        @csrf

        <table class="form-section">
            <tr>
                <th colspan="2">
                    <h2>Sign Up</h2>
                </th>
            </tr>
            <tr>
                <th>
                    <label for="name">Name :</label>
                </th>
                <td>
                    <input type="text" id="name" name="name" placeholder="enter name">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="email">Email :</label>
                </th>
                <td>
                    <input type="email" id="email" name="email" placeholder="enter email">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="password">Password :</label>
                </th>
                <td>
                    <input type="password" id="password" name="password" placeholder="enter password">
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{url('/')}}/login">Login</a>
                </td>
                <td>
                    <button type="submit">Sign Up</button>
                </td>
            </tr>
        </table>

        <div class="login-image">
            <img src="{{ asset('images/3.jpg') }}" alt="">
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
</div>
@endsection

@section('title')
Sign Up
@endsection
