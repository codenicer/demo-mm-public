
<div class="panel">
    <div class="panel-body">
        <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
            <strong>Step by Step Instruction:</strong>
            <p>1. Export Products from table by clicking Export Products button. ( NOTE:You can filter product before exporting. )</p>
            <p>2. Update Columns on downloaded CSV file.</p>
            <p>3. Submit the edited file below</p>
            <p>4. Check the updated products.</p>
        </div>

    </div>
    <div class="panel-heading">
        <h1 class="panel-title"><strong>{{__('Upload Product File')}}</strong></h1>
    </div>
    <div class="panel-body">
    <form class="form-horizontal" action="{{route('product_price_bulk_update.import_products')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" class="form-control" name="bulk_file_update" required>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <button class="btn btn-primary" type="submit">{{__('Submit Products')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
