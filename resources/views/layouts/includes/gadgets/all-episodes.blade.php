<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="d-flex justify-content-end mb-3">
            <a href="https://admin.nanolympiad.org/courses/{{ $course->id }}/episodes/create" class="btn btn-outline-primary">
                <i class="fa fa-plus"></i> Add New Episode
            </a>
            <a href="" class="btn btn-primary">
                <i class="fa fa-search"></i> Search
            </a>
        </div>
    </div>
</div>
<div class="course-title">
    <h3 class="text-primary text-center">
        <a href="{{ route('adm.crs.index') }}">{{ $course->title }}</a>
    </h3>
</div>
<hr>
<div class="table-container">
    <div class="table-responsive">
        <table class="table custom-table m-0">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Video</th>
                <th>Tags</th>
                <th>Duration</th>
                <th>Views</th>
                <th>Comments</th>
                <th>Downloaded</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @php
                $menuCounter = 0;
            @endphp
            @forelse ($episodes as $episode)
                @php
                $courseId = $episode->course_id;
                @endphp
                <tr>
                    <td>
                        <strong>{{ ++$menuCounter }}</strong>
                        <br>
                        <small class="text-muted">Episode: {{ $episode->episode_number }} | ID: {{ $episode->id }}</small>
                    </td>

                    <td>
                        <a href="{{ env('URL_FRONT') }}/courses/{{ $episode->slug }}">
                            {{ $episode->title }}
                        </a>
                    </td>
                    <td>
                        {{ $episode->type }}
                    </td>
                    <td>{!! $episode->showStatus() !!}</td>
                    <td>
                        @if($episode->video_path)
                            <a href="{{ env('APP_URL') }}/{{ $episode->video_path }}" target="_blank" class="btn btn-sm btn-primary">Internal</a>
                        @else
                            @if($episode->video_url)
                                <a href="{{ $episode->video_url }}" target="_blank" class="btn btn-sm btn-primary">External</a>
                            @else
                                <span class="text-muted">No Video</span>
                            @endif
                        @endif
                    </td>
                    <td>{{ $episode->tags ?? '-' }}</td>
                    <td>
                        {{ $episode->time }}
                    </td>
                    <td>{{ number_format($episode->view_count) }}</td>
                    <td>{{ number_format($episode->comment_count) }}</td>
                    <td>{{ number_format($episode->download_count) }}</td>
                    <td>-</td>
                    <td>
                        <!-- View -->
                        <a href="{{ route('adm.crs.epi.view', ['course_id' => $courseId, 'id' => $episode->id]) }}"
                           class="btn btn-primary" title="View">
                            <i class="fas fa-play-circle"></i>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('adm.crs.epi.edit', ['course_id' => $courseId, 'id' => $episode->id]) }}"
                           class="btn btn-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Download -->
                        <a href="{{ route('adm.crs.epi.download', ['course_id' => $courseId, 'id' => $episode->id]) }}"
                           class="btn btn-success" title="Download">
                            <i class="fas fa-download"></i>
                        </a>

                        <!-- Publish/Unpublish -->
                        <a href="{{ route('adm.crs.epi.toggleStatus', ['course_id' => $courseId, 'id' => $episode->id]) }}"
                           class="btn btn-secondary" title="Publish/Unpublish">
                            <i class="fas fa-toggle-on"></i>
                        </a>

                        <!-- Stats -->
                        <a href="{{ route('adm.crs.epi.stats', ['course_id' => $courseId, 'id' => $episode->id]) }}"
                           class="btn btn-info" title="Analytics">
                            <i class="fas fa-chart-bar"></i>
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('adm.crs.epi.remove', ['course_id' => $courseId, 'id' => $episode->id]) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center">No episodes available</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
