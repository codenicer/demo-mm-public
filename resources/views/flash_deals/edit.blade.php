@extends('layouts.app')

@section('content')

<style>
     .r-style{
        justify-content: space-between;
    }
     .r-end{
         flex-direction: column;
        /* align-content: flex-end; */
        align-items: flex-end;
     }
    .r-button-default-csv{
         margin: .5rem;
    }
    .r-button-import{
        margin: 0 2rem 0 0;
        max-height: 3.4rem;

    }
    .btn-small {
        padding: 2px 10px;
        font-size: 11.9px;
        -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
                border-radius: 3px;
        }


    .flashdeal-modal-wrap {
        display: none;
        top: 0;
        left: 0;
        z-index: 99999;
        position: fixed;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,.6);
        align-items: center;
        justify-content: center;
    }

    .flashdeal-modal-body {
        width: 70%;
        min-height: 50%;
        background: white;
        border-radius: 2px;
        flex-direction: column;
        padding: 5px 10px;
    }

    .flashdeal-title {
        flex-grow: 1;
    }

    .flashdeal-button {
        padding: 5px;
        cursor: pointer;
    }

    .flashdeal-button > i {
        font-size: 1.8rem;
    }

    .flashdeal-modal-wrap-open,
    .flashdeal-modal-body,
    .flashdeal-body-title {
        display: flex;
    }

</style>

<div class='flashdeal-modal-wrap'>
    <div class='flashdeal-modal-body'>
        <div class="flashdeal-body-title">
            <h4 class='flashdeal-title'>Flash Deal Product Import</h4>
            <div class='flashdeal-button' onclick="closeModal()">
                <i class="fa fa-close"></i>
            </div>
        </div>
        @include('flash_deals.modal_content',[
            'flash_deal_id'=>$flashDeal->id,
            'flash_deal_title'=>$flashDeal->title
        ])
    </div>
</div>

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading d-flex r-style">
            <h3 class="panel-title">{{__('Flash Deal Information ')}}</h3>
        <a class="btn" href="{{route('export_flashdeal_product',$flashDeal->id)}}">{{"Download ".$flashDeal->title." produst list."}}</a>
        </div>
        <div class="d-flex r-end">
                <button  onclick='openModal()' class="r-button-import btn btn-purple" >Import Products</button>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('flash_deals.update', $flashDeal->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
        <input type="hidden" name="_method" value="PATCH">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Title')}}" id="name" name="title"
                            value="{{ $flashDeal->title }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="start_date">{{__('Date')}}</label>
                    <div class="col-sm-9">
                        <div class="d-flex align-items-center">
                            <input type="datetime-local" class="form-control" name="start_date"

                                value="{{ date('Y-m-d\TH:i:s', strtotime($flashDeal->start_date)) }}">
                            <span style='padding: 5px 10px'>{{__('to')}}</span>
                            <input type="datetime-local" class="form-control" name="end_date"
                                value="{{ date('Y-m-d\TH:i:s', strtotime($flashDeal->end_date)) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="products">{{__('Products')}}</label>
                    <div class="col-sm-9">
                        <select name="products[]" id="products" class="form-control demo-select2" multiple required
                            data-placeholder="Choose Products">
                            @foreach(\App\Product::all() as $product)
                            @php
                                $flashDealProduct = \App\FlashDealProduct::where('flash_deal_id',
                                $flashDeal->id)->where('product_id', $product->product_id)->first();
                            @endphp
                            <option value="{{$product->product_id}}"
                                <?php if($flashDealProduct != null) echo "selected";?>>{{__($product->name)}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group" id="discount_table">

                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    function openModal(){
        $('.flashdeal-modal-wrap').addClass('flashdeal-modal-wrap-open')
    }

    function closeModal() {
        $('.flashdeal-modal-wrap').removeClass('flashdeal-modal-wrap-open')
    }

    $(document).ready(function(){

            get_flash_deal_discount();

            $('#products').on('change', function(){
                get_flash_deal_discount();
            });

            function get_flash_deal_discount(){
                var product_ids = $('#products').val();
                if(product_ids.length > 0){
                    $.post('{{ route('flash_deals.product_discount_edit') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids, flash_deal_id:{{ $flashDeal->id }}}, function(data){
                        $('#discount_table').html(data);
                        $('.demo-select2').select2();
                    });
                }
                else{
                    $('#discount_table').html(null);
                }
            }
        });
</script>
@endsection
