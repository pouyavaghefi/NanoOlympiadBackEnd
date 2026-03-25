<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.partners.info') }}" enctype="multipart/form-data">
            @csrf

            <!-- Display Existing Partners -->
            <div id="partners-list">
                @foreach($partners as $partner)
                    <div class="form-group existing-partner mb-4" id="partner-{{ $partner->id }}">
                        <label for="partner_brand_{{ $partner->id }}">Upload Partner Brand for {{ $partner->name }}</label>

                        <!-- Show Existing Image -->
                        @if($partner->partner_image)
                            <div class="mb-3">
                                <img src="/partners/{{ $partner->partner_image }}" alt="Partner Brand" style="max-width: 150px; height: auto;">
                                <button type="button" class="btn btn-danger btn-sm remove-image" data-partner-id="{{ $partner->id }}">Remove</button>
                            </div>
                        @endif

                        <!-- Hidden Input for Partner ID -->
                        <input type="hidden" name="partner_ids[]" value="{{ $partner->id }}">

                        <!-- File Input -->
                        <input type="file" class="form-control mb-2" id="partner_brand_{{ $partner->id }}" name="partner_brand_{{ $partner->id }}">

                        <!-- Link Input -->
                        <label for="partner_link_{{ $partner->id }}">Partner Link for {{ $partner->name }}</label>
                        <input type="text" class="form-control" id="partner_link_{{ $partner->id }}" name="partner_link_{{ $partner->id }}" value="{{ old('partner_link_'.$partner->id, $partner->partner_link) }}">
                    </div>
                @endforeach
            </div>

            <!-- Add New Partner Inputs -->
            <div id="new-partners-container"></div>

            <div class="d-flex justify-content-between">
                <button type="button" id="add-partner" class="btn btn-success mb-3">+ Add New Partner</button>
                <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-partner').addEventListener('click', function () {
        const container = document.getElementById('new-partners-container');
        const newPartnerIndex = container.children.length;

        const newInputGroup = `
            <div class="form-group mb-4">
                <label for="new_partner_brand_${newPartnerIndex}">New Partner Brand</label>
                <input type="file" class="form-control mb-2" id="new_partner_brand_${newPartnerIndex}" name="new_partner_brands[]">

                <label for="new_partner_link_${newPartnerIndex}">New Partner Link</label>
                <input type="text" class="form-control" id="new_partner_link_${newPartnerIndex}" name="new_partner_links[]" placeholder="https://example.com">
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newInputGroup);
    });

    // Remove Image Handler with AJAX
    document.querySelectorAll('.remove-image').forEach(button => {
        button.addEventListener('click', function () {
            const partnerId = this.dataset.partnerId;

            if (confirm('Are you sure you want to remove this partner brand?')) {
                fetch(`/api/landing/partners/${partnerId}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`partner-${partnerId}`).remove();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while removing the partner brand.');
                    });
            }
        });
    });
</script>
