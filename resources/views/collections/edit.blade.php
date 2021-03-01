@extends('layouts.app')

@section('content')

<style>
    .r-style{
        justify-content: space-between;
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

    .collection-modal-wrap {
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

    .collection-modal-body {
        width: 70%;
        min-height: 50%;
        background: white;
        border-radius: 2px;
        flex-direction: column;
        padding: 5px 10px;
    }

    .collection-title {
        flex-grow: 1;
    }

    .collection-button {
        padding: 5px;
        cursor: pointer;
    }

    .collection-button > i {
        font-size: 1.8rem;
    }

    .collection-modal-wrap-open,
    .collection-modal-body,
    .collection-body-title {
        display: flex;
    }
</style>
<div class='collection-modal-wrap'>
    <div class='collection-modal-body'>
        <div class="collection-body-title">
            <h4 class='collection-title'>Collection Product Import</h4>
            <div class='collection-button' onclick="closeModal()">
                <i class="fa fa-close"></i>
            </div>

        </div>
        @include('collections.modal_content',[
           'collection_id' => $collection->id,
           'collection_title'=>$collection->title
        ])
    </div>
</div>

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading d-flex r-style">
                <h3 class="panel-title">{{__("Collection's Product")}}</h3>
                {{-- <button class='modal-btn' onclick='openModal()'>pindot</button> --}}
                <a href="{{route('export_collection_product', $collection->id)}}"  class="r-button-default-csv btn" >Export Product list on this Collection</a>
                {{-- <a  href="{{route('export_collection_product')}}"   class="r-button-default-csv btn" >Export Default Products</a> --}}
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading  d-flex r-style">
                <h3 class="panel-title">{{__('Collection Name')}}: <span class="text-dark">{{__($collection->title)}}</span></h3>
                <div>
                    <button  onclick='openModal()' class="r-button-import btn btn-purple" >Import Products</button>
                </div>

            </div>
            <div class="panel-body">

                <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th width="20%">{{__('Name')}}</th>
                        <th>{{__('Photo')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Prices')}}</th>
                        <th>{{__('Set To Collection')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allProducts as $key => $product)

                        <tr>
                            {{-- {{  dd($product)}} --}}
                            <td>{{$product->product_id}}</td>

                            <td><a {{isset($product->slug) ? " href=".route('product', $product->slug )."": ""}} target="_blank">{{ __($product->name) }}</a></td>
                            <td><img class="img-md" src="{{ asset($product->featured_img)}}" alt="Image"></td>
                            <td>{{$product->variations ? $product->variations  :'N/A'}}</td>

                            <td>Base price: {{ number_format($product->unit_price,2) }}

                                @php

                                    //echo print_r(count($hub_prices),1);
                                    // $qty = 0;
                                    foreach ($product->hubs as $hub_prices) {
                                        echo '<BR/>'.$hub_prices->address.":".number_format($hub_prices->pivot->unit_price,2);
                                     }
                                    // echo $qty;
                                @endphp


                            </td>
                            <td><label class="switch">
                                    <input onchange="update_featured(this)" value="{{ $product->product_id }}" type="checkbox" <?php if(in_array($product->product_id, $product_id) ) echo "checked";?> >
                                    <span class="slider round"></span></label></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection

@section('script')
        <script type="text/javascript">
          function openModal(){
              $('.collection-modal-wrap').addClass('collection-modal-wrap-open')
          }

          function closeModal() {
            $('.collection-modal-wrap').removeClass('collection-modal-wrap-open')
          }
         function update_featured(el){
            if(el.checked){
              var status = 1;
            }
            else{
              var status = 0;
            }
            $.post('{{ route('collections.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status,collection_id:{{$collection->id}}}, function(data){
              if(data == 1){
                showAlert('success', 'Product successfully set to this collection.');
              }
              else{
                showAlert('danger', 'Something went wrong');
              }
            });
          }

          function export_default_products(){

               $('.r-button-default-csv').text("Exporting please wait...")
               $('.r-button-default-csv').attr('disabled','true')

               $.ajax({
                         url: '{{ route('product_bulk_export.index')  }}',
                         data:{_token:'{{ csrf_token() }}'},
                         success: download.bind(true, "products", "test.xlsx")
                    });
            //    $.ajax({url: {{  route('product_bulk_export.index')  }},
            //      {_token:'{{ csrf_token() }}'}
            //     success: download.bind(true, "products.xlsx", "xlsx")
            //     });
                // $.get('{{  route('product_bulk_export.index')  }}',, function(response, status, xhr){
                //     console.log(xhr)
                //     $('.r-button-default-csv').removeAttr('disabled')
                //     $('.r-button-default-csv').text( "Export Default Products")

                //         });
          }
    </script>

@endsection
