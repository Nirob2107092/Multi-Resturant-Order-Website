@extends('client.client_dashboard')
@section('client')
@php
    $id = Auth::guard('client')->id();
    $client = App\Models\Client::find($id);
    $status = $client->status;
@endphp
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-sm-0 font-size-18">Restaurant Dashboard</h4>
                        @if ($status === '1')
                            <p class="text-success mb-0"><i class="ri-checkbox-circle-line me-1"></i>Your restaurant account is <b>Active</b></p>
                        @else
                            <p class="text-danger mb-0"><i class="ri-error-warning-line me-1"></i>Your restaurant account is <b>Inactive</b> - Waiting for admin approval</p>
                        @endif
                    </div>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Overview</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @if ($status === '0')
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="ri-alert-line me-2"></i>
                    <strong>Account Pending!</strong> Your restaurant is currently under review. Some features may be limited.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif

        <!-- Restaurant Statistics (No Orders) -->
        <div class="row">
            <!-- Total Menus -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Menus</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $totalMenus }}">{{ $totalMenus }}</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="avatar-sm rounded-circle bg-soft-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-soft-primary">
                                        <i class="ri-file-list-3-line font-size-24 text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top">
                            <p class="mb-0 text-muted">Menu items</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Products</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $totalProducts }}">{{ $totalProducts }}</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="avatar-sm rounded-circle bg-soft-success mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-soft-success">
                                        <i class="ri-shopping-bag-line font-size-24 text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top">
                            <p class="mb-0 text-muted">Available items</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Gallery -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Gallery</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $totalGallery }}">{{ $totalGallery }}</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="avatar-sm rounded-circle bg-soft-warning mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-soft-warning">
                                        <i class="ri-image-line font-size-24 text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top">
                            <p class="mb-0 text-muted">Gallery images</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Coupons -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Coupons</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $totalCoupons }}">{{ $totalCoupons }}</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="avatar-sm rounded-circle bg-soft-info mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-soft-info">
                                        <i class="ri-coupon-line font-size-24 text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top">
                            <p class="mb-0 text-muted">Active coupons</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
.card-h-100 { min-height: 175px; }
.card-animate { transition: all 0.3s ease-in-out; }
.card-animate:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
.bg-soft-primary { background-color: rgba(64,81,137,0.1) !important; }
.bg-soft-success { background-color: rgba(10,179,156,0.1) !important; }
.bg-soft-warning { background-color: rgba(241,180,76,0.1) !important; }
.bg-soft-info { background-color: rgba(80,165,241,0.1) !important; }
.mini-stat-icon { width: 60px; height: 60px; display:flex; align-items:center; justify-content:center; }
.counter-value { font-weight: 600; }
</style>
@endsection