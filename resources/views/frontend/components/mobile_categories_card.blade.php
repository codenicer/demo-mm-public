<div class='d-flex flex-column text-center p-2 position-relative bg-white'>
    <a class='w-100 h-100 position-absolute' href="{{ route('product.category', $category->slug) }}" style="top: 0; left: 0; z-index: 3; cursor: pointer"></a>
    <div class='w-100' style="{{'padding-bottom: 100%; background: url('.asset($category->banner).') no-repeat center center / cover;'}}"></div>
    <div class='flex-grow-1 text-sm'>{{$category->name}}</div>
</div>
