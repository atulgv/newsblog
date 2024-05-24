@extends('pages.adminlayout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush
@section('admin-content')
<div class="section">
    <form
        @if ($title['button'] == 'Create')
            action="{{url('/')}}/admin/new-category" method="post"
        @else
            action="{{url('/')}}/admin/edit-category/{{$category[0]['category_id']}}" method="post"
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
                    <input type="name" id="name" name="name" placeholder="enter name" value="@if ($category != null) {{$category[0]['name']}} @endif">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button>{{$title['button']}}</button>
                </td>
            </tr>
        </table>

        <div class="login-image">
            <img src="{{ asset('images/1.jpg') }}" alt="">
        </div>
    </form>
    @error('name')
        <div class="register-error1">
            <p>{{ $message }}</p>
        </div>
    @enderror

</div>
@endsection

@section('title')
Create category
@endsection
