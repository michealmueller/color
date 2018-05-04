<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <a class="navbar-brand" href="http://colormarketing.org" style="margin-right: 80px;">
            <img class="" height="55" src="/assets/img/CMG_200px.svg" />
        </a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/profile">
                        <span class="la la-user ks-icon"></span>
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/forums">
                        <span class="la la-forumbee ks-icon"></span>
                        Forums
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="la la-file-pdf-o ks-icon"></span> Reports
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link" target="_blank" href="/digitalcolorreports/{{ Auth::id() }}/digital">
                            Digital Color Reports
                        </a>
                        @if($data['user'] !=null && $data['user']->isAdmin == 1)
                                <a class="nav-link" target="_blank" href="/admin/reports">
                                    Reports
                                </a>
                        @endif
                        <a class="nav-link" target="_blank" href="/rovingcolorreports/{{Auth::id()}}/roving">
                            Roving Color Reports
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" style="margin-left: 20px;">
                        <span class="la la-sign-out ks-icon" aria-hidden="true"></span>
                        Logout
                    </a>
                </li>
            </ul>

            <div class="my-2 my-lg-0">
                @if($data['user'] !=null && $data['user']->activated != 1 && $data['user']->isAcademic == 1)
                    <div class="nav-item nav-link btn-action-block" style="padding: 0;">
                    </div>
                @elseif($data['user'] !=null && $data['user']->activated != 1)
                <!-- BEGIN NAVBAR ACTION BUTTON -->
                    <div class="nav-item nav-link btn-action-block" style="padding: 0;">
                        <a class="" href="http://members.colormarketing.org/verify/resend" target="_blank">
                            <span class="btn btn-info ks-action">Activate Your Account! <small>Check your email</small></span>
                        </a>
                    </div>
                @elseif($data['user'] !=null && $data['user']->lastpayment == null)
                    <div class="nav-item nav-link btn-action-block" style="padding: 0;">
                        <a class="btn btn-danger" href="/NewSubscription">
                            <span class="ks-action">Subscribe!</span>
                            <span class="ks-description"></span>
                        </a>
                    </div>
                @elseif($data['user'] != null && $data['user']->lastpayment != null)
                    <div class="nav-item nav-link btn-action-block" style="padding: 0;">
                                <span class="btn
                                @if( $data['userDaysLeft'] <= 30)
                                        btn-danger"> <a href="/NewSubscription">
                                @else
                                            btn-success">
                                        @endif
                                        <span class="ks-action">Remaining Days</span>
                                    <span class="ks-description">
                                        @if( $data['userDaysLeft'] > 0)
                                            {{ $data['userDaysLeft'] }}
                                        @endif
                                        @if($data['userDaysLeft'] <= 0)
                                            <small>Renew Now</small>
                                        @endif
                                    </span>
                                    </a>
                                </span>
                    </div>
                    @endif
            </div>


            <!--if($data['user']->activated == 1 && $data['userDaysLeft'] <= 0 )
                <div class="nav-item nav-link ks-btn-action">
                    <a class="btn btn-success" href="/NewSubscription">Start Subscription</a>
                </div>
            endif-->

        </div>
    </div>
</nav>