@extends('frontend.layouts.app')

@section('content')
    <style>
        .ru-lds-roller {
            display: inline-block;
            position: relative;
            width: 100px;
            height: 100px;
        }
        .ru-lds-roller div {
            animation: ru-lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            transform-origin: 40px 40px;
        }
        .ru-lds-roller div:after {
            content: " ";
            display: block;
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #F79F8E;
            margin: -4px 0 0 -4px;
        }
        .ru-lds-roller div:nth-child(1) {
            animation-delay: -0.036s;
        }
        .ru-lds-roller div:nth-child(1):after {
            top: 63px;
            left: 63px;
        }
        .ru-lds-roller div:nth-child(2) {
            animation-delay: -0.072s;
        }
        .ru-lds-roller div:nth-child(2):after {
            top: 68px;
            left: 56px;
        }
        .ru-lds-roller div:nth-child(3) {
            animation-delay: -0.108s;
        }
        .ru-lds-roller div:nth-child(3):after {
            top: 71px;
            left: 48px;
        }
        .ru-lds-roller div:nth-child(4) {
            animation-delay: -0.144s;
        }
        .ru-lds-roller div:nth-child(4):after {
            top: 72px;
            left: 40px;
        }
        .ru-lds-roller div:nth-child(5) {
            animation-delay: -0.18s;
        }
        .ru-lds-roller div:nth-child(5):after {
            top: 71px;
            left: 32px;
        }
        .ru-lds-roller div:nth-child(6) {
            animation-delay: -0.216s;
        }
        .ru-lds-roller div:nth-child(6):after {
            top: 68px;
            left: 24px;
        }
        .ru-lds-roller div:nth-child(7) {
            animation-delay: -0.252s;
        }
        .ru-lds-roller div:nth-child(7):after {
            top: 63px;
            left: 17px;
        }
        .ru-lds-roller div:nth-child(8) {
            animation-delay: -0.288s;
        }
        .ru-lds-roller div:nth-child(8):after {
            top: 56px;
            left: 12px;
        }
        @keyframes ru-lds-roller {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="m-auto d-flex align-items-center flex-column ">
                <div class="ru-lds-roller "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                <h2>Please wait...</h2>
            </div>
        </div>
    </div>
    <form id="frmPayment" name="frmPayment" method="post" action="{{$data['eghlUrl']}}">
        <input type="hidden" name="TransactionType" value="{{$data['TransactionType']}}">
        <input type="hidden" name="PymtMethod" value="{{$data['PymtMethod']}}">
        <input id="service_id" type="hidden" name="ServiceID" value="{{$data['ServiceID']}}">
        <input id="payment_id" type="hidden" name="PaymentID" value="{{$data['PaymentID']}}">
        <input type="hidden" name="OrderNumber" value="{{$data['OrderNumber']}}">
        <input type="hidden" name="PaymentDesc" value="{{$data['PaymentDesc']}}">
        <input type="hidden" name="MerchantName" value="{{$data['MerchantName']}}">
        <input id="return_url" type="hidden" name="MerchantReturnURL" value="{{$data['MerchantReturnURL']}}">
        <input id="approval_url" type="hidden" name="MerchantApprovalURL" value="{{$data['MerchantApprovalURL']}}">
        <input id="upapproval_url" type="hidden" name="MerchantUnApprovalURL" value="{{$data['MerchantUnApprovalURL']}}">
        <input id="amount" type="hidden" name="Amount" value="{{$data['Amount']}}">
        <input id="currency_code" type="hidden" name="CurrencyCode" value="{{$data['CurrencyCode']}}">
        <input id="ip_address" type="hidden" name="CustIP" value="{{$data['CustIP']}}">
        <input type="hidden" name="CustName" value="{{$data['CustName']}}">
        <input type="hidden" name="CustEmail" value="{{$data['CustEmail']}}">
        <input type="hidden" name="CustPhone" value="{{$data['CustPhone']}}">
        <input id="hash_value" type="hidden" name="HashValue" value="{{$data['HashValue']}}">
        <input  type="hidden" name="LanguageCode" value="{{$data['LanguageCode']}}">
        <input id="page_timeout" type="hidden" name="PageTimeout" value="{{$data['PageTimeout']}}">
    </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#frmPayment').submit()
        });
    </script>
@endsection