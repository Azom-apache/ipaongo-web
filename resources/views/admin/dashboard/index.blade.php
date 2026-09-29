@extends('layouts.admin.master')
@section('content')
    @push('page_info')
        <h5 class="mb-0">Dashboard</h5>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ul>
        </nav>
    @endpush

    @push('css')
        <style>
            .dashboard-card {
                transition: all 0.3s ease;
                border: none;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                height: 100px;
                display: flex;
                align-items: center;
            }

            .dashboard-card .card-body {
                padding: 1rem 0.5rem;
            }

            .dashboard-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            }

            .card-icon {
                font-size: 2rem;
                opacity: 0.8;
            }

            .count-number {
                font-size: 1.6rem;
                font-weight: bold;
                margin-bottom: 0;
            }

            .card-title {
                font-size: 0.8rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 3px;
            }

            .stats-section {
                margin-bottom: 2rem;
            }

            .section-title {
                font-size: 1.2rem;
                font-weight: 600;
                color: #495057;
                margin-bottom: 1rem;
                border-bottom: 2px solid #e9ecef;
                padding-bottom: 0.5rem;
            }

            .gradient-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .gradient-success {
                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                color: white;
            }

            .gradient-info {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .gradient-warning {
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                color: white;
            }

            .gradient-danger {
                background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
                color: white;
            }

            .gradient-secondary {
                background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
                color: #495057;
            }

            .gradient-dark {
                background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
                color: white;
            }

            .recent-activity {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border-radius: 15px;
                padding: 2rem;
                margin-bottom: 2rem;
            }

            .activity-item {
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
                padding: 1rem;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                backdrop-filter: blur(10px);
            }

            .activity-icon {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                font-size: 1.2rem;
            }
        </style>
    @endpush

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <!-- Recent Activity Section -->
            <div class="recent-activity">
                <h4 class="mb-4"><i class="fas fa-chart-line"></i> Recent Activity (Last 7 Days)</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="activity-item">
                            <div class="activity-icon gradient-success">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $data['recent_users'] }}</h5>
                                <small>New Users</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="activity-item">
                            <div class="activity-icon gradient-primary">
                                <i class="fas fa-blog"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $data['recent_blogs'] }}</h5>
                                <small>New Blogs</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="activity-item">
                            <div class="activity-icon gradient-info">
                                <i class="fas fa-blog"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $data['recent_blogs'] }}</h5>
                                <small>New Blogs</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Management Section -->
            <div class="stats-section">
                <h5 class="section-title"><i class="fas fa-users-cog"></i> User Management</h5>
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card dashboard-card gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-users card-icon"></i>
                                <p class="card-title">Total Users</p>
                                <p class="count-number">{{ number_format($data['total_users']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card dashboard-card gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-user-shield card-icon"></i>
                                <p class="card-title">Admins</p>
                                <p class="count-number">{{ number_format($data['total_admins']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card dashboard-card gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-user-friends card-icon"></i>
                                <p class="card-title">Members</p>
                                <p class="count-number">{{ number_format($data['total_members']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card dashboard-card gradient-secondary">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-day card-icon"></i>
                                <p class="card-title">Today Users</p>
                                <p class="count-number">{{ number_format($data['today_users']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Management Section -->
            <div class="stats-section">
                <h5 class="section-title"><i class="fas fa-newspaper"></i> Content Management</h5>
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-blog card-icon"></i>
                                <p class="card-title">Blogs</p>
                                <p class="count-number">{{ number_format($data['total_blogs']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-newspaper card-icon"></i>
                                <p class="card-title">News</p>
                                <p class="count-number">{{ number_format($data['total_news']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-briefcase card-icon"></i>
                                <p class="card-title">Jobs</p>
                                <p class="count-number">{{ number_format($data['total_jobs']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-ad card-icon"></i>
                                <p class="card-title">Advertisements</p>
                                <p class="count-number">{{ number_format($data['total_advertisements']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-danger">
                            <div class="card-body text-center">
                                <i class="fas fa-project-diagram card-icon"></i>
                                <p class="card-title">Projects</p>
                                <p class="count-number">{{ number_format($data['total_projects']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-secondary">
                            <div class="card-body text-center">
                                <i class="fas fa-images card-icon"></i>
                                <p class="card-title">Gallery</p>
                                <p class="count-number">{{ number_format($data['total_galleries']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card"
                            style="background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%); color: white;">
                            <div class="card-body text-center">
                                <i class="fas fa-video card-icon"></i>
                                <p class="card-title">Videos</p>
                                <p class="count-number">{{ number_format($data['total_videos']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card"
                            style="background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%); color: white;">
                            <div class="card-body text-center">
                                <i class="fas fa-bell card-icon"></i>
                                <p class="card-title">Notices</p>
                                <p class="count-number">{{ number_format($data['total_notices']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card"
                            style="background: linear-gradient(135deg, #3f51b5 0%, #303f9f 100%); color: white;">
                            <div class="card-body text-center">
                                <i class="fas fa-percent card-icon"></i>
                                <p class="card-title">Offers</p>
                                <p class="count-number">{{ number_format($data['total_offers']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card"
                            style="background: linear-gradient(135deg, #009688 0%, #00695c 100%); color: white;">
                            <div class="card-body text-center">
                                <i class="fas fa-sliders-h card-icon"></i>
                                <p class="card-title">Sliders</p>
                                <p class="count-number">{{ number_format($data['total_sliders']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card"
                            style="background: linear-gradient(135deg, #795548 0%, #5d4037 100%); color: white;">
                            <div class="card-body text-center">
                                <i class="fas fa-file-alt card-icon"></i>
                                <p class="card-title">Pages</p>
                                <p class="count-number">{{ number_format($data['total_pages']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Community Section -->
            <div class="stats-section">
                <h5 class="section-title"><i class="fas fa-users"></i> Community</h5>
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-question-circle card-icon"></i>
                                <p class="card-title">Q&A</p>
                                <p class="count-number">{{ number_format($data['total_question_answers']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-users-cog card-icon"></i>
                                <p class="card-title">Committees</p>
                                <p class="count-number">{{ number_format($data['total_committees']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-building card-icon"></i>
                                <p class="card-title">Departments</p>
                                <p class="count-number">{{ number_format($data['total_departments']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-danger">
                            <div class="card-body text-center">
                                <i class="fas fa-tint card-icon"></i>
                                <p class="card-title">Blood Donors</p>
                                <p class="count-number">{{ number_format($data['total_blood_donors']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-store card-icon"></i>
                                <p class="card-title">Bikroy</p>
                                <p class="count-number">{{ number_format($data['total_bikroys']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-secondary">
                            <div class="card-body text-center">
                                <i class="fas fa-bullhorn card-icon"></i>
                                <p class="card-title">Ads</p>
                                <p class="count-number">{{ number_format($data['total_ads']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory & Location Section -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="stats-section">
                        <h5 class="section-title"><i class="fas fa-warehouse"></i> Inventory</h5>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card dashboard-card gradient-primary">
                                    <div class="card-body text-center">
                                        <i class="fas fa-boxes card-icon"></i>
                                        <p class="card-title">Total Stock</p>
                                        <p class="count-number">{{ number_format($data['total_stocks']) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card dashboard-card gradient-danger">
                                    <div class="card-body text-center">
                                        <i class="fas fa-exclamation-triangle card-icon"></i>
                                        <p class="card-title">Low Stock</p>
                                        <p class="count-number">{{ number_format($data['low_stocks']) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="stats-section">
                        <h5 class="section-title"><i class="fas fa-map-marker-alt"></i> Location</h5>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card dashboard-card gradient-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-map card-icon"></i>
                                        <p class="card-title">Areas</p>
                                        <p class="count-number">{{ number_format($data['total_areas']) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card dashboard-card gradient-info">
                                    <div class="card-body text-center">
                                        <i class="fas fa-city card-icon"></i>
                                        <p class="card-title">Districts</p>
                                        <p class="count-number">{{ number_format($data['total_districts']) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card dashboard-card gradient-warning">
                                    <div class="card-body text-center">
                                        <i class="fas fa-home card-icon"></i>
                                        <p class="card-title">Upazilas</p>
                                        <p class="count-number">{{ number_format($data['total_upazilas']) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Section -->
            <div class="stats-section">
                <h5 class="section-title"><i class="fas fa-cogs"></i> System</h5>
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-user-tag card-icon"></i>
                                <p class="card-title">Roles</p>
                                <p class="count-number">{{ number_format($data['total_roles']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-tags card-icon"></i>
                                <p class="card-title">Tags</p>
                                <p class="count-number">{{ number_format($data['total_tags']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-truck card-icon"></i>
                                <p class="card-title">Delivery</p>
                                <p class="count-number">{{ number_format($data['total_delivery_options']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-id-card card-icon"></i>
                                <p class="card-title">Profiles</p>
                                <p class="count-number">{{ number_format($data['total_profiles']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-danger">
                            <div class="card-body text-center">
                                <i class="fas fa-upload card-icon"></i>
                                <p class="card-title">Imports</p>
                                <p class="count-number">{{ number_format($data['total_imports']) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card dashboard-card gradient-secondary">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-plus card-icon"></i>
                                <p class="card-title">Today Blogs</p>
                                <p class="count-number">{{ number_format($data['today_blogs']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
