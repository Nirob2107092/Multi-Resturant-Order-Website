@extends('frontend.dashboard.dashboard')
@section('dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<section class="offer-dedicated-body mt-4 mb-4 pt-2 pb-2">
    <div class="container">
       <div class="row">
          <div class="col-md-8">
             <div class="offer-dedicated-body-left">
    
    @php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
    $deliveryAddress = session('delivery_address', $profileData->address);
    $deliveryLat = session('delivery_lat');
    $deliveryLng = session('delivery_lng');
    @endphp
                 
    <div class="pt-2"></div>
    <div class="bg-white rounded shadow-sm p-4 mb-4">
        <h4 class="mb-1">Choose a delivery address</h4>
        <h6 class="mb-3 text-black-50">Select or add a new address</h6>
        
        <div class="row">
            {{-- Default Address --}}
            <div class="col-md-12">
                <div class="bg-white card addresses-item mb-4 border {{ session('delivery_address') ? '' : 'border-success' }}">
                    <div class="gold-members p-4">
                        <div class="media">
                            <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                            <div class="media-body">
                                <h6 class="mb-1 text-black">Home (Default)</h6>
                                <p class="text-black">{{ $profileData->address }}</p>
                                <p class="mb-0 text-black font-weight-bold">
                                    <button class="btn btn-sm btn-success mr-2" onclick="selectDefaultAddress()">
                                        {{ session('delivery_address') ? 'USE THIS ADDRESS' : 'DELIVERING HERE' }}
                                    </button> 
                                    <span class="badge badge-info">Est. 30MIN</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Custom Address (if set) --}}
            @if(session('delivery_address') && session('delivery_address') != $profileData->address)
            <div class="col-md-12">
                <div class="bg-white card addresses-item mb-4 border border-success">
                    <div class="gold-members p-4">
                        <div class="media">
                            <div class="mr-3"><i class="icofont-location-pin icofont-3x text-danger"></i></div>
                            <div class="media-body">
                                <h6 class="mb-1 text-black">Current Delivery Address</h6>
                                <p class="text-black">{{ session('delivery_address') }}</p>
                                <p class="mb-0 text-black font-weight-bold">
                                    <span class="badge badge-success mr-2">DELIVERING HERE</span>
                                    <button class="btn btn-sm btn-outline-danger" onclick="clearCustomAddress()">
                                        <i class="icofont-close"></i> Remove
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Add New Address Section --}}
            <div class="col-md-12">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i class="icofont-plus-circle"></i> Add New Delivery Address
                        </h6>
                    </div>
                    <div class="card-body">
                        {{-- Manual Address Input --}}
                        <div class="form-group">
                            <label>Enter Address Manually</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="manual_address" 
                                       placeholder="Enter your delivery address">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" onclick="setManualAddress()">
                                        <i class="icofont-check"></i> Use This
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="text-center my-2">
                            <strong>OR</strong>
                        </div>

                        {{-- Map Selection --}}
                        <div class="form-group">
                            <label>Select from Map</label>
                            <button type="button" class="btn btn-outline-primary btn-block" 
                                    data-toggle="modal" data-target="#mapModal">
                                <i class="icofont-map"></i> Choose Location on Map
                            </button>
                        </div>

                        {{-- Locate Me Button --}}
                        <button type="button" class="btn btn-outline-info btn-block" onclick="locateMe()">
                            <i class="icofont-ui-pointer"></i> Use My Current Location
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-2"></div>
    <div class="bg-white rounded shadow-sm p-4 osahan-payment">
        <h4 class="mb-1">Choose payment method</h4>
        <h6 class="mb-3 text-black-50">Credit/Debit Cards</h6>
        <div class="row">
            <div class="col-sm-4 pr-0">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-cash-tab" data-toggle="pill" href="#v-pills-cash" role="tab">
                        <i class="icofont-money"></i> Pay on Delivery
                    </a>
                    <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab">
                        <i class="icofont-credit-card"></i> Credit/Debit Cards
                    </a>
                </div>
            </div>
            <div class="col-sm-8 pl-0">
                <div class="tab-content h-100" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-cash" role="tabpanel">
                        <h6 class="mb-3 mt-0">Cash on Delivery</h6>
                        <p>Please keep exact change handy to help us serve you better</p>
                        <hr>
                        <form action="{{ route('cash_order') }}" method="post" id="checkoutForm">
                            @csrf
                            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                            <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                            <input type="hidden" name="address" id="checkout_address" value="{{ $deliveryAddress }}">
                            <input type="hidden" name="latitude" value="{{ $deliveryLat }}">
                            <input type="hidden" name="longitude" value="{{ $deliveryLng }}">

                            <div class="alert alert-info">
                                <strong>Delivery Address:</strong><br>
                                <span id="display_address">{{ $deliveryAddress }}</span>
                            </div>

                            <button type="submit" class="btn btn-success btn-block btn-lg">
                                PLACE ORDER <i class="icofont-long-arrow-right"></i>
                            </button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="v-pills-home" role="tabpanel">
                        {{-- Your card payment form --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
             </div>
          </div>

          {{-- Right sidebar with cart (existing code) --}}
          <div class="col-md-4">
             {{-- Your existing cart code --}}
          </div>
       </div>
    </div>
</section>

{{-- Map Modal --}}
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Delivery Location</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 400px; width: 100%;"></div>
                <div class="mt-3">
                    <label>Selected Address:</label>
                    <input type="text" class="form-control" id="selected_address" readonly>
                    <input type="hidden" id="selected_lat">
                    <input type="hidden" id="selected_lng">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="confirmMapAddress()">
                    Use This Location
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Load Leaflet CSS in head --}}
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
      crossorigin=""/>
