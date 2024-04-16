<div class="vertical-menu">


<!-- LOGO -->
<div class="navbar-brand-box">
    <a href="#" class="logo logo-dark">
        @php
            $data = \App\Models\AppInfo::first();
        @endphp
        <span class="logo-sm">
            {{-- Check if $data->dark_logo is not null --}}
            @if ($data && $data->dark_logo)
                {{-- If $data->dark_logo is not null, display it --}}
                <img src="{{ asset($data->dark_logo) }}" height="40">
            @else
                {{-- If $data->dark_logo is null, fallback to default logo --}}
                <img src="{{ asset('images/setting/logo-sm.svg') }}" height="40">
            @endif
        </span>
        <span class="logo-lg">
            {{-- Check if $data->logo is not null --}}
            @if ($data && $data->logo)
                {{-- If $data->logo is not null, display it --}}
                <img src="{{ asset($data->logo) }}" height="40">
            @else
                {{-- If $data->logo is null, fallback to default logo --}}
                <img src="{{ asset('images/setting/logo-lg.svg') }}" height="40">
            @endif
        </span>
    </a>

    <a href="#" class="logo logo-light">
        <span class="logo-sm">
            <img src="{{ asset('/assets/images/logo-sm.svg') }}" alt="" height="26">
        </span>
        <span class="logo-lg">
            <img src="{{ asset('/assets/images/logo-lg-wh.svg') }}" alt="" height="40">
        </span>
    </a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
    <i class="fa fa-fw fa-bars"></i>
</button>

