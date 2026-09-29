@extends('layouts.admin.master')
@section('content')
    @push('page_info')
        <h5 class="mb-0">Projects</h5>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Project</li>
            </ul>
        </nav>
    @endpush
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <style>
            /* Modern Projects Create Form Styling */
            .projects-create-container {
                background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
                min-height: 100vh;
                padding: 20px 0;
            }

            .modern-card {
                background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
                border: none;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(135, 206, 235, 0.1);
                overflow: hidden;
                margin-bottom: 30px;
            }

            .card-header-modern {
                background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
                color: white;
                padding: 25px;
                border: none;
                position: relative;
            }

            .card-header-modern::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 20px 20px 0 0;
            }

            .card-header-modern h4 {
                margin: 0;
                font-weight: 600;
                position: relative;
                z-index: 1;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            }

            .card-body-modern {
                padding: 30px;
            }

            .modern-form-group {
                margin-bottom: 20px;
            }

            .modern-label {
                color: #333;
                font-weight: 600;
                margin-bottom: 8px;
                display: block;
                font-size: 14px;
            }

            .modern-input,
            .modern-textarea,
            .modern-select {
                width: 100%;
                padding: 12px 15px;
                border: 2px solid rgba(135, 206, 235, 0.2);
                border-radius: 10px;
                font-size: 14px;
                transition: all 0.3s ease;
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
            }

            .modern-input:focus,
            .modern-textarea:focus,
            .modern-select:focus {
                border-color: #87CEEB;
                box-shadow: 0 0 0 3px rgba(135, 206, 235, 0.1);
                outline: none;
                background: #ffffff;
            }

            .input-group-text {
                border: 2px solid rgba(135, 206, 235, 0.2) !important;
                border-right: none !important;
                background: rgba(135, 206, 235, 0.05) !important;
                color: #4682B4 !important;
                font-weight: 600 !important;
            }

            /* File Input Styling */
            .file-input-wrapper {
                position: relative;
                display: inline-block;
                width: 100%;
            }

            .file-input-label {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                border: 2px dashed rgba(135, 206, 235, 0.3);
                border-radius: 12px;
                background: rgba(135, 206, 235, 0.02);
                cursor: pointer;
                transition: all 0.3s ease;
                color: #4682B4;
                font-weight: 500;
            }

            .file-input-label:hover {
                border-color: #87CEEB;
                background: rgba(135, 206, 235, 0.05);
            }

            .file-input-label i {
                margin-right: 10px;
                font-size: 20px;
            }

            .file-input {
                position: absolute;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            /* Radio Button Styling */
            .radio-group {
                display: flex;
                gap: 20px;
                margin-top: 8px;
            }

            .radio-option {
                display: flex;
                align-items: center;
                cursor: pointer;
                padding: 8px 12px;
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .radio-option:hover {
                background: rgba(135, 206, 235, 0.05);
            }

            .radio-option input[type="radio"] {
                margin-right: 8px;
                accent-color: #87CEEB;
            }

            .radio-option label {
                margin: 0;
                cursor: pointer;
                color: #333;
                font-weight: 500;
            }

            /* Checkbox Styling */
            .checkbox-group {
                display: flex;
                align-items: center;
                margin-top: 8px;
            }

            .checkbox-group input[type="checkbox"] {
                margin-right: 10px;
                width: 18px;
                height: 18px;
                accent-color: #87CEEB;
            }

            .checkbox-group label {
                margin: 0;
                cursor: pointer;
                color: #333;
                font-weight: 500;
            }

            /* Section Styling */
            .form-section {
                background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
                border: 1px solid rgba(135, 206, 235, 0.1);
                border-radius: 15px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 4px 15px rgba(135, 206, 235, 0.05);
            }

            .section-title {
                color: #4682B4;
                font-weight: 600;
                margin-bottom: 15px;
                font-size: 16px;
                display: flex;
                align-items: center;
            }

            .section-title i {
                margin-right: 8px;
                color: #87CEEB;
            }

            /* Submit Button */
            .submit-section {
                text-align: center;
                padding: 30px 0;
                margin-top: 40px;
            }

            .btn-modern-submit {
                padding: 15px 50px;
                border-radius: 50px;
                font-weight: 600;
                font-size: 16px;
                text-transform: uppercase;
                letter-spacing: 1px;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                position: relative;
                overflow: hidden;
                background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
                color: white;
                box-shadow: 0 8px 25px rgba(135, 206, 235, 0.3);
            }

            .btn-modern-submit:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 35px rgba(135, 206, 235, 0.4);
            }

            .btn-modern-submit::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s;
            }

            .btn-modern-submit:hover::before {
                left: 100%;
            }

            /* Summernote customization */
            .note-editor {
                border: 2px solid rgba(135, 206, 235, 0.2) !important;
                border-radius: 12px !important;
                box-shadow: none !important;
            }

            .note-editor.note-frame {
                box-shadow: 0 4px 15px rgba(135, 206, 235, 0.1) !important;
            }

            .note-toolbar {
                background: linear-gradient(135deg, #f8f9ff 0%, #e6f3ff 100%) !important;
                border-bottom: 1px solid rgba(135, 206, 235, 0.2) !important;
                border-radius: 12px 12px 0 0 !important;
            }

            .note-editing-area .note-editable {
                background: #ffffff !important;
                border-radius: 0 0 12px 12px !important;
                min-height: 200px !important;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .card-body-modern {
                    padding: 20px;
                }

                .form-section {
                    padding: 20px;
                }

                .radio-group {
                    flex-direction: column;
                    gap: 10px;
                }

                .btn-modern-submit {
                    padding: 12px 40px;
                    font-size: 14px;
                }
            }
        </style>
    @endpush

    <div id="content-page" class="content-page projects-create-container">
        <div class="container-fluid">
            @include('layouts.admin.errors')

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="modern-card">
                        <div class="card-header-modern">
                            <h4 class="card-title">
                                <i class="fas fa-project-diagram" style="margin-right: 10px;"></i>
                                Project Post
                            </h4>
                        </div>
                        <div class="card-body-modern">
                            <form action="{{ route('dashboard.projects.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Media Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-image"></i>
                                        Media & Gallery
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Image</label>
                                        <div class="file-input-wrapper">
                                            <input type="file" class="file-input" name="image" id="projectImage"
                                                accept="image/*">
                                            <label for="projectImage" class="file-input-label">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span>Choose Project Image</span>
                                            </label>
                                        </div>
                                        <div id="imagePreview" class="image-preview"
                                            style="display: none; margin-top: 10px;">
                                            <img id="previewImg" src="" alt="Image Preview"
                                                style="max-width: 200px; max-height: 150px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                        </div>
                                    </div>

                                    <div class="modern-form-group">
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="gallery" name="gallery">
                                            <label for="gallery">Gallery</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status & Visibility Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-toggle-on"></i>
                                        Status & Visibility
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Status</label>
                                        <div class="radio-group">
                                            <div class="radio-option">
                                                <input type="radio" required="" name="status" value="1" checked
                                                    id="status-published">
                                                <label for="status-published">Published</label>
                                            </div>
                                            <div class="radio-option">
                                                <input type="radio" required="" value="0" name="status"
                                                    id="status-draft">
                                                <label for="status-draft">Save as draft</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Side Ber Visiblity</label>
                                        <div class="radio-group">
                                            <div class="radio-option">
                                                <input type="radio" required="" name="sideber" value="Yes"
                                                    id="sidebar-yes">
                                                <label for="sidebar-yes">Yes</label>
                                            </div>
                                            <div class="radio-option">
                                                <input type="radio" required="" name="sideber" value="No"
                                                    id="sidebar-no">
                                                <label for="sidebar-no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Project Hierarchy Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-sitemap"></i>
                                        Project Hierarchy
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="modern-form-group">
                                                <label class="modern-label">Parent Project</label>
                                                <select name="parent" id="ParentCat" class="modern-select">
                                                    <option value="">Parent</option>
                                                    @php
                                                        $gparent = \App\Project::where('parent', 0)
                                                            ->where('menu', 1)
                                                            ->where('order', '!=', 0)
                                                            ->orderBy('order', 'asc')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($gparent as $item)
                                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="modern-form-group" id="ResultShow">
                                                <label class="modern-label">Sub Project</label>
                                                <select name="subcat" id="SubCategory" class="modern-select">
                                                    <option value="">-- Select Project --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="modern-form-group" id="SubSubCategory">
                                                <label class="modern-label">Sub Sub Project</label>
                                                <select class="modern-select">
                                                    <option value="">--Sub Sub Project--</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Basic Information Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-info-circle"></i>
                                        Basic Information
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="modern-form-group">
                                                <label class="modern-label">Project Title</label>
                                                <input type="text" required="" id="ProjectTitle" name="title"
                                                    value="" class="modern-input"
                                                    placeholder="Enter project title">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="modern-form-group">
                                                <label class="modern-label">Project Sub Title</label>
                                                <input type="text" id="ProjectSubTitle" name="sub_title"
                                                    value="" class="modern-input"
                                                    placeholder="Enter project subtitle">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="modern-form-group">
                                                <label class="modern-label">Project Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                            style="background: rgba(135, 206, 235, 0.1); border: 2px solid rgba(135, 206, 235, 0.2); color: #4682B4; font-weight: 600;">$</span>
                                                    </div>
                                                    <input type="number" name="price" value=""
                                                        class="modern-input" placeholder="0.00" min="0"
                                                        step="0.01" style="border-left: none;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="modern-form-group">
                                                <label class="modern-label">Is it Go Menu?</label>
                                                <div style="display: flex; gap: 20px; margin-top: 8px;">
                                                    <div class="checkbox-group">
                                                        <input class="form-check-input" type="checkbox" name="menu"
                                                            id="inlineCheckbox1" value="1">
                                                        <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                                    </div>
                                                    <div class="checkbox-group">
                                                        <input class="form-check-input" type="checkbox" name="menu"
                                                            id="inlineCheckbox2" value="0">
                                                        <label class="form-check-label" for="inlineCheckbox2">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-edit"></i>
                                        Content
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Short Desc</label>
                                        <textarea name="short_desc" class="modern-textarea" placeholder="Enter short description" rows="3"></textarea>
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Description</label>
                                        <textarea name="description" class="modern-textarea summernote" placeholder="Enter detailed project description"></textarea>
                                    </div>
                                </div>

                                <!-- Submit Section -->
                                <div class="submit-section">
                                    <button type="submit" class="btn-modern-submit">
                                        <i class="fas fa-save" style="margin-right: 8px;"></i>
                                        Submit
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.summernote').summernote({
                    placeholder: 'Enter detailed project description...',
                    tabsize: 2,
                    height: 250,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'help']]
                    ]
                });

                // Image preview functionality
                $('#projectImage').on('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $('#previewImg').attr('src', e.target.result);
                            $('#imagePreview').show();
                        };
                        reader.readAsDataURL(file);
                    } else {
                        $('#imagePreview').hide();
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#ParentCat").change(function() {
                    var parent = $(this).val();
                    if (parent) {
                        jQuery.ajax({
                            type: 'POST',
                            dataType: 'JSON',
                            data: 'id=' + parent,
                            url: "{{ route('dashboard.subcategory') }}",
                            success: function(response) {
                                //console.log(response);
                                if (response) {
                                    $('select[name="subcat"]').empty();
                                    $('#SubCategory').append(
                                        '<option value="">-- Select Project --</option>');
                                    $.each(response, function(key, value) {
                                        $('select[name="subcat"]').append(
                                            '<option value="' + value.id + '">' + value
                                            .title + '</option>');
                                    });
                                } else {
                                    $('#ResultShow').empty();
                                }
                            }
                        });
                    } else {
                        $('#city').empty();
                    }
                });

                $("#SubCategory").change(function() {
                    var subcat = $(this).val();
                    jQuery.ajax({
                        type: 'POST',
                        data: 'subcat=' + subcat,
                        url: "{{ route('dashboard.subcategory') }}",
                        success: function(data) {
                            jQuery('#SubSubCategory').html(data);
                            //jQuery('#ResultShow').multiselect('multiselect');
                        }
                    });
                });
            });
        </script>
        <script>
            //$(document).ready(function(){

            //});
        </script>
    @endpush
@endsection
