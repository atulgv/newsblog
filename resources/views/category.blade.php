@extends('pages.layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush
@section('content')
    <div class="main">
        <div class="post-section">
            @if ($category == null)
                {{'No posts found'}}
            @else
            <div class="number-of-posts">
                <div class="category-number">{{ $category[0]['name'] }} - </div>
                <div>&nbsp;{{ count($category[0]['post']) }}</div>
                <div>&nbsp;posts</div>
            </div>
            @foreach ($category[0]['post'] as $post)
            <div class="main-card">
                <div class="card-image">
                    <img src="{{ asset($post['image']) }}" alt="">
                </div>
                <div class="card-body">
                    <div class="card-title">{{ $post['title'] }}</div>
                    <div class="card-tags">
                        <div><i class="fa-regular fa-user"></i><span>admin</span></div>
                        <div><i class="fa-solid fa-tag"></i><span>{{ $category[0]['name'] }}</span></div>
                        <div><i class="fa-solid fa-calendar-days"></i><span>{{ $post['date'] }}</span></div>
                    </div>
                    <div class="card-description">
                        {{ $post['description'] }}
                    </div>
                    <a class="card-button" href="{{url('/')}}/post/{{$post['post_id']}}">See more</a>
                </div>
            </div>
            @endforeach
            @endif

        </div>
        @include('pages.sidebar')
    </div>

@endsection

@section('title')
    Category
@endsection
