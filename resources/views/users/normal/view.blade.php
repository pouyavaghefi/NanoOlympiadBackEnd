@extends('layouts.master')

@section('title', 'View User')

@section('head-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icon.min.css" />
@endsection

@section('wrapper')
    @php
        $frontUrl = config('app.front_url') ?? 'https://ino-official.org';
    @endphp
    <!-- User Profile Row -->
    <div class="row gutters justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fa fa-user-circle me-2"></i> User Profile (User ID: {{ $user->id }})
                    </h5>
                    <div>
                        <a href="{{ route('adm.site.users.edit', $user->id) }}" class="btn btn-sm btn-light me-2">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('adm.site.users.sendMessage',$user->id) }}" class="btn btn-sm" style="
                                color: cyan;
                                border: 2px solid cyan;
                                background-color: transparent;
                                border-radius: 4px;
                                transition: background-color 0.3s, color 0.3s;
                            ">
                            <i class="fa fa-paper-plane"></i> Send New Message
                        </a>
                        @if ($user->hasMessages())
                            <a href="{{ route('adm.site.users.conversations', $user->id) }}" class="btn btn-sm" style="
                                    background-color: #f0f0f0;
                                    border: 1px solid #999;
                                    color: #333;
                                    border-radius: 4px;
                                    margin-left: 8px;
                                    transition: all 0.3s;
                                ">
                                <i class="fa fa-comments"></i> View Conversation
                            </a>
                        @endif

                        <style>
                            a.btn-sm:hover {
                                background-color: cyan;
                                color: #004d00; /* Darker green text for contrast */
                                text-decoration: none;
                            }
                        </style>
                    </div>
                </div>

                @include('users.normal.layouts.muted')

                <a href="{{ route('adm.site.users.downloadPdf', $user->id) }}"
                   class="btn btn-info mb-4 btn-block btn-lg border-0 shadow-lg rounded-3"
                   style="background-color: #17a2b8; color: #fff; font-weight: bold; font-size: 1.2rem;">
                    <i class="fa fa-file-pdf"></i> Download User Info as PDF
                </a>

                <form action="{{ route('adm.site.users.uploadMemPhoto', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="file" class="form-label">Select File</label>
                        <input class="form-control" type="file" id="file" name="file" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-upload"></i> Upload
                    </button>
                </form>

                @include('users.normal.layouts.files')

                <div class="card-footer bg-light text-end">
                    <form action="{{ route('adm.site.users.remove', $user->id) }}" method="GET" class="d-inline">
                        <button class="btn btn-danger">
                            <i class="fa fa-trash"></i> Remove
                        </button>
                    </form>

                    <a href="{{ route('adm.site.users.index') }}" class="btn btn-secondary ms-2">
                        <i class="fa fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('users.normal.layouts.modals')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const moveModal = document.getElementById('moveFileModal');
            moveModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                document.getElementById('moveSourceUserId').value = button.getAttribute('data-user-id');
                document.getElementById('moveFileName').value = button.getAttribute('data-file-name');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const renameModal = document.getElementById('renameModal');

            renameModal.addEventListener('show.bs.modal', function (event) {
                let button = event.relatedTarget;
                let filename = button.getAttribute('data-filename');
                let userid = button.getAttribute('data-userid');

                document.getElementById('renameOldName').value = filename;
                document.getElementById('renameUserId').value = userid;
                document.getElementById('renameNewName').value = filename;
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Delete Button Handler
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.dataset.userId;
                    const fileName = this.dataset.fileName;

                    if (confirm('Are you sure you want to delete this file?')) {
                        fetch(`/site/users/user-files/soft-delete/${userId}/${encodeURIComponent(fileName)}`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.status === 'deleted') {
                                    alert('File moved to trash.');
                                    toggleDeleteRestoreButton(fileName, userId);
                                } else {
                                    alert('Delete failed: ' + (data.message || 'Unknown error.'));
                                }
                            });
                    }
                });
            });

// Restore Button Handler
            document.querySelectorAll('.restore-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.dataset.userId;
                    const fileName = this.dataset.fileName;

                    fetch(`/site/users/user-files/restore/${userId}/${encodeURIComponent(fileName)}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'restored') {
                                alert('File restored successfully.');
                                toggleDeleteRestoreButton(fileName, userId);
                            } else {
                                alert('Restore failed: ' + (data.message || 'Unknown error.'));
                            }
                        });
                });
            });

            // History Button Handler
            document.querySelectorAll('.history-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.dataset.userId;
                    const fileName = this.dataset.fileName;

                    fetch(`/api/user-files/history/${userId}/${fileName}`)
                        .then(res => res.json())
                        .then(data => {
                            let html = '<ul>';
                            data.forEach(log => {
                                html += `<li><strong>${log.action}</strong> - ${log.performed_at}<br><small>${log.details}</small></li>`;
                            });
                            html += '</ul>';

                            Swal.fire({
                                title: 'File History',
                                html: html,
                                width: 600,
                            });
                        });
                });
            });
        });
    </script>
    <script>
        function toggleDeleteRestoreButton(fileName, userId) {
            fetch(`/api/user-files/is-trashed/${userId}/${fileName}`)
                .then(response => response.json())
                .then(data => {
                    const deleteBtn = document.querySelector(`.delete-btn[data-file-name="${fileName}"][data-user-id="${userId}"]`);
                    const restoreBtn = document.querySelector(`.restore-btn[data-file-name="${fileName}"][data-user-id="${userId}"]`);

                    if (data.status === 'trashed') {
                        deleteBtn.style.display = 'none';
                        restoreBtn.style.display = 'inline-block';
                    } else {
                        deleteBtn.style.display = 'inline-block';
                        restoreBtn.style.display = 'none';
                    }
                });
        }
    </script>
    @if(session('success'))
        <script>
            Swal.fire('Success', '{{ session('success') }}', 'success');
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire('Error', '{{ session('error') }}', 'error');
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle passport verification checkbox changes
            document.querySelectorAll('.passport-verify-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const userId = this.dataset.userId;
                    const fileName = this.dataset.fileName;
                    const isVerified = this.checked;

                    // Uncheck all other checkboxes in the table
                    if (isVerified) {
                        document.querySelectorAll('.passport-verify-checkbox').forEach(cb => {
                            if (cb !== this) cb.checked = false;
                        });
                    }

                    // Make AJAX request to update passport photo
                    updatePassportPhoto(userId, fileName, isVerified);
                });
            });

            function updatePassportPhoto(userId, fileName, isVerified) {
                const params = new URLSearchParams({
                    file_name: fileName,
                    is_verified: isVerified,
                    _token: document.querySelector('meta[name="csrf-token"]').content
                });

                fetch(`/api/update-passport-photo/${userId}?${params.toString()}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            alert('Failed to update passport photo: ' + data.message);
                            document.querySelector(`.passport-verify-checkbox[data-user-id="${userId}"][data-file-name="${fileName}"]`).checked = !isVerified;
                        }else{
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating passport photo');
                        document.querySelector(`.passport-verify-checkbox[data-user-id="${userId}"][data-file-name="${fileName}"]`).checked = !isVerified;
                    });
            }
        });
    </script>
@endsection