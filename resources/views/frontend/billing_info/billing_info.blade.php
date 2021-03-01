<div id="billing_info">


<div class='d-flex align-items-center h6 card-title'>
    <span id='ship_err_text'>{{__("Billing Info")}}</span>
    <i class='ml-2 la la-truck' style='font-size: 1.5rem; background-color: white; color: rgba(27, 154, 163, 0.822);'></i>
</div>
<div class="row">
    <div class="col-lg-6 col-12">
        <div class="form-group">
            <label class="control-label">{{__('First Name')}}</label>
            <input id="billing_first_name"  value="{{isset($billingInfo) ? $billingInfo['first_name'] : ''}}" type="text" class="form-control" name="billing_first_name" placeholder="{{__('First Name')}}"   />
        </div>
    </div>

    <div class="col-lg-6 col-12">
        <div class="form-group">
            <label class="control-label">{{__('Last Name')}}</label>
            <input id="billing_last_name" value="{{isset($billingInfo) ? $billingInfo['last_name'] : ''}}" type="text" class="form-control" name="billing_last_name" placeholder="{{__('Last Name')}}"   />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label class="control-label">{{__('Email')}}</label>
            <input type="text" class="form-control" value="{{isset($billingInfo) ? $billingInfo['email'] : ''}}" id="billing_email" name="billing_email" placeholder="{{__('Email')}}" >
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group has-feedback">
            <label class="control-label">{{__('Contact Number')}}</label>
            <input id="billing_phone" type="tel" value="{{isset($billingInfo) ? $billingInfo['phone'] : ''}}"  class="form-control" placeholder="{{__('Phone')}}" name="billing_phone" >
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">{{__('Address')}}</label>
            <input type="text" value="{{isset($billingInfo) ? $billingInfo['address'] : ''}}" class="form-control" id="billing_address" name="billing_address" placeholder="{{__('Street address, P.O. box, company name, c/o')}}"  >
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-12"  tabindex="0" style="outline:none;" id="focus-focus">
        <div class="form-group">
            <label class="control-label">{{__('Province')}}</label>
            <input id="billing_province" value="{{isset($billingInfo) ? $billingInfo['province'] : ''}}" type="text" class="form-control" name="billing_province" placeholder="{{__('Province')}}"   />
        </div>
    </div>
    <div class="col-lg-6 col-12">
        <div class="form-group">
            <label class="control-label">{{__('City')}}</label>
            <input id="billing_city" value="{{isset($billingInfo) ? $billingInfo['city'] : ''}}" type="text" class="form-control" name="billing_city" placeholder="{{__('City')}}"  />
        </div>
    </div>


</div>
<div class="row">
    <div class="col-md-6" >
        <div class="form-group has-feedback">
            <label class="control-label">{{__('Barangay')}}</label>
            <input id="billing_barangay" value="{{isset($billingInfo) ? $billingInfo['barangay'] : ''}}" type="text"  class="form-control" placeholder="{{__('Barangay')}}" name="billing_barangay" >
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label class="control-label">{{__('Postal Code')}}</label>
            <input type="text" value="{{isset($billingInfo) ? $billingInfo['zip'] : ''}}" class="form-control" id="billing_postal_code" name="billing_postal_code" placeholder="{{__('Postal / Zip Code')}}" >
        </div>

    </div>
</div>
</div>

<script>
    if(performance.navigation.type == 2)
    {
        location.reload();
    }
        function billing_checkbox_handler(e){
            var hidden = e.checked;
            $('#input_billing_same_as_shipping').val(hidden == 0 ? 1 : 0);
            if(hidden){
                $('#billing_info_form').css({'display':'none'})
                $('#billing_info input').prop('required',false)

            } else{
                $('#billing_info_form').css({'display':''})
                $('#billing_info input').prop('required',true)
            }
            $('#focus-focus').focus()
            return true;
        }

        billing_checkbox_handler(document.getElementById('billing_same_as_shipping'));
</script>
