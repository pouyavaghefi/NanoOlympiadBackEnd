<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="d-flex justify-content-end mb-3">
            <a href="https://admin.nanolympiad.org/academy/teachers/create" class="btn btn-outline-primary">
                <i class="fa fa-plus"></i> Add New Teacher
            </a>
            <a href="" class="btn btn-primary">
                <i class="fa fa-search"></i> Search
            </a>
        </div>
    </div>
</div>
<div class="table-container">
    <div class="table-responsive">
        <table class="table custom-table m-0">
            <thead>
            <tr>
                <th>#</th>
                <th>Profile</th>
                <th>Expertise</th>
                <th>Resume</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($teacher->profile_picture)
                                <img src="{{ asset($teacher->profile_picture) }}" alt="Profile Picture" class="rounded-circle me-2" width="40" height="40">
                            @else
                                <img src="{{ asset('teachers/classroom.png') }}" alt="Default Avatar" class="rounded-circle me-2" width="40" height="40">
                            @endif
                            &nbsp;&nbsp;
                            <span>{{ $teacher->user->email ?? 'Unknown' }}</span>
                        </div>
                    </td>
                    <td>{{ $teacher->expertise ?? 'N/A' }}</td>
                    <td>
                        @if($teacher->resume_url)
                            <a href="{{ asset($teacher->resume_url) }}" target="_blank" class="btn btn-sm btn-primary">View Resume</a>
                        @else
                            <span class="text-muted">No Resume</span>
                        @endif
                    </td>
                    <td>
                        <div class="td-actions d-flex justify-content-between align-items-center">
                            <!-- Edit Button -->
                            <a href="{{ route('adm.aca.tea.edit', $teacher->id) }}"
                               class="btn btn-outline-secondary btn-sm me-2"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Edit Teacher">
                                <i class="icon-pencil"></i>
                            </a>

                            <!-- Delete Button -->
                            <a href="{{ route('adm.aca.tea.delete', $teacher->id) }}"
                               class="btn btn-outline-danger btn-sm"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Delete Teacher"
                               onclick="return confirm('Are you sure you want to delete this teacher?');">
                                <i class="icon-cancel"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No teachers available</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
