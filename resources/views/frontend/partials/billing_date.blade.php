
<div class="card-body pl-4">
    <input type="date" name="delivery_date" class='d-flex form-control datepicker'  readonly id='delivery_date' value="{{ isset($orderInfo['delivery_date']) ? $orderInfo['delivery_date']:'' }}" />
    <div id='deldatepicker' class='d-flex justify-content-center' data-date="{{ isset($orderInfo['delivery_date']) ? $orderInfo['delivery_date']:'' }}" data-date-format='yyyy-mm-dd'> </div>
</div>

<script>
    $(document).ready(function() {
        var blockDates = {!!collect($blockDates)!!};
        var blockDays = {!!collect($blockDays)!!};
        var today = '{{$today}}';


        function getMissingDate(arr, arr2){
            var result
            var dates = []
            var genDates = []
            var maxDate
            var minDate

            if(blockDates.length){

                
                blockDates.forEach(function(date){
                    if(new Date(date) >= new Date(today)){
                        dates.push(new Date(date))
                    }
                })

                maxDate = new Date(Math.max.apply(null,dates));
                minDate = new Date(Math.min.apply(null,dates));
                
          
                while(minDate <= maxDate){
                    genDates.push(new Date(minDate))
                    new Date(minDate.setDate(minDate.getDate() + 1))
                }

                if(genDates.length === dates.length){
                    var arrOneWeek = [];

                    minDate = new Date(maxDate.setDate(maxDate.getDate() + 1))

                    for (var i = 0; i < 6; i++) {
                        arrOneWeek.push({
                            date: new Date(minDate),
                            day: new Date(minDate).getDay()
                        })
                        new Date(minDate.setDate(minDate.getDate() + 1))
                    }

                    var filteredDates = []

                    arrOneWeek.forEach(function(diff){
                        if(arr2.indexOf(diff.day.toString()) === -1){
                            filteredDates.push(diff);
                        }
                    })

                    return result = new Date(filteredDates[0].date);
                }

                var difference = arrDiff(genDates, dates)


                if(difference.length){

                    if(blockDates.length){
                        var filteredDates = []
                    
                        difference.forEach(function(diff){
                            if(arr2.indexOf(diff.day.toString()) === -1){
                                filteredDates.push(diff);
                            }
                        })

                        return result = new Date(filteredDates[0].date);

                    } else {

                        return result = new Date(difference[0].date)
                    }
                } else {

                    var arrOneWeek = [];

                    minDate = new Date(today)

                    for (var i = 0; i < 6; i++) {
                        arrOneWeek.push({
                            date: new Date(minDate),
                            day: new Date(minDate).getDay()
                        })
                        new Date(minDate.setDate(minDate.getDate() + 1))
                    }

                    var filteredDates = []

                    arrOneWeek.forEach(function(diff){
                        if(arr2.indexOf(diff.day.toString()) === -1){
                            filteredDates.push(diff);
                        }
                    })
                    
                    return result = new Date(filteredDates[0].date);

                }

            } else {

                var arrOneWeek = [];

                minDate = new Date(today)

                for (var i = 0; i < 6; i++) {
                    arrOneWeek.push({
                        date: new Date(minDate),
                        day: new Date(minDate).getDay()
                    })
                    new Date(minDate.setDate(minDate.getDate() + 1))
                }

                var filteredDates = []

                arrOneWeek.forEach(function(diff){
                    if(arr2.indexOf(diff.day.toString()) === -1){
                        filteredDates.push(diff);
                    }
                })
                
                return result = new Date(filteredDates[0].date);
            }
           
        }

        function arrDiff(ar, ar2){
            var a = []
            var diff = [];

            for (var i = 0; i < ar.length; i++) {
                a[formatDate(ar[i])] = true;
            }

            for (var i = 0; i < ar2.length; i++) {
                if (formatDate([ar2[i]])) {
                    delete a[formatDate(ar2[i])];
                } else {
                    a[formatDate(ar2[i])] = true;
                }
            }

            for (var k in a) {
                var k = {
                    date: k,
                    day: new Date(k).getDay()
                }
                diff.push(k);
            }

            return diff;
        }

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;

            return [year, month, day].join('-');
        }

        var currentValue = getMissingDate(blockDates, blockDays)
        var isoDate = new Date(currentValue.getTime() - (currentValue.getTimezoneOffset() * 60000)).toISOString().slice(0,10);

        $('#deldatepicker').datepicker({startDate: today, datesDisabled: blockDates, daysOfWeekDisabled: blockDays}).on('changeDate', function(e){
            if($('#deldatepicker').datepicker('getDate') == null){
                $('#delivery_time').attr('disabled', 'disabled');
            }else{
                var isoDate = new Date(e.date.getTime() - (e.date.getTimezoneOffset() * 60000)).toISOString().slice(0,10);
                $('#delivery_date').val(isoDate)
                $('#delivery_time').removeAttr("disabled", false)
            }
        })

        $('#deldatepicker').datepicker('update', currentValue);
        $("#delivery_date").val(isoDate)
    });
</script>