@extends('master)
@yield('content')
<div class="ks-column ks-page">
    <div class="ks-header">
        <section class="ks-title">
            <h3>Profile Settings</h3>
            <div class="ks-controls">
                <button type="button" class="btn btn-primary-outline ks-light ks-profile-tabs-block-toggle" data-block-toggle=".ks-profile > .ks-tabs-container">Tabs</button>
                <button type="button" class="btn btn-primary-outline ks-light ks-settings-menu-block-toggle" data-block-toggle=".ks-settings-tab > .ks-menu">Menu</button>
            </div>
        </section>
    </div>

    <div class="ks-content">
        <div class="ks-body ks-profile">
            <div class="ks-header">
                <div class="ks-user">
                    <img src="assets/img/avatars/ava-1.png" class="ks-avatar" width="100" height="100">
                    <div class="ks-info">
                        <div class="ks-name">Karen Lucas</div>
                        <div class="ks-description">New York, USA</div>
                        <div class="ks-rating">
                            <i class="la la-star ks-star" aria-hidden="true"></i>
                            <i class="la la-star ks-star" aria-hidden="true"></i>
                            <i class="la la-star ks-star" aria-hidden="true"></i>
                            <i class="la la-star ks-star" aria-hidden="true"></i>
                            <i class="la la-star-half-o ks-star" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="ks-statistics">
                    <div class="ks-item">
                        <div class="ks-amount">869</div>
                        <div class="ks-text">orders</div>
                    </div>
                    <div class="ks-item">
                        <div class="ks-amount">131</div>
                        <div class="ks-text">reviews</div>
                    </div>
                    <div class="ks-item">
                        <div class="ks-amount">$3,004</div>
                        <div class="ks-text">rewand points</div>
                    </div>
                </div>
            </div>
            <div class="ks-tabs-container ks-tabs-default ks-tabs-no-separator ks-full ks-light">
                <ul class="nav ks-nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" data-target="#overview" aria-expanded="true">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" data-target="#contacts" aria-expanded="false">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" data-target="#orders" aria-expanded="false">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" data-target="#wish-list" aria-expanded="false">Wish list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" data-target="#storecredit" aria-expanded="false">Store credit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" data-target="#returns" aria-expanded="false">Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" data-target="#reward-points" aria-expanded="false">Reward points</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-toggle="tab" data-target="#settings" aria-expanded="false">Settings</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="overview" role="tabpanel" aria-expanded="false">
                        Content 1
                    </div>
                    <div class="tab-pane" id="contacts" role="tabpanel" aria-expanded="false">
                        Content 2
                    </div>
                    <div class="tab-pane" id="orders" role="tabpanel" aria-expanded="true">
                        Content 3
                    </div>
                    <div class="tab-pane" id="wish-list" role="tabpanel" aria-expanded="false">
                        Content 1
                    </div>
                    <div class="tab-pane" id="storecredit" role="tabpanel" aria-expanded="false">
                        Content 2
                    </div>
                    <div class="tab-pane" id="returns" role="tabpanel" aria-expanded="true">
                        Content 3
                    </div>
                    <div class="tab-pane" id="reward-points" role="tabpanel" aria-expanded="false">
                        Content 1
                    </div>
                    <div class="tab-pane active" id="settings" role="tabpanel" aria-expanded="false">
                        <div class="ks-settings-tab">
                            <div class="ks-menu">
                                <ul class="nav nav-pills nav-stacked">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="profile-settings-general.html">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="profile-settings-contact-info.html">Contact Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="profile-settings-experience.html">Experience</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="profile-settings-education.html">Education</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="profile-settings-organizations.html">Organizations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="profile-settings-notifications.html">Notifications</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="profile-settings-billing.html">Billing</a>
                                    </li>
                                </ul>
                            </div>
                            <form class="ks-form ks-general"> <!-- ks-uppercase ks-light -->
                                <h3 class="ks-header">
                                    General
                                </h3>

                                <div class="ks-manage-avatar ks-group">
                                    <img class="ks-avatar" src="assets/img/avatars/ava-4.png" width="100" height="100">
                                    <div class="ks-body">
                                        <div class="ks-header">Your Avatar</div>
                                        <div class="ks-description">
                                            A square image 100x100px is recommended
                                        </div>
                                        <div class="ks-controls">
                                            <button type="button" class="btn btn-primary">
                                                <span class="la la-upload ks-icon"></span>
                                                <span class="ks-text">Upload Image</span>
                                            </button>
                                            <button type="button" class="btn btn-primary-outline ks-light">Import from Gravatar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ks-group ks-linked-accounts">
                                    <div class="ks-header">Link account with another member</div>
                                    <div class="ks-body">
                                        <span class="ks-linked-account">Your account linked with <span class="ks-name">Alex Frolov</span> <img class="ks-avatar" src="assets/img/avatars/ava-3.png" width="24" height="24"></span>
                                        <a href="#">Unlink Account</a>
                                    </div>
                                </div>
                                <div class="ks-group ks-connect-with-social-accounts">
                                    <div class="ks-header">Connect with social accounts</div>
                                    <div class="ks-body">
                                        <div class="ks-connect-with">
                                            <button type="button" class="btn btn-danger">
                                                <span class="la la-google ks-icon"></span> <span class="ks-text">Connect with Google</span>
                                            </button>
                                        </div>
                                        <div class="ks-connect-with ks-connected">
                                            <button type="button" class="btn btn-primary-outline ks-light">
                                                <span class="la la-facebook ks-icon"></span>
                                                <span class="text ks-text">Connected as <span class="ks-name">Stephen Bates</span></span>
                                            </button>
                                            <a href="#">Disconnect</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection