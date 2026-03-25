<div class="table-container p-3">
    <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
        <table class="table table-hover table-bordered table-striped text-nowrap w-100">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Telegram Phone</th>
                <th>Username</th>
                <th>Email</th>
{{--                <th>Rating</th>--}}
{{--                <th>Message</th>--}}
                <th>Photo</th>
                <th>ID Document</th>
                <th>Folder</th>
                <th>IP Address</th>
{{--                <th>User Agent</th>--}}
                <th>Referer</th>
                <th>Locale</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($submissions as $submission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $submission->user_id ?? 'guest' }}
                    </td>
                    <td>{{ $submission->telegram_phone }}</td>
                    <td>{{ $submission->telegram_username ?? '—' }}</td>
                    <td>{{ $submission->email }}</td>
{{--                    <td>--}}
{{--                        @if($submission->number_rating)--}}
{{--                            <span class="badge badge-primary">{{ $submission->number_rating }}/10</span>--}}
{{--                        @else--}}
{{--                            <span class="badge badge-secondary">N/A</span>--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                    <td style="max-width: 200px;">--}}
{{--                        @if($submission->message)--}}
{{--                            <div style="white-space: normal;">{{ Str::limit($submission->message, 100) }}</div>--}}
{{--                        @else--}}
{{--                            <span class="text-muted">—</span>--}}
{{--                        @endif--}}
{{--                    </td>--}}
                    <td>
                        @if($submission->personal_photo_path)
                            <a href="{{ env('SECONDARY_URL_FRONT') . '/private-survey-images/' . $submission->folder_name . '/avatar/' . basename($submission->personal_photo_path) }}" target="_blank">
                                <img src="{{ env('SECONDARY_URL_FRONT') . '/private-survey-images/' . $submission->folder_name . '/avatar/' . basename($submission->personal_photo_path) }}" alt="Photo" width="40" height="40" class="rounded">
                            </a>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($submission->identification_document_path)
                            <a href="{{ env('SECONDARY_URL_FRONT') . '/private-survey-images/' . $submission->folder_name . '/id/' . basename($submission->identification_document_path) }}" class="btn btn-sm btn-outline-secondary" target="_blank">View</a>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>{{ $submission->folder_name }}</td>
                    <td><code class="d-block">{{ $submission->ip_address }}</code></td>
{{--                    <td style="max-width: 250px;">--}}
{{--                        <small class="d-block text-muted">{{ $submission->user_agent }}</small>--}}
{{--                    </td>--}}
                    <td>{{ $submission->referer ?? '—' }}</td>
                    <td>{{ $submission->locale ?? '—' }}</td>
                    <td>{{ $submission->created_at ? $submission->created_at->format('Y-m-d H:i') : '—' }}</td>
                    <td>{{ $submission->updated_at ? $submission->updated_at->format('Y-m-d H:i') : '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="16" class="text-center text-muted">No submissions found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
