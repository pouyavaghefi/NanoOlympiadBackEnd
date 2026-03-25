<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="d-flex justify-content-end mb-3">
            <a href="https://admin.nanolympiad.org/courses/create" class="btn btn-outline-primary">
                <i class="fa fa-plus"></i> Add New Course
            </a>
            <a href="" class="btn btn-primary">
                <i class="fa fa-search"></i> Search
            </a>
        </div>
    </div>
</div>
<div class="course-title">
    <h3 class="text-primary text-center">
        <a href="{{ route('adm.crs.cats.index') }}">{{ $category->name }}</a>
    </h3>
</div>
<hr>
<div class="table-container">
    <div class="table-responsive">
        <table class="table custom-table m-0">
            <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Sessions</th>
                <th>Categories</th>
                <th>Price</th>
                <th>Statistics</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($category->relatedCourses() as $relatedCourse)
            @php
            $course = \DB::table('courses')->find($relatedCourse->course_id);
            @endphp
            <tr>
                <td>{{ $course->title }}</td>
                <td>
                        <span class="course-status-{{ $course->id }}">
                            @if($course->save_draft == 1)
                                <span class="badge bg-danger" style="color:white">Saved</span>
                            @else
                                <span class="badge bg-success" style="color:white">Published</span>
                            @endif
                        </span>
                </td>
                <td>{{ $course->sessions }}</td>
                <td>

                </td>
                <td>${{ number_format($course->price, 2) }}</td>
                <td>
                    <div class="course-statistics">
                        <!-- Enrollments -->
                        <div class="stat-item">
                            <span class="stat-icon"><i class="fa fa-users"></i></span>
                            <span class="stat-value">12</span>
                            <span class="stat-label">Enrollments</span>
                        </div>

                        <!-- Completion Rate -->
                        @if(isset($course->completion_rate))
                        <div class="stat-item">
                            <span class="stat-icon"><i class="fa fa-check-circle"></i></span>
                            <span class="stat-value">12%</span>
                            <span class="stat-label">Completion</span>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $course->completion_rate ?? '' }}%" aria-valuenow="{{ $course->completion_rate ?? '' }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        @endif

                        <!-- Ratings -->
                        @if(isset($course->average_rating))
                        <div class="stat-item">
                            <span class="stat-icon"><i class="fa fa-star"></i></span>
                            <span class="stat-value">{{ number_format(16.212, 1) }}</span>
                            <span class="stat-label">Rating</span>
                            <div class="rating-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star{{ $i <= $course->average_rating ? ' text-warning' : ' text-muted' }}"></i>
                                @endfor
                            </div>
                        </div>
                        @endif

                        <!-- Reviews -->
                        <div class="stat-item">
                            <span class="stat-icon"><i class="fa fa-comments"></i></span>
                            <span class="stat-value">20</span>
                            <span class="stat-label">Reviews</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="td-actions d-flex justify-content-between align-items-center">
                        <!-- Quick Edit Button -->
                        <a href="javascript:void(0)"
                           class="btn btn-warning btn-sm"
                           data-id="{{ $course->id }}"
                           data-title="{{ $course->title }}"
                           onclick="quickEditCourse(this)">
                            <i class="fa fa-pencil-alt"></i> Quick Edit
                        </a>

                        <!-- Change Status -->
                        <a href="javascript:void(0);"
                           class="btn btn-outline-warning btn-sm me-2 change-status"
                           data-id="{{ $course->id }}"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Change Status">
                            <i class="fa {{ $course->save_draft ? 'fa-toggle-off' : 'fa-toggle-on' }}"></i>
                        </a>

                        <!-- View Course Button -->
                        <a href="{{ route('adm.crs.show', $course->slug) }}"
                           target="_blank"
                           class="btn btn-outline-success btn-sm me-2"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="View Course">
                            <i class="icon-eye"></i>
                        </a>

                        <!-- Episode Button -->
                        <a href="{{ route('adm.crs.epi.index', $course->id) }}"
                           class="btn btn-outline-info btn-sm"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Manage Episodes">
                            <i class="icon-list"></i>
                        </a>

                        <!-- Edit Button -->
                        <a href="{{ route('adm.crs.edit', $course->id) }}"
                           class="btn btn-outline-secondary btn-sm me-2"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Edit Course">
                            <i class="icon-pencil"></i>
                        </a>

                        <!-- Delete Button -->
                        <a href="{{ route('adm.crs.remove', $course->id) }}"
                           class="btn btn-outline-danger btn-sm"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Delete Course"
                           onclick="return confirm('Are you sure you want to delete this course?');">
                            <i class="icon-cancel"></i>
                        </a>

                        <a href="{{ route('adm.crs.cats.related.crs', $course->id) }}"
                           class="btn btn-dark btn-sm"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Translate Course">
                            <i class="fa fa-language"></i>
                        </a>

                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No courses available</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
