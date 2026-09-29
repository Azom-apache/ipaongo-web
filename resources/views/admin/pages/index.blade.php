@extends('layouts.admin.master')
@section('content')
    @push('page_info')
        <h5 class="mb-0">Pages</h5>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Pages</li>
            </ul>
        </nav>
    @endpush

    @push('css')
        <style>
            /* Modern Pages Index Styling */
            .pages-index-container {
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

            .card-header-modern .d-flex {
                position: relative;
                z-index: 1;
            }

            .card-header-modern h4 {
                margin: 0;
                font-weight: 600;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            }

            .btn-add-new {
                background: rgba(255, 255, 255, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.3);
                color: white;
                padding: 8px 16px;
                border-radius: 25px;
                text-decoration: none;
                transition: all 0.3s ease;
                font-weight: 500;
            }

            .btn-add-new:hover {
                background: rgba(255, 255, 255, 0.3);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            .card-body-modern {
                padding: 0;
            }

            /* Modern Table Styling */
            .modern-table {
                width: 100%;
                margin: 0;
                border-collapse: separate;
                border-spacing: 0;
            }

            .modern-table thead th {
                background: linear-gradient(135deg, #f0f4ff 0%, #e6f3ff 100%);
                color: #4682B4;
                font-weight: 600;
                padding: 20px;
                text-align: left;
                border-bottom: 2px solid rgba(135, 206, 235, 0.2);
                font-size: 14px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .modern-table tbody tr {
                transition: all 0.3s ease;
                border-bottom: 1px solid rgba(135, 206, 235, 0.1);
            }

            .modern-table tbody tr:hover {
                background: linear-gradient(135deg, rgba(135, 206, 235, 0.02) 0%, rgba(70, 130, 180, 0.02) 100%);
                transform: translateX(5px);
                box-shadow: 0 4px 15px rgba(135, 206, 235, 0.1);
            }

            .modern-table tbody td {
                padding: 18px 20px;
                color: #333;
                font-size: 14px;
                vertical-align: middle;
            }

            .modern-table tbody td:first-child {
                font-weight: 600;
                color: #4682B4;
                width: 60px;
                text-align: center;
                background: rgba(135, 206, 235, 0.05);
            }

            /* Action Buttons */
            .action-buttons {
                display: flex;
                gap: 8px;
            }

            .btn-action {
                padding: 10px 15px;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                font-size: 13px;
                font-weight: 500;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                transition: all 0.3s ease;
                min-width: 80px;
                justify-content: center;
                white-space: nowrap;
            }

            .btn-edit {
                background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
                color: white;
            }

            .btn-edit:hover {
                background: linear-gradient(135deg, #4682B4 0%, #87CEEB 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(135, 206, 235, 0.3);
            }

            .btn-delete {
                background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
                color: white;
            }

            .btn-delete:hover {
                background: linear-gradient(135deg, #ee5a52 0%, #ff6b6b 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
            }

            /* Empty State */
            .empty-state {
                text-align: center;
                padding: 60px 20px;
                color: #666;
            }

            .empty-state i {
                font-size: 48px;
                color: #87CEEB;
                margin-bottom: 20px;
            }

            .empty-state h5 {
                color: #4682B4;
                margin-bottom: 10px;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .modern-table {
                    font-size: 12px;
                }

                .modern-table thead th,
                .modern-table tbody td {
                    padding: 12px 10px;
                }

                .action-buttons {
                    flex-direction: column;
                    gap: 4px;
                }

                .btn-action {
                    padding: 8px 12px;
                    font-size: 12px;
                    min-width: 70px;
                }

                .card-header-modern .d-flex {
                    flex-direction: column;
                    gap: 15px;
                    text-align: center;
                }

                .btn-add-new {
                    align-self: center;
                }
            }
        </style>
    @endpush

    <div id="content-page" class="content-page pages-index-container">
        <div class="container-fluid">
            @include('layouts.admin.errors')

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="modern-card">
                        <div class="card-header-modern">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">
                                    <i class="fas fa-file-alt" style="margin-right: 10px;"></i>
                                    All Pages
                                </h4>
                                <a href="{{ route('dashboard.pages.create') }}" class="btn-add-new">
                                    <i class="fas fa-plus" style="margin-right: 5px;"></i>
                                    Add New Page
                                </a>
                            </div>
                        </div>
                        <div class="card-body-modern">
                            @if ($pages->count() > 0)
                                <table class="modern-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 60px;">#</th>
                                            <th>Page Title</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl = 1; @endphp
                                        @foreach ($pages as $page)
                                            <tr>
                                                <td>
                                                    <span
                                                        style="display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; background: rgba(135, 206, 235, 0.1); border-radius: 50%; font-weight: bold;">
                                                        {{ $sl++ }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div style="font-weight: 500; color: #333;">
                                                        <i class="fas fa-file-alt"
                                                            style="margin-right: 8px; color: #87CEEB;"></i>
                                                        {{ $page->title }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="{{ route('dashboard.pages.edit', $page->id) }}"
                                                            class="btn-action btn-edit" title="Edit Page">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form class='d-inline'
                                                            action="{{ route('dashboard.pages.destroy', $page->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                onclick="return confirm('Are you sure you want to delete this page?')"
                                                                class="btn-action btn-delete" title="Delete Page">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-file-alt"></i>
                                    <h5>No Pages Found</h5>
                                    <p>You haven't created any pages yet. Click the "Add New Page" button to get started.
                                    </p>
                                    <a href="{{ route('dashboard.pages.create') }}" class="btn-add-new"
                                        style="display: inline-block; margin-top: 20px;">
                                        <i class="fas fa-plus" style="margin-right: 5px;"></i>
                                        Create Your First Page
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
