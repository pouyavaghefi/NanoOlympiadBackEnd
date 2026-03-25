<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card mb-3">
            <div class="card-header" style="text-align:left">
                Choose which section to be appeared at Landing and it's priority among the others
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('adm.pgs.prior') }}">
                    @csrf

                    @forelse ($sections as $section)
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="sections[]" value="{{ $section->section_name }}"
                                   {{ $section->is_enabled ? 'checked' : '' }}>
                            {{ ucfirst(str_replace('-', ' ', $section->section_name)) }}
                        </label>
                        <input type="number" name="priorities[{{ $section->section_name }}]"
                               value="{{ $section->priority }}" class="form-control" style="width: 60px; display: inline;">
                    </div>
                    @empty
                    <p style="color:red"><strong>Seeder has not been run yet!</strong></p>
                    @endforelse

                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
