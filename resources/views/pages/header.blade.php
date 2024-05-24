<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapid News - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @stack('style')
</head>
<body>
    <header>
        <div class="navbar">
            <div class="navbar-title">
                <a href="{{url('/')}}"><h1>
                    <div class="title-letter">R</div>
                    <div class="title-word">apid</div>
                    <div class="title-letter">N</div>
                    <div class="title-word">ews</div></h1>
                </a>
            </div>
            <div class="navbar-search">
                <form action="{{url('/')}}/search">
                    <select name="search-item" id="search-item">
                        <option value="" selected disabled>Select one</option>
                        <option value="title">Title</option>
                        <option value="description">Description</option>
                    </select>
                    <input type="search" name="search" placeholder="Search Rapid News...">
                </form>
            </div>
            <div class="navbar-login">
                @if (!session()->get('name'))
                <a href="{{url('/')}}/login">
                    <i class="fa-regular fa-user"></i>
                    <div>Sign In</div>
                </a>
                @else
                <a href="{{url('/')}}/destroy-session">
                    <i class="fa-regular fa-user"></i>
                    <div>Log Out</div>
                </a>
                @endif
            </div>
        </div>
