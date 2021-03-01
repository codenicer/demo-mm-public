

<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel='stylesheet'>
<div class="card-title pl-4" s>
    <h3 class="heading heading-3 strong-400 mb-0 d-flex" style="flex-direction:row;justify-content:center;">
        <span>{{__('Calendar Preview')}}</span>
    </h3>
</div>
<div class="card-body pl-4">
    <input type="date" name="delivery_date" class='d-flex form-control datepicker'  readonly id='delivery_date' value="" />
    <div id='deldatepicker' class='d-flex justify-content-center' data-date="" data-date-format='yyyy-mm-dd'> </div>
</div>

<script>
        var blockDates = {!!collect($blockDates)!!};
        var today = '{{$today}}'
        $('#deldatepicker').datepicker({startDate: today, datesDisabled: blockDates}).on('changeDate', function(e){
                        if($('#deldatepicker').datepicker('getDate') == null){
                            $('#delivery_time').attr('disabled', 'disabled');
                        }else{
                            var isoDate = new Date(e.date.getTime() - (e.date.getTimezoneOffset() * 60000)).toISOString().slice(0,10);
                            $('#delivery_date').val(isoDate)
                            $('#delivery_time').removeAttr("disabled", false)

                        }
                    });
</script>
