<div class="panel">
    <div class="panel-categories">
        <ul>
            @foreach ($categories as $category)
            <li><a href="{{url('/')}}/category/{{$category['category_id']}}">{{ $category['name'] }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="panel-hi-section">
        <div class="panel-hi">
            <div>Hi</div>
            @if (session()->get('role') == 'admin')
            <div>admin</div>
            @elseif (session()->get('role') == 'user')
            <div>user</div>
            @else
            <div>Guest</div>
            @endif
        </div>

        @if (session()->get('role') == 'admin')
        <a class="panel-home" href="{{url('/')}}/admin/persons-data">
            <i class="fa-solid fa-house"></i>
        </a>
        @elseif (session()->get('role') == 'user')
        <a class="panel-home" href="{{url('/')}}/user/show-my-data">
            <i class="fa-solid fa-house"></i>
        </a>
        @endif
    </div>
</div>
</header>
