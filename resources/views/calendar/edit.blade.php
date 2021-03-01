@extends('layouts.app')

@section('content')
{{-- {{dd(\App\Hub::where('hub_id',$calendar->id)->first()->name)}} --}}
    <!-- Basic Data Tables -->
    <!--===================================================-->
<style>
    .active-tr{
        background-color:rgb(0, 255, 0,0.2) !important;
    }
    .rr{
        cursor:pointer;
    }
    .rr_hide{
        display: none;
    }
</style>

<br>
    <div class="panel ">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Calendar Setting')}}</h3>
        </div>
        <div class="panel-body">

            <div class="d-flex">
                <div class="flex-grow">
                    <form class="form-horizontal" action="{{ route('calendar.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5>Settings</h5>
                        <br>
                        <input name="id" class="rr_hide" value={{$calendar->id}} >
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="rule">{{__('Rule')}}</label>
                            <div class="col-sm-10">
                                <input value={{$calendar->rule}}
                                onchange="loadCalendar()" type="text" placeholder="{{__('ex. today')}}" id="rule" name="rule" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="validations">{{__('Validations')}}</label>
                            <div class="col-sm-10">
                                <input value={{$calendar->validation}}
                                 onchange="loadCalendar()" type="text" placeholder="{{__('ex. = or >')}}" id="validations" name="validations" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="condition">{{__('Condition')}}</label>
                            <div class="col-sm-10">
                                <input value={{$calendar->condition}}
                                 onchange="loadCalendar()" type="text" placeholder="{{__('ex. today')}}" id="condition" name="condition" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="set_calendar">{{__('Set Caledar')}}</label>
                            <div class="col-sm-10">
                                <input  value={{$calendar->set_calendar}}
                                onchange="loadCalendar()"type="text" placeholder="{{__('ex. ["1997-12-31","1997-12-32"]')}}" id="set_calendar" name="set_calendar" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="hub_id">{{__('Hub')}}</label>
                            <div class="col-sm-10">
                                 <select
                                 onchange="loadCalendar()" required aria-required="true"  class="form-control" name="hub_id" id="exampleFormControlSelect1" required="required">
                                         <option value={{$calendar->hub_id}}>{{\App\Hub::where('hub_id',$calendar->id)->first()->name}}</option>
                                    @foreach (\App\Hub::all() as $key => $hub)
                                         <option value={{$hub->hub_id}}>{{$hub->name}}</option>
                                     @endforeach
                                  </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="start_date">{{__('Date Start')}}</label>
                            <div class="col-sm-10">
                                <input  value={{$calendar->start_datetime}}
                                  onchange="loadCalendar()" type="date" placeholder="{{__('Date Start')}}" id="start_date" name="start_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="end_date">{{__('Date End')}}</label>
                            <div class="col-sm-10">
                                <input  value={{$calendar->end_datetime}}
                                 onchange="loadCalendar()" type="date" placeholder="{{__('Date End')}}" id="end_date" name="end_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                        </div>
                    </form>
                 </div>
                <div class="flex-grow">
                    <h5>Calendar Preview</h5>
                    <br>
                    <div class="form-group col-lg-6" id="calendar-preview-card">

                    </div>
                </div >
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
        function getFormData(){
            try {
                const init_data = $('form').serialize()
                const data = JSON.parse('{"' + init_data.replace(/&/g, '","').replace(/=/g,'":"') + '"}', function(key, value) { return key===""?value:decodeURIComponent(value) })
                delete data._token
                const {condition,hub_id,rule,set_calendar,start_date,end_date,validations} = data

                 if(validations && hub_id && rule && set_calendar && start_date && end_date && validations ){
                   return data
                 }
                return null
            } catch (err) {
                return null
            }
        }

        function loadCalendar(){
            const calendar_data = getFormData()
            if(calendar_data){
                $.post('{{ route('calendar.load_calendar') }}', {_token:'{{ csrf_token() }}', calendar_data}, function(data){
                   if(data == "invalid"){
                        $('#calendar-preview-card').html("<h3>Invalid rule argument.</h3>")
                   }else{
                     $('#calendar-preview-card').html(data)
                   }

                })
            }else{
                $('#calendar-preview-card').html("<h1>Incomplete form data.</h1>")
            }
        }

        loadCalendar()

    </script>
@endsection
