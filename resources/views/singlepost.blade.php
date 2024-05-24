@extends('pages.layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/singlepost.css') }}">
@endpush
@section('content')
    <div class="main">
        <div class="single-post">
            <div class="single-post-section">
                <div class="single-post-image">
                    <img src="{{ asset($post[0]['image']) }}" alt="">
                </div>
                <div class="single-post-tags">
                    <div><i class="fa-regular fa-user"></i><span>{{ $post[0]['person']['name'] }}</span></div>
                    <div><i class="fa-solid fa-tag"></i><span>{{ $post[0]['category']['name'] }}</span></div>
                    <div><i class="fa-solid fa-calendar-days"></i><span>{{ $post[0]['date'] }}</span></div>
                </div>
                <div class="single-post-title">
                    {{ $post[0]['title'] }}
                </div>
                <div class="single-post-description">
                    {{ $post[0]['description'] }}
                </div>
            </div>
            <div class="comments-section">
                <div class="comment-section-title">Comments :</div>
                @if ($comment == null)

                @else
                @foreach ($comment as $item)
                <div class="comment-section-comments">
                    <div><span>{{ $item['person']['name'] }} says :</span></div>
                    <div class="main-comment">{{ $item['content'] }}</div>
                </div>
                @endforeach
                @endif

                <form action="{{url('/')}}/add-comment/{{$post[0]['post_id']}}" method="post" class="comment-section-form">
                    @csrf
                    <label for="comment">Enter comment :</label>
                    <textarea name="content" id="comment" rows="3"></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
        <div class="ad-section"></div>
    </div>

@endsection

@section('title')
    Home
@endsection
