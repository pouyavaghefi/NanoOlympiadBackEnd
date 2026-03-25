@extends('layouts.master')

@section('title', 'Send Private Message')

@section('styles')
    <!-- Trix Editor -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: 0.375rem; /* Bootstrap 5 default */
            padding: 0.375rem 0.75rem;
            min-height: 38px;
            line-height: 1.5;
            font-size: 1rem;
            box-shadow: none;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--multiple .select2-search__field {
            height: auto;
            line-height: 1.5;
            margin-top: 0;
            padding: 0;
            font-size: 1rem;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25); /* Bootstrap 5 focus */
        }

    </style>
@endsection
@section('wrapper')
    <div class="row gutters">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('adm.site.users.sendMessage.submit',$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('layouts.partials.errors')

                        {{-- Subject --}}
                        <div class="mb-3">
                            <label for="subject" class="form-label">Message Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Send Type --}}
                        <div class="mb-3">
                            <label for="send_type" class="form-label">Send Type</label>
                            <select class="form-control" id="send_type" name="send_type" required>
                                <option value="">Select Type</option>
                                <option value="individual" {{ old('send_type') == 'individual' ? 'selected' : '' }}>Individual</option>
                                <option value="group" {{ old('send_type') == 'group' ? 'selected' : '' }}>Group</option>
                            </select>
                            @error('send_type')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Recipients (for group) --}}
                        <div class="mb-3" id="recipients-container" style="display: none;">
                            Recipients
                            <small class="text-muted">(Other users will be appended to the receivers of this message along with the associated user.)</small>
                            <select name="recipients[]" id="recipients" class="form-control w-100" multiple>
                                @foreach($users as $recipient)
                                    <option
                                            value="{{ $recipient->id }}"
                                            @if(
                                                (is_array(old('recipients')) && in_array($recipient->id, old('recipients')))
                                                || $recipient->id == $user->id
                                            )
                                                selected
                                            @endif
                                    >
                                        {{ $recipient->name }} ({{ $recipient->email }})
                                    </option>
                                @endforeach
                            </select>


                        </div>

                        {{-- Receiver Type --}}
                        <div class="mb-3">
                            <label for="receiver_type" class="form-label">Receiver Type</label>
                            {{-- Show as disabled select for user info --}}
                            <select class="form-control" id="receiver_type_display" disabled>
                                <option selected>User</option>
                            </select>

                            {{-- Submit actual value as hidden input --}}
                            <input type="hidden" name="receiver_type" value="user">
                        </div>


                        {{-- Tags --}}
                        <div class="mb-3">
                            <label for="tag_id" class="form-label">Tags</label>
                            <select class="form-control" name="tag_id" id="tag_id">
                                @forelse($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>{{ $tag->title }}</option>
                                @empty
                                    <option disabled>No tags available</option>
                                @endforelse
                            </select>
                            @error('tag_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            <a href="{{ route('adm.site.tags.create') }}" class="btn btn-link mt-1">Add New Tag</a>
                        </div>

                        {{-- Message Priority --}}
                        <div class="mb-3">
                            <label for="priority" class="form-label">Message Priority</label>
                            <select class="form-control" name="priority" id="priority" required>
                                <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="important" {{ old('priority') == 'important' ? 'selected' : '' }}>Important</option>
                                <option value="critical" {{ old('priority') == 'critical' ? 'selected' : '' }}>Very Important</option>
                            </select>
                            @error('priority')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pinned --}}
                        <div class="mb-3">
                            <label for="pinned" class="form-label">Pin Message</label>
                            <select class="form-control" name="pinned" id="pinned" required>
                                <option value="0" {{ old('pinned') == '0' ? 'selected' : '' }}>Do Not Pin</option>
                                <option value="1" {{ old('pinned') == '1' ? 'selected' : '' }}>Pin This Message</option>
                            </select>
                            @error('pinned')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Message Text --}}
                        <div class="mb-3">
                            <label for="body" class="form-label">Message Text</label>
                            <textarea class="form-control" name="body" id="body" rows="6" required>{{ old('body') }}</textarea>
                            @error('body')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Attachment --}}
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment</label>
                            <input type="file" class="form-control" name="attachment" id="attachment">
                            @error('attachment')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Allow Reply --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="can_reply" name="can_reply" value="1" {{ old('can_reply') ? 'checked' : '' }}>
                            <label class="form-check-label" for="can_reply">Allow Reply</label>
                        </div>

                        {{-- Allow Reply --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="send_mail" name="send_mail" value="1" {{ old('send_mail') ? 'checked' : '' }}>
                            <label class="form-check-label" for="send_mail">Send Mail to <code>{{ $user->email }}</code></label>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Show/hide recipients based on send_type --}}
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#recipients').select2({
                    width: '100%', // explicitly set width
                    placeholder: "...",
                    allowClear: true
                });


                // Show/hide based on send_type
                $('select[name="send_type"]').on('change', function () {
                    if ($(this).val() === 'group') {
                        $('#recipients-container').slideDown();
                    } else {
                        $('#recipients-container').slideUp();
                        $('#recipients').val(null).trigger('change');
                    }
                }).trigger('change'); // Run on load in case form is re-rendered
            });
        </script>

        <script>
            function toggleRecipients() {
                const sendType = document.getElementById('send_type').value;
                const wrapper = document.getElementById('recipients-wrapper');
                wrapper.style.display = sendType === 'group' ? 'block' : 'none';
            }
            document.getElementById('send_type').addEventListener('change', toggleRecipients);
            document.addEventListener('DOMContentLoaded', toggleRecipients);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @endsection
@endsection
