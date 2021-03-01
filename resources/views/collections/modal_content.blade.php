
<div class="panel">
    <div class="panel-body">
        <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
            <strong>Step by Step Instruction:</strong>
            <p>1. You can download the Product list of this collection here. <a class="btn btn-primary btn-small" href="{{route('export_collection_product', $collection_id)}}">
                {{$collection_title.' Product List Download.'}}</a></p>
            <p>2. Or Download the default product list here. <a class="btn btn-primary btn-small" href="{{route('export_default_product.index')}}"  >Default Product List Download</a></p>
            <p>3. Then change set_to_collection column from 'N' to 'Y' (uppercase or lowercase) for product you want to set on this collection</p>
            <p>4. Edit prioritization column you want to prioritized first (highest to lowest).</p>
            <p>5. Submit the edited file and check the updated collection.</p>
        </div>

    </div>
    <div class="panel-heading">
        <h1 class="panel-title"><strong>{{__('Upload Product File')}}</strong></h1>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="{{ route('import_collection_product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="hidden" name="collection_id" value={{$collection_id}}>
                <input type="file" class="form-control" name="import_collection_product" required>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <button class="btn btn-primary" type="submit">{{__('Import Products')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
