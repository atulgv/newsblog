<div class="sidebar">
    @if (session()->get('role') == 'user')
    <div class="sidebar-user-section">
        <div class="sidebar-user-section-title">
            Add new post
        </div>
        <a class="sidebar-user-section-button" href="{{url('/')}}/user/show-new-post">Create Post</a>
    </div>
    @endif
    <div class="latest-posts">
        Latest posts
    </div>
    @if ($sidebar == null)
        {{'no posts found'}}
    @else
    @foreach ($sidebar as $post)
    <div class="sidebar-card">
        <div class="sidebar-card-image">
            <img src="{{ asset($post['image']) }}" alt="">
        </div>
        <div class="sidebar-card-body">
            <div class="sidebar-card-title">{{ $post['title'] }}</div>
            <div class="sidebar-card-tags">
                <div><i class="fa-regular fa-user"></i><span>{{ $post['person']['name'] }}</span></div>
                <div><i class="fa-solid fa-tag"></i><span>{{ $post['category']['name'] }}</span></div>
                <div><i class="fa-solid fa-calendar-days"></i><span>{{ $post['date'] }}</span></div>
            </div>
            <a class="sidebar-card-button" href="{{url('/')}}/post/{{$post['post_id']}}">See more</a>
        </div>
    </div>
    @endforeach
    @endif
</div>
