<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="d-flex justify-content-end mb-3">
            <a href="https://admin.nanolympiad.org/courses/categories/create" class="btn btn-outline-primary">
                <i class="fa fa-plus"></i> Add New Category
            </a>
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
                <th>Status</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @php($menuCounter = 0)
            @forelse ($cats as $cat)
            <tr>
                <td>{{ ++$menuCounter }}</td>
                <td>{{ $cat->name }}</td>
                <td>
                    @if($cat->status == 1)
                    <span class="badge bg-success" style="color:white">Active</span>
                    @else
                    <span class="badge bg-danger" style="color:white">Deactive</span>
                    @endif
                </td>
                <td>{{ $cat->slug }}</td>
                <td>
                    <div class="td-actions d-flex justify-content-between align-items-center">
                        <!-- Quick Edit Button -->
                        <a href="javascript:void(0)"
                           class="btn btn-warning btn-sm"
                           data-id="{{ $cat->id }}"
                           data-title="{{ $cat->title }}"
                           onclick="quickEditCategory(this)">
                            <i class="fa fa-pencil-alt"></i> Quick Edit
                        </a>

                        <!-- Change Status -->
                        <a href="javascript:void(0);"
                           class="btn btn-outline-warning btn-sm me-2 change-status"
                           data-id="{{ $cat->id }}"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Change Status">
                            <i class="fa {{ $cat->status ? 'fa-toggle-off' : 'fa-toggle-on' }}"></i>
                        </a>


                        <!-- View Category Button -->
                        <a href="{{ route('adm.crs.cats.show', $cat->slug) }}"
                           target="_blank"
                           class="btn btn-outline-success btn-sm me-2"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="View Category">
                            <i class="icon-eye"></i>
                        </a>

                        <!-- Episode Button -->
                        <a href="{{ route('adm.crs.cats.related.crs', $cat->id) }}"
                           class="btn btn-outline-info btn-sm"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Related Courses">
                            <i class="icon-list"></i>
                        </a>

                        <!-- Edit Button -->
                        <a href="{{ route('adm.crs.cats.edit', $cat->id) }}"
                           class="btn btn-outline-secondary btn-sm me-2"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Edit Category">
                            <i class="icon-pencil"></i>
                        </a>

                        <!-- Delete Button -->
                        <a href="{{ route('adm.crs.cats.remove', $cat->id) }}"
                           class="btn btn-outline-danger btn-sm"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Delete Category"
                           onclick="return confirm('Are you sure you want to delete this category?');">
                            <i class="icon-cancel"></i>
                        </a>
                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No course category available</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
