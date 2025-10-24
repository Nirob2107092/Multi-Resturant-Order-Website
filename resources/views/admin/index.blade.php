@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-sm-0 font-size-18">Dashboard Overview</h4>
                        <p class="text-muted mb-0">Welcome back! Here's what's happening today.</p>
                    </div>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">DASHBOARD</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Dashboard Summary Cards -->
        <div class="row">
            <!-- Categories Card -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Categories</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $totalCategories }}">{{ $totalCategories }}</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="avatar-sm rounded-circle bg-soft-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-soft-primary">
                                        <i class="ri-stack-line font-size-24 text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top">
                            <p class="mb-0 text-muted"><i class="mdi mdi-arrow-up-bold text-success me-1"></i>Food categories</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cities Card -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Cities</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $totalCities }}">{{ $totalCities }}</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="avatar-sm rounded-circle bg-soft-success mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-soft-success">
                                        <i class="ri-map-pin-line font-size-24 text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top">
                            <p class="mb-0 text-muted"><i class="mdi mdi-arrow-up-bold text-success me-1"></i>Service locations</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Card -->
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
                                <div class="avatar-sm rounded-circle bg-soft-warning mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-soft-warning">
                                        <i class="ri-shopping-bag-line font-size-24 text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top">
                            <p class="mb-0 text-muted"><i class="mdi mdi-arrow-up-bold text-success me-1"></i>Available items</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menus Card -->
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
                                <div class="avatar-sm rounded-circle bg-soft-info mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-soft-info">
                                        <i class="ri-file-list-3-line font-size-24 text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-top">
                            <p class="mb-0 text-muted"><i class="mdi mdi-arrow-up-bold text-success me-1"></i>Active menus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Restaurant Statistics -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-grow-1">
                        <h5 class="mb-0"><i class="ri-store-2-line text-primary me-2"></i>Restaurant Statistics</h5>
                    </div>
                </div>
            </div>

            <!-- Total Restaurants -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Restaurants</p>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                    <span class="counter-value" data-target="{{ $totalRestaurants }}">{{ $totalRestaurants }}</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div id="total_restaurants_chart" data-colors='["--vz-primary"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                    <i class="ri-store-2-fill text-primary"></i>
                                </h4>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-soft-success text-success">All Restaurants</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Restaurants -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Pending Approval</p>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                    <span class="counter-value" data-target="{{ $pendingRestaurants }}">{{ $pendingRestaurants }}</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div id="pending_restaurants_chart" data-colors='["--vz-warning"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                    <i class="ri-time-line text-warning"></i>
                                </h4>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-soft-warning text-warning">Needs Review</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approved Restaurants -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Approved & Active</p>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                    <span class="counter-value" data-target="{{ $approvedRestaurants }}">{{ $approvedRestaurants }}</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div id="approved_restaurants_chart" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                    <i class="ri-checkbox-circle-line text-success"></i>
                                </h4>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-soft-success text-success">Active Now</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Statistics -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-grow-1">
                        <h5 class="mb-0"><i class="ri-shopping-cart-line text-primary me-2"></i>Order Management</h5>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Orders</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $totalOrders }}">{{ $totalOrders }}</span>
                                </h4>
                                <span class="badge bg-soft-primary text-primary">All Time</span>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-primary rounded fs-3">
                                    <i class="ri-shopping-cart-2-line text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending Orders</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $pendingOrders }}">{{ $pendingOrders }}</span>
                                </h4>
                                <span class="badge bg-soft-warning text-warning">
                                    <i class="ri-arrow-right-up-line align-middle me-1"></i>Waiting
                                </span>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-warning rounded fs-3">
                                    <i class="ri-time-line text-warning"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Processing Orders -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Processing</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $processingOrders }}">{{ $processingOrders }}</span>
                                </h4>
                                <span class="badge bg-soft-info text-info">
                                    <i class="ri-arrow-right-up-line align-middle me-1"></i>In Progress
                                </span>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info rounded fs-3">
                                    <i class="ri-loader-4-line text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmed Orders -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Confirmed</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $confirmedOrders }}">{{ $confirmedOrders }}</span>
                                </h4>
                                <span class="badge bg-soft-primary text-primary">
                                    <i class="ri-check-line align-middle me-1"></i>Verified
                                </span>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-primary rounded fs-3">
                                    <i class="ri-check-double-line text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivered Orders -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Delivered</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $deliveredOrders }}">{{ $deliveredOrders }}</span>
                                </h4>
                                <span class="badge bg-soft-success text-success">
                                    <i class="ri-arrow-right-up-line align-middle me-1"></i>Completed
                                </span>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-success rounded fs-3">
                                    <i class="ri-truck-line text-success"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container-fluid -->
</div>

<style>
.card-h-100 {
    min-height: 175px;
}

.card-animate {
    transition: all 0.3s ease-in-out;
}

.card-animate:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.bg-soft-primary {
    background-color: rgba(64, 81, 137, 0.1) !important;
}

.bg-soft-success {
    background-color: rgba(10, 179, 156, 0.1) !important;
}

.bg-soft-warning {
    background-color: rgba(241, 180, 76, 0.1) !important;
}

.bg-soft-info {
    background-color: rgba(80, 165, 241, 0.1) !important;
}

.mini-stat-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.counter-value {
    font-weight: 600;
}
</style>

@endsection