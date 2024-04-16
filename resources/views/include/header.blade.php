<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('/assets/images/logo-sm.svg') }}" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/assets/images/logo-lg.svg') }}" alt="" height="26">
                    </span>
                </a>

                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('/assets/images/logo-sm.svg') }}" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/assets/images/logo-lg-wh.svg') }}" alt="" height="26">
                    </span>
                </a>

            </div>

            <button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn noti-icon">
                <i class="fa fa-fw fa-bars font-size-16"></i>
            </button>

            <form id="global_search_form" class="app-search d-none d-lg-block" method="POST">
                <div class="position-relative">
                    <input name="data" type="search" onkeyup="selectDrop('global_search_form','{{ route('global.search') }}', 'global_search_data')" class="form-control" placeholder="Search...">
                    @csrf

                    <span class="bx bx-search icon-sm"></span>
                </div>
            </form>
            <div id="global_search_data" class="global-search-data custom-scroll-ui"></div>


        </div>

        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block d-block d-lg-none">

                <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-search icon-sm"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-2">
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" class="form-control rounded bg-light border-0"
                                    placeholder="Search...">
                                <i class="bx bx-search search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                {{-- @if (auth()->user()->type !== 'publisher' && auth()->user()->type !== 'admin' && auth()->user()->type !== 'central-store') --}}
                  @if (isRetail() || isCentral())
                    <a class="btn btn-outline-primary header" target="_blank"
                        href="{{ route('pos.index') }}">
                        <i class="bx bx-list-ul me-2"></i>
                        POS </a>
                @endif
                <button type="button" class="btn header-item noti-icon d-none" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell icon-sm"></i>
                    <span class="noti-dot bg-danger rounded-pill">{{notification()['notifi_count']}}</span>
                </button>
           
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 " aria-labelledby="page-header-notifications-dropdown" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 87.2px, 0px);">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="m-0 font-size-15"> Notifications </h5>
                                </div>
                                {{-- <div class="col-auto">
                                    <a href="javascript:void(0);" class="small"> Mark all as read</a>
                                </div> --}}
                            </div>
                        </div>
                        <div data-simplebar="init" style="max-height: 250px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -16.8px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                            {{-- <h6 class="dropdown-header bg-light">New</h6> --}}


                            @foreach (notifi() as $notifi)
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex border-bottom align-items-start">
                                    {{-- <div class="flex-shrink-0">
                                        <img src="{{asset('assets/images/users/avatar-3.jpg')}}" class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                    </div> --}}
                                    <div class="flex-grow-1">
                                        <?php 
                                        // $ddd = App\Models\Notification::where('is_read','unread')->get();
                                        // echo $ddd;
                                        ?>
                                        <h6 class="mb-1"></h6>
                                        
                                        <div class="text-muted">
                                            <p class="mb-1 font-size-13">{{$notifi->message}} <span class="badgebg-success-subtle text-success"></span></p>
                                            @php
                                            $createdAt = $notifi->created_at;
                                            $diff = now()->diff($createdAt);
                                            $days = $diff->days;
                                            $hours = $diff->h;
                                            $minutes = $diff->i;
                                            @endphp
                                            <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i>{{$days}} days  {{$hours}} hours {{$minutes}} minutes</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                           
                           @endforeach

                           
                        </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 459px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: block; height: 136px;"></div></div></div>
                        <div class="p-2 border-top d-grid">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{route('list.view')}}">
                                <i class="uil-arrow-circle-right me-1"></i> <span>View More..</span>
                            </a>
                        </div>
                    </div>
                    
                </div>
        


            {{-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                    <i class="bx bx-cog icon-sm"></i>
                </button>
            </div> --}}



            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">

                    <img class="rounded-circle header-profile-user" src="{{asset ('/assets/images/users/avatar-6.jpg')}}"

                        alt="Header Avatar">
                    <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                        <span class="user-name">{{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <h6 class="dropdown-header">Welcome {{ auth()->user()->name }}!</h6>
                    <a class="dropdown-item" href="{{route('profile.view')}}"><i
                            class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Profile</span></a>

                    @if ( auth()->user()->type == 'publisher') 
                    <a class="dropdown-item" href="{{route('publisher.self.view')}}">
                        <i class="mdi mdi-home text-muted font-size-16 align-middle me-1"></i>
                        <span class="align-middle">My Publisher</span>
                    </a>

                    <a class="dropdown-item" href="{{ route('stores.index', 'central-store')  }}">
                        <i class="mdi mdi-home text-muted font-size-16 align-middle me-1"></i>
                        <span class="align-middle">My Stores</span>
                    </a>
                    @endif
                    
                    @if ( auth()->user()->role_id == 1 ) 
                    <a class="dropdown-item" href="{{route('retail.self.view')}}">
                        <i class="mdi mdi-home text-muted font-size-16 align-middle me-1"></i>
                        <span class="align-middle">My Retail Store</span>
                    </a>
                    @endif

                    @if ( auth()->user()->role_id == 3) 
                    <a class="dropdown-item" href="{{route('central.self.view')}}">
                        <i class="mdi mdi-home text-muted font-size-16 align-middle me-1"></i>
                        <span class="align-middle">My Central Store</span>
                    </a>

                    <a class="dropdown-item" href="">
                        <i class="mdi mdi-home text-muted font-size-16 align-middle me-1"></i>
                        <span class="align-middle">My Store</span>
                    </a>

                    @endif

                    {{-- <a class="dropdown-item" href="pages-faqs.html"><i
                            class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Help </span></a> --}}
                    {{-- <div class="dropdown-divider"></div> --}}

                    {{-- <a class="dropdown-item d-flex align-items-center" href="contacts-settings.html"><i
                            class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Settings</span><span
                            class="badgebg-success-subtle text-success ms-auto">New</span></a> --}}

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" href="auth-signout-cover.html"><i
                                class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                                class="align-middle">Logout</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @if (Route::currentRouteName() == 'dashboard') --}}
    <!-- end dash troggle-icon -->
    {{-- @endif --}}




</header>
