<div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="false">
    <div class="ks-body">
        <div class="ks-widgets">
            <div class="card panel panel-default ks-solid ks-widget ks-widget-info">
                <h5 class="card-header">About</h5>
                <div class="card-block">
                    <div class="ks-item">
                        <span>Username</span>
                        <span>&#64;{{ $data['user']->username }}</span>
                    </div>
                    <div class="ks-item">
                        <span>Joined</span>
                        <span>{{ $data['user']->created_at->format('D, M d Y') }}</span>
                    </div>
                    <div class="ks-item">
                        <span>Bio</span>
                        {{ $data['user']->bio }}
                    </div>
                    <!--<div class="ks-item">
                        <span>Location</span>
                        <span>New York, USA</span>
                    </div>-->
                </div>
            </div>

            <div class="card panel panel-default ks-solid ks-widget ks-widget-tags">
                <h5 class="card-header">Skills</h5>
                <div class="card-block">
                    @if($data['skills'])
                        @foreach($data['skills'] as $skill)
                            <a href="" class="skills" data-toggle="modal" data-target=".bd-example-modal-lg-skills" data-id="{{$skill}}">
                                <span class="badge badge-pill badge-default-outline">{{ $skill }}</span>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="card panel panel-default ks-solid ks-widget ks-widget-social-profiles">
                <h5 class="card-header">Social Profiles</h5>
                <div class="card-block">
                    @if($data['user']->facebook)
                        <a target="_blank" href="https://facebook.com/{{ $data['user']->facebook }}" class="ks-social-profile">
                            <span class="la la-facebook"></span>
                        </a>
                    @endif
                    @if($data['user']->twitter)
                        <a target="_blank" href="https://twitter.com/{{ $data['user']->twitter }}" class="ks-social-profile">
                            <span class="la la-twitter"></span>
                        </a>
                    @endif
                    @if($data['user']->instagram)
                        <a target="_blank" href="https://instagram.com/{{ $data['user']->instagram }}" class="ks-social-profile">
                            <span class="la la-instagram"></span>
                        </a>
                    @endif
                    @if($data['user']->linkedin)
                        <a target="_blank" href="https://linkedin.com/{{ $data['user']->linkedin }}" class="ks-social-profile">
                            <span class="la la-linkedin"></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="ks-feed">
            <form method="post" action="/profile/updateStatus" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="post_creator" value="{{ $data['user']->username }}">
                <input type="hidden" name="post_date" value="{{ date('Y-m-d') }}">
                <div class="card panel panel-default ks-post-box">
                    <label class="ks-message h-100">
                        <img class="ks-avatar img-responsive" src="{{ $data['user']->gravatar }}" width="100" height="100">
                        <textarea name="post_content" class="form-control h-100" placeholder="What's new?" required=""></textarea>
                    </label>
                    <div style="vertical-align: middle; padding: 10px;">
                        <div class="ks-actions">
                            <label class="fileContainer">
                                <small><span class="la la-camera la-2x"></span>Upload Image
                                    <input id="fileInput" type="file" name="fileInput"/>
                                </small></label>
                            <output id="img_placeholder"></output>
                        </div>
                        <input type="submit" name="post" value="Post" class="pull-right btn btn-primary">
                    </div>
                </div>
            </form>
            @if($data['timelines'])
                @php $i=0 @endphp
                @foreach($data['timelines'] as $postData)
                    <div class="card panel panel-default ks-post">
                        <div class="ks-header">
                            <a href="#" class="ks-user">
                                <img class="ks-avatar" src="{{ $postData['user']->gravatar }}" width="100" height="100">
                                <a href="/profile/{{ $postData['user']->username }}"><span class="ks-name">{{ $postData['user']->firstname }} {{ $postData['user']->lastname }} &#64;{{ $postData['user']->username }}</span></a>
                            </a>
                            <span class="ks-date-created">{{  Carbon\Carbon::parse($postData['date'])->format('D, M jS Y') }}</span>
                        </div>
                        <div class="ks-body">
                            <div class="ks-text" id="markedContent" data-provide="markdown">
                                <div class="ks-text">
                                    {!! nl2br($postData['post_content']) !!}
                                </div>
                                @if($postData['image_url'] != null)
                                    <div>
                                        <img class="img-responsive img-thumbnail" src="{{ $postData['image_url'] }}" />
                                    </div>
                                @endif

                            </div>
                            @foreach($postData['comments'] as $comment)
                                <div class="card panel panel-default ks-comments-section">
                                    <div class="ks-comment">
                                        <div class="ks-body">
                                            <div class="ks-avatar">
                                                @if(App\User::find($comment['user_id'])->gravatar == null)
                                                    <img class="ks-avatar" src="/assets/img/profile/avatar_default.jpeg" width="100" height="100">
                                                @else
                                                    <img src="{{ App\User::find($comment['user_id'])->gravatar }}" height="36" width="36"/>
                                                @endif
                                            </div>
                                            <div class="ks-comment-box">
                                                <div class="ks-name">
                                                    <a href="/profile/{{ App\User::find($comment['user_id'])->username }}">
                                                        {{ App\User::find($comment['user_id'])->firstname }}
                                                        {{ App\User::find($comment['user_id'])->lastname }}</a>
                                                    <span class="ks-time">{{ $comment['created_at'] }}</span>
                                                </div>
                                                <div class="ks-message">
                                                    {!! nl2br($comment['content']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Comment Section -->
                        <div class="toggleHolder">
                            <a href="#" data-toggle="#toggled_content{{$i}}" class="toggler btn btn-primary pull-right">Comment</a>
                        </div>
                        <div id="toggled_content{{$i}}" style='display:none;'>
                            <div class="ks-feed">
                                <form method="post" action="/comment/timeline/{{ $postData['id'] }}">
                                    {{ csrf_field() }}
                                    <div class="card panel panel-default ks-post-box">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="comment_text" placeholder="Enter your comment"></textarea>
                                        </div>
                                        <div class=" ks-controls">
                                            <!--<div class="ks-actions">
                                                <a href="#" class="ks-action">
                                                    <span class="la la-camera"></span>
                                                </a>
                                            </div>-->
                                            <input class="form-control btn btn-success" type="submit" name="comment" value="Comment" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Comment Section -->
                    </div>
                    @php $i++ @endphp
                @endforeach
            @endif
        </div>
        <div class="ks-widgets">
            @if($data['advert'])
                <div class="card panel panel-default ks-solid ks-widget ks-widget-users">
                    <div class="card-block">
                        <a href="{{ $data['advert']->advert_link }}">
                            <img class="img-responsive img-thumbnail" src="{{ $data['advert']->advert_location }} " alt="Advertisment" />
                        </a>
                    </div>
                </div>
            @endif
            <div class="card panel panel-default ks-solid ks-widget ks-widget-users">
                <h5 class="card-header">Who to follow</h5>
                <div class="card-block">
                    @if($data['followWho'] != 'There are no other members in your industry.')
                        @foreach($data['followWho'] as $follow)
                            <div class="ks-user">
                                <img class="ks-avatar" src="{{ $follow->gravatar }}" width="100" height="100">
                                <div class="ks-info">
                                    <a href="/profile/{{ $follow->username }}" class="ks-name">{{ $follow->firstname }} {{ $follow->lastname }}</a>
                                    <span class="ks-occupation">{{ $follow->company }}</span>
                                </div>
                                <a href="/follow/{{ $follow->id }}" class="ks-add">+</a>
                            </div>
                        @endforeach
                    @else
                        <div class="ks-user">
                            <div class="ks-info">
                                {{ $data['followWho'] }}
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>