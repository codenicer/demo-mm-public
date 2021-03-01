<div class="mb-1">
    <div class="container">
        <div class="section-title-1 clearfix">
            <h3 class="heading-5 strong-700 mb-0 float-left">
                <span class="mr-4">{{__('Top Selling Brands')}}</span>
            </h3>
        </div>
        <div class="row">
            @foreach ($bestBrands as $brand)
                <div class="mb-2 col-3">
                    <a href="{{ route('top_brands.product-list', $brand->slug) }}" class="bg-white border d-block c-base-2 box-2 icon-anim pl-2">
                        <div class="row align-items-center no-gutters">
                            <div class="col-3 text-center">
                                <img src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($brand->logo) }}" alt="{{ __($brand->name) }}" class="img-fluid img lazyload">
                            </div>
                            <div class="info col-7">
                                <div class="name text-truncate pl-3 py-4">{{ __($brand->name) }}</div>
                            </div>
                            <div class="col-2 text-center">
                                <i class="la la-angle-right c-base-1"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
