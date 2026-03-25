<ul class="chat-box">
    @forelse ($messages as $message)
        @php
            $isAdmin = $message->sender_id === $adminId;
            $senderUser = \App\Models\User::find($message->sender_id);

            $avatar = $senderUser && $senderUser->avatar
                ? config('app.front_url', 'https://nanolympiad.org') . '/storage/' . $senderUser->avatar
                : asset('/img/avatar.png');

            $name = $senderUser
                ? trim(($senderUser->fname ?? '') . ' ' . ($senderUser->lname ?? ''))
                : 'Unknown';

            $time = \Carbon\Carbon::parse($message->created_at)->format('H:i');

            // Fetch replies for this message
            $replies = DB::table('message_replies')
                ->where('message_id', $message->id)
                ->orderBy('created_at')
                ->get();
        @endphp

        {{-- Main message --}}
        <li class="chat-{{ $isAdmin ? 'right' : 'left' }}">
            @if (!$isAdmin)
                <div class="chat-avatar">
                    <img src="{{ $avatar }}" alt="{{ $name }}">
                    <div class="chat-name">{{ $name }}</div>
                </div>
            @endif

            <div class="chat-text">
                <p>{!! nl2br(e($message->body ?? $message->message)) !!}</p>
                <div class="chat-hour">{{ $time }} <span class="icon-done_all"></span></div>
            </div>

            @if ($isAdmin)
                <div class="chat-avatar">
                    <img src="{{ $avatar }}" alt="{{ $name }}">
                    <div class="chat-name">{{ $name }}</div>
                </div>
            @endif
        </li>

        {{-- Replies under message --}}
        @foreach ($replies as $reply)
            @php
                $replyUser = \App\Models\User::find($reply->sender_id);
                $fullName = trim($user->fname . ' ' . $user->lname);
                $avatar = $user->avatar
                       ? config('app.front_url', 'https://nanolympiad.org') . '/storage/' . $user->avatar
                       : asset('/img/avatar.png');
                $lastLogin = $user->last_login;
                $replyTime = \Carbon\Carbon::parse($reply->created_at)->format('H:i');
            @endphp

            <li class="chat-right ms-5" style="text-align: right;">
                <div class="active-user-info d-flex align-items-center justify-content-end mb-1">
                    <div class="avatar-info me-2 text-end">
                        <h5 class="mb-0">{{ $fullName ?: 'Unknown User' }}</h5>
                        <small class="text-muted">{{ $replyTime }}</small>
                    </div>
                    <img src="{{ $avatar }}" class="avatar rounded-circle" alt="avatar" style="width: 40px; height: 40px; object-fit: cover;" />
                </div>

                <div class="chat-text bg-light border rounded px-3 py-2 d-inline-block" style="max-width: 70%; margin-left: auto;">
                    <p class="mb-0">{!! nl2br(e($reply->reply)) !!}</p>
                </div>
            </li>
        @endforeach



    @empty
        <li class="text-center text-muted">No messages found.</li>
    @endforelse
</ul>
