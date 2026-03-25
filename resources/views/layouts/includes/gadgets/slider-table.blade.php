<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Subtitle</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Button 1 Text</th>
                            <th>Button 2 Text</th>
                            <th class="text-right">Created</th>
                            <th class="text-right">Updated</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ env('URL_ADMIN') }}/storage/{{ $slider->slide_image }}" alt="{{ $slider->slide_title }}" style="width: 100px; height: auto;"></td>
                                <td>{{ $slider->slide_subtitle }}</td>
                                <td>{{ $slider->slide_title }}</td>
                                <td>{{ $slider->slide_description }}</td>
                                <td>{{ $slider->button1_text }}</td>
                                <td>{{ $slider->button2_text }}</td>
                                <td class="text-right">{{ $slider->created_at->format('M-d, Y') }}</td>
                                <td class="text-right">{{ $slider->updated_at->format('M-d, Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Slider actions">
                                        <!-- Edit Button -->
                                        <a href="{{ route('adm.pgs.slider.edit',$slider->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <!-- View Button -->
                                        <a target="_blank" href="{{ route('adm.pgs.slider.view',$slider->id) }}" class="btn btn-dark btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>

                                        <!-- Remove Button -->
                                        <form action="{{ route('adm.pgs.slider.delete',$slider->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this slider?')">
                                                <i class="fas fa-trash-alt"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</div>

