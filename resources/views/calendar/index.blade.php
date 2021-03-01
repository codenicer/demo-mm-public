@extends('layouts.app')

@section('content')

<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel='stylesheet'>
    <!-- Basic Data Tables -->
    <!--===================================================-->
{{-- {{dd($calendar_rules)}} --}}
<style>
    .active-tr{
        background-color:rgb(0, 255, 0,0.2) !important;
    }
    .rr{
        cursor:pointer;
    }
</style>

<div class="row">
    <div class="col-sm-12">
    <a href="{{route('calendar.create')}}"
            class="btn btn-rounded btn-info pull-right">{{__('Create New Rule')}}</a>
    </div>
</div>
<br>
    <div class="panel ">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Calendar Setting')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Rules')}}</th>
                        <th>{{ __('Validations')}}</th>
                        <th>{{ __('Conditions')}}</th>
                        <th>{{ __('Set Calendar')}}</th>
                        <th>{{ __('Hub') }}</th>
                        <th>{{__('Date Start')}}</th>
                        <th>{{__('Date End')}}</th>
                        <th>{{__('Status')}}</th>
                        <th width="10%">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                      @foreach($calendar_rules as $key => $rule)
                    <tr class="rr" onClick="trOnSelect({{$rule}})" id={{"id_".$rule->id}}>
                        <td >{{$key + 1}}</td>
                        <td >{{$rule->rule}}</td>
                        <td>{{$rule->validation}}</td>
                        <td>{{$rule->condition}}</td>
                        <td>{{$rule->set_calendar}}</td>
                        <td>{{$rule->hub_id}}</td>
                        <td>{{ date('m-d-Y', strtotime($rule->start_datetime)) }}</td>
                        <td>{{ date('m-d-Y', strtotime($rule->end_datetime)) }}</td>
                        <td><label class="switch">
                                <input onchange="update_status(this)" value="{{ $rule->id }}" type="checkbox"
                                    <?php if($rule->status == 1) echo "checked";?>>
                                <span class="slider round"></span></label>
                        </td>

                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown"
                                    type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a
                                            href={{route('calendar.edit', encrypt($rule->id))}}>{{__('Edit')}}</a>
                                    </li>
                                    <li>
                                      <a
                                          onclick="confirm_modal('{{route('calendar.destroy', encrypt($rule->id))}}');">{{__('Delete')}}</a>
                                  </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <br>
                <div style="display:flex;flex-direction:row;justify-content:center;">
                    <div  class="col-lg-4 ml-lg-auto">
                        <div class="row ">
                            <div class="col-12">
                                <div class="form-group card  pt-0" id="calendar-preview-card">
                                </div>
                            </div>
                        </div>
                    </div>
             </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
        function trOnSelect(rule){
            const {id} = rule

            $("tr").removeClass("active-tr")
            $(`#id_${id}`).addClass("active-tr")
            const selected_data = rule

            $.post('{{ route('calendar.get_preview') }}', {_token:'{{ csrf_token() }}', selected_data}, function(data){
                $('#calendar-preview-card').html(
                    data
                )
                    // var blockDates = data.block_dates;
                    // var today = data.today
                    // console.log(blockDates,today)

             });

            return true
        }




      function update_status(button_switch){
        $.post('{{ route('calendar.update_status') }}', {_token:'{{ csrf_token() }}', id:button_switch.value, status:button_switch.checked}, function(data){
          if(data.status == true){
            location.reload();
          }
          else{
            showAlert('danger', 'Something went wrong');
          }
        });
      }
    </script>
@endsection