@endpush

{{-- Load Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<style>
#map {
    height: 450px;
    width: 100%;
    border-radius: 8px;
}

.leaflet-container {
    font-family: inherit;
}
</style>

<script>
let map, marker;

// Initialize map when modal opens
$('#mapModal').on('shown.bs.modal', function () {
    if (!map) {
        try {
            // Default to Dhaka, Bangladesh
            const defaultLat = 23.8103;
            const defaultLng = 90.4125;

            // Create map
            map = L.map('map', {
                center: [defaultLat, defaultLng],
                zoom: 13,
                zoomControl: true
            });

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            // Add draggable marker
            marker = L.marker([defaultLat, defaultLng], {
                draggable: true,
                autoPan: true
            }).addTo(map);

            // Add popup to marker
            marker.bindPopup('Drag me to your location!').openPopup();

            // Update address when marker is dragged
            marker.on('dragend', function(e) {
                const pos = marker.getLatLng();
                getAddressFromCoords(pos.lat, pos.lng);
            });

            // Click on map to move marker
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                getAddressFromCoords(e.latlng.lat, e.latlng.lng);
                marker.openPopup();
            });

            // Get initial address
            getAddressFromCoords(defaultLat, defaultLng);

            console.log('Map initialized successfully');
        } catch (error) {
            console.error('Map initialization error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Map Error',
                text: 'Failed to load map. Please try manual entry.'
            });
        }
    }
    
    // Refresh map size after modal animation
    setTimeout(() => {
        if (map) {
            map.invalidateSize();
        }
    }, 200);
});

// Close modal cleanup
$('#mapModal').on('hidden.bs.modal', function () {
    // Optional: destroy map to free memory
    // if (map) {
    //     map.remove();
    //     map = null;
    // }
});

function getAddressFromCoords(lat, lng) {
    $('#selected_lat').val(lat);
    $('#selected_lng').val(lng);
    $('#selected_address').val('Loading address...');

    // Use OpenStreetMap Nominatim API
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`, {
        headers: {
            'Accept-Language': 'en'
        }
    })
    .then(response => response.json())
    .then(data => {
        let address = data.display_name || `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        $('#selected_address').val(address);
        marker.setPopupContent(address).openPopup();
    })
    .catch(error => {
        console.error('Geocoding error:', error);
        const fallbackAddress = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        $('#selected_address').val(fallbackAddress);
    });
}

