@extends('layouts.master')

@section('title','Members Country')

@section('styles')
<style>
    .flag-alert {
        color: red;
        background-color: #ffeeee;
        padding: 5px;
        border-radius: 4px;
        margin-bottom: 10px;
        font-size: 12px;
        border-left: 3px solid red;
    }
    .flag-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .flag-img {
        width: 30px;
        height: 20px;
    }
    .country-name-container {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .needs-attention {
        background-color: #fff8e6;
    }
</style>
@endsection

@section('wrapper')
@include('layouts.includes.forms.upload-file-same-directory')
<hr>
<!-- Content wrapper start -->
<div class="content-wrapper">
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <button class="btn btn-primary" onclick="showAddCountryDialog()">
                            <i class="fas fa-plus"></i> Add New Country
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="countriesTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slogan</th>
                                <th>Pinned</th>
                                <th>Show at Members Page</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($countriesList as $li)
                            <tr data-country-code="{{ strlen($li->name) <= 3 ? $li->name : '' }}"
                                class="{{ strlen($li->name) <= 3 ? 'needs-attention' : '' }}">
                                <td>
                                    <div class="flag-container">
                                        <img src="{{ env('APP_URL') }}/members-country/{{ $li->flag }}"
                                             class="flag-img"
                                             alt="{{ $li->name }}"
                                             onerror="this.style.display='none'">
                                        <div class="country-name-container">
                                            <span class="country-name">{{ $li->name }}</span>
                                            @if(strlen($li->name) <= 3)
                                            <div class="flag-alert">
                                                This country is appended to the main list due to user registration.<br>
                                                A system/database check by maintainer is required.
                                            </div>
                                            @endif
                                            <button class="btn btn-sm btn-outline-secondary change-flag-btn"
                                                    onclick="showFlagSelectionDialog('{{ $li->id }}', '{{ addslashes($li->name) }}', {{ $li->auto_added ? 'true' : 'false' }})">
                                                Change Flag
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ pathinfo($li->flag, PATHINFO_FILENAME) }}</td>
                                <td>
                                    @if($li->pinned == 1)
                                    <div class="badge badge-secondary">
                                        PINNED
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if($li->members_page == 1)
                                    <div class="badge badge-secondary">
                                        SHOW
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <button type="button" class="btn btn-secondary" onclick="changeMembersPageStatus('{{ $li->id }}', {{ $li->members_page }})">
                                            Change Condition
                                        </button>
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
    <!-- Row end -->
</div>
<!-- Content wrapper end -->

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Fetch country names from API when page loads
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('#countriesTable tbody tr[data-country-code]');

        rows.forEach(row => {
            const countryCode = row.getAttribute('data-country-code');
            if (countryCode) {
                fetchCountryName(countryCode)
                    .then(countryName => {
                        if (countryName) {
                            row.querySelector('.country-name').textContent = countryName;
                            row.classList.remove('needs-attention');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching country name:', error);
                    });
            }
        });
    });

    async function fetchCountryName(countryCode) {
        try {
            // First try using the RestCountries API
            const response = await fetch(`https://restcountries.com/v3.1/alpha/${countryCode.toLowerCase()}`);
            if (!response.ok) throw new Error('Country not found');

            const data = await response.json();
            return data[0]?.name?.common || null;
        } catch (error) {
            console.error('RestCountries API error:', error);
            // Fallback to local mapping if API fails
            const localMap = {
                'In': 'India',
                'Ir': 'Iran',
                'Us': 'United States',
                'Uk': 'United Kingdom',
                'Ca': 'Canada',
                'Au': 'Australia',
                'De': 'Germany',
                'Fr': 'France',
                'Jp': 'Japan',
                'Cn': 'China'
            };
            return localMap[countryCode] || null;
        }
    }

    function showFlagSelectionDialog(countryId, countryName, isAutoAdded) {
        Swal.fire({
            title: `Change Flag for ${countryName}`,
            html: `
                <div class="text-left">
                    ${isAutoAdded ? '<div class="flag-alert">This country is appended to the main list due to user registration.<br>A system/database check by maintainer is required.</div>' : ''}
                    <select id="flagSelect" class="form-control">
                        <option value="">Select a flag</option>
                        @foreach($existingFlags as $flag)
                        <option value="{{ $flag }}">{{ $flag }}</option>
                        @endforeach
                    </select>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Update Flag',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const flag = document.getElementById('flagSelect').value;
                if (!flag) {
                    Swal.showValidationMessage('Please select a flag');
                    return false;
                }
                return { flag: flag };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                updateCountryFlag(countryId, result.value.flag);
            }
        });
    }

    function updateCountryFlag(countryId, flag) {
        fetch(`/academy/members/members-country/update-flag/${countryId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ flag: flag })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success!', 'Flag updated successfully', 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Error!', data.message || 'Failed to update flag', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Failed to update flag', 'error');
            });
    }

    function showAddCountryDialog() {
        Swal.fire({
            title: 'Add New Country',
            html: `
                <input type="text" id="countryName" class="swal2-input" placeholder="Country Name" required>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Add Country',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const countryName = Swal.getPopup().querySelector('#countryName').value;
                if (!countryName) {
                    Swal.showValidationMessage('Please enter a country name');
                    return false;
                }
                return { countryName: countryName };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                addNewCountry(result.value.countryName);
            }
        });
    }

    function addNewCountry(countryName) {
        fetch('/academy/members/members-country/add-country', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: countryName
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success!', 'Country added successfully', 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Error!', data.message || 'Failed to add country', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Failed to add country', 'error');
            });
    }

    function changeMembersPageStatus(countryId, currentStatus) {
        const newStatus = currentStatus === 1 ? 0 : 1;
        const statusText = newStatus === 1 ? 'SHOW' : 'HIDE';

        Swal.fire({
            title: 'Change Members Page Status',
            text: `Are you sure you want to change this to ${statusText}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/academy/members/members-country/update-status/${countryId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        members_page: newStatus
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Success!', 'Status updated successfully', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to update status', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Failed to update status', 'error');
                    });
            }
        });
    }
</script>
@endsection