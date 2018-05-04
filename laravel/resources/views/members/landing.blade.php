@extends('master')

@section('content')
    <div class="ks-page-custom" style="font-size: 12px;">
        <div class="ks-body">
            <!--<div class="ks-logo" style="padding-top:100px;">
                <img class="img-responsive" width="250" src="/assets/img/CMG-Logo2.png">
            </div>-->
            <div class="row ">
                <div class="col-md-12 text-center">
                    <h2>Welcome, {{ $data['user']->firstname }} {{ $data['user']->lastname }}</h2>
                </div>
            </div>
            <div class="ks-column ks-page">
                <div class="ks-page-content-body">
                    <div class="ks-page-content-body">
                        <div class="container">
                            <div class="row" style="padding-top: 50px;">
                                <div class="col-lg-2 d-flex">
                                    <div class="card panel panel-primary block-default">
                                        <h5 class="card-header" style="height: 65px;">
                                            Your Profile
                                        </h5>
                                        <div class="card-block">
                                            <h4 class="card-title" style="height: 50px;">Your CMG Profile</h4>
                                            <a href="/profile" class="align-self-end"><button class="btn btn-primary">View Profile</button></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 d-flex">
                                    <div class="card panel panel-primary block-default">
                                        <h5 class="card-header" style="height: 65px;">
                                            Membership Directory
                                        </h5>
                                        <div class="card-block">
                                            <h4 class="card-title" style="height: 50px;">Member Directory</h4>
                                            <a href="/members/directory"><button class="btn btn-primary">View Directory</button></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 d-flex">
                                    <div class="card panel panel-primary block-default">
                                        <h5 class="card-header" style="height: 65px;">
                                            Roving Color Reports
                                        </h5>
                                        <div class="card-block">
                                            <h4 class="card-title" style="height: 50px;">Color Reports</h4>
                                            <a href="http://colormarketing.org/roving-color-reports/"><button class="btn btn-primary">View Reports</button></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 d-flex">
                                    <div class="card panel panel-primary block-default">
                                        <h5 class="card-header" style="height: 65px;">
                                            Digital Color Forecasts
                                        </h5>
                                        <div class="card-block">
                                            <h4 class="card-title" style="height: 50px;">Color Forecasts</h4>
                                            <a href="http://colormarketing.org/digital-color-forecasts/"><button class="btn btn-primary">View Forecasts</button></a>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-2 d-flex">
                                    <div class="card panel panel-primary block-default">
                                        <h5 class="card-header" style="height: 65px;">
                                            Upcoming Events
                                        </h5>
                                        <div class="card-block">
                                            <h4 class="card-title" style="height: 50px;">CMG Events</h4>
                                            <a href="http://colormarketing.org/upcoming-events/"><button class="btn btn-primary">View Events</button></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 d-flex">
                                    <div class="card panel panel-primary block-default">
                                        <h5 class="card-header" style="height: 65px;">
                                            Member Forum
                                        </h5>
                                        <div class="card-block">
                                            <h4 class="card-title" style="height: 50px;">CMG Forum</h4>
                                            <a href="http://members.colormarketing.org/forums"><button class="btn btn-primary">View Forum</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="ks-tabs-page-container">
                                    <div class="col-md-12 ks-header row">
                                    </div>

                                    <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page paddingTop">
                                        <li style="background-color: #9b555f;" class="nav-item first">
                                            <a class="nav-link active" href="#" data-toggle="tab" data-target="#in-patient">
                                                Welcome to CMG</a>
                                        </li>
                                        <li style="background-color: #77657a;" class="nav-item second">
                                            <a class="nav-link" href="#" data-toggle="tab" data-target="#discharged">
                                                CMG's World Color Forecast&#8482;</a>
                                        </li>
                                        <li style="background-color: #84cdb1;" class="nav-item third">
                                            <a class="nav-link" href="#" data-toggle="tab" data-target="#reconciliation">
                                                CMG Member Resources</a>
                                        </li>
                                        <li style="background-color: #6ba9b2" class="nav-item fourth">
                                            <a class="nav-link" href="#" data-toggle="tab" data-target="#growth">
                                                CMG Career Growth</a>
                                        </li>
                                        <li style="background-color: #c79355;" class="nav-item fifth">
                                            <a class="nav-link" href="#" data-toggle="tab" data-target="#forecasting">
                                                Color Forecasting Events</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active ks-column-section" id="in-patient" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h3>COLOR MARKETING IS OUR MISSION</h3>
                                                    <p>Color Marketing Group® is the premier international association for color design professionals. Our Mission is creating accurate and relevant  color and trend forecast information by connecting global color professionals in their shared passion.</p>

                                                    <h3>YOUR PRODUCTS MATTER</h3>
                                                    <p>Color Marketers and Designers know that color is key to selling products. Having the right colors during the product development process benefits
                                                        product sales by:</p>
                                                    <ul>
                                                        <li>Providing more time for planning and product development.</li>
                                                        <li>Ensuring you offer the right products at the right time.</li>
                                                        <li>Ensuring your products meet consumer desires &amp; expectations.</li>
                                                        <li>Ensuring your products will compliment other product areas.</li>
                                                        <li>Providing a competitive edge enabling you to Lead with confidence!</li>
                                                    </ul>
                                                    <br>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h3>WHAT WE DO</h3>
                                                    <p>CMG <strong>EDUCATES</strong> industry on the importance of color marketing. </p>
                                                    <p>CMG <strong>IDENTIFIES</strong> World Color Forecast™ directions two years out and specific to your region and industry. </p>
                                                    <p>CMG <strong>VALIDATES</strong> color forecasts that enrich your bottom line. </p>
                                                    <p>CMG <strong>EDUCATES</strong> color marketers on all aspects of color. </p>
                                                    <p>CMG <strong>BUILDS</strong> lasting professional color marketing relationships.</p>

                                                    <h3>BUILD YOUR MEMBERSHIP VALUE</h3>
                                                    <p>CMG is a hands-on, voluntary association. Grow your color knowledge, professional skills, build relationships and more when you actively
                                                        participate in all aspects of CMG events and committees.</p>

                                                    <p>Color Marketing Group is here to answer your questions and to help you as your strategic color marketing resource.  </p>
                                                    <h4>Welcome to the CMG tribe!</h4>
                                                    <p>Sincerely, <br>
                                                        <img style="margin-top: 15px; margin-bottom: 15px;" src="https://colormarketing.org/wp-content/uploads/2017/10/sharon_sig.jpg" alt="Sharon_Griffis_singature"> <br>
                                                        Sharon Griffis<br>
                                                        Executive Director<br>
                                                        Color Marketing Group<br>
                                                        sgriffis@colormarketing.org<br>
                                                        703.329.850<br>
                                                        <br>
                                                        <br>

                                                        1908 Mount Vernon Avenue, 3rd Floor, Alexandria, VA 22301, USA • 703.329.8500 • COLORMARKETING.ORG</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="discharged" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h3>THE PROCESS</h3>
                                                    <p>The annual process of creating CMG’s World Color Forecast™ starts with pre-summit meetings. Traveling the world to trade events, taking in the cultural shifts, scientific discoveries, technology advances, and global changes, our color design professionals gather the research for color and trend discussions that ultimately guide our CMG World Color Forecast™ two years ahead of the markets.</p>
                                                    <p> Each year CMG holds ChromaZones® to discuss and reveal the research and stories that support the forecasted colors. During these global color forecasting meetings color design professionals share concentrated information that is fundamental to the final forecasted color directions. This information is available to the attendees of the ChromaZones® and also moves onto the final World Color Forecast™ colors, steered annually each September. </p>

                                                </div>
                                                <div class="col-lg-6">

                                                    <p>Three global conferences are held annually  in Europe, Asia Pacific, and Latin America. Color and trend forecast discussions from these conference attendees is steered into the European, Asia Pacific, and Latin American Color Forecasts which are combined with the North American Color Forecast to create the final 64 color CMG World Color Forecast™. </p>

                                                    <p>Each November the CMG International Summit reveals the World Color Forecast™ colors and the supporting final reports. The Summit holds Color
                                                        Application Workshops to further discuss the mixed industry use of the CMG World Color Forecast color evolution, combinations and product
                                                        applications. The results of these workshops (Colors in Action, Contract Colors, CMG Group, and World Colors) are presented at the Summit and are  offered online.</p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="reconciliation" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h3>CMG LIBRARY -- Coming Soon!</h3>
                                                    <p>Need a quick answer to a color question? Want to learn more about a CMG event? Turn to our member-only online library for color white papers, videos,
                                                        training, and other resources. Submit your company’s educational material to be included in this valuable color resource.  </p>
                                                    <h3>MEMBERSHIP DIRECTORY</h3>
                                                    <p>Our online Membership Directory provides the opportunity to connect and grow your relationships with like-minded color professionals. Search by name,
                                                        company, product, and more to engage with fellow members. Build your own community of followers, sharing color design information with global experts and leaders.   </p>
                                                    <h3>JOB DIRECTORY-- Coming Soon!</h3>
                                                    <p>Need a color professional to fill a company position? Your membership in CMG provides a members-only job board for recruiting top color and CMF talent.
                                                    </p>

                                                    <h3>REGIONAL COLOR FORCASTS - Coming Soon!</h3>
                                                    <p>&nbsp;</p>
                                                    <h3>TREND REPORTS FROM FUTURE THINKING WORKSHOPS - Coming Soon</h3>
                                                    <p>&nbsp;</p>
                                                    <h3>INDUSTRY TALLY REPORTS - Coming Soon</h3>
                                                    <p>&nbsp;</p>
                                                    <h3>ROVING REPORTS - Coming Soon</h3>
                                                    <p>&nbsp;</p>
                                                    <h3>TRADE SHOW ROVING COLOR & DESIGN REPORTER</h3>
                                                    <p>Do you want to be a Roving Reporter for Color Marketing Group?  Roving Reporters share written and photographic information of trade shows and markets
                                                        from around the world. Reports focus on the top ten color and design trends that you feel would be of interest to the CMG membership and help build our online member resources.
                                                    </p>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h3>COLOR PROFESSIONALS SPEAKER DIRECTORY</h3>
                                                    <p>Many of the members of CMG are speakers on various topics related to color, finishes, materials, trends, systems and all things color marketing.
                                                        Located as part of the Member Directory, this searchable resource is open to all members. </p>
                                                    <h3>CMG BLOG </h3>
                                                    <p>Visit our blog for further details relating to your membership, upcoming events, speaker and much more.  Do you have content you want to share?
                                                        Let us know.</p>
                                                    <h3>OPPORTUNITIES</h3>
                                                    <p>All CMG events benefit from the support of our CMG member-sponsors. Share your company’s marketing message with the members and support the Group at
                                                        the same time. </p>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="growth" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <p>The direction and success of Color Marketing Group is driven by members who join committees, work on projects, and drive special programs of CMG's
                                                        strategic plan. By volunteering, your career and membership value grows as you connect, learn, and work alongside fellow color professionals.</p>

                                                    <h3>EXECUTIVE COMMITTEE</h3>
                                                    <p>CMG's Board members and officers are CMG veterans who have volunteered their time, and whose leadership and vision their peers recognize. All CMG Board
                                                        Members are elected by the membership. After 3 years of consecutive membership in CMG you can run for the Board of Directors and the Board (and
                                                        former Board) Members can be elected to the Executive committee. </p>

                                                    <h3>BOARD OF DIRECTORS</h3>
                                                    <p>CMG's Board members and officers are CMG veterans who have volunteered their time, and whose leadership and vision their peers recognize. All CMG Board
                                                        Members are elected by the membership. After 3 years of consecutive membership in CMG you can run for the Board of Directors and the Board (and former Board) Members can be elected to the Executive Board. </p>

                                                    <h3>COMMITTEES – Discover the power of volunteering!</h3>
                                                    <p>Grow your CMG Membership value by participating on a committee. Opportunities range from a one-time task to committee involvement or a leadership role.
                                                        Volunteer roles differ among our committees.</p>

                                                    <p><strong>Communications and Public Relations</strong></p>
                                                    <p>Work with CMG’s VP Communications & PR to develop annual communications and public relations strategies for CMG to optimize information flow to all CMG
                                                        internal and external audiences. </p>

                                                    <p><strong>CMG App Development</strong></p>
                                                    <p>Bring CMG into the leading edge of color by providing a mobile color tool for identifying, tracking, applying, and checking colors in the field for business.</p>

                                                    <p><strong>Color Applications Workshops</strong></p>
                                                    <p>Work with the Executive Director to provide participants with the highest quality Color Applications Workshop experience held during the annual Summit.</p>

                                                </div>
                                                <div class="col-lg-6">
                                                    <p><strong>Color Education & Training Committee</strong></p>
                                                    <p>Work with the Executive Director  and Membership Committee to communicate CMG’s organizational structure, mission and culture through a  comprehensive orientation to new members and first time attendees.</p>
                                                    <p>Work with the Member Benefits team to establish a program to enhance CMG members professional development; explore development of a CEU offering, explore development of a training program for students.</p>

                                                    <p><strong>Color Forecasting</strong></p>
                                                    <p>Work with the VP Color Forecasting to coordinate ChromaZone® events; pull together the final color palettes; and ensure consistency of deliverables
                                                        across all the Workshops.</p>

                                                    <p><strong>Event Planning</strong></p>
                                                    <p>Work with the Executive Director to develop the event program, including individual speakers and networking events. Provide the membership with the
                                                        best possible meeting experience</p>

                                                    <p><strong>Future Thinking Workshop</strong></p>
                                                    <p>Work with the Executive Director to provide participants with the highest quality Future Thinking Workshop experience.</p>

                                                    <p><strong>Marketing</strong></p>
                                                    <p>Work with CMG&rsquo;s VP Marketing to develop annual marketing strategy for CMG for internal and external audiences.</p>

                                                    <p><strong>Membership Committee</strong></p>
                                                    <p>Work with the Executive Director to maintain highest level of CMG professional membership and composition.</p>

                                                    <p><strong>Special Projects</strong></p>
                                                    <p>Work with the Executive Director on Special Projects to move CMG forward as the leading color professional&rsquo;s association.</p>

                                                    <p><strong>Website Development Committee</strong></p>
                                                    <p>Work with Executive Director to increase website traffic by keeping web content up to date and relevant.  Undertake quarterly reviews and updates to
                                                        content and imagery.</p>

                                                    <p><strong>Event Planning Committees (Summit, Europe, Asia, and Latin America)</strong></p>
                                                    <p>Work with the Executive Director to develop the event  program, including individual speakers and networking events. Provide the membership with best
                                                        possible meeting experience.</p>
                                                    <br>
                                                    <strong> To join a Committee, contact Sharon Griffis <a href="mailto:sgriffis@colormarketing.org">sgriffis@colormarketing.org</a></strong> </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="forecasting" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <p>The members of Color Marketing Group® convene throughout the year in local and international gatherings to discern what innovations are about to change
                                                        the world, what adaptations we need to make, and which hues best express how colors evolve with the times. Join us!</p>
                                                    <br>
                                                    <p>Your color story makes our larger color story. &nbsp;Your voice speaks volumes about where colors are moving. &nbsp;Tell your story and show you colors as part
                                                        of CMG&rsquo;s World Color Forecast™. &nbsp;</p>
                                                    <br>
                                                    <h4> Why do we forecast color directions?</h4>
                                                    <ul>
                                                        <li>Provides more time for product planning and product development. </li>
                                                        <li>Ensures you offer the right products at the right time.</li>
                                                        <li>Ensures your products meet consumer desires &amp; expectations. </li>
                                                        <li>Ensures your products will compliment other product areas. </li>
                                                        <li>Provides a competitive edge enabling you to Lead with confidence!</li>
                                                    </ul>
                                                    <br>
                                                    <p>Your participation in our annual forecasting process is key. Each year we host 8 to 10 trend forward, color forecasting ChromaZones® and Conferences
                                                        around the globe to discuss and identify colors and trends emerging two years ahead. Validated color stories and colors are identified and are steered
                                                        into the World Color Forecast™ leading the color marketing industry into the future. By participating in the annual Forecasting process you are driving,
                                                        sharing, discussing and exposing emerging colors ahead of the revelation of the final World Color Forecast™ at our International Summit. This allows
                                                        your product teams to LEAD the color marketing future. Your voice on color is invaluable to Color Marketing Group.</p>
                                                    <br>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h3>ChromaZone® Color Forecasting Workshops</h3>
                                                    <p>Global ChromaZones® are held annually and participants come prepared to contribute their top 3 most important color stories, trends and driving
                                                        influences in their industry two years ahead. Guided by a detailed worksheet your presentation (visual imagery, written explanation, color chips,
                                                        and product examples) will communicate your forward-thinking color and trends that drive the ChromaZone Final Report and Forecast.</p>
                                                    <h4>Benefits of Participating</h4>
                                                    <ul>
                                                        <li>Identify current successful colors to determine the evolution of future color directions. </li>
                                                        <li>Validation of your color stories during workshop discussions draw support for individual colors and stories for the ChromaZone Final Report. </li>
                                                        <li>Visual examples of participating company&rsquo;s current and future colors, stories and influences. </li>
                                                        <li>Validation of past CMG Forecast colors. </li>
                                                        <li>Access attendee-only, ChromaZone Final Report and 16 Forecast colors and notations. </li>
                                                        <li>Build your color tribe by working with color professionals. </li>
                                                        <li>Application discussions of color directions across industry </li>
                                                        <li>Planning color 2+ years in advance provides a directional change opportunity to review and refine the future direction of your products without
                                                            completely abandoning your product launch schedule.</li>
                                                        <li>Cross-reference current color success stories with the most recent CMG forecasts.</li>
                                                    </ul>
                                                    <h3>CMG Conferences – Europe, Asia Pacific, and Latin America</h3>
                                                    <p>At the very heart of all CMG Conferences s the Color Forecasting process where the world&rsquo;s leading color and design influencers share, discuss, and
                                                        explore color directions. You will be on the cutting edge of color forecasting, and you&rsquo;ll bring these insights back with you to shape and validate
                                                        discussions and decisions on color directions for your industry, product or service.  CMG&rsquo;s Color Forecasting process is a collaboration of minds;
                                                        a joint effort to understand and interpret what is happening in the world around us and how this will influence color.  The final result is a 16-color
                                                        Directional Forecast that is distributed electronically with a report identifying the trends and influences affecting color directions.</p>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection