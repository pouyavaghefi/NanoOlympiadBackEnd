<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form action="{{ route('adm.aca.tea.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- User Selection -->
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select User</option>
                    @forelse(\App\Models\User::where('is_active', 1)->where('super_user', 0)->get() as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @empty
                        <option value="" disabled>No active users available</option>
                    @endforelse
                </select>
            </div>

            <!-- Expertise -->
            <div class="form-group">
                <label for="expertise">Expertise</label>
                <input type="text" class="form-control" id="expertise" name="expertise" value="{{ old('expertise') }}" placeholder="Enter expertise">
            </div>

            <!-- Resume -->
            <div class="form-group">
                <label for="resume">Upload Resume</label>
                <input type="file" class="form-control-file" id="resume" name="resume">
            </div>

            <!-- Biography -->
            <div class="form-group">
                <label for="bio">Biography</label>
                <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Write a short bio">{{ old('bio') }}</textarea>
            </div>

            <!-- Profile Picture -->
            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Teacher</button>
        </form>
    </div>
</div>
