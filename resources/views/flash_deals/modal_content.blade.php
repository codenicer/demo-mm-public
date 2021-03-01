
<div class="panel">
    <div class="panel-body">
        <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
            <strong>Step by Step Instruction:</strong>
             <p>1. You can download product list of this flash deal. <a class="btn btn-primary btn-small" href="{{route('export_flashdeal_product',$flash_deal_id)}}" >{{
                 "Download ".strtolower($flash_deal_title)." product list"
             }}</a></p>
            <p>2. Or download the flash deal default product list. <a class="btn btn-primary btn-small" href="{{route('export_default_flashdeal_product.index')}}"  >Download flash deal default product</a></p>
            <p>3. Then change set_to_flashdeal column from 'N' to 'Y' (uppercase or lowercase) for product you want to set on this flashdeal</p>
            <p>4. Edit discount amount (numeric) and discount type column ('amount' or 'percent')</p>
            <p>5. And the prioritization column you want to prioritized first (highest to lowest).</p>
            <p>6. Submit the edited file and check the updated flashdeal product.</p>
        </div>

    </div>
    <div class="panel-heading">
        <h1 class="panel-title"><strong>{{__('Upload Product File')}}</strong></h1>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="{{ route('import_flashdeal_product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="hidden" name='flash_deal_id' value="{{$flash_deal_id}}">
                <input type="file" class="form-control" name="import_flash_deal_product" required>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <button class="btn btn-primary" type="submit">{{__('Import Products')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
