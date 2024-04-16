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
                $role = \App\Models\Role::where('id', $id)->first();

                // Check if $role is an instance of Role model
                if ($role instanceof \App\Models\Role) {
                    $roleType = $role->name;
                } else {
                    $roleType = 'Unknown';
                }
            @endphp
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"> Retail {{ $roleType }}</li>

                <li>
                    {{-- @can('dashboar.show') --}}
                    <a href="{{ route('dashboard.show') }}" class="has-arrow">
                        <i class='bx bx-book nav-icon'></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                    {{-- @endcan --}}
                    {{-- <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('dashboard') }}" href="">Profile</a></li>

                    </ul> --}}
                </li>





                <?php 
                if(auth()->user()->role_id==1)
                {
                    ?>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-cog nav-icon'></i>
                        <span class="menu-item" data-key="t-books">Books</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('books.index') }}">All Books </a></li>
                        <li><a href="{{ route('categories.index') }}">Genres </a></li>
                        <li><a href="{{ route('auth.index') }}">Author</a></li>
                    </ul>
                </li>
                <?php 
                }
                    ?>
                <?php 
                     if(auth()->user()->role_id==1)
                     {
                         ?>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-store-alt nav-icon'></i>
                        <span class="menu-item" data-key="t-inventry">Inventory</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('master-stock-inventery.item-wise-stock') }}">ITEMISE STOCK </a>
                        </li>
                        {{-- <li><a href="{{ route('master-stock-inventery.index') }}">Batch wise STOCK </a> --}}
                </li>
                <li><a href="{{ route('transfer.index') }}">TRANSFER </a>
                </li>
                <li><a href="{{ route('transfer.index') }}">ADJUSTMENT </a>
                </li>
                <li><a href="{{ route('transfer.index') }}">Waitlist </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <span class="menu-item" data-key="t-Storage">Storage </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('storagesites.index') }}">Storage Site </a></li>
                        <li><a href="{{ route('storagelocations.index') }}">Storage Location </a></li>
                        <li><a href="{{ route('racks.index') }}">Rack </a></li>

                    </ul>
                </li>
            </ul>
            </li>
            <?php 
            }
                ?>
            <?php 
                 if(auth()->user()->role_id==2 || auth()->user()->role_id==1 || auth()->user()->role_id==8)
                 {
                     ?>


            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-purchase-tag-alt nav-icon'></i>
                    <span class="menu-item" data-key="t-sale">Purchase</span>

                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('purchase.index') }}">Purchase List </a></li>

                    <!--<li><a href="{{ route('purchase.create') }}">Add Purchase </a></li>-->
                    <li><a href="#">Purchase Return </a></li>
                    <li><a href="{{ route('grn.index') }}">GRN List </a></li>
                    <li><a href="{{ route('dispatch.index') }}">Dispatch List </a></li>
                    <!--<li><a href="{{ route('grn.create') }}">Add GRN </a></li>-->
                    <li><a href="{{ route('requisition.index') }}" class="">Requisition List</a></li>
                    @if (isCentral() || isPublisher())
                    <li><a href="{{ route('requisition.index') }}">Requisition Request </a></li>
                    @endif
                </ul>
            </li>
            <?php 
            }
                ?>


            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-cart nav-icon'></i>
                    <span class="menu-item" data-key="t-sale">Sale </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    @can('sale.index')
                        <li><a href="{{ route('sale.index') }}">Sale List </a></li>
                    @endcan
                    @can('sale.create')
                        <!--<li><a href="{{ route('sale.create') }}">Add Sale </a></li>-->
                    @endcan
                    @can('pos.index')
                        <li><a href="{{ route('pos.index') }}">POS </a></li>
                    @endcan
                    <li><a href="#">Sale Return </a></li>
                </ul>
            </li>
            <?php 
        if(auth()->user()->role_id == 8 || auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
        {
            ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-cog nav-icon'></i>
                    <span class="menu-item" data-key="t-Customer">Customer</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    {{-- @can('retail.customer') --}}
                    <li><a href="{{ route('retail.customer') }}">List Customers </a></li>
                    {{-- @endcan --}}
                    <!--<li><a href="{{ route('retail.view') }}">Add Customers </a></li>-->
                    {{-- @can('index.wish') --}}
                    <li><a href="{{ route('index.wish') }}">Customer Whishlist </a></li>
                    {{-- @endcan --}}
                </ul>
            </li>

            {{-- <li>
                <a href="{{ route('purches.index') }}" class="has-arrow">
                    <i class='bx bx-cog nav-icon'></i>
                    <span class="menu-item" data-key="t-Customer">Purchase Invoice</span>
                </a>
            </li> --}}

            <?php
        }
        ?>

            <?php 
                 if(auth()->user()->role_id==1 || auth()->user()->role_id==8)
                 {
                     ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bxs-bank nav-icon'></i>
                    <span class="menu-item" data-key="t-payment">Accounts </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    {{-- <li><a href="#">Expenses </a></li>
                        <li><a href="#">Expense Category </a></li>
                        <li><a href="#">Payment Method</a></li> --}}
                    <li><a href="{{ route('customer.payment') }}"> Customer payments</a></li>
                    <li><a href="{{ route('payout.list.pending') }}">Publisher Payouts</a></li>
                </ul>
            </li>
            <?php 
        }
            ?>

            <?php 
             if(auth()->user()->role_id==1 )
                {
                   ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="bx bx-file nav-icon"></i>
                    <span class="menu-item" data-key="t-setting">Reports and Analytics</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">Retail Stores (Own and Publisher-wise) </a></li>

                </ul>
            </li>
            <?php 
        }
            ?>
              <?php 
              if(auth()->user()->role_id==1 )
                 {
                    ?>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-list-ul nav-icon'></i>
                    <span class="menu-item" data-key="t-utility">Utility</span>

                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">Bulk Email/SMS Notification</a></li>
                    <li><a href="#">Backup</a></li>
                    <li><a href="#">Activity Log</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-cog nav-icon'></i>

                    <span class="menu-item" data-key="t-setup">Setting</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">Print</a></li>
                    <li><a href="#">Payment Mode</a></li>
                    <li><a href="#">POS Receipt</a></li>
                    <li><a href="#">SMS Templates</a></li>
                    <li><a href="#">Email Templates</a></li>
                    <li><a href="#">Notification</a></li>
                    <li><a href="#">Profile Edit</a></li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <span class="menu-item" data-key="t-user">User & Role </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.index', 'retail-store') }}">For Retail </a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <?php 
        }
            ?>




            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
