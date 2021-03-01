<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Home Collections')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_collections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel-body">
            <div class="form-group" id="category">
                <label class="col-lg-2 control-label">{{__('Collection')}}</label>
                <div class="col-lg-7">
                    <select class="form-control demo-select2-placeholder" name="collection_id" id="collection_id" required>
                        @foreach(\App\Collections::all() as $collection)
                            @if (\App\HomeCollection::where('collection_id', $collection->id)->first() == null)
                                <option value="{{$collection->id}}">{{__($collection->title)}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group" id="subsubcategory">
                <label class="col-lg-2 control-label">{{__('Page_size')}}</label>
                <div class="col-lg-7">
                <input type="number" name="page_size" class="form-control demo-select2-placeholder" required>
                </select>
                </div>
            </div>

        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
        </div>
    </form>
    <!--===================================================-->
    <!--End Horizontal Form-->

</div>
