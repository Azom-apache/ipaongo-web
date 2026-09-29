<!doctype html>
<html lang="en">

<head>
    @php
        $app = \App\Helpers\Website::setting();
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @if ($app)
            {{ $app->site_title }}
        @endif
    </title>
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/responsive.css') }}">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/tailwindCss3.4.17') }}"></script>
    <script defer src="{{ asset('js/cdn.alpine.js') }}"></script>
    @yield('css_atik')
    @stack('css')

    <style>
        /* Header Styles */
        .iq-top-navbar {
            background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .iq-navbar-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            height: 70px;
        }

        .iq-sidebar-logo .top-logo {
            display: flex !important;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #ffffff;
            transition: opacity 0.3s ease;
        }

        .iq-sidebar-logo .top-logo:hover {
            opacity: 0.9;
        }

        .iq-sidebar-logo .top-logo img {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            object-fit: contain;
            padding: 2px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .iq-sidebar-logo .top-logo span {
            font-weight: 600;
            font-size: 18px;
            color: #ffffff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .navbar-breadcrumb {
            flex: 1;
            padding: 0 20px;
        }

        .navbar-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .navbar-list li {
            position: relative;
        }

        .navbar-list .dropdown-toggle {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #4682B4;
            background: rgba(135, 206, 235, 0.05);
            border: 1px solid rgba(135, 206, 235, 0.1);
        }

        .navbar-list .dropdown-toggle:hover {
            background: linear-gradient(135deg, rgba(135, 206, 235, 0.1) 0%, rgba(70, 130, 180, 0.1) 100%);
            color: #4682B4;
            border-color: rgba(135, 206, 235, 0.3);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(135, 206, 235, 0.2);
        }

        .navbar-list .dropdown-toggle img {
            margin-right: 8px;
        }

        .navbar-list .dropdown-toggle .hidden-xs {
            margin-right: 8px;
            font-weight: 500;
        }

        .navbar-list .dropdown-menu {
            border: 1px solid rgba(135, 206, 235, 0.2);
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(135, 206, 235, 0.15);
            min-width: 250px;
            background: linear-gradient(135deg, #ffffff 0%, #e6f3ff 100%);
            backdrop-filter: blur(10px);
        }

        .navbar-list .dropdown-menu .dropdown-header {
            padding: 15px;
            border-bottom: 1px solid rgba(135, 206, 235, 0.2);
            background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
            color: #ffffff;
        }

        .navbar-list .dropdown-menu .dropdown-header h5 {
            color: #ffffff;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .navbar-list .dropdown-menu .dropdown-header small {
            color: #e6f3ff;
        }

        .navbar-list .dropdown-menu li a {
            padding: 12px 15px;
            display: flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 5px;
        }

        .navbar-list .dropdown-menu li a:hover {
            background: linear-gradient(135deg, rgba(135, 206, 235, 0.15) 0%, rgba(70, 130, 180, 0.15) 100%);
            color: #ffffff;
            transform: translateX(3px);
            box-shadow: 0 2px 8px rgba(135, 206, 235, 0.2);
        }

        .navbar-list .dropdown-menu li a i {
            margin-right: 10px;
            width: 16px;
            text-align: center;
            color: #667eea;
        }

        .navbar-list .dropdown-menu li a:hover i {
            color: #764ba2;
        }

        .navbar-list .dropdown-menu .divider {
            margin: 8px 0;
            border-top: 1px solid rgba(102, 126, 234, 0.1);
        }

        /* Breadcrumb Styles */
        .navbar-breadcrumb .breadcrumb {
            background: transparent;
            margin: 0;
            padding: 0;
        }

        .navbar-breadcrumb .breadcrumb-item {
            color: #666;
        }

        .navbar-breadcrumb .breadcrumb-item.active {
            color: #007bff;
            font-weight: 500;
        }

        /* Content Wrapper */
        .content-wrapper {
            min-height: calc(100vh - 70px);
        }

        .content-wrapper .content-page {
            padding-top: 15px !important;
            margin-left: 260px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .iq-navbar-custom {
                padding: 0 15px;
                height: 60px;
            }

            .navbar-breadcrumb {
                display: none;
            }

            .navbar-list .dropdown-toggle .hidden-xs {
                display: none;
            }

            .iq-sidebar-logo .top-logo span {
                display: none;
            }

            .iq-sidebar-logo .top-logo img {
                width: 35px;
                height: 35px;
            }

            .content-wrapper .content-page {
                margin-left: 0;
                padding-top: 15px !important;
            }
        }

        /* Navbar toggle button */
        .navbar-toggler {
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.3) !important;
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .navbar-toggler:hover {
            background: rgba(255, 255, 255, 0.2) !important;
        }

        /* Menu toggle button in header */
        .iq-menu-bt .wrapper-menu .line-menu {
            background: #ffffff;
            height: 2px;
            width: 18px;
            border-radius: 1px;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
            <div class="loader">
                <div class="cube">
                    <div class="sides">
                        <div class="top"></div>
                        <div class="right"></div>
                        <div class="bottom"></div>
                        <div class="left"></div>
                        <div class="front"></div>
                        <div class="back"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
        @include('layouts.admin.aside')
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <div class="iq-sidebar-logo">
                    <div class="top-logo">
                        <a href="{{ route('dashboard.index') }}" class="logo">
                            @php
                                $logoPath = \App\Setting::first()?->logo
                                    ? asset('uploads/setting/' . \App\Setting::first()->logo)
                                    : asset('admin/images/logo.png');
                            @endphp
                            <img src="{{ $logoPath }}" class="img-fluid" alt="Logo"
                                onerror="this.src='{{ asset('admin/images/logo.png') }}'"
                                style="
                                margin-top: -6px;">
                            <span>{{ env('APP_NAME', 'Admin Panel') }}</span>
                        </a>
                    </div>
                </div>
                {{-- <div class="navbar-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            @stack('breadcrumb')
                        </ol>
                    </nav>
                </div> --}}
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ri-menu-3-line"></i>
                    </button>
                    <div class="iq-menu-bt align-self-center">
                        <div class="wrapper-menu">
                            <div class="line-menu half start"></div>
                            <div class="line-menu"></div>
                            <div class="line-menu half end"></div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    </div>
                    <ul class="navbar-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('admin/images/user/1.jpg') }}" class="img-fluid rounded"
                                    alt="user" style="width: 32px; height: 32px; border-radius: 50%;">
                                <span class="hidden-xs"
                                    style="
                                color: aliceblue;">{{ Auth::user()->name ?? 'Admin' }}</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">

                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="fa fa-user"></i> My Profile</a></li>
                                {{-- <li><a href="#"><i class="fa fa-edit"></i> Edit Profile</a></li>
                                <li><a href="#"><i class="fa fa-cog"></i> Account Settings</a></li>
                                <li><a href="#"><i class="fa fa-lock"></i> Privacy Settings</a></li> --}}
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        style="color: #dc3545;">
                                        <i class="fa fa-sign-out"></i> Sign Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
