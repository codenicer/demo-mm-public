<div class="d-flex align-items-center py-1">
    <img src="{{ asset( isset($cartItem['thumbnail_img']) ? $cartItem['thumbnail_img'] : 'frontend/images/placeholder.jpg') }}" alt="" style='width: 50px;'>
    <a class='flex-grow-1 mx-2' href="#">
        {{ __($cartItem['name']) }}
    </a>
    <span class="text-center" style='min-width: 30px'>x{{ $cartItem['quantity'] }}</span>
    <span class="dc-price text-right" style='min-width: 80px'>{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>
    <i onclick='removeFromCartMobile("{{$cartItem['id']}}")' class="la la-trash px-2 text-lg text-danger" style='min-width: 20px'></i>
</div>
