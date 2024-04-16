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
            <!-- Left Menu Start -->
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
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Central {{$roleType}}</li>

                <li>
                    <a href="{{ route('dashboard.show') }}">
                        <i class='bx bxs-dashboard nav-icon'></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard </span>
                    </a>
                    {{-- <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('central.showdetail') }}">Profile </a></li>
                    </ul> --}}

                </li>
                {{-- role_id = 3 Admin --}}
                <?php 
                if(auth()->user()->role_id==3)
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
                <?php } ?>


                <?php 
                if(auth()->user()->role_id==3 || auth()->user()->role_id==7)
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
                <li><a href="{{ route('adjust.index') }}">ADJUSTMENT </a>
                </li>
                <li><a href="{{ route('exchange.index') }}">Exchange </a>
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
            <?php } ?>
            <?php 
            if(auth()->user()->role_id==3 || auth()->user()->role_id==7)
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
                    {{-- <li><a href="{{ route('grn.index') }}">GRN List </a></li> --}}
                    <!--<li><a href="{{ route('grn.create') }}">Add GRN </a></li>-->
                    <li><a href="{{ route('dispatch.index') }}">Dispatch List </a></li>
                    <li><a href="#" class="has-arrow">GRN </a>
                        <ul class="sub-menu" aria-expanded="false" class="has-arrow">
                            {{-- <li><a href="{{ route('grn.index') }}">GRN List </a></li>  --}}


                            <li><a href="{{ route('mannual-grn.index') }}"> GRN List </a>
                            </li>
                            {{-- <li><a href="{{ route('grncsv.index') }}">GRN CSV </a></li> --}}
                            <!-- <li><a href="{{ route('requisition.create') }}">Add Requisition </a></li>-->
                        </ul>
                    </li>


                    <!--<li><a href="{{ route('mannual-grn.create') }}">Add Mannual GRN </a></li>-->
                    {{-- <li><a href="{{ route('mannual-grn.index') }}">Mannual GRN  List </a></li> --}}
                    @if (isCentral() || isPublisher())
                    <li> <a href="{{ route('requisition-request.index') }}" class="">Requisition Request</a> </li>
                    @endif
                </ul>
            </li>
            <?php } ?>




            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-cog nav-icon'></i>
                    <span class="menu-item" data-key="t-projects">Sale</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('sale.index') }}">Sale List </a></li>
                    <!--<li><a href="{{ route('sale.create') }}">Add Sale </a></li>-->
                    <li><a href="{{ route('pos.index') }}">POS </a></li>
                    <li><a href="#">Sale Return </a></li>
                    <li><a href="#"> Return and Refund </a></li>
                    {{-- /   <li><a href="#"> Coupon and Discount Setting </a></li> --}}
                </ul>
            </li>

            <li>
                {{-- <a href="#" class="has-arrow">
                        <i class="bx bx bx-group"></i>
                        <span class="menu-item" data-key="t-projects">Customer<span></a> --}}
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-group nav-icon'></i>
                    <span class="menu-item" data-key="t-sale">Customer</span>

                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('central.customer') }}">List Customers </a></li>
                    <li><a href="{{ route('central.wishlist') }}">Customer Whishlist </a></li>
                </ul>
            </li>


         
            <?php 
            if(auth()->user()->role_id==3 || auth()->user()->role_id==7)
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
                    <li><a href="{{ route('customer.payment') }}">Customer payments </a></li>
                    <li><a href="{{ route('payout.list.pending') }}">Publisher Payouts</a></li>

                </ul>
            </li>
            <?php } ?>
            <?php 
            if(auth()->user()->role_id==3)
            {
                ?>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="bx bx-file nav-icon"></i>
                    <span class="menu-item">Reports and Analytics</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">Retail Stores (Own and Publisher-wise) </a></li>

                    <!--<li><a href="{{ route('purchase.create') }}">Add Purchase </a></li>-->
                    <li><a href="{{ route('purchase_request.index') }}">Purchase Request </a></li>

                    <li><a href="#">Purchase Return </a></li>
                </ul>
            </li>
            <?php } ?>
            <?php 
            if(auth()->user()->role_id==3)
            {
                ?>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-list-ul nav-icon'></i>
                    <span class="menu-item" data-key="t-projects">Utility</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">Bulk Email/SMS Notification</a></li>
                    <li><a href="#">Backup</a></li>
                    <li><a href="#">Marketing And Prmotions</a></li>
                    <li><a href="#">Activity Logs</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php 
            if(auth()->user()->role_id==3)
            {
                ?>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class='bx bx-cog nav-icon'></i>
                    <span class="menu-item" data-key="t-projects">Setting</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">Print</a></li>
                    <li><a href="#">Payment Mode</a></li>
                    <li><a href="#">POS Receipt</a></li>
                    <li><a href="#">SMS Templates</a></li>
                    <li><a href="#">Email Templates</a></li>
                    <li><a href="#">Notification</a></li>
                    <li><a href="#">Edit Profile</a></li>
                    <li><a href="#">User & Role</a></li>
                </ul>
            </li>
            <?php } ?>
           

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
