@extends('layouts.admin.master')
@section('content')
    @push('page_info')
        <h5 class="mb-0">Members</h5>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Member</li>
            </ul>
        </nav>
    @endpush

    @push('css')
        <style>
            /* Modern Members Create Form Styling */
            .members-create-container {
                background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
                min-height: 100vh;
                padding: 10px 0;
            }

            .modern-card {
                background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
                border: none;
                border-radius: 12px;
                box-shadow: 0 6px 20px rgba(135, 206, 235, 0.1);
                overflow: hidden;
                margin-bottom: 15px;
            }

            .card-header-modern {
                background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
                color: white;
                padding: 15px 18px;
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
                border-radius: 12px 12px 0 0;
            }

            .card-header-modern h4 {
                margin: 0;
                font-weight: 600;
                position: relative;
                z-index: 1;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                font-size: 16px;
            }

            .card-body-modern {
                padding: 15px;
            }

            .modern-form-group {
                margin-bottom: 12px;
            }

            .modern-label {
                color: #333;
                font-weight: 600;
                margin-bottom: 6px;
                display: block;
                font-size: 13px;
            }

            .modern-input {
                width: 100%;
                padding: 10px 12px;
                border: 2px solid rgba(135, 206, 235, 0.2);
                border-radius: 8px;
                font-size: 13px;
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
                padding: 12px;
                border: 2px dashed rgba(135, 206, 235, 0.3);
                border-radius: 8px;
                background: rgba(135, 206, 235, 0.02);
                cursor: pointer;
                transition: all 0.3s ease;
                color: #4682B4;
                font-weight: 500;
                font-size: 13px;
            }

            .file-input-label:hover {
                border-color: #87CEEB;
                background: rgba(135, 206, 235, 0.05);
            }

            .file-input-label i {
                margin-right: 8px;
                font-size: 16px;
            }

            .file-input {
                position: absolute;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            /* Section Styling */
            .form-section {
                background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
                border: 1px solid rgba(135, 206, 235, 0.1);
                border-radius: 10px;
                padding: 12px;
                margin-bottom: 12px;
                box-shadow: 0 3px 12px rgba(135, 206, 235, 0.05);
            }

            .section-title {
                color: #4682B4;
                font-weight: 600;
                margin-bottom: 10px;
                font-size: 13px;
                display: flex;
                align-items: center;
            }

            .section-title i {
                margin-right: 6px;
                color: #87CEEB;
                font-size: 14px;
            }

            /* Submit Button */
            .submit-section {
                text-align: center;
                padding: 15px 0;
                margin-top: 18px;
            }

            .btn-modern-submit {
                padding: 10px 30px;
                border-radius: 25px;
                font-weight: 600;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                position: relative;
                overflow: hidden;
                background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
                color: white;
                box-shadow: 0 4px 15px rgba(135, 206, 235, 0.3);
            }

            .btn-modern-submit:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(135, 206, 235, 0.4);
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

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .members-create-container {
                    padding: 8px 0;
                }

                .card-body-modern {
                    padding: 12px;
                }

                .card-header-modern {
                    padding: 12px 15px;
                }

                .form-section {
                    padding: 10px;
                    margin-bottom: 10px;
                }

                .modern-form-group {
                    margin-bottom: 10px;
                }

                .btn-modern-submit {
                    padding: 8px 25px;
                    font-size: 12px;
                }
            }
        </style>
    @endpush

    <div id="content-page" class="content-page members-create-container">
        <div class="container-fluid">
            @include('layouts.admin.errors')

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="modern-card">
                        <div class="card-header-modern">
                            <h4 class="card-title">
                                <i class="fas fa-user-plus" style="margin-right: 10px;"></i>
                                Add New Member
                            </h4>
                        </div>
                        <div class="card-body-modern">
                            <form action="{{ route('dashboard.members.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Basic Information Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-info-circle"></i>
                                        Basic Information
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Member Name</label>
                                        <input type="text" required="" name="name" class="modern-input"
                                            placeholder="Enter member name">
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Designation</label>
                                        <input type="text" name="designation" class="modern-input" required=""
                                            placeholder="Enter designation">
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Organization</label>
                                        <input type="text" name="bio_graphy" class="modern-input" required=""
                                            placeholder="Enter organization">
                                    </div>
                                </div>

                                <!-- Contact Information Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-address-book"></i>
                                        Contact Information
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="modern-form-group">
                                                <label class="modern-label">Mobile</label>
                                                <input type="text" name="mobile" class="modern-input" required=""
                                                    placeholder="Enter mobile number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="modern-form-group">
                                                <label class="modern-label">Email</label>
                                                <input type="text" name="email" class="modern-input" required=""
                                                    placeholder="Enter email address">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Facebook</label>
                                        <input type="text" name="facebook" class="modern-input" required=""
                                            placeholder="Enter Facebook profile URL">
                                    </div>
                                </div>

                                <!-- Media Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-image"></i>
                                        Profile Image
                                    </div>

                                    <div class="modern-form-group">
                                        <label class="modern-label">Member Image</label>
                                        <div class="file-input-wrapper">
                                            <input type="file" class="file-input" name="image" id="memberImage"
                                                accept="image/*">
                                            <label for="memberImage" class="file-input-label">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span>Choose Profile Image</span>
                                            </label>
                                        </div>
                                        <div id="imagePreview" class="image-preview"
                                            style="display: none; margin-top: 10px;">
                                            <img id="previewImg" src="" alt="Image Preview"
                                                style="max-width: 200px; max-height: 150px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Section -->
                                <div class="submit-section">
                                    <button type="submit" class="btn-modern-submit">
                                        <i class="fas fa-save" style="margin-right: 8px;"></i>
                                        Add Member
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
        <script>
            $(document).ready(function() {
                // Image preview functionality
                $('#memberImage').on('change', function() {
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
    @endpush
@endsection
