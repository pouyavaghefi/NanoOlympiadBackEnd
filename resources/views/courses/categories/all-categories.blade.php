@extends('layouts.master')

@section('title','Categories')

@section('wrapper')
    @include('layouts.partials.alerts-secondary')
    @include('layouts.includes.gadgets.all-categories')
@endsection

@section('scripts')
    <script>
        function quickEditCategory(element) {
            let categoryId = element.getAttribute('data-id');
            let currentTitle = element.getAttribute('data-title');

            Swal.fire({
                title: 'Edit Category Title',
                input: 'text',
                inputLabel: 'Enter new title',
                inputValue: currentTitle,
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Title cannot be empty!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let newTitle = result.value;

                    fetch(`/courses/categories/quick-edit/${categoryId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ title: newTitle })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Success', 'Title updated successfully!', 'success');
                                location.reload();
                            } else {
                                Swal.fire('Error', 'Failed to update title.', 'error');
                            }
                        })
                        .catch(() => Swal.fire('Error', 'An error occurred.', 'error'));
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.change-status').on('click', function() {
                var categoryId = $(this).data('id');
                var $this = $(this);

                $.ajax({
                    url: '{{ route("adm.crs.cats.change-status", ":id") }}'.replace(':id', categoryId),
                    type: 'GET',
                    success: function(response) {
                        if (response.is_active) {
                            $this.find('i').removeClass('fa-toggle-off').addClass('fa-toggle-on');
                        } else {
                            $this.find('i').removeClass('fa-toggle-on').addClass('fa-toggle-off');
                        }

                        alert('Category status changed successfully.');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error changing category status. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
