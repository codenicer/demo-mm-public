@extends('layouts.app')

@section('content')
    <style>
        .sortable2 {cursor: not-allowed;}
        .sogreen {background-color: green;}
    </style>
    <div class="tab-base">

        <!--Nav Tabs-->
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#demo-lft-tab-0" aria-expanded="true">{{ __('Home Settings') }}</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-1" aria-expanded="false">{{ __('Home slider') }}</a>
            </li>
            @if(getBusinessSettings('show_home_banner_1'))
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-2" aria-expanded="false">{{ __('Home banner 1') }}</a>
            </li>
            @endif
            @if(getBusinessSettings('show_home_categories'))
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-4" aria-expanded="false">{{ __('Home Categories') }}</a>
            </li>
            @endif
            @if(getBusinessSettings('show_home_collections'))
                <li class="">
                    <a data-toggle="tab" href="#demo-lft-tab-5" aria-expanded="false">{{ __('Home Collections') }}</a>
                </li>
            @endif
            @if(getBusinessSettings('show_home_banner_2'))
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-3" aria-expanded="false">{{ __('Home banner 2') }}</a>
            </li>
            @endif
            @if(getBusinessSettings('show_home_best_sellers'))
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-6" aria-expanded="false">{{ __('Best Seller') }}</a>
            </li>
            @endif
        </ul>

        <!--Tabs Content-->
        <div class="tab-content">
            <div id="demo-lft-tab-0" class="tab-pane fade active in">
                <br>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Settings')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{__('Component')}}</th>
                                    <th>{{__('Show')}}</th>
                                    <th >{{__('Attribute')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   <td>Home Categories</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_categories')"  value="{{ getBusinessSettings('show_home_categories')  }}" type="checkbox" <?php if(getBusinessSettings('show_home_categories') == 1) echo "checked";?>   >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>Show Featured Only
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_featured_categories')"  value="{{ getBusinessSettings('show_home_featured_categories')  }}"  <?php if(getBusinessSettings('show_home_featured_categories') == 1) echo "checked";?>  type="checkbox"  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Flash Sale</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_flash_deals')"  value="{{ getBusinessSettings('show_home_flash_deals')  }}"  <?php if(getBusinessSettings('show_home_flash_deals') == 1) echo "checked";?>  type="checkbox"  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label for="FS_limit">
                                            Products to show
                                        </label>
                                        <select class="form-control" name="FS_limit" id="FS_limit" onchange="update_home_settings(this, 'home_flash_deal_size')">
                                            <option value="2" {{ getBusinessSettings('home_flash_deal_size') == 2 ?  'selected' :'' }}>2</option>
                                            <option value="4" {{ getBusinessSettings('home_flash_deal_size') == 4 ?  'selected' :'' }}>4</option>
                                            <option value="6" {{ getBusinessSettings('home_flash_deal_size') == 6 ?  'selected' :'' }}>6</option>
                                            <option value="8" {{ getBusinessSettings('home_flash_deal_size') == 8 ?  'selected' :'' }}>8</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Campaign</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_campaigns')"  value="{{ getBusinessSettings('show_home_campaigns')  }}"  <?php if(getBusinessSettings('show_home_campaigns') == 1) echo "checked";?>  type="checkbox"  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label for="FS_limit1">
                                            Products to show
                                        </label>
                                        <select class="form-control" name="FS_limit1" id="FS_limit1" onchange="update_home_settings(this, 'home_campaign_size')">
                                            <option value="2" {{ getBusinessSettings('home_campaign_size') == 2 ?  'selected' :'' }}>2</option>
                                            <option value="4" {{ getBusinessSettings('home_campaign_size') == 4 ?  'selected' :'' }}>4</option>
                                            <option value="6" {{ getBusinessSettings('home_campaign_size') == 6 ?  'selected' :'' }}>6</option>
                                            <option value="8" {{ getBusinessSettings('home_campaign_size') == 8 ?  'selected' :'' }}>8</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Home Collections</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_collections')"  value="{{ getBusinessSettings('show_home_collections')  }}"  <?php if(getBusinessSettings('show_home_collections') == 1) echo "checked";?>  type="checkbox"  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label for="FS_limit2">
                                            Collections to show
                                        </label>
                                        <select class="form-control" name="FS_limit2" id="FS_limit2" onchange="update_home_settings(this, 'home_collection_size')">
                                            <option value="2" {{ getBusinessSettings('home_collection_size') == 2 ?  'selected' :'' }}>2</option>
                                            <option value="4" {{ getBusinessSettings('home_collection_size') == 4 ?  'selected' :'' }}>4</option>
                                            <option value="6" {{ getBusinessSettings('home_collection_size') == 6 ?  'selected' :'' }}>6</option>
                                            <option value="8" {{ getBusinessSettings('home_collection_size') == 8 ?  'selected' :'' }}>8</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Best Sellers</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_best_sellers')"  value="{{ getBusinessSettings('show_home_best_sellers')  }}"  <?php if(getBusinessSettings('show_home_best_sellers') == 1) echo "checked";?>  type="checkbox"  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label for="FS_limit3">
                                            Products to show
                                        </label>
                                        <select class="form-control" name="FS_limit3" id="FS_limit3" onchange="update_home_settings(this, 'home_best_seller_size')">
                                            <option value="2" {{ getBusinessSettings('home_best_seller_size') == 2 ?  'selected' :'' }}>2</option>
                                            <option value="4" {{ getBusinessSettings('home_best_seller_size') == 4 ?  'selected' :'' }}>4</option>
                                            <option value="6" {{ getBusinessSettings('home_best_seller_size') == 6 ?  'selected' :'' }}>6</option>
                                            <option value="8" {{ getBusinessSettings('home_best_seller_size') == 8 ?  'selected' :'' }}>8</option>
                                            <option value="12" {{ getBusinessSettings('home_best_seller_size') == 12 ?  'selected' :'' }}>12</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Featured Products</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_featured_products')"  value="{{ getBusinessSettings('show_home_featured_products')  }}"  <?php if(getBusinessSettings('show_home_featured_products') == 1) echo "checked";?>  type="checkbox"  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label for="FS_limit4">
                                            Products to show
                                        </label>
                                        <select class="form-control" name="FS_limit4" id="FS_limit4" onchange="update_home_settings(this, 'home_featured_product_size')">
                                            <option value="2" {{ getBusinessSettings('home_featured_product_size') == 2 ?  'selected' :'' }}>2</option>
                                            <option value="4" {{ getBusinessSettings('home_featured_product_size') == 4 ?  'selected' :'' }}>4</option>
                                            <option value="6" {{ getBusinessSettings('home_featured_product_size') == 6 ?  'selected' :'' }}>6</option>
                                            <option value="8" {{ getBusinessSettings('home_featured_product_size') == 8 ?  'selected' :'' }}>8</option>
                                            <option value="12" {{ getBusinessSettings('home_featured_product_size') == 12 ?  'selected' :'' }}>12</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Best Selling Brands</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_brands')"  value="{{ getBusinessSettings('show_home_brands')  }}"  <?php if(getBusinessSettings('show_home_brands') == 1) echo "checked";?>  type="checkbox"  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label for="FS_limit5">
                                            Brands to show
                                        </label>
                                        <select class="form-control" name="FS_limit5" id="FS_limit5" onchange="update_home_settings(this, 'home_brand_size')">
                                            <option value="2" {{ getBusinessSettings('home_brand_size') == 2 ?  'selected' :'' }}>2</option>
                                            <option value="4" {{ getBusinessSettings('home_brand_size') == 4 ?  'selected' :'' }}>4</option>
                                            <option value="6" {{ getBusinessSettings('home_brand_size') == 6 ?  'selected' :'' }}>6</option>
                                            <option value="8" {{ getBusinessSettings('home_brand_size') == 8 ?  'selected' :'' }}>8</option>
                                            <option value="12" {{ getBusinessSettings('home_brand_size') == 12 ?  'selected' :'' }}>12</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Banner 1</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_banner_1')"  value="{{ getBusinessSettings('show_home_banner_1')  }}"  <?php if(getBusinessSettings('show_home_banner_1') == 1) echo "checked";?>  type="checkbox"  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label for="FS_limit6">
                                            Banners to show
                                        </label>
                                        <select class="form-control" name="FS_limit6" id="FS_limit6" onchange="update_home_settings(this, 'home_banner1_size')">
                                            <option value="2" {{ getBusinessSettings('home_banner1_size') == 2 ?  'selected' :'' }}>2</option>
                                            <option value="3" {{ getBusinessSettings('home_banner1_size') == 3 ?  'selected' :'' }}>3</option>
                                            <option value="4" {{ getBusinessSettings('home_banner1_size') == 4 ?  'selected' :'' }}>4</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Banner 2</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_home_settings(this, 'show_home_banner_2')"  value="{{ getBusinessSettings('show_home_banner_2')  }}"  <?php if(getBusinessSettings('show_home_banner_2') == 1) echo "checked";?>  type="checkbox"  >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label for="FS_limit6">
                                            Banners to show
                                        </label>
                                        <select class="form-control" name="FS_limit6" id="FS_limit6" onchange="update_home_settings(this, 'home_banner2_size')">
                                            <option value="2" {{ getBusinessSettings('home_banner2_size') == 2 ?  'selected' :'' }}>2</option>
                                            <option value="3" {{ getBusinessSettings('home_banner2_size') == 3 ?  'selected' :'' }}>3</option>
                                            <option value="4" {{ getBusinessSettings('home_banner2_size') == 4 ?  'selected' :'' }}>4</option>

                                        </select>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-12 pull-left">
                                <div>Note: Changes may not be applied after 10 minutes.</div>
                                <a onclick="apply_setting_to_home()" class="btn btn-rounded btn-success pull-left">{{__('Apply Settings to Homepage Now!')}}</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-1" class="tab-pane fade">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_slider()" class="btn btn-rounded btn-info pull-right">{{__('Add New Slider')}}</a>
                    </div>
                </div>

                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home slider')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Photo')}}</th>
                                    <th width="50%">{{__('Link')}}</th>
                                    <th>{{__('Published')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Slider::all() as $key => $slider)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img loading="lazy"  class="img-md" src="{{ asset($slider->photo)}}" alt="Slider Image"></td>
                                        <td>{{$slider->link}}</td>
                                        <td><label class="switch">
                                            <input onchange="update_slider_published(this)" value="{{ $slider->id }}" type="checkbox" <?php if($slider->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="confirm_modal('{{route('sliders.destroy', $slider->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <div id="demo-lft-tab-2" class="tab-pane fade">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_banner_1()" class="btn btn-rounded btn-info pull-right">{{__('Add New Banner')}}</a>
                    </div>
                </div>

                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home banner')}} (Max 3 published)</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Photo')}}</th>
                                    <th>{{__('Position')}}</th>
                                    <th>{{__('Published')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Banner::where('position', 1)->get() as $key => $banner)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img loading="lazy"  class="img-md" src="{{ asset($banner->photo)}}" alt="banner Image"></td>
                                        <td>{{ __('Banner Position ') }}{{ $banner->position }}</td>
                                        <td><label class="switch">
                                            <input onchange="update_banner_published(this)" value="{{ $banner->id }}" type="checkbox" <?php if($banner->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="edit_home_banner_1({{ $banner->id }})">{{__('Edit')}}</a></li>
                                                    <li><a onclick="confirm_modal('{{route('home_banners.destroy', $banner->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-3" class="tab-pane fade">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_banner_2()" class="btn btn-rounded btn-info pull-right">{{__('Add New Banner')}}</a>
                    </div>
                </div>

                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home banner')}} (Max 3 published)</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Photo')}}</th>
                                    <th>{{__('Position')}}</th>
                                    <th>{{__('Published')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Banner::where('position', 2)->get() as $key => $banner)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img loading="lazy"  class="img-md" src="{{ asset($banner->photo)}}" alt="banner Image"></td>
                                        <td>{{ __('Banner Position ') }}{{ $banner->position }}</td>
                                        <td><label class="switch">
                                            <input onchange="update_banner_published(this)" value="{{ $banner->id }}" type="checkbox" <?php if($banner->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="edit_home_banner_2({{ $banner->id }})">{{__('Edit')}}</a></li>
                                                    <li><a onclick="confirm_modal('{{route('home_banners.destroy', $banner->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-4" class="tab-pane fade">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_home_category()" class="btn btn-rounded btn-info pull-right">{{__('Add New Category')}}</a>
                    </div>
                </div>

                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home Categories')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Page Size')}}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody id="homecategorieslist">
                                @foreach(\App\HomeCategory::orderBy('status','desc')
                                                ->orderBy('prioritization','asc')
                                                ->orderBy('updated_at', 'asc')->get() as $key => $home_category)
                                    @if($home_category->status == 0)
                                    <tr id="home_category_id:{{$home_category->id}}" class="sortable1" data-content="data:{{$home_category->id}}" >
                                            <td class="text-center" style="font-size: 20px;"><i class="fa fa-not-equal" ></i>
                                            </td>
                                    @else
                                    <tr id="home_category_id:{{$home_category->id}}" style="cursor: pointer;" data-content="data:{{$home_category->id}}" >
                                            <td class="text-center" style="font-size: 20px;"><i class="fa fa-bars"></i>
                                            </td>
                                            @endif
                                        <td>{{$home_category->id}} {{$home_category->category->name}}</td>
                                        <td>
                                            {{$home_category->page_size}}
                                        </td>
                                        <td><label class="switch">
                                            <input onchange="update_home_category_status(this)" value="{{ $home_category->id }}" type="checkbox" <?php if($home_category->status == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="edit_home_category({{ $home_category->id }})">{{__('Edit')}}</a></li>
                                                    <li><a onclick="confirm_modal('{{route('home_categories.destroy', $home_category->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-5" class="tab-pane fade">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_home_collection()" class="btn btn-rounded btn-info pull-right">{{__('Add New Collection')}}</a>
                    </div>
                </div>

                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home Collections')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered " cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Collection')}}</th>
                                <th>{{ __('Status') }}</th>
                                <th width="10%">{{__('Options')}}</th>
                            </tr>
                            </thead>
                            <tbody id="homecollectionlist">
                            @foreach(\App\HomeCollection::orderBy('status','desc')
                                            ->orderBy('prioritization','asc')
                                            ->orderBy('updated_at', 'asc')->get() as $key => $home_collection)
                                @if($home_collection->status == 0)
                                    <tr id="home_collection_id:{{$home_collection->id}}" class="sortable1" data-content="data:{{$home_collection->id}}" >
                                        <td class="text-center" style="font-size: 20px;"><i class="fa fa-not-equal" ></i>
                                        </td>
                                @else
                                    <tr id="home_collection_id:{{$home_collection->id}}" style="cursor: pointer;" data-content="data:{{$home_collection->id}}" >
                                        <td class="text-center" style="font-size: 20px;"><i class="fa fa-bars"></i>
                                        </td>
                                        @endif
                                        <td>{{$home_collection->id}} {{isset($home_collection->Collections->title) ? $home_collection->Collections->title : ""}}</td>
                                        <td><label class="switch">
                                                <input onchange="update_home_collection_status(this)" value="{{ $home_collection->id }}" type="checkbox" <?php if($home_collection->status == 1) echo "checked";?> >
                                                <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="edit_home_collection({{ $home_collection->id }})">{{__('Edit')}}</a></li>
                                                    <li><a onclick="confirm_modal('{{route('home_collections.destroy', $home_collection->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-6" class="tab-pane fade">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Top 10 Information')}}</h3>
                    </div>

                    <!--Horizontal Form-->
                    <!--===================================================-->
                    <form class="form-horizontal" action="{{ route('top_10_settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3" for="url">{{__('Top Categories (Max 10)')}}</label>
                                <div class="col-sm-9">
                                    <select class="form-control demo-select2-max-10" name="top_categories[]" multiple required>
                                        @foreach (\App\Category::all() as $key => $category)
                                            <option value="{{ $category->id }}" @if($category->top == 1) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3" for="url">{{__('Top Brands (Max 10)')}}</label>
                                <div class="col-sm-9">
                                    <select class="form-control demo-select2-max-10" name="top_brands[]" multiple required>
                                        @foreach (\App\Brand::all() as $key => $brand)
                                            <option value="{{ $brand->id }}" @if($brand->top == 1) selected @endif>{{ $brand->name }}</option>
                                        @endforeach
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
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>

