<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="chat-section">
            <!-- Row start -->
            <div class="row no-gutters">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-2 col-3">
                    <div class="users-container">
{{--                        <div class="chat-search-box">--}}
{{--                            <div class="input-group">--}}
{{--                                <input class="form-control" placeholder="Search" />--}}
{{--                                <div class="input-group-btn">--}}
{{--                                    <button type="button" class="btn btn-primary">--}}
{{--                                        <i class="icon-magnifying-glass"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="usersContainerScroll">
                            @include('users.features.partials.conversation-users', ['conversations' => $conversations])
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-10 col-9">
                    <div class="active-user-chatting">
                        @include('users.features.partials.conversation-header')

                        @include('users.features.partials.conversation-modals')
                    </div>
                    <div class="chat-container">
                        <div class="chatContainerScroll">
                            @include('users.features.partials.conversation-content', [
                                 'adminId' => $adminId,
                             ])
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
    </div>
</div>
<!-- Row end -->