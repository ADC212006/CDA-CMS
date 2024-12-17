@extends('app.main')
@section('section')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <!-- <h2 class="content-header-title float-start mb-0">Category</h2> -->
                        <!-- <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('slider.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Quikc Links
                                </li>
                            </ol>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-4 col-12">
                <div class="mb-1 breadcrumb-right text-end">
                    <h4 class="card-title"><button type="button" id="addButton" class="btn btn-primary"
                            data-toggle="modal" data-target="#addModal">
                            Add New Record
                        </button></h4>
                    <!-- <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i
                                    class="me-1" data-feather="check-square"></i><span
                                    class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i
                                    class="me-1" data-feather="message-square"></i><span
                                    class="align-middle">Chat</span></a><a class="dropdown-item"
                                href="app-email.html"><i class="me-1" data-feather="mail"></i><span
                                    class="align-middle">Email</span></a><a class="dropdown-item"
                                href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span
                                    class="align-middle">Calendar</span></a></div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="content-body">

            <!-- Advanced Search -->
            <section id="advanced-search-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- <div class="card-header border-bottom">
                                <h4 class="card-title"><button type="button" id="addButton" class="btn btn-primary"
                                        data-toggle="modal" data-target="#addModal">
                                        Add New Record
                                    </button></h4>

                            </div> -->
                            <!--Search Form -->
                            <div class="card-header border-bottom">
                            <h4 class="card-title">
                                <label for="statusFilter"> <h5>Filter by Status: </h5></label>
                                <select id="statusFilter" class="form-select">
                                    <option value="">All</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                </h4>
                                </div>
                            <div class="d-inline-block">
                                <!-- Button trigger modal -->

                                <!-- Modal -->
                                <div class="modal fade text-start modal-success" id="success" tabindex="-1"
                                    aria-labelledby="myModalLabel110" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel110">Success Modal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Tart lemon drops macaroon oat cake chocolate toffee chocolate bar
                                                icing. Pudding jelly beans
                                                carrot cake pastry gummies cheesecake lollipop. I love cookie lollipop
                                                cake I love sweet gummi
                                                bears cupcake dessert.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"
                                                    class="btn btn-success waves-effect waves-float waves-light"
                                                    data-bs-dismiss="modal">Accept</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-datatable table-responsive p-1">
                                <table class="datatables-ajax table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="actionWidth"></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Advanced Search -->

            <!-- Responsive Datatable -->

            <!--/ Responsive Datatable -->

        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<!-- Add Modal -->
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <!-- Added modal-lg class here -->
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <h5 class="modal-title" id="addModalLabel">Add New Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" class="row gy-2 gx-2" enctype="multipart/form-data">
                    <div class="col-6">
                        <label class="form-label" for="addUrl">Enter End Point example('.../endpoint') <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="addUrl" name="url" placeholder="/endpoint" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="addTitle">Title <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="addTitle" name="title" placeholder="Title" required>
                    </div>
                    <div class="col-6 mt-2">
                        <label class="form-label" for="addImage">Image <span style="color:red">*</span></label>
                        <input type="file" class="form-control" id="addImage" name="image" accept="image/*" required>
                    </div>
                   
                    <div class="col-6 mt-2">
                        <label class="form-label" for="addStatus">Status <span style="color:red">*</span></label>
                        <select class="form-select" id="addStatus" name="status" required>
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-12 text-center  mt-2">
                        <img id="imgPreviewAddForm" class="img-preview mb-2" src="#" alt="Image Preview"
                            style="display: none; max-width: 100%;">

                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                        <button type="button" id="saveAddChanges" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" class="row gy-2 gx-2" onsubmit="return false">
                    <input type="hidden" id="editId" name="editId">
                    <div class="col-6">
                        <label class="form-label" for="editUrl">Enter End Point example('.../endpoint') <span style="color:red">*</span></label>
                        <input type="text" id="editUrl" name="editUrl" class="form-control" placeholder="/endpoint">
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="editTitle">Title <span style="color:red">*</span></label>
                        <input type="text" id="editTitle" name="editTitle" class="form-control" placeholder="Title">
                    </div>

                    <div class="col-6 mt-2">
                        <label class="form-label" for="editStatus">Status <span style="color:red">*</span></label>
                        <select id="editStatus" name="editStatus" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="col-6 mt-2">
                        <label class="form-label" for="editImage">Image <span style="color:red">*</span></label>
                        <input type="file" id="editImage" name="editImage" class="form-control" accept="image/*">
                        <input type="hidden" id="editImageName" name="editImageName" class="form-control">
                    </div>

                    <div class="col-12 text-center mt-3">
                        <img id="imgPreview" class="img-preview mb-2" src="#" alt="Image Preview"
                            style="display: none; max-width: 100%;">
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveChanges">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-5">
                <h1 class="text-center mb-1" id="deleteModalTitle">Delete Record</h1>
                <p class="text-center">Are you sure you want to delete this record?</p>

                <!-- Delete form -->
                <form id="deleteForm" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                    <input type="hidden" id="deleteId" name="deleteId">

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-danger me-1 mt-1" id="confirmDelete">Delete</button>
                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="#" alt="Full Image" style="max-width: 100%; height: auto;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var table = $('.datatables-ajax').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{route("link.fetch")}}',
                dataSrc: 'data',
                data: function(d) {
                    d.status = $('#statusFilter').val(); // Add filter parameter to request data
                }
            },
            stateSave: true,
            "initComplete": function(settings, json) {
                $('#example_filter input').val(''); // Clear the search input field visually
                table.ajax.reload(null, false); // Reload data while keeping pagination intact
            },
            columns: [{
                    data: 'id',
                    title: 'ID',
                    render: function(data) {
                        return `<p id="id-${data}">${data}</p>`;
                    }
                },
                {
                    data: 'title',
                    title: 'Title',
                    render: function(data, type, row) {
                        return `<p id="title-${row.id}">${data}</p>`;
                    }
                },
                {
                    data: 'url',
                    title: 'url',
                    render: function(data, type, row) {
                        return `<p id="url-${row.id}">${data}</p>`;
                    }
                },
                {
                    data: 'image',
                    title: 'Image',
                    render: function(data, type, row) {
                        var imageUrl =
                            `${baseUrl}/${data}`; // Adjust URL based on your storage path
                        return `
                    <div class="img-thumbnail-wrapper">
                        <input type="hidden" id="image_${row.id}" value="${data}">
                        <img data-bs-toggle="modal" data-bs-target="#imageModal" data-image="${imageUrl}" src="${imageUrl}" alt="Thumbnail" height="50px" width="100px">
                        <div class="overlay" id="image-viewer" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="${imageUrl}">
                            <span class="text">Click to view image</span>
                        </div>
                    </div>
                `;
                    }
                },
                {
                    data: 'status',
                    title: 'Status',
                    render: function(data, type, row) {
                        // Customize how you want to display the status
                        return `<p id="status-${row.id}">${data}</p>`;
                    }
                },
                {
                    data: 'id',
                    title: 'Action',
                    render: function(data) {
                        return `
                    <p id="action-${data}">
                        <a href="{{ env('WEBSITE_URL') . '#quick-link' }}" target="_blank">
                            <i data-feather="eye" style="width: 20px; height: 20px; color: #6e6b7b  ;"></i>
                        </a>
                        <i class="edit-btn" data-feather="edit" data-id="${data}" style="width: 20px; height: 20px;"></i>
                        <i class="delete-btn" data-feather="delete" data-id="${data}" style="width: 20px; height: 20px;"></i>
                    </p>
                `;
                    }
                }
            ],
            drawCallback: function() {
                feather.replace();
            },
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            order: [
                [0, 'desc']
            ]
        });
        $('#statusFilter').on('change', function() {
            table.ajax.reload(); // Reload table data with the new filter
        });
        $('#imageModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var imageUrl = button.data('image'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-body img').attr('src', imageUrl);
        });
        $(document).on('click', '.edit-btn', function() {
            $('#editForm')[0].reset(); // Reset the form fields
            $('#editForm .form-control, #addForm .form-select').removeClass(
                'error');
            var id = $(this).data('id');
            var title = $('#title-' + id).text();
            var description = $('#description-' + id).text();
            var text = $('#text-' + id).text();
            var status = $('#status-' + id).text(); // Fetch status value
            var url = $('#url-' + id).text();
            var image = $('#image_' + id).val();
            $('#editId').val(id);
            $('#editTitle').val(title);
            $('#editUrl').val(url);
            $('#editStatus').val(status.toLowerCase()); // Set status dropdown
            // Display file information
            $('#editImageName').val(image);
            if (image) {
                var imageUrl = `${baseUrl}/${image}`;
                $('#imgPreview').attr('src', imageUrl).show();
            } else {
                $('#imgPreview').attr('src', '').hide();
            }
            $('#editForm').find('.input-error').removeClass('input-error');
            $('#editForm').find('.error').remove();
            // Show the edit modal
            $('#editModal').modal('show');
        });
        // Initialize form validation
        $("#editForm").validate({
            rules: {
                editUrl: {
                    required: true,
                    minlength: 2,
                    startsWithSlash: true,

                },
                editTitle: {
                    required: true,
                    minlength: 2,
                    noSpecialChars:true,
                    maxlength: 30,


                },
                editImage: {
                    extension: "jpg|jpeg|png" // Allowed image formats
                },
                editStatus: {
                    required: true
                }
            },
            messages: {
                editTitle: {
                    required: "Please enter a title.",
                    minlength: "Title must be at least 2 characters long."
                },
                editDescription: {
                    required: "Please enter a description."
                },
                editText: {
                    required: "Please enter some text."
                },
                editImage: {
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif)."
                },
                editStatus: {
                    required: "Please select a status."
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            errorPlacement: function(error, element) {
                // Customize the placement of the error message
                error.appendTo(element
            .parent()); // This example appends the error message to the parent element
            },
            submitHandler: function(form) {
                // On form validation success, make an AJAX request
                var id = $('#editId').val(); // Get the ID of the record being edited
                $.ajax({
                    url: '{{ route("link.update", ":id") }}'.replace(':id', id),
                    method: 'POST',
                    data: new FormData(form),
                    contentType: false,
                    processData: false,
                    success: function() {
                        $('#editModal').modal('hide');
                        table.ajax.reload(null, false);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
        $(document).on('onchange', 'input, textarea', function() {
            $(this).removeClass(
                'input-error'); // Remove red border and background from the input field on focusout
            $(this).next('.error').remove(); // Remove the error message on focusout
        });
        var deleteUrl = "{{ route('link.destroy', ['id' => '__id__']) }}";
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            var url = deleteUrl.replace('__id__', id); // Replace the placeholder with the actual id
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url, // Use the constructed URL
                        method: 'DELETE',
                        success: function(response) {
                            table.ajax.reload(null, false);
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            );
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the record.',
                                'error'
                            );
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
        $.validator.addMethod("extension", function(value, element, param) {
            // Accepts a comma-separated list of file extensions
            var ext = (value.split('.').pop() || '').toLowerCase();
            return this.optional(element) || $.inArray(ext, param.split('|')) !== -1;
        }, "Invalid file extension.");
        $.validator.addMethod("startsWithSlash", function(value, element) {
            return this.optional(element) || (value.startsWith('/') && !/\s/.test(value));
        }, "The text must start with '/' and cannot contain spaces.");
        // Initialize form validation
        $("#addForm").validate({
            rules: {
                url: {
                    required: true,
                    minlength: 1,
                    startsWithSlash: true,
                    

                },
                title: {
                    required: true,
                    minlength: 2,
                    noSpecialChars:true,
                    maxlength: 30,


                },
                image: {
                    required: true,
                    extension: "jpg|jpeg|png" // Allowed image formats
                },
                status: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "Please enter a title.",
                    minlength: "Title must be at least 2 characters long."
                },
                image: {
                    required: "Please upload an image.",
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif)."
                },
                status: {
                    required: "Please select a status."
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            errorPlacement: function(error, element) {
                // Customize the placement of the error message
                error.appendTo(element
            .parent()); // This example appends the error message to the parent element
            },
            submitHandler: function(form) {
                // On form validation success, make an AJAX request
                $.ajax({
                    url: '{{route("links.store")}}', // Your API endpoint
                    method: 'POST',
                    data: new FormData(form),
                    contentType: false,
                    processData: false,
                    success: function() {
                        $('#addModal').modal('hide');
                        $('.datatables-ajax').DataTable().ajax
                            .reload(); // Refresh DataTable
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
        // Handle keyup event to remove error styling
        // Handle focusout event to remove error styling
        // Add button click handler to clear form and errors
        $(document).ready(function() {
    $('#addButton').click(function() {
        // Reset the form fields
        $('#addForm')[0].reset();

        // Clear and hide image preview
        $('#imgPreviewAddForm').attr('src', '').hide();
        $('#addForm .form-control, #addForm .form-select').removeClass(
            'error'); 
        // Remove error messages and styling
        $('#addForm').find('.error').remove(); // Remove error messages
        $('#addForm').find('.is-invalid').removeClass('is-invalid'); // Remove invalid styling
        $('#addForm').find('.is-valid').removeClass('is-valid'); // Remove valid styling
        
        // Reset form validation state
        $("#addForm").validate().resetForm();

        // Clear file inputs
        $('#addForm').find('input[type="file"]').val('');
        
        // Show the modal
        $('#addModal').modal('show');
    });
});

        // Save button click handler to trigger form submission
        $('#saveAddChanges').click(function() {
            $('#addForm').submit(); // Trigger form validation and submission
        });

        function resetSearchAndReload() {
            table.search(''); // Clear search input field
            // table.ajax.reload(null, false); // Reload table data while keeping pagination intact
        }
        // Trigger the function on page load
        resetSearchAndReload();
        $('#addImage').on('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgPreviewAddForm').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#imgPreviewAddForm').hide();
            }
        });
        $('#editImage').on('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgPreview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#imgPreview').hide();
            }
        });
        
        function handleImageUpload(inputId, previewId, desiredWidth, desiredHeight) {
            document.getElementById(inputId).addEventListener('change', function(event) {
                const file = event.target.files[0];
                const img = new Image();
                const imgPreview = document.getElementById(previewId);
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                    };
                    img.onload = function() {
                        const width = img.width;
                        const height = img.height;
                        if (width !== desiredWidth || height !== desiredHeight) {
                            // Show error with SweetAlert2
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Image Dimensions',
                                text: `The image must be ${desiredWidth}px wide and ${desiredHeight}px high.`,
                                confirmButtonText: 'OK'
                            });
                            document.getElementById(inputId).value = ''; // Reset the file input
                            // Hide image preview and clear src
                            if (imgPreview) {
                                imgPreview.style.display = 'none';
                                imgPreview.src = ''; // Clear src
                            }
                        } else {
                            // Hide error if dimensions are correct
                            // Show image preview
                            if (imgPreview) {
                                imgPreview.src = e.target.result;
                                imgPreview.style.display = 'block';
                            }
                        }
                    };
                    img.onerror = function() {
                        console.error("The image could not be loaded.");
                        Swal.fire({
                            icon: 'error',
                            title: 'Image Load Error',
                            text: 'The image could not be loaded. Please try again.',
                            confirmButtonText: 'OK'
                        });
                        document.getElementById(inputId).value = ''; // Reset the file input
                        // Hide image preview and clear src
                        if (imgPreview) {
                            imgPreview.style.display = 'none';
                            imgPreview.src = ''; // Clear src
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    // No file selected, hide image preview and clear src
                    if (imgPreview) {
                        imgPreview.style.display = 'none';
                        imgPreview.src = ''; // Clear src
                    }
                }
            });
        }
        // Call the function for both inputs
        handleImageUpload('addImage', 'imgPreviewAddForm', 199 , 189);
        handleImageUpload('editImage', 'imgPreview', 199 , 189);

    });
    // Define the base URL with a placeholder for 'id'
</script>

@endsection