@php
                $fullName = trim($user->fname . ' ' . $user->lname);
                $avatar = $user->avatar
                   ? config('app.front_url', 'https://nanolympiad.org') . '/storage/' . $user->avatar
                   : asset('/img/avatar.png');
                $lastLogin = $user->last_login;
@endphp
<div class="active-user-info">
    <img src="{{ $avatar }}" class="avatar" alt="avatar" />
    <div class="avatar-info">
        <h5>{{ $fullName ?: 'Unknown User' }}</h5>
        <div class="typing"></div>
    </div>
</div>
<div class="chat-actions">
{{--    <a href="#" data-toggle="modal" data-target="#videoCall">--}}
{{--        <i class="icon-video"></i>--}}
{{--    </a>--}}
{{--    <a href="#" data-toggle="modal" data-target="#audioCall">--}}
{{--        <i class="icon-phone1"></i>--}}
{{--    </a>--}}
</div>