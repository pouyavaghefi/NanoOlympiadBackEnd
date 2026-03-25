@php
    $currentConversationId = (int) request()->segment(count(request()->segments()));
@endphp
<ul class="users list-unstyled p-0 m-0">
    @forelse ($conversations as $conversation)
        @php
            $messageRec = \Illuminate\Support\Facades\DB::table('message_recipient')->where('message_id', $conversation->id)->get();
            $userId = request()->segment(count(request()->segments()));

            $availableMsg = [];
            foreach ($messageRec as $rec) {
                if ($rec->user_id == $userId) {
                    $availableMsg[] = $rec;
                }
            }

            $isActive = $conversation->id === $currentConversationId;
            $fullName = trim($user->fname . ' ' . $user->lname);
            $lastCreated = $conversation->created_at;
        @endphp
        <li class="person mb-2 {{ $isActive ? 'active bg-primary text-white rounded' : '' }}" data-chat="user-{{ $user->id }}">
            <a href="{{ route('adm.site.users.conversations.custom', ['user' => $user->id, 'conversation' => $conversation->id]) }}"
               class="d-flex align-items-center p-2 rounded border transition {{ $isActive ? 'text-white' : 'hover:bg-light' }}">
                <div class="user me-3 position-relative d-flex justify-content-center align-items-center {{ $isActive ? 'bg-white text-primary' : 'bg-primary text-white' }} rounded-circle"
                     style="width: 45px; height: 45px;">
                    <i class="fas fa-comments fa-lg"></i>
                </div>
                <div class="name-time">
                    <div class="fw-bold" style="{{ $isActive ? 'color: white;' : '' }}">{{ $conversation->subject }}</div>
                    <div class="small" style="{{ $isActive ? 'color: rgba(255,255,255,0.8);' : 'color: #6c757d;' }}">{{ $lastCreated }}</div>
                </div>
            </a>
        </li>
    @empty
        <li class="text-muted text-center mt-3">No conversations found.</li>
    @endforelse
</ul>
