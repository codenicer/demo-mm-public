<div class='position-relative' style="{{'width: 100%; padding-bottom: 100%; background: url('.asset($category->icon).') no-repeat center center / cover;'}}">
    <a class='w-100 h-100' href="{{ route('product.category', $category->slug) }}" style="position: absolute; top: 0; left: 0; z-index: 3; cursor: pointer"></a>
    <div class='position-absolute h-100 w-100 d-flex align-items-center justify-content-center text-white text-center pointer' style='background: rgba(0,0,0,.3)'>
        <span style="font-size:1rem">{{$category->name}}</span>

    </div>
</div>
