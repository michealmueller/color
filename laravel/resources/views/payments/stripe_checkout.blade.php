@extends('master')

@section('content')
    <div class="ks-column ks-page">
        <div class="ks-content">
                <!--<div class="card card-inverse card-danger">
                    <div class="card-header">For testing purposes use the following card information</div>
                    <div class="card-block">
                        Email: any email.<br>
                        Card Number: 4242 4242 4242 4242,<br>
                        Expiration: any future date,<br>
                        CCV: any 3 digits<br>
                        ZipCode: any valid Zip.<br>
                        <footer>
                            <cite>This card will be removed in production.</cite>
                        </footer>
                    </div>
                </div>-->
                <div class="ks-body ks-full-height">
                    <div class="ks-nav-body-wrapper">
                        <div class="container-fluid">
                            <div class="ks-pricing-plans-page">
                                <div class="ks-logo"><img class="img-responsive" width="250px" src="/assets/img/CMG-Logo2.png"></div>
                                <div class="ks-header">
                                    <h4 class="ks-name text-center">Pricing</h4>
                                    <div class="ks-description">
                                        Choose your Membership Category
                                    </div>
                                </div>
                                <div class="ks-plans">
                                    @if(session('regType') == 'user')
                                    <div class="ks-plan">
                                        <div class="ks-header">
                                            <h5 class="ks-name">Limited Account</h5>
                                            <div class="ks-price">
                                                <div class="ks-currency">$</div>
                                                <div class="ks-amount">0</div>
                                                <div class="ks-period">forever</div>
                                            </div>
                                        </div>
                                        <div class="ks-body">
                                            <ul class="ks-list">
                                                <li>Limited Access</li>
                                                <li>Event Registration</li>
                                            </ul>

                                            <a href="/" class="btn btn-primary btn-block ks-light">Continue</a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="ks-plan ks-info">
                                        <div class="ks-header">
                                            <h5 class="ks-name">Full Member</h5>
                                            <div class="ks-price">
                                                <div class="ks-currency">$</div>
                                                <div class="ks-amount">{{ $discount }}</div>
                                                <div class="ks-period">/Calendar Year</div>
                                            </div>
                                        </div>
                                        <div class="ks-body">
                                            <ul class="ks-list ks-success text-center">
                                                <li>All current and archived Digital Colors and Reports</li>
                                                <li>CMG Member Directory and Social Networking area</li>
                                                <li>Online Event registration with Member Discounts</li>
                                                <li>Access to Roving Color & Design Reports</li>
                                            </ul>
                                            <br>
                                            <div class="btn btn-block" >
                                                <form method="POST" action="NewCharge" >
                                                    {{ csrf_field() }}
                                                    <!--
                                                    data-key="pk_live_dCD9fVKPRZAwjHA71YGc3isg"
                                                    data-key="pk_test_uOpzdE7e2XF36aTaxUcTjUN0"
                                                    -->
                                                        <!--{ $discount }}00"-->
                                                    <script
                                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                            data-key="pk_live_dCD9fVKPRZAwjHA71YGc3isg"
                                                            data-amount="{{ $discount }}00"
                                                            data-name="1 Year Membership"
                                                            data-description="1 Year Membership to ColorMarketing"
                                                            data-locale="auto"
                                                            data-zip-code="true">
                                                    </script>
                                                    <!--data-image="/assets/img/CMG-Logo2.png"-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div><p>
                                        <ul class="list-unstyled">
                                            <li>*Plans are non-recurring.</li>
                                            <li>*Plan amount subject to change on membership length.</li>
                                        </ul>
                                    </p>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
