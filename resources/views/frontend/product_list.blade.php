@foreach ($filterProducts as $product)
<div class="col-md-4 col-sm-6 mb-4 pb-2">
  <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
    <div class="list-card-image">
      @php
        $stats = isset($ratingStatsByClient) && $ratingStatsByClient instanceof \Illuminate\Support\Collection
            ? $ratingStatsByClient->get($product->client_id)
            : null;
        $avg   = $stats ? number_format((float)$stats->avg_rating, 1) : '0.0';
        $count = $stats->total_ratings ?? 0;
      @endphp
      <div class="star position-absolute">
        <span class="badge badge-success">
          <i class="icofont-star"></i> {{ $avg }} ({{ $count }})
        </span>
      </div>
      <div class="favourite-heart text-danger position-absolute">
        <a href="{{ route('res.details',$product->client_id) }}"><i class="icofont-heart"></i></a>
      </div>
      <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
      <a href="{{ route('res.details',$product->client_id) }}">
        <img src="{{ asset($product->image) }}" class="img-fluid item-img">
      </a>
    </div>
    <div class="p-3 position-relative">
      <div class="list-card-body">
        <h6 class="mb-1">
          <a href="{{ route('res.details',$product->client_id) }}" class="text-black">{{ $product->name }}</a>
        </h6>
        <p class="text-gray mb-3 time">
          <span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2">
            <i class="icofont-wall-clock"></i> 20–25 min
          </span>
          <span class="float-right text-black-50">{{ $product->price }}</span>
        </p>
      </div>

      @php
        $coupon = isset($couponsByClient) && $couponsByClient instanceof \Illuminate\Support\Collection
                  ? $couponsByClient->get($product->client_id)
                  : null;
      @endphp
      @if($coupon)
        <div class="list-card-badge">
          <span class="badge badge-success">OFFER</span>
          <small>
            @if(isset($coupon->discount) && isset($coupon->discount_type) && $coupon->discount_type === 'percent')
              {{ (int) $coupon->discount }}% off |
            @elseif(isset($coupon->discount))
              Save {{ number_format($coupon->discount, 2) }} |
            @endif
            Use Coupon {{ $coupon->coupon_code ?? $coupon->coupon_name ?? 'OFFER' }}
          </small>
        </div>
      @endif
    </div>
  </div>
</div>
@endforeach