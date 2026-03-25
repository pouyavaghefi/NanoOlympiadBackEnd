@if (!empty($files))
    <div class="card-body border-top">
        <h6 class="mb-3"><i class="fa fa-folder-open me-2"></i> &nbsp;User Files</h6>

        <a href="{{ url('/site/users/internal-download-zip/' . $user->id) }}"
           class="btn btn-success mb-4 btn-block btn-lg border-0 shadow-lg rounded-3"
           style="background-color: #28a745; color: #fff; font-weight: bold; font-size: 1.2rem;">
            <i class="fa fa-file-archive"></i> Download All Files as ZIP
        </a>


        <a href="{{ url('/site/users/internal-delete-all-files/' . $user->id) }}"
           class="btn btn-danger mb-4 btn-block btn-lg border-0 shadow-lg rounded-3"
           style="background-color: #dc3545; color: #fff; font-weight: bold; font-size: 1.2rem;"
           onclick="return confirm('Are you sure you want to delete all files?')">
            <i class="fa fa-trash"></i> Delete All Files
        </a>
        <div class="table-responsive">
            <small class="text-muted mb-2 d-block" style="text-align: left">
                If none of the uploaded passport files are checked, the user will be notified
            </small>
            <table class="table table-hover align-middle text-nowrap">
                <thead class="table-light">
                <tr>
                    <th><i class="fa fa-check-circle"></i> Verified</th>
                    <th><i class="fa fa-file-alt"></i> File Name</th>
                    <th><i class="fa fa-weight"></i> Size</th>
                    <th><i class="fa fa-clock"></i> Last Modified</th>
                    <th><i class="fa fa-cog"></i> Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($files as $file)
                    @if($user->member() !== null)
                    <tr>
                        <td>
                            <input type="checkbox"
                                   class="passport-verify-checkbox"
                                   data-user-id="{{ $user->id }}"
                                   data-file-name="{{ $file['name'] }}"
                                    {{ ($user->member()->passport_verified == 1 && $file['name'] == basename($user->member()->passport_photo)) ? 'checked' : '' }}>
                        </td>
                        <td>
                            <i class="fa fa-file text-secondary me-1"></i> {{ $file['name'] }}
                        </td>
                        <td>
                            <span class="badge bg-info text-white" style="">{{ formatBytes($file['size']) }}</span>
                        </td>
                        <td>
                            <small class="text-muted">{{ $file['modified'] }}</small>
                        </td>
                        <td class="text-nowrap">
                            {{-- Rename --}}
                            <button class="btn btn-sm btn-primary d-inline-block"
                                    data-bs-toggle="modal"
                                    data-bs-target="#renameModal"
                                    data-filename="{{ $file['name'] }}"
                                    data-userid="{{ $user->id }}"
                                    title="Edit File">
                                <i class="fa fa-edit"></i> Rename
                            </button>

                            {{-- Restore --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-warning restore-btn"
                                    data-user-id="{{ $user->id }}"
                                    data-file-name="{{ $file['name'] }}"
                                    style="display: none"
                                    title="Restore File">
                                <i class="fa fa-undo"></i> Restore
                            </button>

                            {{-- Move --}}
                            <button class="btn btn-sm btn-outline-warning d-inline-block"
                                    data-bs-toggle="modal"
                                    data-bs-target="#moveFileModal"
                                    data-user-id="{{ $user->id }}"
                                    data-file-name="{{ $file['name'] }}"
                                    title="Move File">
                                <i class="fa fa-arrow-right"></i> Move
                            </button>

                            {{-- History --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-dark history-btn"
                                    data-user-id="{{ $user->id }}"
                                    data-file-name="{{ $file['name'] }}"
                                    title="File History">
                                <i class="fa fa-history"></i> History
                            </button>

                            {{-- Metadata --}}
                            <a href="#" class="btn btn-sm btn-outline-dark d-inline-block" title="File Metadata">
                                <i class="fa fa-info-circle"></i> Metadata
                            </a>

                            {{-- Download --}}
                            <a href="#"
                               class="btn btn-sm btn-outline-primary d-inline-block"
                               title="Download File"
                               onclick="generateAndDownload('{{ $user->id }}', '{{ $file['name'] }}'); return false;">
                                <i class="fa fa-download"></i> Download
                            </a>

                            <script>
                                const FRONT_URL = @json($frontUrl);

                                function generateAndDownload(userId, fileName) {
                                    fetch(`${FRONT_URL}/api/user-files/generate-token/for-file-preview?user_id=${userId}&file_name=${encodeURIComponent(fileName)}`)
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.url) {
                                                // Change preview URL to download URL:
                                                const downloadUrl = data.url.replace('/preview/', '/download/');
                                                const link = document.createElement('a');
                                                link.href = downloadUrl;
                                                link.download = fileName;
                                                document.body.appendChild(link);
                                                link.click();
                                                document.body.removeChild(link);
                                            } else {
                                                alert('Failed to generate download URL.');
                                            }
                                        })
                                        .catch(() => alert('Could not generate download link.'));
                                }

                            </script>


                            {{-- PDF Download --}}
                            <a href="#" class="btn btn-sm btn-outline-success d-inline-block" title="Download as PDF">
                                <i class="fa fa-file-pdf"></i> PDF
                            </a>

                            {{-- Tags --}}
                            <button class="btn btn-sm btn-outline-info d-inline-block"
                                    data-bs-toggle="modal"
                                    data-bs-target="#tagModal"
                                    title="Add Tags">
                                <i class="fa fa-tags"></i> Tags
                            </button>

                            {{-- Convert --}}
                            <a href="#"
                               class="btn btn-sm btn-outline-info d-inline-block"
                               title="Convert File"
                               onclick="generateAndConvert('{{ $user->id }}', '{{ $file['name'] }}'); return false;">
                                <i class="fa fa-exchange-alt"></i> Convert
                            </a>

                            <script>
                                function generateAndConvert(userId, fileName) {
                                    fetch(`${FRONT_URL}/api/user-files/generate-token/for-file-convert?user_id=${userId}&file_name=${encodeURIComponent(fileName)}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.url) {
                                                // Redirect to the conversion URL or open it in new tab
                                                window.location.href = data.url;
                                                // OR
                                                // window.open(data.url, '_blank');
                                            } else {
                                                alert('Failed to generate convert link.');
                                            }
                                        })
                                        .catch(err => {
                                            console.error(err);
                                            alert('Error while generating convert link.');
                                        });
                                }
                            </script>
                            {{-- Preview --}}
                            <button
                                    class="btn btn-sm btn-outline-secondary d-inline-block"
                                    onclick="generateAndOpenPreview('{{ $user->id }}', '{{ $file['name'] }}')"
                                    title="Preview File">
                                <i class="fa fa-eye"></i> Preview
                            </button>

                            <script>
                                function generateAndOpenPreview(userId, fileName) {
                                    fetch(`${FRONT_URL}/api/user-files/generate-token/for-file-preview?user_id=${userId}&file_name=${encodeURIComponent(fileName)}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            if(data.url){
                                                window.open(data.url, '_blank');  // open preview URL in a new tab
                                            } else {
                                                alert('Failed to generate preview URL.');
                                            }
                                        })
                                        .catch(() => alert('Could not generate preview.'));
                                }
                            </script>

                            {{-- Delete --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-danger delete-btn"
                                    data-user-id="{{ $user->id }}"
                                    data-file-name="{{ $file['name'] }}"
                                    title="Delete File">
                                <i class="fa fa-trash"></i> Delete
                            </button>


                            {{-- Share --}}
                            <a href="#"
                               class="btn btn-sm btn-primary d-inline-block"
                               title="Share File"
                               onclick="generateAndCopyLink('{{ $user->id }}', '{{ $file['name'] }}'); return false;">
                                <i class="fa fa-share-alt"></i> Share
                            </a>

                            <script>
                                function generateAndCopyLink(userId, fileName) {
                                    fetch(`${FRONT_URL}/api/user-files/generate-token/for-file-preview?user_id=${userId}&file_name=${encodeURIComponent(fileName)}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            if(data.url){
                                                navigator.clipboard.writeText(data.url).then(() => {
                                                    alert('Preview link copied to clipboard!');
                                                }).catch(() => {
                                                    alert('Failed to copy the link.');
                                                });
                                            } else {
                                                alert('Failed to generate preview URL.');
                                            }
                                        })
                                        .catch(() => alert('Could not generate preview.'));
                                }
                            </script>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <hr>
            <table class="table table-striped align-middle text-nowrap">
                <thead class="table-light">
                <tr>
                    <th><i class="fa fa-key"></i> Token</th>
                    <th><i class="fa fa-clock"></i> Expires At</th>
                    <th><i class="fa fa-hourglass-end"></i> UNIX Expiry</th>
                    <th><i class="fa fa-cogs"></i> Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($user_access_tokens as $token)
                    <tr>
                        <td class="text-monospace">{{ $token->token }}</td>
                        <td>{{ \Carbon\Carbon::parse($token->expires_at)->format('Y-m-d H:i') }}</td>
                        <td>{{ $token->unix_expiry_timestamp ?? '-' }}</td>
                        <td>
                            <form method="POST" action="#">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger me-1" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                            <form method="POST" action="#" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning" title="Regenerate">
                                    <i class="fa fa-sync"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr>

            @php
                $commentCount = $course_comments->count();
                $registrationCount = $course_registrations->count();
            @endphp

            @if ($commentCount > 0 || $registrationCount > 0)
                <div class="alert alert-info d-flex align-items-center justify-content-between">
                                    <span>
                                        <i class="fa fa-bell me-1"></i>
                                        This user has
                                        @if ($commentCount > 0)
                                            <strong>{{ $commentCount }}</strong> comment{{ $commentCount > 1 ? 's' : '' }}
                                        @endif
                                        @if ($commentCount > 0 && $registrationCount > 0)
                                            and
                                        @endif
                                        @if ($registrationCount > 0)
                                            <strong>{{ $registrationCount }}</strong> course registration{{ $registrationCount > 1 ? 's' : '' }}
                                        @endif.
                                    </span>
                    <a href="" class="btn btn-sm btn-primary">
                        <i class="fa fa-eye"></i> View Details
                    </a>
                </div>
                <hr>
            @endif
        </div>
    </div>
@else
    <div class="alert alert-warning mx-3 mt-4 mb-0">No files uploaded for this user.</div>
@endif