<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Home Collections')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_collections.update', $homeCollections->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="panel-body">
            <div class="form-group" id="category">
                <label class="col-lg-2 control-label">{{__('Collections')}}</label>
                <div class="col-lg-7">
                    <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
                        @foreach(\App\Collections::all() as $collection)
                            <option value="{{$collection->id}}" @php if($homeCollections->collection_id == $collection->id) echo "selected"; @endphp>{{__($collection->title)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        <div class="form-group" id="subsubcategory">
                <label class="col-lg-2 control-label">{{__('Page_size')}}</label>
                <div class="col-lg-7">
                <input type="number" name="page_size" class="form-control demo-select2-placeholder" value="{{$homeCollections->page_size}}" required>
                </select>
                </div>
            </div>
        <div class="panel-footer text-right">
            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
        </div>
    </form>
    <!--===================================================-->
    <!--End Horizontal Form-->

</div>
