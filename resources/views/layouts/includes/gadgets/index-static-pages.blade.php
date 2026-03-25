@extends('layouts.master')

@section('title','Static Web Pages')

@section('wrapper')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ env('APP_URL') }}/web-pages/statics/create" class="btn btn-outline-primary">
                    <i class="fa fa-plus"></i> Add New Static Page
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
                    <th>Slug</th>
                    <th>Route Name</th>
                    <th>Wallpaper</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th class="text-right">Created At</th>
                    <th class="text-right">Updated At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($webpages as $webpage)
                    @php
                        $slug = $webpage->slug;
                        $img = $webpage->wall_paper;
                    @endphp
                    @if($webpage->route_name !== "index")
                    <tr>
                        <td>{{ $webpage->id }}</td>
                        <td><a href="{{ env('FRONT_URL') }}/{{ $slug }}" target="_blank">{{ $webpage->title }}</a></td>
                        <td>{{ $webpage->slug }}</td>
                        <td>{{ $webpage->route_name }}</td>
                        <td>
                            @if($webpage->wall_paper)
                                <img src="{{ asset('storage/' . $webpage->wall_paper) }}" alt="Wallpaper" width="50">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($webpage->content)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            @if($webpage->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Deactive</span>
                            @endif
                        </td>
                        <td class="text-right">
                            {!! $webpage->created_at ? $webpage->created_at->format('M d, Y') : '<i>via seeder</i>' !!}
                        </td>
                        <td class="text-right">
                            {!! $webpage->updated_at ? $webpage->updated_at->format('M d, Y') : '<i>via seeder</i>' !!}
                        </td>
                        <td class="text-right">
                            <div class="btn-group" role="group" aria-label="Actions">
                                @if($webpage->editable == 1)
                                <a href="{{ route('adm.pgs.statics.edit', $webpage->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif

                                <a href="" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-warning" title="Change Status">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @else
                        @continue
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

