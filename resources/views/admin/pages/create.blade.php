@extends('layouts.admin.master')
@section('content')
    @push('page_info')
        <h5 class="mb-0">Pages</h5>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Page</li>
            </ul>
        </nav>
    @endpush
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <style>
            /* Modern Page Create Form Styling */
            .page-create-container {
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
                padding: 40px;
                background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
            }

            .modern-form-group {
                margin-bottom: 30px;
            }

            .modern-label {
                color: #333;
                font-weight: 600;
                margin-bottom: 10px;
                display: block;
                font-size: 16px;
                letter-spacing: 0.5px;
            }

            .modern-input {
                width: 100%;
                padding: 15px 20px;
                border: 2px solid rgba(135, 206, 235, 0.2);
                border-radius: 12px;
                font-size: 16px;
                transition: all 0.3s ease;
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
            }

            .modern-input:focus {
                border-color: #87CEEB;
                box-shadow: 0 0 0 3px rgba(135, 206, 235, 0.1);
                outline: none;
                background: #ffffff;
            }

            .modern-textarea {
                width: 100%;
                padding: 15px 20px;
                border: 2px solid rgba(135, 206, 235, 0.2);
                border-radius: 12px;
                font-size: 16px;
                transition: all 0.3s ease;
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
                min-height: 150px;
                resize: vertical;
            }

            .modern-textarea:focus {
                border-color: #87CEEB;
                box-shadow: 0 0 0 3px rgba(135, 206, 235, 0.1);
                outline: none;
                background: #ffffff;
            }

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

                .modern-form-group {
                    margin-bottom: 20px;
                }

                .btn-modern-submit {
                    padding: 12px 40px;
                    font-size: 14px;
                }
            }
        </style>
    @endpush

    <div id="content-page" class="content-page page-create-container">
        <div class="container-fluid">
            @include('layouts.admin.errors')

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="modern-card">
                        <div class="card-header-modern">
                            <h4 class="card-title">
                                <i class="fas fa-plus-circle" style="margin-right: 10px;"></i>
                                Create New Page
                            </h4>
                        </div>
                        <div class="card-body-modern">
                            <form action="{{ route('dashboard.pages.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="modern-form-group">
                                    <label class="modern-label">
                                        <i class="fas fa-heading" style="margin-right: 8px; color: #87CEEB;"></i>
                                        Page Title *
                                    </label>
                                    <input type="text" class="modern-input" name="page_title"
                                        placeholder="Enter your page title" required>
                                </div>

                                <div class="modern-form-group">
                                    <label class="modern-label">
                                        <i class="fas fa-edit" style="margin-right: 8px; color: #87CEEB;"></i>
                                        Page Content *
                                    </label>
                                    <textarea name="content" class="modern-textarea summernote" placeholder="Write your page content here..." required></textarea>
                                </div>

                                <div class="submit-section">
                                    <button type="submit" class="btn-modern-submit">
                                        <i class="fas fa-save" style="margin-right: 8px;"></i>
                                        Create Page
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.summernote').summernote({
                    placeholder: 'Write your page content here...',
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
            });
        </script>
    @endpush
@endsection
