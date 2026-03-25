<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="d-flex justify-content-end mb-3">
            <a href="" class="btn btn-primary">
                <i class="fa fa-search"></i> Search
            </a>
            <a href="https://admin.nanolympiad.org/courses/all" class="btn" style="background-color: #6c63ff; color: white;">
                <i class="fa fa-list-alt"></i> Courses
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
                <th>Title</th>
                <th>Type</th>
                <th>Duration</th>
                <th>Views</th>
                <th>Comments</th>
                <th>Downloads</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($episodes as $episode)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $episode->title }}</td>
                    <td>{{ ucfirst($episode->type) }}</td>
                    <td>{{ $episode->time }}</td>
                    <td>{{ number_format($episode->view_count) }}</td>
                    <td>{{ number_format($episode->comment_count) }}</td>
                    <td>{{ number_format($episode->download_count) }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('adm.crs.epi.editEpi', ['course_id' => $episode->course_id,'id' => $episode->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('adm.crs.epi.remove', ['course_id' => $episode->course_id,'id' => $episode->id]) }}" method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No episodes available</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
