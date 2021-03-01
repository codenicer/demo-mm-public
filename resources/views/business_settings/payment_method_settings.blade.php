@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Payment Method Settings')}}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>{{__('Payment Method')}}</th>
                        <th>{{__('Show')}}</th>
                        <th>{{__('Disable')}}</th>
                        <th >{{__('Attribute')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Paypal</td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'show_payment_paypal')"  value="{{ getBusinessSettings('show_payment_paypal')  }}" type="checkbox" <?php if(getBusinessSettings('show_payment_paypal') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'disable_payment_paypal')"  value="{{ getBusinessSettings('disable_payment_paypal')  }}" type="checkbox" <?php if(getBusinessSettings('disable_payment_paypal') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>Minimum Amount
                                <input class="form-control" onchange="update_home_settings(this, 'payment_paypal_min')" value="{{ getBusinessSettings('payment_paypal_min')  }}" name="payment_paypal_min" id="payment_paypal_min" type="number"   >

                        </td>
                    </tr>
                    <tr>
                        <td>GrabPay</td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'show_payment_grabpay')"  value="{{ getBusinessSettings('show_payment_grabpay')  }}" type="checkbox" <?php if(getBusinessSettings('show_payment_grabpay') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'disable_payment_grabpay')"  value="{{ getBusinessSettings('disable_payment_grabpay')  }}" type="checkbox" <?php if(getBusinessSettings('disable_payment_grabpay') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>Minimum Amount
                            <input class="form-control" onchange="update_home_settings(this, 'payment_grabpay_min')" value="{{ getBusinessSettings('payment_grabpay_min')  }}" name="payment_grabpay_min" id="payment_grabpay_min" type="number"   >

                        </td>
                    </tr>
                    <tr>
                        <td>Billease</td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'show_payment_billease')"  value="{{ getBusinessSettings('show_payment_billease')  }}" type="checkbox" <?php if(getBusinessSettings('show_payment_billease') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'disable_payment_billease')"  value="{{ getBusinessSettings('disable_payment_billease')  }}" type="checkbox" <?php if(getBusinessSettings('disable_payment_billease') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>Minimum Amount
                            <input class="form-control" onchange="update_home_settings(this, 'payment_billease_min')" value="{{ getBusinessSettings('payment_billease_min')  }}" name="payment_billease_min" id="payment_billease_min" type="number"   >

                        </td>
                    </tr>
                    <tr>
                        <td>COD</td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'show_payment_cod')"  value="{{ getBusinessSettings('show_payment_cod')  }}" type="checkbox" <?php if(getBusinessSettings('show_payment_cod') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'disable_payment_cod')"  value="{{ getBusinessSettings('disable_payment_cod')  }}" type="checkbox" <?php if(getBusinessSettings('disable_payment_cod') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>Maximum Amount
                            <input class="form-control" onchange="update_home_settings(this, 'payment_cod_max')" value="{{ getBusinessSettings('payment_cod_max')  }}" name="payment_cod_max" id="payment_cod_max" type="number"   >

                        </td>
                    </tr>
                    <tr>
                        <td>Bank Deposit</td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'show_payment_bank_deposit')"  value="{{ getBusinessSettings('show_payment_bank_deposit')  }}" type="checkbox" <?php if(getBusinessSettings('show_payment_bank_deposit') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'disable_payment_bank_deposit')"  value="{{ getBusinessSettings('disable_payment_bank_deposit')  }}" type="checkbox" <?php if(getBusinessSettings('disable_payment_bank_deposit') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>Minimum Amount
                            <input class="form-control" onchange="update_home_settings(this, 'payment_bank_deposit_min')" value="{{ getBusinessSettings('payment_bank_deposit_min')  }}" name="payment_bank_deposit_min" id="payment_bank_deposit_min" type="number"   >

                        </td>
                    </tr>
                    <tr>
                        <td>Cash Pickup</td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'show_payment_cashpickup')"  value="{{ getBusinessSettings('show_payment_cashpickup')  }}" type="checkbox" <?php if(getBusinessSettings('show_payment_cashpickup') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="switch">
                                <input onchange="update_home_settings(this, 'disable_payment_cashpickup')"  value="{{ getBusinessSettings('disable_payment_cashpickup')  }}" type="checkbox" <?php if(getBusinessSettings('disable_payment_cashpickup') == 1) echo "checked";?>   >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>Minimum Amount
                            <input class="form-control" onchange="update_home_settings(this, 'payment_cashpickup_min')" value="{{ getBusinessSettings('payment_cashpickup_min')  }}" name="payment_cashpickup_min" id="payment_cashpickup_min" type="number"   >

                        </td>
                    </tr>
                    <tr>
                        <td>Minimum Order Amount</td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>Minimum Amount
                            <input class="form-control" onchange="update_home_settings(this, 'minimum_order_amount')" value="{{ getBusinessSettings('minimum_order_amount')  }}" name="minimum_order_amount" id="minimum_order_amount" type="number"   >

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



</div>
@endsection
@section('script')

    <script>
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
            if( el.type === 'number'){
                pValue = el.value;
            }
            var url = '{{ route('business_settings.updateItem') }}';
            $.post(url, {_token:'{{ csrf_token() }}', type:type, value:pValue, _method:'PATCH'}, function(data){
                if(data == 1){
                    showAlert('success', 'Payment Settings updated successfully');
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
    </script>

@endsection