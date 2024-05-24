@extends('pages.layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush
@section('content')
<div class="section">
    <form action="{{url('/')}}/authenticate" method="post" class="form">
        @csrf

        <table class="form-section">
            <tr>
                <th colspan="2">
                    <h2>Login</h2>
                </th>
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
                    <a href="{{url('/')}}/signup">Sign Up</a>
                </td>
                <td>
                    <button type="submit">Login</button>
                </td>
            </tr>
        </table>


        <div class="login-image">
            <img src="{{ asset('images/4.jpg') }}" alt="">
        </div>
    </form>
    @error('email')
        <div class="login-error1">
            <p>{{ $message }}</p>
        </div>
    @enderror
    @error('password')
        <div class="login-error2">
            <p>{{ $message }}</p>
        </div>
    @enderror
    @if ($error != null)
        <div class="login-error1">
            <p>{{ $error }}</p>
        </div>
    @endif
</div>
@endsection

@section('title')
login
@endsection
