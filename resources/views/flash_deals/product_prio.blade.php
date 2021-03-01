@extends('layouts.app')

{{-- {{dd($all_products,)}} --}}
@section('content')
    <style>
        .haha:hover{
            background-color:rgb(0, 255, 0,0.2) !important;
            cursor:pointer;
        }
    </style>

    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-headinßßg">
                <h3 class="panel-title">{{__("Flash Deal's Priority Product")}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{__('Flash Deal Name')}}: <span class="text-dark">{{__($flashDeal->title)}}</span></h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered demo-dt-basic-priority" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><i class="fa fa-bars"></i></th>
                            <th width="80%">{{__('Name')}}</th>

                        </tr>
                        </thead>
                      <tbody id="collectionlist">
                            @foreach($all_products as $key => $product)
                            {{-- <tr id="home_category_id:{{$home_category->id}}" class="sortable1" data-content="data:{{$home_category->id}}" >
                                <td class="text-center" style="font-size: 20px;"><i class="fa fa-not-equal" ></i>
                            </td> --}}
                            {{-- {{dd($product->product_id)}} --}}
                            {{-- <tr id="{{$product->product_id}}" class="haha">
                                <td><i style="font-size:20px;" class="fa fa-bars"></i></td>
                                <td>{{$product->name}}</td>
                                <input type="hidden" value="{{$product->product_id}}" id="item" name="item">
                             </tr> --}}
                             <tr id="home_category_id:{{$product->product_id}}" style="cursor: pointer;" data-content="data:{{$product->product_id}}" >
                                <td class="text-center" style="font-size: 20px;"><i class="fa fa-bars"></i>
                                </td>

                            <td>{{$product->product_id}} {{$product->name}}</td>
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
            <script
                    src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
                    integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
                    crossorigin="anonymous"></script>
            <script>

              var $sortableSlider = $("#collectionlist");
              $sortableSlider.sortable({
                items: "tr:not(.sortable3)",
                stop: function(event, ui){
                        $.post('{{ route("flash_deals.product_prio_update") }}',{_token:'{{ csrf_token() }}',  data: {
                                previous: ui.item[0].previousElementSibling ? ui.item[0].previousElementSibling.id : 0,
                                item: ui.item[0].id,
                                next: ui.item[0].nextElementSibling ? ui.item[0].nextElementSibling.id : 0,
                                f_id: '{{$flashDeal->id}}'
                            }} ,function(result){
                                    if(result == 1){
                                    showAlert('success','Priority updated successfully');
                                    }else{
                                    showAlert('danger','Something went wrong');
                                    }
                        })
                }
              })


            </script>

@endsection
