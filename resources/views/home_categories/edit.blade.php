<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Home Categories')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_categories.update', $homeCategory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="panel-body">
            <div class="form-group" id="category">
                <label class="col-lg-2 control-label">{{__('Category')}}</label>
                <div class="col-lg-7">
                    <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
                        @foreach(\App\Category::all() as $category)
                            <option value="{{$category->id}}" @php if($homeCategory->category_id == $category->id) echo "selected"; @endphp>{{__($category->name)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group" id="subsubcategory">
                <label class="col-lg-2 control-label">{{__('Page Size')}}</label>
                <div class="col-lg-7">
                    <select class="form-control demo-select2-max-4" name="page_size" id="page_size" required>
                        <option value="2" @php if($homeCategory->page_size == 2) echo "selected"; @endphp>2</option>
                        <option value="4" @php if($homeCategory->page_size == 4) echo "selected"; @endphp>4</option>
                        <option value="6" @php if($homeCategory->page_size == 6) echo "selected"; @endphp>6</option>
                        <option value="8" @php if($homeCategory->page_size == 8) echo "selected"; @endphp>8</option>
                        <option value="12" @php if($homeCategory->page_size == 12) echo "selected"; @endphp>12</option>
                        <option value="18" @php if($homeCategory->page_size == 18) echo "selected"; @endphp>18</option>
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
