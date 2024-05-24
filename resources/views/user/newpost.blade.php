@extends('pages.layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/postform.css') }}">
@endpush
@section('content')
<div class="section">
    <form
        @if ($title['button'] == 'Create')
            action="{{url('/')}}/user/new-post" method="post"
        @else
            action="{{url('/')}}/user/edit-post/{{$post[0]['post_id']}}" method="post"
        @endif
     class="postform" enctype="multipart/form-data">
        @csrf

        <table class="form-section">
            <tr>
                <th colspan="2">
                    <h2>{{$title['title']}}</h2>
                </th>
            </tr>
            <tr>
                <th>
                    <label for="title">title :</label>
                </th>
                <td>
                    <input type="text" id="title" name="title" placeholder="enter title" value="@if ($post != null) {{$post[0]['title']}} @endif">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="description">Description :</label>
                </th>
                <td>
                    <textarea name="description" id="description" placeholder="enter description">@if ($post != null) {{$post[0]['description']}} @endif</textarea>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="image">Image :</label>
                </th>
                <td>
                    <input type="file" id="image" name="image">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="category">Category :</label>
                </th>
                <td>
                    <select name="category" id="category">
                        <option value="" selected disabled>Select category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category['category_id'] }}">{{ $category['name'] }}</option>
                        @endforeach

                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button>{{$title['button']}}</button>
                </td>
            </tr>
        </table>

        <div class="login-image">
            <img src="{{ asset('images/1.jpeg') }}" alt="">
        </div>
    </form>
    @error('title')
        <div class="register-error1">
            <p>{{ $message }}</p>
        </div>
    @enderror
    @error('description')
        <div class="register-error2">
            <p>{{ $message }}</p>
        </div>
    @enderror
    @error('image')
        <div class="register-error3">
            <p>{{ $message }}</p>
        </div>
    @enderror
    @error('category')
        <div class="register-error4">
            <p>{{ $message }}</p>
        </div>
    @enderror
</div>
@endsection

@section('title')
Create post
@endsection