<div data-simplebar class="sidebar-menu-scroll">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        @php
        $id = auth()->user()->role_id;
       $role = \App\Models\Role::where('id',$id)->first();
    
        // Check if $role is an instance of Role model
        if ($role instanceof \App\Models\Role) {
            $roleType = $role->name;
        } else {
            $roleType = 'Unknown';
        }
    @endphp
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" data-key="t-menu"> Publisher {{$roleType}}</li>

            <li>
                <a href="{{ route('dashboard.show') }}">
                    <i class='bx bxs-dashboard nav-icon'></i>
                    <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                </a>
                {{-- <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('publisher.view')}}">Profile</a></li>
                </ul> --}}
            </li>
            <?php 
            if (auth()->user()->role_id == 5)
            {
            ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-book nav-icon'></i>
                    <span class="menu-item" data-key="t-ecommerce">User Management</span>
                </a>
               <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.index') }}">User</a></li>
                </ul> 
            </li>
            <?php 
            }
            ?>
            <li> 
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-book nav-icon'></i>
                    <span class="menu-item" data-key="t-ecommerce">Books</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('books.index') }}">All Books </a></li>
                  {{--  <li><a href="{{ route('books.csv') }}">CSV Upload </a></li>  --}}

                  {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <span class="menu-item" data-key="t-projects">Bulk Upload</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('books.csv.download') }}">Book CSV Download </a></li>
                        <li><a href="{{ route('books.csv.upload') }}">Book CSV Upload </a></li>
                    </ul>
                </li> --}}

                    <li><a href="{{ route('categories.index') }}">Genres </a></li>

                    <li><a href="{{ route('auth.index') }}">Author</a></li>
                    {{-- <li><a href="#">Brand</a></li> --}}
                    {{-- <li><a href="{{ route('racks.index') }}">Rack </a></li> --}}
                    <li><a href="{{route('admin.inx.unit')}}">Units</a></li>
                    {{-- <li><a href="#">Stock Count </a></li> --}}

                </ul>
            </li>

            <?php
            if(auth()->user()->role_id == 5)
            {
            ?>
             <li>
            <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bxs-user-detail nav-icon'></i>
                    <span class="menu-item" data-key="store"> Store</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('stores.index', 'central-store')  }}">Central Store</a></li>
                     {{-- <li><a href="">Retail Store</a></li> --}}
                    {{-- <li><a href="{{ route('publisher.index') }}">Publisher Store</a></li>  --}}
                </ul>
            </li>   
            <?php }?>

            {{-- <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-book nav-icon'></i>
                    <span class="menu-item" data-key="t-store"> Store</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('stores.index', 'central-store')  }}">Central Store</a></li>
                    <li><a href="">Retail Store</a></li>
                    <li><a href="">Publisher Store</a></li>
                </ul>
            </li> --}}
{{-- 
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-purchase-tag-alt nav-icon'></i>
                    <span class="menu-item" data-key="t-sale">Inventory</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    @if (isCentral() || isPublisher())
                    <li><a href="{{ route('requisition-request.index') }}">Requisition Request </a></li>
                    @endif
                </ul>
            </li> --}}

            {{-- <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-book nav-icon'></i>
                    <span class="menu-item" data-key="t-ecommerce">Transfer</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('ps.trans')}}">All Transfer</a></li>
                    <li><a href="">Create Transfer</a></li>
                    <li><a href=""> </a></li>
                </ul>
            </li> --}}

            {{-- <li>

                <a href="{{ route('stores.index', 'central-store')  }}" >
                    <i class='bx bxs-user-detail nav-icon'></i>
                    <span class="menu-item" data-key="t-ecommerce">Central Store Management</span>
                </a>
            </li> --}}

            {{-- <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-book nav-icon'></i>
                    <span class="menu-item" data-key="t-Purchace">Purchace</span>
                </a>
                <ul>
                    <li><a href="#">GRN List </a></li>
                <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('grn.index') }}">GRN List </a></li>
                        <li><a href="{{ route('grn.create') }}">Add GRN </a></li>
                </ul>
                </ul>
                
            </li> --}}

            {{-- <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-book nav-icon'></i>
                    <span class="menu-item" data-key="t-Sales">Sales</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href=""> </a></li>
                    {{-- <li><a href="{{ route('brands.index')}}">Brand </a></li> --}}
                    {{-- <li><a href=""> </a></li> --}}
                    {{-- <li><a href=""> </a></li> --}}
                {{-- </ul> --}}
            {{-- </li> --}} 
            
            {{-- <li>
                <a href="javascript: void(0);">
                    <i class='bx bx-rupee nav-icon'></i>
                    <span class="menu-item" data-key="t-projects">Payout Management</span>
                </a>

            </li> --}}

            {{-- <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="bx bx-file nav-icon"></i>
                    <span class="menu-item">Reports and Analytics</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">

                    <li><a href="#"> Book-wise Sale Data </a></li>
                    <li><a href="#"> Store-wise Sale Data </a></li>
                    <li><a href="#"> District-wise Sale Data </a></li>
                    <li><a href="#"> Same for Stock </a></li>
                    <li><a title="Manage publisher information, including contact details and payment preferences"
                            href="#"> Manage publisher information</a></li>
                    <li><a href="#"> View personalized sales data and analytics. </a></li>
                    <li><a title=" - Detailed sales and royalty reports for each book. Real-time sales tracking"
                            href="#">Detailed sales</a></li>
                            <li><a title=" - Detailed sales and royalty reports for each book. Real-time sales tracking"
                                href="#">Real time sales tracking</a></li>

                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-book nav-icon'></i>
                    <span class="menu-item" data-key="t-Utility">Utility</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href=""> </a></li>
                    {{-- <li><a href="{{ route('brands.index')}}">Brand </a></li> --}}
                    {{-- <li><a href="">Activities Log</a></li> --}}
                    {{-- <li><a href="">Bulk Data Export</a></li> --}}
                    {{-- <li><a href="">Bulk send</a></li> --}}
                    {{-- <li><a href="">Offer</a></li> --}}
                    {{-- <li><a href="">Back up</a></li> --}}
                {{-- </ul> --}}
            {{-- </li> --}} 

                        {{-- <li>
                            <a href="{{ route('dashboard') }}">
                                <i class='bx bxs-dashboard nav-icon'></i>
                                <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('publisher.view')}}">Profile</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class='bx bx-book nav-icon'></i>
                                <span class="menu-item" data-key="t-ecommerce">User and Role Management</span>
                            </a>
                            {{-- <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('publisher.view')}}">Publisher</a></li>
                            </ul> --}}
                        {{-- </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class='bx bx-book nav-icon'></i>
                                <span class="menu-item" data-key="t-ecommerce">Books</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('books.index') }}">All Books </a></li>
                                <li><a href="{{ route('categories.index') }}">Category </a></li>
                                <li><a href="#">Author</a></li>
                                <li><a href="#">Brand</a></li> --}}
                                {{-- <li><a href="{{ route('racks.index') }}">Rack </a></li> --}}
                                {{-- <li><a href="#">Units</a></li> --}}
                                {{-- <li><a href="#">Stock Count </a></li> --}}

                            {{-- </ul> --}}
                        {{-- </li> --}} 

                       
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class='bx bx-purchase-tag-alt nav-icon'></i>
                                <span class="menu-item" data-key="t-sale">Inventory</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                @if (isCentral() || isPublisher())
                                <li><a href="{{ route('requisition-request.index') }}">Requisition Request </a></li>
                                @endif
                            </ul>
                        </li> --}}

                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class='bx bx-book nav-icon'></i>
                                <span class="menu-item" data-key="t-ecommerce">Transfer</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('ps.trans')}}">All Transfer</a></li>
                                <li><a href="">Create Transfer</a></li>
                                <li><a href=""> </a></li>
                            </ul>
                        </li> --}}

                        {{-- <li>

                            <a href="{{ route('stores.index', 'central-store')  }}" >
                                <i class='bx bxs-user-detail nav-icon'></i>
                                <span class="menu-item" data-key="t-ecommerce">Central Store Management</span>
                            </a>
                        </li> --}}

                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class='bx bx-book nav-icon'></i>
                                <span class="menu-item" data-key="t-Purchace">Purchace</span>
                            </a>
                            <ul>
                                <li><a href="#">GRN List </a></li>
                            <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('grn.index') }}">GRN List </a></li>
                                    <li><a href="{{ route('grn.create') }}">Add GRN </a></li>
                            </ul>
                            </ul>
                            
                        </li> --}}

                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class='bx bx-book nav-icon'></i>
                                <span class="menu-item" data-key="t-Sales">Sales</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href=""> </a></li>
                                {{-- <li><a href="{{ route('brands.index')}}">Brand </a></li> --}}
                                {{-- <li><a href=""> </a></li> --}}
                                {{-- <li><a href=""> </a></li> --}}
                            {{-- </ul> --}}
                        {{-- </li> --}} 
                        
                        {{-- <li>
                            <a href="javascript: void(0);">
                                <i class='bx bx-rupee nav-icon'></i>
                                <span class="menu-item" data-key="t-projects">Payout Management</span>
                            </a>

                        </li> --}}

                
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class='bx bx-book nav-icon'></i>
                                <span class="menu-item" data-key="t-Utility">Utility</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a> </a></li>
                                {{-- <li><a href="{{ route('brands.index')}}">Brand </a></li> --}}
                                <li><a>Activities Log</a></li>
                                <li><a >Bulk Data Export</a></li>
                                <li><a >Bulk send</a></li>
                                <li><a >Offer</a></li>
                                <li><a >Back up</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class='bx bx-purchase-tag-alt nav-icon'></i>
                                <span class="menu-item" data-key="t-Setting">Setting </span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="#">Notifications </a></li>
                                <li><a href="javascript: void(0);">User and Role </a></li>
                                <li><a href="{{route('edit.user')}}"> Edit profile </a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class='bx bxs-bank nav-icon'></i>
                                <span class="menu-item" data-key="t-payment">Accounts </span>
        
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                {{-- <li><a href="#">Expenses </a></li>
                                <li><a href="#">Expense Category </a></li>
                                <li><a href="#">Payment Method</a></li> --}}
                                <li><a href="{{ route('payout.list.pending') }}">Publisher Payouts</a></li>
                                {{-- <li><a href="{{route('customer.payment')}}"> Customer Transactions </a></li> --}}
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="bx bx-file nav-icon"></i>
                                <span class="menu-item">Reports and Analytics</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a> Book-wise Sale Data </a></li>
                                <li><a > Store-wise Sale Data </a></li>
                                <li><a > District-wise Sale Data </a></li>
                                <li><a > Same for Stock </a></li>
                                <li><a title="Manage publisher information, including contact details and payment preferences"
                                       > Manage publisher information</a></li>
                                <li><a > View personalized sales data and analytics. </a></li>
                                <li><a title=" - Detailed sales and royalty reports for each book. Real-time sales tracking"
                                       >Detailed sales</a></li>
                                        <li><a title=" - Detailed sales and royalty reports for each book. Real-time sales tracking"
                                            >Real time sales tracking</a></li>

                            </ul>
                        </li>

        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->
