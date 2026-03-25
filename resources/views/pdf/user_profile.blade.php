<!DOCTYPE html>
<html>
<head>
    <title>User Profile Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9fafb;
            padding: 20px;
        }
        .report-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eaeaea;
        }
        .header h1 {
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 28px;
        }
        .header .subtitle {
            color: #7f8c8d;
            font-size: 14px;
        }
        .profile-section {
            margin-bottom: 30px;
            background: #fff;
            border-radius: 6px;
            padding: 5px;
        }
        .section-title {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-left: 4px solid #3498db;
            margin-bottom: 20px;
            font-size: 18px;
            color: #2c3e50;
            border-radius: 4px;
            display: flex;
            align-items: center;
        }
        .section-title svg {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-item {
            margin-bottom: 15px;
        }
        .info-label {
            font-weight: 600;
            color: #5a6a7a;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .info-value {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 15px;
            display: flex;
            align-items: center;
        }
        .country-flag {
            display: inline-block;
            margin-right: 10px;
            vertical-align: middle;
            width: 28px;
            height: 18px;
            object-fit: cover;
            border-radius: 2px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .verified {
            background-color: #e6f7ed;
            color: #10b759;
        }
        .unverified {
            background-color: #fff4e6;
            color: #ff9500;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #eaeaea;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
        }
        .highlight-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .text-muted {
            color: #94a3b8;
        }
    </style>
</head>
<body>
<div class="report-container">
    <div class="header">
        <h1>User Profile Report</h1>
        <div class="subtitle">Generated on {{ now()->format('F j, Y \a\t H:i') }}</div>
    </div>

    <div class="highlight-box">
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Report ID</div>
                <div class="info-value">UP-{{ $user->id }}-{{ now()->format('Ymd') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Account Status</div>
                <div class="info-value">{!! $user->showStatus() !!}</div>
            </div>
        </div>
    </div>

    <div class="profile-section">
        <div class="section-title">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Personal Information
        </div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Full Name</div>
                <div class="info-value">{{ $user->fullName() ?? 'Not Specified' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Email Address</div>
                <div class="info-value">{{ $user->email }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Email Verification</div>
                <div class="info-value">
                    @if($user->email_verified_at)
                        <span class="status-badge verified">Verified • {{ $user->email_verified_at->format('M j, Y') }}</span>
                    @else
                        <span class="status-badge unverified">Pending Verification</span>
                    @endif
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Last Login</div>
                <div class="info-value">
                    @if($user->last_login)
                        {{ \Carbon\Carbon::parse($user->last_login)->format('M j, Y \a\t H:i') }}
                    @else
                        <span class="text-muted">Never logged in</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($user->member())
        <div class="profile-section">
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Member Details
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Surname</div>
                    <div class="info-value">{{ $user->member()->surname ?? 'Not provided' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Father's Name</div>
                    <div class="info-value">{{ $user->member()->father_name ?? 'Not provided' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Date of Birth</div>
                    <div class="info-value">
                        @if($user->member()->birthday)
                            {{ $user->member()->birthday }}
                        @else
                            Not provided
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Gender</div>
                    <div class="info-value">{{ ucfirst($user->member()->gender) ?? 'Not specified' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Passport Number</div>
                    <div class="info-value">{{ $user->member()->passport_number ?? 'Not provided' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Passport Status</div>
                    <div class="info-value">
                        @if($user->member()->passport_verified ?? false)
                            <span class="status-badge verified">Verified</span>
                        @else
                            <span class="status-badge unverified">Not Verified</span>
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">{{ $user->member()->phone ?? 'Not provided' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Personal Code</div>
                    <div class="info-value">{{ $user->member()->personal_code ?? 'Not provided' }}</div>
                </div>
            </div>
        </div>

        <div class="profile-section">
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Address Information
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Country</div>
                    <div class="info-value">
                        @php
                            // Get the member's country value (e.g. "Ir")
                            $memberCountry = $user->member()->country;

                            if ($memberCountry) {
                                // Clean the country code (remove .png if present)
                                $cleanCountryCode = strtolower(preg_replace('/\.(png|jpg|jpeg)$/i', '', $memberCountry));

                                // Find matching country record
                                $countryRecord = DB::table('members_country')
                                    ->where('flag', 'like', $cleanCountryCode . '.%')
                                    ->first();
                            }
                        @endphp

                        @if($memberCountry)
                            @if($countryRecord)
                                <img src="{{ public_path('members-country/' . $countryRecord->flag) }}"
                                     class="country-flag"
                                     alt="{{ $countryRecord->name }} flag">
                                {{ $countryRecord->name }}
                            @else
                                {{ $memberCountry }}
                            @endif
                        @else
                            <span class="text-muted">Not specified</span>
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">City</div>
                    <div class="info-value">{{ $user->member()->city ?? 'Not provided' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Full Address</div>
                    <div class="info-value">{{ $user->member()->address ?? 'Not provided' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Postal Code</div>
                    <div class="info-value">{{ $user->member()->postal_code ?? 'Not provided' }}</div>
                </div>
            </div>
        </div>

        <div class="profile-section">
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Agent Information
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Agent Name</div>
                    <div class="info-value">{{ $user->member()->agent_name ?? 'Not assigned' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Agent Code</div>
                    <div class="info-value">{{ $user->member()->agent_code ?? 'Not assigned' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Referral Code</div>
                    <div class="info-value">{{ $user->member()->referer_code ?? 'Not assigned' }}</div>
                </div>
            </div>
        </div>
    @else
        <div class="profile-section">
            <div class="section-title">Member Details</div>
            <div class="text-muted" style="padding: 15px 0;">
                No member information available. This user hasn't completed their member profile.
            </div>
        </div>
    @endif

    <div class="footer">
        <div>Confidential User Profile Report</div>
        <div>Generated by {{ config('app.name') }} • {{ now()->format('Y') }}</div>
    </div>
</div>
</body>
</html>