<script type="text/javascript">

    function updateSettings(el, type){
        if($(el).is(':checked')){
            var value = 1;
        }
        else{
            var value = 0;
        }
        $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
            if(data == 1){
                showAlert('success', 'Settings updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function add_slider(){
        $.get('{{ route('sliders.create')}}', {}, function(data){
            $('#demo-lft-tab-1').html(data);
        });
    }

    function add_banner_1(){
        $.get('{{ route('home_banners.create', 1)}}', {}, function(data){
            $('#demo-lft-tab-2').html(data);
        });
    }

    function add_banner_2(){
        $.get('{{ route('home_banners.create', 2)}}', {}, function(data){
            $('#demo-lft-tab-3').html(data);
        });
    }

    function edit_home_banner_1(id){
        var url = '{{ route("home_banners.edit", "home_banner_id") }}';
        url = url.replace('home_banner_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-2').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function edit_home_banner_2(id){
        var url = '{{ route("home_banners.edit", "home_banner_id") }}';
        url = url.replace('home_banner_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-3').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }
    /*categories*/

    function add_home_category(){
        $.get('{{ route('home_categories.create')}}', {}, function(data){
            $('#demo-lft-tab-4').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function edit_home_category(id){
        var url = '{{ route("home_categories.edit", "home_category_id") }}';
        url = url.replace('home_category_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-4').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function update_home_category_status(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('home_categories.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                showAlert('success', 'Home Page Category status updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    var $sortableCategory = $("#homecategorieslist");
    $sortableCategory.sortable({
        items: "tr:not(.sortable3)",
        stop: function(event, ui){

            console.log('ui', ui);
            $.post('{{ route("home_categories.priority") }}',{_token:'{{ csrf_token() }}',
                data: {
                    previous: ui.item[0].previousElementSibling ? ui.item[0].previousElementSibling.id : 0,
                    item: ui.item[0].id,
                    next: ui.item[0].nextElementSibling ? ui.item[0].nextElementSibling.id : 0
                }

            } ,function(result){
                console.log(result)

                if(result == 1){
                    showAlert('success','Priority updated successfully');
                }else{
                    showAlert('danger','Something went wrong');
                }
            })
        }
    });

    function update_banner_published(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('home_banners.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                showAlert('success', 'Banner status updated successfully');
            }
            else{
                showAlert('danger', 'Maximum 4 banners to be published');
            }
        });
    }

    function update_slider_published(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        var url = '{{ route('sliders.update', 'slider_id') }}';
        url = url.replace('slider_id', el.value);

        $.post(url, {_token:'{{ csrf_token() }}', status:status, _method:'PATCH'}, function(data){
            if(data == 1){
                showAlert('success', 'Published sliders updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function update_home_settings(el, type){
        console.log('type;',el.type);
        console.log('value:',el.type);
        var pValue;
        if( el.type === 'checkbox'){
            if(el.checked){
                pValue = 1;
            }
            else{
                pValue = 0;
            }
        }
        if( el.type === 'select-one'){
            pValue = el.value;
        }

        var url = '{{ route('business_settings.updateItem') }}';

        $.post(url, {_token:'{{ csrf_token() }}', type:type, value:pValue, _method:'PATCH'}, function(data){
            if(data == 1){
                showAlert('success', 'Home Settings updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function apply_setting_to_home(){


        var url = '{{ route('business_settings.updateCache') }}';

        $.post(url, {_token:'{{ csrf_token() }}', _method:'PATCH'}, function(data){
            if(data == 1){
                location.reload();
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }


    /* collections */
    function add_home_collection(){
        $.get('{{ route('home_collections.create')}}', {}, function(data){
            $('#demo-lft-tab-5').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function edit_home_collection(id){
        var url = '{{ route("home_collections.edit", "home_collection_id") }}';
        url = url.replace('home_collection_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-5').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function update_home_collection_status(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('home_collections.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                showAlert('success', 'Home Collection status updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }


    var $sortableCollection = $("#homecollectionlist");
    $sortableCollection.sortable({
        items: "tr:not(.sortable3)",
        stop: function(event, ui){

            console.log('ui', ui);
            $.post('{{ route("home_collections.priority") }}',{_token:'{{ csrf_token() }}',
                data: {
                    previous: ui.item[0].previousElementSibling ? ui.item[0].previousElementSibling.id : 0,
                    item: ui.item[0].id,
                    next: ui.item[0].nextElementSibling ? ui.item[0].nextElementSibling.id : 0
                }

            } ,function(result){
                console.log(result);

                if(result == 1){
                    showAlert('success','Priority updated successfully');
                }else{
                    showAlert('danger','Something went wrong');
                }
            })
        }
    });
    $( ".sortable" ).draggable({ disabled: true })

</script>

@endsection