function confirmMapAddress() {
    const address = $('#selected_address').val();
    const lat = $('#selected_lat').val();
    const lng = $('#selected_lng').val();

    if (!address || address === 'Loading address...') {
        Swal.fire({
            icon: 'warning',
            title: 'Please wait',
            text: 'Address is still loading. Please wait a moment.'
        });
        return;
    }

    // Close modal first
    $('#mapModal').modal('hide');

    // Show loading
    Swal.fire({
        title: 'Saving address...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: '{{ route("set.delivery.address") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            address: address,
            latitude: lat,
            longitude: lng
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Address Updated!',
                text: 'Delivery address has been set successfully.',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to save address. Please try again.'
            });
        }
    });
}

function locateMe() {
    if (!navigator.geolocation) {
        Swal.fire({
            icon: 'error',
            title: 'Not Supported',
            text: 'Geolocation is not supported by your browser'
        });
        return;
    }

    // Show loading with no timer
    Swal.fire({
        title: 'Getting your location...',
        html: 'This may take a few seconds. Please wait.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Set timeout for geolocation (10 seconds)
    const geoTimeout = setTimeout(() => {
        Swal.fire({
            icon: 'error',
            title: 'Location Timeout',
            text: 'Unable to get your location. Please try manually or use the map.'
        });
    }, 10000);

    navigator.geolocation.getCurrentPosition(
        function(position) {
            // Clear timeout on success
            clearTimeout(geoTimeout);
            
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // Keep loading while fetching address
            Swal.update({
                title: 'Found your location!',
                html: 'Getting address details...'
            });

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`, {
                headers: {
                    'Accept-Language': 'en'
                }
            })
            .then(response => response.json())
            .then(data => {
                const address = data.display_name || `${lat}, ${lng}`;
                
                // Now save the address
                return $.ajax({
                    url: '{{ route("set.delivery.address") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        address: address,
                        latitude: lat,
                        longitude: lng
                    }
                });
            })
            .then(response => {
                clearTimeout(geoTimeout);
                Swal.fire({
                    icon: 'success',
                    title: 'Location Found!',
                    text: 'Your delivery address has been set.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                clearTimeout(geoTimeout);
                console.error('Location error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Got your location but failed to save. Please try map selection.'
                });
            });
        },
        function(error) {
            // Clear timeout on error
            clearTimeout(geoTimeout);
            
            let errorMessage = 'Unable to get your location. ';
            
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage += 'Please allow location access in your browser settings.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage += 'Location information is unavailable.';
                    break;
                case error.TIMEOUT:
                    errorMessage += 'Location request timed out.';
                    break;
                default:
                    errorMessage += 'Please try manually or use the map.';
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Location Error',
                text: errorMessage,
                confirmButtonText: 'OK'
            });
        },
        {
            enableHighAccuracy: true,
            timeout: 8000,
            maximumAge: 0
        }
    );
}

function setManualAddress() {
    const address = $('#manual_address').val().trim();
    
    if (!address) {
        Swal.fire({
            icon: 'warning',
            title: 'Empty Address',
            text: 'Please enter an address'
        });
        return;
    }

    Swal.fire({
        title: 'Saving address...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: '{{ route("set.delivery.address") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            address: address
        },
        success: function() {
            Swal.fire({
                icon: 'success',
                title: 'Address Updated!',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to save address. Please try again.'
            });
        }
    });
}

function selectDefaultAddress() {
    Swal.fire({
        title: 'Setting default address...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: '{{ route("set.delivery.address") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            address: '{{ $profileData->address }}',
            use_default: true
        },
        success: function() {
            Swal.fire({
                icon: 'success',
                title: 'Using Default Address',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        }
    });
}

function clearCustomAddress() {
    $.ajax({
        url: '{{ route("clear.delivery.address") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function() {
            location.reload();
        }
    });
}

// Update the display address before form submission
$('#checkoutForm').on('submit', function() {
    const currentAddress = $('#display_address').text();
    $('#checkout_address').val(currentAddress);
});
</script>

{{-- Your existing cart scripts --}}
@endsection