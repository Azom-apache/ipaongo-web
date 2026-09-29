<div class="iq-sidebar"
    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 2px 0 10px rgba(0,0,0,0.1);">
    <style>
        /* Custom Sidebar Styling */
        .iq-sidebar {
            background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%) !important;
        }

        .iq-sidebar .iq-sidebar-logo a {
            color: #ffffff !important;
        }

        .iq-sidebar .iq-sidebar-logo a span {
            color: #ffffff !important;
            font-weight: 600;
            font-size: 16px !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .iq-sidebar-menu .iq-menu li a {
            color: #000000 !important;
            font-size: 14px !important;
            transition: all 0.3s ease;
        }

        .iq-sidebar-menu .iq-menu li a i {
            font-size: 16px !important;
            width: 18px !important;
            margin-right: 10px !important;
        }

        .iq-sidebar-menu .iq-menu li a:hover,
        .iq-sidebar-menu .iq-menu li.active>a {
            color: #000000 !important;
            background: rgba(255, 255, 255, 0.15) !important;
            border-radius: 8px;
            margin: 2px 8px;
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .iq-sidebar-menu .iq-menu li a::before {
            background: #ffffff !important;
        }

        .iq-sidebar-menu .iq-menu li.active>a::before {
            background: #ffffff !important;
            opacity: 1 !important;
            height: 100% !important;
        }

        .iq-sidebar-menu .iq-menu li .iq-submenu li a {
            color: #000000 !important;
            padding-left: 50px !important;
        }

        .iq-sidebar-menu .iq-menu li .iq-submenu li a:hover {
            color: #000000 !important;
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .iq-menu-title {
            color: #ffffff !important;
            font-size: 13px !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 10px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .iq-menu-title span {
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .iq-menu-title i {
            font-size: 14px !important;
        }

        /* Menu toggle button */
        .iq-menu-bt .wrapper-menu .line-menu {
            background: #e8f0ff;
        }

        /* Submenu arrow */
        .iq-arrow-right {
            color: #a8b7ff !important;
            font-size: 14px !important;
        }

        .iq-menu li.menu-open .iq-arrow-right {
            color: #ffffff !important;
        }

        /* Consistent menu text styling for all items */
        .iq-menu li a span {
            text-transform: none !important;
            font-weight: 500 !important;
            letter-spacing: 0.3px !important;
            font-size: 14px !important;
        }
    </style>
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="/">
            <img src="{{ asset('admin/images/logo.png') }}" class="img-fluid" alt="">
            <span>
                @if ($app)
                    {{ $app->site_title }}
                @endif
            </span>
        </a>
        <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="line-menu half start"></div>
                <div class="line-menu"></div>
                <div class="line-menu half end"></div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul class="iq-menu">

                <li>
                    <a href="/" class="iq-waves-effect" target="_blank"><i class="ri-home-4-line"></i><span>Back
                            to web</span></a>
                </li>
                <li>
                    <a href="{{ route('dashboard.index') }}" class="iq-waves-effect"><i
                            class="ri-home-4-line"></i><span>Dashboard</span></a>
                </li>
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i class="ri-mail-line"></i><span>News,
                                Event, Training, Notice</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.news.create') }}">Add </a></li>
                            <li><a href="{{ route('dashboard.news.index') }}">All</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-project-diagram"></i><span>Projects</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.projects.create') }}">Add </a></li>
                            <li><a href="{{ route('dashboard.projects.index') }}">All</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-blog"></i><span>Blogs</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.blogs.create') }}">Add blogs</a></li>
                            <li><a href="{{ route('dashboard.blogs.index') }}">All blogs</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-video"></i><span>Video</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.videos.create') }}">Add Video</a></li>
                            <li><a href="{{ route('dashboard.videos.index') }}">All Video</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-images"></i><span>Gallery</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.galleries.create') }}">Add gallery</a></li>
                            <li><a href="{{ route('dashboard.galleries.index') }}">All gallery</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fa fa-users"></i><span>Members</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.members.create') }}">Add member</a></li>
                            <li><a href="{{ route('dashboard.members.index') }}">All Members</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fa  fa-plus-circle"></i><span>Pages</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.pages.create') }}">Add Page</a></li>
                            <li><a href="{{ route('dashboard.pages.index') }}">All Page</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-hand-holding-heart"></i><span>Donations</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.admin.donations.index') }}">All Donations</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i class="fas fa-heart"></i><span>Blood
                                Donors</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.blood.index') }}">All Donors</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.settings.index') }}" class="iq-waves-effect"><i
                                class="fa fa-cogs"></i><span>Setting</span></a>
                    </li>
                @else
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fa  fa-plus-circle"></i><span>Pages</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.pages.create') }}">Add Page</a></li>
                            <li><a href="{{ route('dashboard.pages.index') }}">All Page</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i class="ri-mail-line"></i><span>News,
                                Notice</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.news.create') }}">Add </a></li>
                            <li><a href="{{ route('dashboard.news.index') }}">All</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-images"></i><span>Gallery</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.galleries.create') }}">Add gallery</a></li>
                            <li><a href="{{ route('dashboard.galleries.index') }}">All gallery</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-video"></i><span>Video</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.videos.create') }}">Add Video</a></li>
                            <li><a href="{{ route('dashboard.videos.index') }}">All Video</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i class="fas fa-images"></i><span>
                                Slider </span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.sliders.create') }}">Add Slider</a></li>
                            <li><a href="{{ route('dashboard.sliders.index') }}">All Slider</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-project-diagram"></i><span>Projects</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.projects.create') }}">Add </a></li>
                            <li><a href="{{ route('dashboard.projects.index') }}">All</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-users"></i><span>Members</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <li><a href="{{ route('dashboard.members.create') }}">Add </a></li>
                            <li><a href="{{ route('dashboard.members.index') }}">All</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-heart"></i><span>Donors</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <!--<li><a href="{{ route('dashboard.members.create') }}">Add </a></li>-->
                            <li><a href="{{ route('dashboard.blood.index') }}">All</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="iq-waves-effect"><i
                                class="fas fa-cog"></i><span>Setting</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu">
                            <!--<li><a href="{{ route('dashboard.members.create') }}">Add </a></li>-->
                            <li><a href="{{ route('dashboard.settings.index') }}">Update</a></li>
                        </ul>
                    </li>
                @endif


            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
