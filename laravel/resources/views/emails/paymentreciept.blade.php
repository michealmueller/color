<div style="background-color: #f5f6fa;"><!-- [if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
    <![endif]-->
    <div style="margin: 0px auto; max-width: 600px;">&nbsp;</div>
    <!-- [if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]--> <!-- [if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
    <![endif]-->
    <div style="margin: 0px auto; max-width: 600px; background: #fff;">
        <table style="width: 100%;" role="presentation" cellspacing="0" cellpadding="0">
            <tbody>
            <tr style="vertical-align: top;">
                <td style="background-repeat: no-repeat; vertical-align: top; background: #fff url('http://members.colormarketing.org/assets/img/CMG-Logo2.png') no-repeat center center; background-position: center center; width: 250px; padding: 10px 0 10px 0;" height="240"><!-- [if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="width:100%;">
                        <tr>
                            <td style="padding:0;background-color:transparent;">
                    <![endif]-->
                    <div class="mj-hero-content" style="float: center; margin: 0px auto; width: 100%; background-color: transparent;">&nbsp;</div>
                    <!-- [if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]--></td>
            </tr>
            </tbody>
        </table>
        <div class="mj-column-per-100 outlook-group-fix" style="vertical-align: top; display: inline-block; direction: ltr; font-size: 13px; text-align: left; width: 100%;">
            <table role="presentation" border="0" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td style="word-break: break-word; font-size: 0px; padding: 10px 25px;" align="center">
                        <div class="" style="cursor: auto; color: #000000; font-family: Ubuntu, Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; text-align: center;">
                            <h2 style="font-size: 30px; font-weight: normal; margin-bottom: 30px; marin-top: 20px;">Thanks for your business!</h2>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="word-break: break-word; font-size: 0px; padding: 10px 25px;" align="center">
                        <div class="" style="cursor: auto; color: #000000; font-family: Ubuntu, Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; text-align: center;">
                            <h3 style="font-size: 24px; font-weight: normal; margin-top: 0; margin-bottom: 10px;">Your order</h3>
                            <div class="ks-text-light ks-datetime" style="color: rgba(51, 51, 51, 0.6);">{{ date('l, M d Y') }} at {{ date('H:i A') }}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="word-break: break-word; font-size: 0px; padding: 10px 25px;" align="left">
                        <table style="cellspacing: 0px; color: #000; font-family: Ubuntu, Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto;" border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr style="border-top: 1px solid rgba(0, 0, 0, 0.1); text-align: left; font-size: 14px; color: #333;">
                                <td style="padding: 10px 15px 10px 0;">CMG Membership 1 year</td>
                                <td style="padding: 10px 0 10px 0; text-align: right;">${{ $data['amount'] }}</td>
                            </tr>
                            <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: left; font-size: 14px; color: #000;">
                                <td style="padding: 10px 15px 10px 0;">Total</td>
                                <td style="padding: 10px 0 10px 0; text-align: right;">${{ $data['amount'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="word-break: break-word; font-size: 0px; padding: 10px 25px;" align="center">
                        <div class="" style="cursor: auto; color: #000000; font-family: Ubuntu, Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; text-align: center;">
                            <h3 class="ks-details" style="font-size: 24px; font-weight: normal; margin-bottom: 10px; margin-top: 20px;">Your details</h3>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="word-break: break-word; font-size: 0px; padding: 10px 25px;" align="left">
                        <table style="cellspacing: 0px; color: #000; font-family: Ubuntu, Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto;" border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.1); text-align: left; font-size: 14px; color: #333;">
                                <td style="padding: 10px 15px 10px 0; vertical-align: top; width: 120px;">&nbsp;</td>
                                <td style="padding: 10px 0 10px 0;">
                                    <div>{{ $data['user']->firstname }} {{ $data['user']->lastname }}</div>
                                <!--<div>{{ $data['user']->address }}</div>
                                        <div>{{ $data['user']->city }}</div>
                                        <div>{{ $data['user']->state }} {{ $data['user']->zip }}</div>--></td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.1); text-align: left; font-size: 14px; color: #333;">
                                <td style="padding: 10px 15px 10px 0; vertical-align: top; width: 120px;">Billed to</td>
                                <td style="padding: 10px 0 10px 0;">
                                    <div>{{ $data['user']->card_brand }}</div>
                                    <div>Ending in {{ $data['user']->card_last_four }}</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="word-break: break-word; font-size: 9px; padding: 10px 25px;" align="center">For US Citizens only: CMG dues are not deductible as a charitable contribution for US Federal Income Tax purposes, but may be deductible as a business expense;</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- [if mso | IE]>
        </td>
        </tr>
        </table>
        <![endif]--></div>
    <!-- [if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]--> <!-- [if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
    <![endif]-->
    <div style="margin: 0px auto; max-width: 600px;">
        <table style="font-size: 0px; width: 100%;" role="presentation" border="0" cellspacing="0" cellpadding="0" align="center">
            <tbody>
            <tr>
                <td style="text-align: center; vertical-align: top; direction: ltr; font-size: 0px; padding: 20px 0px;"><!-- [if mso | IE]>
                    <![endif]--></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- [if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]--></div>