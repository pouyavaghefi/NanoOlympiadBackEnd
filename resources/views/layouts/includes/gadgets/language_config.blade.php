<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.set.langs.cfg.store') }}">
            @csrf

            <!-- Language Configuration Form -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gutters">
                                <!-- Language Name -->
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Language Name</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter language name" required>
                                    </div>
                                </div>

                                <!-- Language Code -->
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="code">Language Code</label>
                                        <input type="text" id="code" name="code" class="form-control" placeholder="Enter language code (e.g., en, fr)" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <button type="submit" class="btn btn-primary">Add To Languages</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Language Table -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($languages->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No languages found.</td>
                                    </tr>
                                @else
                                    @foreach($languages as $language)
                                        <tr>
                                            <td>{{ $language->id }}</td>
                                            <td>@if($language->code == 'en') (main) @endif {{ $language->name }}</td>
                                            <td>
                                                @if($language->is_active)
                                                    @php
                                                        // Generate a random color in hexadecimal format
                                                        $randomColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                                                    @endphp

                                                    @if($language->code === 'en')
                                                        <a href="https://{{ env('MAIN_DOMAIN') }}" target="_blank" style="color: {{ $randomColor }}" title="Click to view">
                                                            {{ $language->code }}
                                                        </a>
                                                    @else
                                                        <a href="https://{{ $language->code }}.{{ env('MAIN_DOMAIN') }}" target="_blank" style="color: {{ $randomColor }}" title="Click to view">
                                                            {{ $language->code }}
                                                        </a>
                                                    @endif
                                                @else
                                                    {{ $language->code }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $language->is_active ? 'Active' : 'Inactive' }}
                                                <a href="#" class="toggle-status" data-id="{{ $language->id }}" data-status="{{ $language->is_active ? '1' : '0' }}">
                                                    [Toggle]
                                                </a>
                                            </td>
                                            <td>
                                                @if(!is_null($language->created_at))
                                                    {{ $language->created_at }}
                                                @else
                                                    <i>via-seeder</i>
                                                @endif
                                            </td>
                                            <td>{{ $language->updated_at }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('adm.set.langs.cfg.edit', $language->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('adm.set.langs.cfg.destroy', $language->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this language?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.querySelectorAll('.toggle-status').forEach(function(link) {
                                        link.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            let languageId = this.getAttribute('data-id');
                                            let currentStatus = this.getAttribute('data-status');

                                            fetch(`/settings/languages/configurations/toggle-status/${languageId}`, {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify({ status: currentStatus })
                                            })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        location.reload();
                                                    } else {
                                                        alert('Failed to toggle status');
                                                    }
                                                })
                                                .catch(error => console.error('Error:', error));
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
