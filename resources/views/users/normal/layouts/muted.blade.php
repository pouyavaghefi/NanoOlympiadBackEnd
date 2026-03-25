@php
        $appended = '/user-image/users/'.$user->id.'/'.basename($user->avatar);
        $avatarUrl = $user->avatar ? env('URL_FRONT') . $appended : asset('img/avatar.png');
@endphp

<div class="card-body">
    <div class="text-center mb-4">
        <img src="{{ $avatarUrl }}"
             alt="User Avatar"
             class="rounded-circle border border-3 border-primary"
             style="width: 120px; height: 120px; object-fit: cover;"
             onerror="this.src='{{ asset('img/avatar.png') }}'">

        <h4 class="mt-3">{{ $user->fullName() ?? 'No Name Provided' }}</h4>
        <p class="text-muted mb-1">
            @if($user->username)
            <small>Username: {{ $user->username }}</small>
            @endif
        </p>
        <p class="text-muted mb-1">
            @if(isset($user->member()->phone))
            <small><i class="fa fa-phone me-1"></i> {{ $user->member()->phone }}</small>
            @endif
        </p>
        <p class="text-muted mb-1">
            @if(isset($user->member()->referer_code))
            <small><i class="fa fa-link me-1"></i> {{ $user->member()->referer_code }}</small>
            @endif
        </p>
        <p class="text-muted mb-1">
            @if(isset($user->member()->postal_code))
            <small><i class="fa fa-envelope me-1"></i> {{ $user->member()->postal_code }}</small>
            @endif
        </p>
        <p class="text-muted mb-1">
            @if(isset($user->member()->address))
            <small><i class="fa fa-map-marker-alt me-1"></i> {{ $user->member()->address }}</small>
            @endif
        </p>
        <p class="text-muted mb-1">
            @if(isset($user->member()->gender))
            <small><i class="fa fa-{{ $user->member()->gender === 'male' ? 'mars' : ($user->member()->gender === 'female' ? 'venus' : 'genderless') }} me-1"></i> {{ $user->member()->gender }}</small>
            @endif
        </p>
        <p class="text-muted mb-1">
            @if(isset($user->member()->country))
            <small>
                <i class="fa fa-globe me-1"></i>
                {{ $user->member()->country->name ?? $user->member()->country }}
            </small>
            @endif
        </p>

        <!-- Admin actions -->
        <div class="mt-3 d-flex justify-content-center gap-2">
            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> Delete Image
                </button>
            </form>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="imageUpload" class="btn btn-primary btn-sm mb-0" style="cursor: pointer;">
                    <i class="fa fa-upload"></i> Upload Image
                </label>
                <input type="file" id="imageUpload" name="avatar" accept="image/*" style="display: none;" onchange="this.form.submit()">
            </form>
        </div>

        @if(isset($user->member()->country))
        @php
        $countryCode = strtolower($user->member()->country);
        $countryName = \Illuminate\Support\Facades\DB::table('countries')
        ->where('code', strtoupper($countryCode))
        ->value('name');
        @endphp

        <div style="font-size: 1.2rem; display: flex; align-items: center; gap: 0.5rem;float:left">
            <span class="flag-icon flag-icon-{{ $countryCode }}" style="font-size: 2rem;"></span>
            <span><i class="fa fa-globe me-1"></i> From <span style="color:purple">{{ $countryName }}</span></span>
        </div>
        @endif
    </div>

    <dl class="row mb-0">
        <dt class="col-sm-4">Full Name</dt>
        <dd class="col-sm-8">
            <form method="POST" action="{{ route('adm.site.users.updateFullName',$user->id) }}">
                @csrf
                <input type="text" class="form-control" name="full_name" value="{{ $user->fullName() ?? 'Not Specified Yet' }}">
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </dd>

        @if(isset($user->member()->surname))
            <dd class="col-sm-8">
                <u>{{ strtoupper($user->member()->surname) }}</u> as Surname
            </dd>
        @endif

        <br>

        <dt class="col-sm-4">Email</dt>
        <dd class="col-sm-8">
            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
        </dd>

        <dt class="col-sm-4">Account Info</dt>
        <dd class="col-sm-8">
            {!! $user->showEmail() !!}
            @if(!is_null($user->email_verified_at))
            <br><small style="color:green" class="">Verified at: {{ $user->email_verified_at }}</small>
            @endif
        </dd>

        <dt class="col-sm-4">Status</dt>
        <dd class="col-sm-8">
            {!! $user->showStatus() !!}
            @if($user->is_active == 1)
            <br><small class="text-success">Passed the 2nd step</small>
            @endif
        </dd>

        <dt class="col-sm-4">Last Login</dt>
        <dd class="col-sm-8">
            {{ $user->last_login ?? 'Never' }}
            @if ($isOnline)
            <span class="badge bg-success ms-2 blinking-badge" style="color:white">ONLINE</span>
            @endif

            <style>
                @keyframes blinking {
                    0%, 100% { opacity: 1; }
                    50% { opacity: 0; }
                }

                .blinking-badge {
                    animation: blinking 1.5s infinite;
                }
            </style>
        </dd>

        <dt class="col-sm-4">Created At</dt>
        <dd class="col-sm-8">
            {{ $user->created_at ? $user->created_at->format('F j, Y - H:i') : 'Not Available' }}
        </dd>

        <dt class="col-sm-4">Updated At</dt>
        <dd class="col-sm-8">
            {{ $user->updated_at ? $user->updated_at->format('F j, Y - H:i') : 'Not Available' }}
        </dd>
    </dl>

    @if($user->is_active == 0 || is_null($user->email_verified_at))
    <a href="{{ route('send.activation.link', $user->id) }}" class="btn btn-outline-dark mt-3">
        <i class="fa fa-envelope"></i> Send Activation Link
    </a>
    @endif

    <a href="{{ route('change.status', $user->id) }}" class="btn btn-outline-dark mt-3">
        <i class="fa fa-exchange-alt"></i> Change Status
    </a>

    <a href="{{ route('change.activation', $user->id) }}" class="btn btn-outline-dark mt-3">
        <i class="fa fa-check-circle"></i> Change Email Activation
    </a>

</div>