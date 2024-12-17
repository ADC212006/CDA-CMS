@extends('app.main')
@section('section')
<!-- BEGIN: Content-->
<style>
    .editor {
        height: 30vh;
        /* Take the full height of the parent */
        /* Optional: Add padding or margins if needed */
    }

    #quillDescription {
        display: none;
        /* Hides the input from view */
    }

    #editQuillDescription {
        display: none;
        /* Hides the input from view */
    }
</style>

</style>
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                    <h4 class="card-title"><button type="button" id="addBanner" class="btn btn-primary"
                                data-toggle="modal" data-target="#addBannerModal">
                                Add New Banner
                            </button></h4>
                        <!-- <h2 class="content-header-title float-start mb-0">Category</h2> -->
                        <!-- <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('slider.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">News & Updates
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
                            <div class="card-datatable p-1">
                                <table class="datatables-ajax table">
                                    <thead>
                                        <tr>
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
<div class="modal fade" id="addBannerModal" tabindex="-1" role="dialog" aria-labelledby="addBannerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="addBannerModalLabel">Add New Banner</h5>
                <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBannerForm" class="row gy-4 gx-3" enctype="multipart/form-data">
                    <div class="col-xl-6 mt-2">
                        <label class="form-label" for="addTitle">Main Heading</label>
                        <input type="text" class="form-control" id="addTitleBanner" name="title" placeholder="Enter title">
                    </div>

                    <div class="col-xl-6 mt-2">
                        <label class="form-label" for="addImage">Image <span style="color:red">*</span></label>
                        <input type="file" class="form-control" id="addImageBanner" name="image" accept="image/*" required>
                    </div>
                    <div class="col-xl-6 mt-2">
                        <label class="form-label" for="addDescription">1st Layer</label>
                        <textarea class="form-control" id="addDescriptionBanner" name="description"
                            placeholder="Enter description"></textarea>
                    </div>
                    <!-- 
                    <div class="col-xl-3 mt-2">
                        <label class="form-label" for="addStatus">Status</label>
                        <select class="form-select" id="addStatus" name="status" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div> -->
                    <div class="col-xl-6 mt-2">
                        <img id="imgPreviewAddBannerForm" class="img-preview mb-2" src="#" alt="Image Preview"
                            style="display: none; max-width: 100%; border: 1px solid #ddd; padding: 5px;">
                    </div>
                    <div class="col-xl-12 text-center mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                        <button type="button" id="saveBannerAddChanges" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                <br>
                <table id="bannersTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Main Heading</th>
                            <th>1st Layer</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>View Banner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated here -->
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <h5 class="modal-title" id="addModalLabel">Add News & Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" class="row gy-2 gx-2" enctype="multipart/form-data">
                    <div class="col-6">
                        <label class="form-label" for="addDate">Date <span style="color:red">*</span></label>
                        <input type="date" class="form-control" id="addDate" name="date" placeholder="addDate" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="addTitle">Title <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="addTitle" name="title" placeholder="Title" required>
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="addSlug">Slug <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="addSlug" name="slug" placeholder="Slug" required
                            readonly>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="addDescription">Description <span style="color:red">*</span></label>
                        <div id="full-wrapper1">
                            <div id="full-container1">
                                <div class="editor" id="addEditor"></div>
                            </div>
                        </div>
                        <p style="color:red;display:none" id="quillDescriptionError"></p>
                        <input type="text" name="description" id="quillDescription">
                    </div>

                    <!-- <div class="col-6 mt-2">
                        <label class="form-label" for="addMainHeading">Article Main Heading</label>
                        <textarea class="form-control" id="addMainHeading" name="addMainHeading" placeholder="Text"
                            required>CDA NEWS ARTICLE</textarea>
                    </div> -->

                    <!-- <div class="col-6 mt-2">
                        <label class="form-label" for="addMainHeadingImage">Image</label>
                        <input type="file" class="form-control" id="addMainHeadingImage" name="addMainHeadingImage"
                            accept="image/*" required>
                    </div> -->
                    <!-- <div class="col-6 mt-2">
                        <img id="addMainHeadingImagePreview" class="img-preview mb-2" src="#" alt="Image Preview"
                            style="display: none; max-width: 100%;">

                    </div> -->
                    <!-- <div class="col-6 mt-2"> -->
                        <!-- <label class="form-label" for="addPageTitle">Add Page Title <span style="color:red">*</span></label> -->
                        <textarea  class="form-control" id="addPageTitle" name="text" placeholder="Text"
                            required style="display: none;">CDA NEWS</textarea>
                    <!-- </div> -->

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
                    <div class="col-6 mt-2">
                        <img id="addImagePreview" class="img-preview mb-2" src="#" alt="Image Preview"
                            style="display: none; max-width: 100%;">

                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                        <button type="submit" id="saveAddChanges" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" class="row gy-2 gx-2" onsubmit="return false">
                    <input type="hidden" id="editId" name="editId">
                    <div class="col-6">
                        <label class="form-label" for="editDate">Date <span style="color:red">*</span></label>
                        <input type="date" class="form-control" id="editDate" name="date" placeholder="editDate" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="editTitle">Title <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="editTitle" name="title" placeholder="Title"
                            required>
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="editSlug">Slug <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="editSlug" name="slug" placeholder="Slug" required
                            readonly>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editDescription">Description <span style="color:red">*</span></label>
                        <div id="full-wrapper1">
                            <div id="full-container1">
                                <div class="editor" id="editEditor"></div>
                            </div>
                        </div>
                        <input type="text" name="description" id="editQuillDescription">
                        <p style="color:red;display:none" id="editQuillDescriptionError"></p>
                    </div>

                    <!-- <div class="col-6 mt-2">
                        <label class="form-label" for="editMainHeading">Article Main Heading</label>
                        <textarea class="form-control" id="editMainHeading" name="editMainHeading" placeholder="Text"
                            required></textarea>
                    </div> -->

                    <!-- <div class="col-6 mt-2">
                        <label class="form-label" for="editMainHeadingImage">Image</label>
                        <input type="file" class="form-control" id="editMainHeadingImage" name="editMainHeadingImage"
                            accept="image/*">
                        <input type="hidden" id="editMainHeadingImageName" name="editMainHeadingImageName"
                            class="form-control">
                    </div> -->
<!-- 
                    <div class="col-6 mt-2">
                        <img id="editMainHeadingImagePreview" class="img-preview mb-2" src="#" alt="Image Preview"
                            style="display: none; max-width: 100%;">
                    </div> -->

                    <!-- <div class="col-6 mt-2"> -->
                        <!-- <label class="form-label" for="editPageTitle">Edit Page Title <span style="color:red">*</span></label> -->
                        <textarea class="form-control" id="editPageTitle" name="text" placeholder="Text"
                            required style="display: none;"></textarea>
                    <!-- </div> -->

                    <div class="col-6 mt-2">
                        <label class="form-label" for="editImage">Image <span style="color:red">*</span></label>
                        <input type="file" class="form-control" id="editImage" name="image" accept="image/*">
                        <input type="hidden" id="editImageName" name="editImageName" class="form-control">
                    </div>

                    

                    <div class="col-6 mt-2">
                        <label class="form-label" for="editStatus">Status <span style="color:red">*</span></label>
                        <select class="form-select" id="editStatus" name="status" required>
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <img id="editImageMainHeadingImagePreview" class="img-preview mb-2" src="#" alt="Image Preview"
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
                <img id="modalImageBanner" src="#" alt="Full Image" style="max-width: 100%; height: auto;">
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
    $('#addTitle').on('input', function() {
        
        const title = $(this).val();
        const slug = generateSlug(title);
        $('#addSlug').val(slug);
    });

    function generateSlug(title) {
        return title
            .toLowerCase() // Convert to lower case
            .trim() // Remove leading and trailing spaces
            .replace(/[^a-z0-9\s-]/g, '') // Remove invalid characters
            .replace(/\s+/g, '-') // Replace spaces with dashes
            .replace(/--+/g, '-'); // Replace multiple dashes with a single dash
    }
    $('#editTitle').on('input', function() {
        const title = $(this).val();
        const slug = generateSlug(title);
        $('#editSlug').val(slug);
    });

    function generateSlug(title) {
        return title
            .toLowerCase() // Convert to lower case
            .trim() // Remove leading and trailing spaces
            .replace(/[^a-z0-9\s-]/g, '') // Remove invalid characters
            .replace(/\s+/g, '-') // Replace spaces with dashes
            .replace(/--+/g, '-'); // Replace multiple dashes with a single dash
    }
    $(document).ready(function() {
        var table = $('.datatables-ajax').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("newsUpdate.fetch") }}', // Adjust to your API endpoint
                dataSrc: 'data', // Adjust based on your server response structure
                data: function(d) {
                    d.status = $('#statusFilter').val(); // Add filter parameter to request data
                }
            },
            stateSave: true,
            initComplete: function(settings, json) {
                $('#example_filter input').val(''); // Clear the search input field visually
                table.ajax.reload(null, false); // Reload data while keeping pagination intact
            },
            columns: [{
                    data: 'id',
                    title: 'ID',
                    render: function(data, type, row) {
                        return `
                        <p id="id-${data}">${data}</p>
                        <p style="display:none" id="add_main_heading-${row.id}">${row.add_main_heading}</p>
                        <p style="display:none" id="text-${row.id}">${row.text}</p>
                        <p style="display:none" id="description-${row.id}">${row.description}</p>
                        <p  style="display:none" id="slug-${row.id}">${row.slug}</p>
                        <input type="hidden" id="add_main_heading_image_${row.id}" value="${row.add_main_heading_image}">
                        <input type="hidden" id="image_${row.id}" value="${row.image}">
                        <input type="hidden" id="fetchDate-${row.id}" value="${row.date}">

                    `;
                    }
                },
                {
                    data: 'title',
                    title: 'Title',
                    render: function(data, type, row) {
                        return `<p id="title-${row.id}">${data}</p>`;
                    }
                },
                // {
                //     data: 'slug',
                //     title: 'Slug',
                //     render: function(data, type, row) {
                //         return `<p id="slug-${row.id}">${data}</p>`;
                //     }
                // },
                // {
                //     data: 'description',
                //     title: 'Description',
                //     render: function(data, type, row) {
                //         return `<p id="description-${row.id}">${data}</p>`;
                //     }
                // },
                // {
                //     data: 'add_main_heading',
                //     title: 'Article Main Heading',
                //     render: function(data, type, row) {
                //         return `<p  id="add_main_heading-${row.id}">${data}</p>`;
                //     }
                // },
                // {
                //     data: 'text',
                //     title: 'Text',
                //     render: function(data, type, row) {
                //         return `<p  id="text-${row.id}">${data}</p>`;
                //     }
                // },
                {
                    data: 'status',
                    title: 'Status',
                    render: function(data, type, row) {
                        // Customize how you want to display the status
                        return `<p id="status-${row.id}">${data}</p>`;
                    }
                },
                // {
                //     data: 'add_main_heading_image',
                //     title: 'Article Main Heading Image',
                //     render: function(data, type, row) {
                //         var imageUrl =
                //             `${baseUrl}/${data}`; // Adjust URL based on your storage path
                //         console.log(baseUrl);
                //         return `
                //             <div class="img-thumbnail-wrapper">
                //                 <input type="hidden" id="add_main_heading_image_${row.id}" value="${data}">
                //                 <img data-bs-toggle="modal" data-bs-target="#imageModal" data-image="${imageUrl}" src="${imageUrl}" alt="Thumbnail" height="50px" width="100px">
                //                 <div class="overlay" id="image-viewer" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="${imageUrl}">
                //                     <span class="text">Click to view image</span>
                //                 </div>
                //             </div>
                //         `;
                //     }
                // },
                // {
                //     data: 'image',
                //     title: 'Image',
                //     render: function(data, type, row) {
                //         var imageUrl =
                //             `${baseUrl}/${data}`; // Adjust URL based on your storage path
                //         return `
                //             <div class="img-thumbnail-wrapper">
                //                 <input type="hidden" id="image_${row.id}" value="${data}">
                //                 <img data-bs-toggle="modal" data-bs-target="#imageModal" data-image="${imageUrl}" src="${imageUrl}" alt="Thumbnail" height="50px" width="100px">
                //                 <div class="overlay" id="image-viewer" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="${imageUrl}">
                //                     <span class="text">Click to view image</span>
                //                 </div>
                //             </div>
                //         `;
                //     }
                // },
                {
                    data: 'id',
                    title: 'Action',
                    render: function(data) {
                        return `
                            <p id="action-${data}">
                                 <a href="{{ env('WEBSITE_URL') . '#news-and-update' }}" target="_blank">
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
        // var quillEdit = new Quill('#editEditor', {
        //     theme: 'snow',
        // });
        // function setQuillContent(html) {
        //     quillEdit.root.innerHTML = html;
        // }
        // Example of setting content
        $(document).on('click', '.edit-btn', function() {
            $('#editForm')[0].reset(); // Reset the form fields
            var id = $(this).data('id');
            var title = $('#title-' + id).text();
            var slug = $('#slug-' + id).text();
            var date = $('#fetchDate-' + id).val();

            var description = $('#description-' + id).text();
            var text = $('#text-' + id).text();
            var add_main_heading = $('#add_main_heading-' + id).text();
            var status = $('#status-' + id).text(); // Fetch status value
            var url = $('#url-' + id).text();
            var image = $('#add_main_heading_image_' + id).val();
            var image2 = $('#image_' + id).val();
            $('#editId').val(id);
            $('#editTitle').val(title);
            $('#editSlug').val(slug);
            $('#editMainHeading').val(add_main_heading);
            // $('#editEditor').text(description);
            // setQuillContent(description);
            quillEdit.root.innerHTML = description;
            $('#editPageTitle').text(text);
         
            $('#editDate').val(date);
            $('#editUrl').val(url);
            $('#editStatus').val(status.toLowerCase()); // Set status dropdown
            // Display file information
            // $('#editMainHeadingImagePreview').val(image);
            if (image) {
                var imageUrl = `${baseUrl}/${image}`;
                $('#editMainHeadingImagePreview').attr('src', imageUrl).show();
                $('#editMainHeadingImageName').val(image);
            } else {
                $('#editMainHeadingImagePreview').attr('src', '').hide();
            }
            if (image2) {
                var imageUrl = `${baseUrl}/${image2}`;
                $('#editImageMainHeadingImagePreview').attr('src', imageUrl).show();
                $('#editImageName').val(image2);
            } else {
                $('#editImageMainHeadingImagePreview').attr('src', '').hide();
            }
            $('#editForm').find('.input-error').removeClass('input-error');
            $('#editForm').find('.error').remove();
            // Show the edit modal
            $('#editModal').modal('show');
        });
        // Initialize form validation
        $("#editForm").validate({
            rules: {
                date: {
                    required: true
                },
                title: {
                    required: true,
                    noSpecialChars:true,
                    maxlength: 150,

                },
                slug: {
                    required: true
                },
                description: {
                    required: true
                },
                editMainHeading: {
                    required: true
                },
                editMainHeadingImage: {
                    extension: "jpg|jpeg|png"
                },
                editPageTitle: {
                    required: true
                },
                image: {
                    extension: "jpg|jpeg|png"
                },
                status: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "Please enter a title."
                },
                slug: {
                    required: "Please enter a slug."
                },
                description: {
                    required: "Please enter a description."
                },
                editMainHeading: {
                    required: "Please enter the main heading text."
                },
                editMainHeadingImage: {
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif)."
                },
                editPageTitle: {
                    required: "Please enter the page title."
                },
                image: {
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
                // Set Quill editor content to hidden input
                $('#editQuillDescription').val(quillEdit.root.innerHTML);
                // Get the ID of the record being edited
                if ($('#editQuillDescription').val() == '<p><br></p>' || $('#editQuillDescription')
                    .val() == null) {
                    $('#editQuillDescriptionError').append('This field is requied');
                    $('#editQuillDescriptionError').show();
                } else {
                    $('#editQuillDescriptionError').append('');
                    $('#editQuillDescriptionError').hide();
                    var id = $('#editId').val();
                    // AJAX request to update the slider
                    $.ajax({
                        url: '{{ route("newsupdate.update", ":id") }}'.replace(':id', id),
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
            }
        });
        $(document).on('onchange', 'input, textarea', function() {
            $(this).removeClass(
                'input-error'); // Remove red border and background from the input field on focusout
            $(this).next('.error').remove(); // Remove the error message on focusout
        });
        var deleteUrl = "{{ route('newsupdate.destroy', ['id' => '__id__']) }}";
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
        $.validator.addMethod("notEmptyHTML", function(value, element) {
            return $(element).val().trim().length > 0;
        }, "Please enter a description.");
        // Initialize form validation
        $("#addForm").validate({
            rules: {
                date:{
                    required: true,
                    
                },
                title: {
                    required: true,
                    minlength: 2,
                    maxlength: 150,

                    noSpecialChars:true,

                },
                slug: {
                    required: true
                },
                description: {
                    notEmptyHTML: true
                },
                addMainHeading: {
                    required: true
                },
                addMainHeadingImage: {
                    required: true,
                    extension: "jpg|jpeg|png" // Allowed image formats
                },
                text: {
                    required: true
                },
                addImage: {
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
                slug: {
                    required: "Please enter a slug."
                },
                description: {
                    notEmptyHTML: "Please enter a description."
                },
                addMainHeading: {
                    required: "Please enter the article's main heading."
                },
                addMainHeadingImage: {
                    required: "Please upload an image.",
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif)."
                },
                text: {
                    required: "Please enter some text."
                },
                addImage: {
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
                // Handle form submission via AJAX
                if ($('#quillDescription').val() == '<p><br></p>' || $('#quillDescription').val() ==
                    null) {
                    $('#quillDescriptionError').append('This field is requied');
                    $('#quillDescriptionError').show();
                } else {
                    $('#quillDescriptionError').append('');
                    $('#quillDescriptionError').hide();
                    $.ajax({
                        url: '{{route("news.store")}}', // Your API endpoint
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
            }
        });
        $('#addBanner').click(function() {
            $('#addForm')[0].reset(); // Reset the form
            $('#addForm').find('.input-error').removeClass('input-error'); // Remove error styling
            $('#addForm').find('.error').remove(); // Remove error messages
            $(".error").removeClass("error");
            $("#addForm").validate().resetForm();
            $(".is-valid").removeClass("is-valid");
            $(".is-invalid").removeClass("is-invalid");
            $('#addBannerModal').modal('show'); // Show the modal
        });
        // Handle keyup event to remove error styling
        // Handle focusout event to remove error styling
        // Add button click handler to clear form and errors
        $('#addButton').click(function() {
            $('#addForm')[0].reset(); // Reset the form
            $('#addForm .form-control, #addForm .form-select').removeClass(
                'error'); 
            $('#addForm').find('.input-error').removeClass('input-error'); // Remove error styling
            $('#addForm').find('.error').remove(); // Remove error messages
            $(".error").removeClass("error");
            $("#addForm").validate().resetForm();
            $(".is-valid").removeClass("is-valid");
            $(".is-invalid").removeClass("is-invalid");
            quillAdd.root.innerHTML = ''; // Clear Quill editor content

            $('#addModal').modal('show'); // Show the modal
        });
        // Save button click handler to trigger form submission
        function resetSearchAndReload() {
            table.search(''); // Clear search input field
            // table.ajax.reload(null, false); // Reload table data while keeping pagination intact
        }
        // Trigger the function on page load
        resetSearchAndReload();
    });
    var quillAdd = new Quill('#addEditor', {
        theme: 'snow'
    });
    quillAdd.on('text-change', function() {
        // Update hidden input with Quill editor's HTML content
        document.getElementById('quillDescription').value = quillAdd.root.innerHTML;
    });
    // Initialize Quill editor for editing
    var quillEdit = new Quill('#editEditor', {
        theme: 'snow'
    });
    quillEdit.on('text-change', function() {
        // Update hidden input with Quill editor's HTML content
        document.getElementById('editQuillDescription').value = quillEdit.root.innerHTML;
    });
    // Define the base URL with a placeholder for 'id'
    $('#addImage').on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#addImagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#addImagePreview').hide();
        }
    });
    $('#addMainHeadingImage').on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#addMainHeadingImagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#addMainHeadingImagePreview').hide();
        }
    });
    $('#editMainHeadingImage').on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#editMainHeadingImagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#editMainHeadingImagePreview').hide();
        }
    });
    $('#editImage').on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#editImageMainHeadingImagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#editImageMainHeadingImagePreview').hide();
        }
    });
    $("#addBannerForm").validate({
            rules: {
                title: {
                    required: false,
                    minlength: 2,
                    noSpecialChars:true,
                    maxlength: 50,

                },
                description: {
                    required: false,
                    maxlength: 100,
                },
                image: {
                    required: true,
                    extension: "jpg|jpeg|png" // Allowed image formats
                },
                status: {
                    required: false
                }
            },
            messages: {
                title: {
                    minlength: "Title must be at least 2 characters long."
                },
                image: {
                    required: "Please upload an image.",
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif, svg)."
                },
                status: {
                    required: "Please select a status."
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
            },
            submitHandler: function(form) {
                $.ajax({
                    url: '{{ route("newsupdate.banner.store") }}',
                    method: 'POST',
                    data: new FormData(form),
                    contentType: false,
                    processData: false,
                    success: function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Public notice banner created successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        fetchBanners();
                    },
                    error: function(xhr) {
                        let errorMessage =
                            'An unexpected error occurred. Please try again later.';
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON
                            .errors) {
                            const errors = xhr.responseJSON.errors;
                            errorMessage = '<div style="text-align: left;">' +
                                Object.keys(errors).map(field =>
                                    `<strong>${field}:</strong> ${errors[field].join(' ')}`
                                ).join('<br>') +
                                '</div>';
                        } else if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = `<p>${xhr.responseJSON.error}</p>`;
                        }
                        Swal.fire({
                            html: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
        $('#saveBannerAddChanges').on('click', function() {
            $('#addBannerForm').submit();
        });
        // Function to fetch banners via AJAX
        function fetchBanners() {
            $.ajax({
                url: '{{ route("newsupdate.banner.get") }}', // Replace with your route if necessary
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        var banners = response.data;
                        var tableBody = $('#bannersTable tbody');
                        tableBody.empty(); // Clear the table body
                        // Populate the table with banners
                        $.each(banners, function(index, banner) {
                            var imageUrl = `${baseUrl}/${banner.image}`;
                            var row = `
                            <tr>
                                <td>${banner.title || 'N/A'}</td>
                                <td>${banner.description || 'N/A'}</td>
                                <td><img id="bannerImage" class="image-preview" data-image-url="${imageUrl}" src="${imageUrl}" alt="Banner Image" style="max-width: 100px; cursor: pointer;"></td>
                                <td>${banner.status}</td>
                                 <td><a href="{{ env('WEBSITE_URL')  }}newsRelease" target="_blank">
                                    <i data-feather="eye" style="width: 20px; height: 20px; color: #6e6b7b  ;"></i>
                                </a></td>
                                
                            </tr>
                        `;
                            tableBody.append(row);
                        });
                    } else {
                        console.error('Failed to retrieve banners:', response.message);
                    }
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            });
        }
        // Call fetchBanners function on document ready or any event you prefer
        fetchBanners();
        $('#addBannerForm #addImageBanner').on('change', function(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgPreviewAddBannerForm').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else {
                // Hide the image preview if no file is selected
                $('#imgPreviewAddBannerForm').hide();
            }
        });
        $('#bannersTable').on('click', '.image-preview', function() {
            var imageUrl = $(this).attr('src'); // Get the image URL from the src attribute
            $('#modalImageBanner').attr('src', imageUrl); // Set the image URL in the modal
            $('#imageModal').modal('show'); // Show the modal
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
        handleImageUpload('addImageBanner', 'imgPreviewAddBannerForm', 1920, 702);
</script>

@endsection