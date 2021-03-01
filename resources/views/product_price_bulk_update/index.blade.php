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
            <h4 class='collection-title'>Product Stock/Price Import</h4>
            <div class='collection-button' onclick="closeModal()">
                <i class="fa fa-close"></i>
            </div>

        </div>
        @include('product_price_bulk_update.modal_context',[
            //    'collection_id' => $collection->id
        ])
    </div>
</div>

<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading  d-flex r-style">
        <h3 class="panel-title">{{__('Product Stock List')}}</h3>
        <div>
            <button  onclick='openModal()' class="r-button-import btn btn-purple" style="margin-top: 1rem" >Import Products</button>
        </div>

    </div>
    <div class="panel-body">
        <div>
            <div class="col-sm-12" style="margin-bottom: 2rem;">
              {{-- <form action="{{route('product_price_bulk_update.sortBy')}}" method="POST"  > --}}
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class=" control-label" for="name">{{__('Filter Brand')}}</label>
                                <div >
                                    <select onchange="filterOnchangeSubmit(this)" name="brand" id="brand" class="form-control demo-select2"  required data-placeholder="Choose Brand">
                                        @if ($selected_brand != null)
                                            <option value="{{$selected_brand->id}}">{{__($selected_brand->name)}}</option>
                                            <option value="0" >{{'Clear Filter'}}</option>
                                        @else
                                            <option value="0" >{{'Choose Brand'}}</option>
                                        @endif
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{__($brand->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class=" control-label" for="name">{{__('Filter Category')}}</label>
                                <div >
                                    <select onchange="filterOnchangeSubmit(this)" name="category" id="category" class="form-control demo-select2"  required data-placeholder="Choose Category">
                                        @if ($selected_category != null)
                                            <option value="{{$selected_category->id}}">{{__($selected_category->name)}}</option>
                                            <option value="0" >{{'Clear Filter'}}</option>
                                        @else
                                            <option value="0" >{{'Choose Category'}}</option>
                                        @endif
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{__($category->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class=" control-label" for="name">{{__('Filter Sub-Category')}}</label>
                                <div >
                                    {{-- {{dd()}} --}}
                                    <select onchange="filterOnchangeSubmit(this)" name="sub_category" id="sub_category" class="form-control demo-select2"  required data-placeholder="Choose Sub-Category">

                                                @if ($selected_subcategory != null && $selected_category != null)
                                                    <option value="{{$selected_subcategory->id}}">{{__($selected_subcategory->name)}}</option>
                                                    <option value="0" >{{'Clear Filter'}}</option>
                                                @elseif ($selected_category != null &&  $sub_categories->count() > 0 )
                                                    <option value="0" >{{'Choose Sub-Category'}}</option>
                                                @else
                                                     <option value="0" >{{'No Selection Available'}}</option>
                                                @endif

                                                @foreach($sub_categories as $sub_category)
                                                    <option value="{{$sub_category->id}}">{{__($sub_category->name)}}</option>
                                                @endforeach


                                    </select>
                                </div>

                            </div>
                        </div>
                        {{-- {{dd(isset($selected_brand),isset($selected_category),isset($selected_category) ,$selected_category->id )}} --}}
                        <div class="col-sm-1" style="margin: 2.1rem;">
                            <a href="{{route('product_price_bulk_update.export_products') . '?'. http_build_query([

                                'brand_id' =>isset($selected_brand) ? $selected_brand->id :null,
                                'category_id'=> isset($selected_category )? $selected_category->id : null  ,
                                'sub_category_id'=>isset($selected_subcategory) ? $selected_subcategory->id : null

                                ]) }}" class="btn btn-rounded btn-info pull-right">{{__('Export Products')}}</a>
                        </div>

                {{-- </form> --}}
            </div>

        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Product Name')}}</th>
                    <th>{{ __('Variant') }}</th>
                    <th>{{ __('SKU') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th width="10%">{{__('Quantity')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach($productStock  as $key => $product)

                        <td>{{$key+1}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->variant}}</td>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->qty}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="clearfix">
            <div class="pull-right">
                {{ $productStock->appends(request()->input())->links() }}
            </div>
        </div> --}}
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">
        function filterOnchangeSubmit (e){

                const brand_filter_value = $('#brand').val()
                const catrgory_filter_value =  $('#category').val()
                const sub_category_filter_value =  $('#sub_category').val()
                let params = {}

                if(e.name == "brand"){

                    if(brand_filter_value != 0){
                           params = {...params,"brand_id":brand_filter_value}
                    }

                }else if(e.name == "category"){

                    if(brand_filter_value != 0){
                             params = {...params,"brand_id":brand_filter_value}
                    }

                    if(catrgory_filter_value != 0){
                        params = {...params,"category_id":catrgory_filter_value}
                    }

                }else {

                    if(brand_filter_value != 0){
                         params = {...params,"brand_id":brand_filter_value}
                    }

                    if(catrgory_filter_value != 0){
                        params = {...params,"category_id":catrgory_filter_value}
                    }

                    if(sub_category_filter_value != 0){
                        params = {...params,"sub_category_id":sub_category_filter_value}
                    }

                }



               return  window.location = '{{route('product_price_bulk_update.sortBy')}}'+'?'+$.param(params)
        }

        function openModal(){
              $('.collection-modal-wrap').addClass('collection-modal-wrap-open')
          }

          function closeModal() {
            $('.collection-modal-wrap').removeClass('collection-modal-wrap-open')
          }

    </script>
@endsection
