@extends('layouts.app')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Product Bulk Update')}}</h3>
        </div>
        <div class="panel-body">
            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                <strong>Step 1:</strong>
                <p>1. Download the product csv file and update data.</p>
                <p>2. Once you have downloaded and updated the file, upload it in the form below and submit.</p>
            </div>
            <br>
            <div class="">
            <a href="{{route('product_bulk_update_export')}}" download><button class="btn btn-primary">Download Products CSV</button></a>
            </div>
            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                <strong>Step 2:</strong>
                <p>1. Category,Sub category,Sub Sub category and Brand should be in numerical ids.</p>
                <p>2. You can download the pdf to get Category,Sub category,Sub Sub category and Brand id.</p>
            </div>
            <br>
            <div class="">
                <a href="{{ route('pdf.download_category') }}"><button class="btn btn-primary">Download Category</button></a>
                <a href="{{ route('pdf.download_sub_category') }}"><button class="btn btn-primary">Download Sub category</button></a>
                <a href="{{ route('pdf.download_sub_sub_category') }}"><button class="btn btn-primary">Download Sub Sub category</button></a>
                <a href="{{ route('pdf.download_brand') }}"><button class="btn btn-primary">Download Brand</button></a>
            </div>
            <br>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <h1 class="panel-title"><strong>{{__('Upload Product File')}}</strong></h1>
        </div>
        <div class="panel-body">
        <form class="form-horizontal" action="{{route('product_bulk_update_import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control" name="bulk_update_file" required>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="submit">{{__('Upload CSV')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
