 <div class="row">
        @include('layouts.partials.alerts')

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <form action="{{ route('adm.aca.tea.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- User Selection -->
                <div class="form-group">
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $teacher->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->email }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Expertise -->
                <div class="form-group">
                    <label for="expertise">Expertise</label>
                    <input type="text" class="form-control" id="expertise" name="expertise"
                           value="{{ old('expertise', $teacher->expertise) }}" placeholder="Enter expertise">
                </div>

                <!-- Biography -->
                <div class="form-group">
                    <label for="bio">Biography</label>
                    <textarea class="form-control" id="bio" name="bio" rows="4"
                              placeholder="Write a short bio">{{ old('bio', $teacher->bio) }}</textarea>
                </div>

                <!-- Profile Picture -->
                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    @php
                        $profilePicturePath = asset("teachers/{$teacher->id}/profile_picture.png");
                    @endphp
                    @if(file_exists(public_path("teachers/{$teacher->id}/profile_picture.png")))
                        <div class="mb-2">
                            <img src="{{ $profilePicturePath }}" alt="Profile Picture" class="img-thumbnail" width="150">
                            <a href="{{ route('adm.aca.tea.removeFile', ['id' => $teacher->id, 'type' => 'profile_picture']) }}" class="btn btn-danger btn-sm">Remove</a>
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                </div>

                <!-- Resume Upload -->
                <div class="form-group">
                    <label for="resume">Resume</label>
                    @php
                        $resumePdfPath = "teachers/{$teacher->id}/resume.pdf";
                        $resumeDocPath = "teachers/{$teacher->id}/resume.doc";
                        $resumeDocxPath = "teachers/{$teacher->id}/resume.docx";
                    @endphp
                    @if(file_exists(public_path($resumePdfPath)) || file_exists(public_path($resumeDocPath)) || file_exists(public_path($resumeDocxPath)))
                        <div class="mb-2">
                            @if(file_exists(public_path($resumePdfPath)))
                                <a href="{{ asset($resumePdfPath) }}" target="_blank">View Resume (PDF)</a>
                            @endif
                            @if(file_exists(public_path($resumeDocPath)))
                                <a href="{{ asset($resumeDocPath) }}" target="_blank">View Resume (DOC)</a>
                            @endif
                            @if(file_exists(public_path($resumeDocxPath)))
                                <a href="{{ asset($resumeDocxPath) }}" target="_blank">View Resume (DOCX)</a>
                            @endif
                            <a href="{{ route('adm.aca.tea.removeFile', ['id' => $teacher->id, 'type' => 'resume']) }}" class="btn btn-danger btn-sm">Remove</a>
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="resume" name="resume">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update Teacher</button>
            </form>
        </div>
    </div>
