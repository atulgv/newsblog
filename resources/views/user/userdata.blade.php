@extends('pages.layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush
@section('content')
    <div class="main">
        <div class="post-section">
            {{-- <div class="number-of-posts">
                <div>10</div>
                <div>posts</div>
            </div> --}}
            @if ($posts == null)
                {{ 'No posts found'}}
            @else
            <div class="number-of-posts">
                <div class="category-number">{{ $posts[0]['person']['name'] }} - </div>
                <div>&nbsp;{{ count($posts) }}</div>
                <div>&nbsp;posts</div>
            </div>
            @foreach ($posts as $post)
            <div class="main-card">
                <div class="card-image">
                    <img src="{{ asset($post['image']) }}" alt="">
                </div>
                <div class="card-body">
                    <div class="card-title">{{ $post['title'] }}</div>
                    <div class="card-tags">
                        <div><i class="fa-regular fa-user"></i><span>{{ $post['person']['name'] }}</span></div>
                        <div><i class="fa-solid fa-tag"></i><span>{{ $post['category']['name'] }}</span></div>
                        <div><i class="fa-solid fa-calendar-days"></i><span>12-08-2023</span></div>
                    </div>
                    <div class="card-description">
                        {{ $post['description'] }}
                    </div>
                    <div class="user-buttons">
                        <a class="card-button" href="{{url('/')}}/post/{{$post['post_id']}}">See more</a>
                        <a href="{{url('/')}}/user/show-edit-post/{{$post['post_id']}}" class="card-button">Edit</a>
                        <form class="user-form" action="{{url('/')}}/user/delete-post/{{$post['post_id']}}" method="post">
                            @csrf
                            <button>Delete</button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
            @endif

        </div>
        @include('pages.sidebar')
    </div>

@endsection

@section('title')
    Home
@endsection
