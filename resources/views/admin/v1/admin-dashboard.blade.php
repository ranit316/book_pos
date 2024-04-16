<x-layout>

    @slot('title', 'Dashboard')

    @slot('body')
    
      
        <!-- end main content-->
        <div class="main-content">
       <?php 
       if(isAdmin())
       {
       ?>
        
     
         <div class="page-content">
                <div class="container-fluid">

                      <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="">Hi, Admin !</h3>
                                <h4 class="">Welcome to Book POS</h4>
                                
                                
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row row-cols-md-2 row-cols-lg-4" id="dsh-stat-grid">
                        <div class="col">
                                        <div class="card bg-primary" style="">
                                            <div class="card-body d-flex justify-content-between">
                                                <div class="">
                                                    <?php 
                                                    $user_id= auth()->user()->id;
                                                    $total_no_of_books = \App\Models\Product::where('status','active')->get()->count();
                                                    $total_no_of_publishers = \App\Models\Publisher::where('status','active')->get()->count();

                                                      ?>
                                                    
                                                    <h3 class="text-light mb-3">Masters</h3>
                                                    <h5 class="text-light mb-1">Total Active Books:</h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">{{$total_no_of_books}}</h2>
                                                <h5 class="text-light mb-1">Total Publishers:</h5>
                                                <h2 class="pt-1 mb-1 text-light">{{$total_no_of_publishers}}</h2>
                                              
                                                </div>
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                    
                    <div class="col">
                                        <div class="card bg-success" style="">
                                             <div class="card-body d-flex justify-content-between">
                                                <div class="">
                                                    <?php  
                                                    $total_no_of_central_stores = \App\Models\Store::where('type','central-store')->where('status','active')->get()->count();
                                                    $total_no_of_retail_stores = \App\Models\Store::where('type','retail-store')->where('status','active')->get()->count();
                                                   
                                                         ?>
                                               
                                                    <h3 class="text-light mb-3">Stores</h3>
                                                    <h5 class="text-light mb-1">Central Store</h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">{{ $total_no_of_central_stores}}</h2>
                                                <h5 class="text-light mb-1">Retail Store</h5>
                                                <h2 class="pt-1 mb-1 text-light">{{$total_no_of_retail_stores}}</h2>
                                              
                                                </div>
                                               
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                            
                    <div class="col">
                                        <div class="card card bg-secondary" style="">
                                             <div class="card-body d-flex justify-content-between">
                                                <div class="">

                                                    <?php  
                                                       $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                      
                                                      $sales_this_month = \App\Models\Sale::where('status','paid')->where('created_at', '>=', $date)->get()->sum('total');

                                                      $sales_q = \App\Models\Sale::where('status','paid')->where('created_at', '>=', $date)->get();
                                                      $all_sale_ids =[];
                                                      foreach($sales_q as $sales_qq)
                                                      {
                                                        $all_sale_ids[]=$sales_qq->id;
                                                      }
                                                      //print_r($all_sale_ids);    
                                                      $sales_book_this_month = \App\Models\SaleDetails::whereIn('sale_id',$all_sale_ids)->get()->sum('qty'); 
                                                    ?>
                                               

                                                    <h3 class="text-light mb-3">Sales</h3>
                                                    <h5 class="text-light mb-1">No of Books (This Month) </h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">{{$sales_book_this_month}}</h2>
                                                <h5 class="text-light mb-1">By Value (This Month)</h5>
                                                <h2 class="pt-1 mb-1 text-light">₹ {{$sales_this_month}}</h2>
                                              
                                                </div>
                                               
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                    
                    <div class="col">
                                        <div class="card bg-info" style="">
                                             <div class="card-body d-flex justify-content-between">
                                                <div class="">
                                                    <?php  
                                                    $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                      $customers_total_this_month =  \App\Models\Customer::where('status','active')->where('created_at', '>=', $date)->get()->count();
                                                     
                                                      $customers_total =  \App\Models\Customer::where('status','active')->get()->count();
                                                     
                                                    ?>
                                                    <h3 class="text-light mb-3">Customers</h3>
                                                    <h5 class="text-light mb-1">Total </h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">{{$customers_total}}</h2>
                                                <h5 class="text-light mb-1">This Month </h5>
                                                <h2 class="pt-1 mb-1 text-light">{{$customers_total_this_month}}</h2>
                                              
                                                </div>
                                               
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                                
                </div>
                

              
          
        </div>
       <?php 
       }
       else if(isPublisher())
       {
       ?>
       
         <div class="page-content">
                <div class="container-fluid">

                      <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="">Hi, Publisher !</h3>
                                <h4 class="">Welcome to Book POS</h4>
                                
                                
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row row-cols-md-2 row-cols-lg-4" id="dsh-stat-grid">
                            <div class="col">
                                            <div class="card bg-primary" style="">
                                                <div class="card-body d-flex justify-content-between">
                                                    <div class="">
                                                        <?php 
                                                        $publisher_user_id= auth()->user()->id;
                                                        $publisher_id= auth()->user()->publisher_id;
                                                       $total_no_of_books = \App\Models\Product::where('status','active')->get()->count();
                                                       $total_no_of_own_books = \App\Models\Product::where('status','active')->where('supplier_id',$publisher_user_id)->get()->count();
                                                        ?>
                                                        <h3 class="text-light mb-3">Book</h3>
                                                        <h5 class="text-light mb-1">Books Total:</h5>
                                                    <h2 class="mb-3 pt-1 mb-1 text-light"> {{$total_no_of_books}}</h2>
                                                    <h5 class="text-light mb-1">Books Own:</h5>
                                                    <h2 class="pt-1 mb-1 text-light"> {{$total_no_of_own_books}}</h2>
                                                  
                                                    </div>
                                                    <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                                </div>
                                                
                                            </div>
                                    </div>
                        
                        <div class="col">
                                            <div class="card bg-success" style="">
                                                 <div class="card-body d-flex justify-content-between">
                                                    <div class="">
                                                        <?php  
                                                        $total_connected_central_store = \App\Models\User::where('status','active')->where('parent_id',$publisher_user_id)->get()->count();
                                                        $total_retail_store = \App\Models\Store::where('status','active')->where('type','retail-store')->get()->count();
                                                        ?>
                                                   
                                                        <h3 class="text-light mb-3">Conected Stores</h3>
                                                        <h5 class="text-light mb-1">Central</h5>
                                                    <h2 class="mb-3 pt-1 mb-1 text-light"> {{$total_connected_central_store}}</h2>
                                                    <h5 class="text-light mb-1">Retail</h5>
                                                    <h2 class="pt-1 mb-1 text-light"> {{$total_retail_store}}</h2>
                                                  
                                                    </div>
                                                   
                                                    <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                                </div>
                                                
                                            </div>
                                    </div>
                                
                        <div class="col">
                                            <div class="card card bg-secondary" style="">
                                                 <div class="card-body d-flex justify-content-between">
                                                    <div class="">

                                                        <?php  
                                                        $all_connected_central_stores = \App\Models\User::where('status','active')->where('parent_id',$publisher_user_id)->get();
                                                        $all_store_ids = [];
                                                        foreach($all_connected_central_stores as $user)
                                                        {
                                                            $all_store_ids[] = $user->store_id;
                                                            
                                                        }
                                                        $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                       $sale_ids_q =  \App\Models\Sale::where('status','paid')->whereIn('store_id',$all_store_ids)->where('created_at', '>=', $date)->get();
                                                      $all_sale_ids2 = [];
                                                      foreach($sale_ids_q as $sale_ids_qqqq)
                                                      {
                                                        $all_sale_ids2[]=$sale_ids_qqqq->id;
                                                      }
                                                      $sales_count = \App\Models\SaleDetails::whereIn('sale_id',$all_sale_ids2)->get()->sum('qty');
                                                       $sales_total =  \App\Models\Sale::where('status','paid')->whereIn('store_id',$all_store_ids)->where('created_at', '>=', $date)->get()->sum('total');
                                                       
                                                         ?>
                                                   

                                                        <h3 class="text-light mb-3">Sales</h3>
                                                        <h5 class="text-light mb-1">Sales by CS (This Month)</h5>
                                                    <h2 class="mb-3 pt-1 mb-1 text-light"> {{$sales_count}}</h2>
                                                    <h5 class="text-light mb-1">Total Sale (This Month)</h5>
                                                    <h2 class="pt-1 mb-1 text-light">₹ {{$sales_total}}</h2>
                                                  
                                                    </div>
                                                   
                                                    <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                                </div>
                                                
                                            </div>
                                    </div>
                        
                        <div class="col">
                                            <div class="card bg-info" style="">
                                                 <div class="card-body d-flex justify-content-between">
                                                    <div class="">
                                                        <?php 
                                                        $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                         $payout_total =  \App\Models\Publisher_Payout::where('publisher_id',$publisher_id)->get()->sum('amount');
                                                         $payout_this_month =   \App\Models\Publisher_Payout::where('publisher_id',$publisher_id)->where('created_at', '>=', $date)->get()->sum('amount');
                                                     
                                                       ?>
                                                        <h3 class="text-light mb-3">Payouts</h3>
                                                        <h5 class="text-light mb-1">Lifetime</h5>
                                                    <h2 class="mb-3 pt-1 mb-1 text-light"> ₹{{$payout_total}}</h2>
                                                    <h5 class="text-light mb-1">This Month - Received</h5>
                                                    <h2 class="pt-1 mb-1 text-light">₹{{$payout_this_month}}</h2>
                                                  
                                                    </div>
                                                   
                                                    <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                                </div>
                                                
                                            </div>
                                    </div>
                                    
                    </div>
                    

                  
              
            </div>
       <?php 
       }
       else if(isCentral())
       {
        ?>
     
         <div class="page-content">
                <div class="container-fluid">

                      <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="">Hi, Central Store !</h3>
                                <h4 class="">Welcome to Book POS</h4>
                                
                                
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row row-cols-md-2 row-cols-lg-4" id="dsh-stat-grid">
                        <div class="col">
                                        <div class="card bg-primary" style="">
                                            <div class="card-body d-flex justify-content-between">
                                                <div class="">
                                                    <?php 
                                                    $user_id= auth()->user()->id;
                                                    $publisher_user_id = auth()->user()->parent_id;
                                                    $store_id = auth()->user()->store_id;
                                                     $total_no_of_books = \App\Models\Product::where('status','active')->get()->count();
                                                     $total_no_of_own_books = \App\Models\Product::where('status','active')->where('supplier_id',$publisher_user_id)->get()->count();
                                                     

                                                      ?>
                                                    
                                                    <h3 class="text-light mb-3">Book</h3>
                                                    <h5 class="text-light mb-1">Total Active Books:</h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">{{$total_no_of_books}}</h2>
                                                <h5 class="text-light mb-1">Total Publisher's Books:</h5>
                                                <h2 class="pt-1 mb-1 text-light"> {{$total_no_of_own_books}}</h2>
                                              
                                                </div>
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                    
                    <div class="col">
                                        <div class="card bg-success" style="">
                                             <div class="card-body d-flex justify-content-between">
                                                <div class="">
                                                    <?php  
                                                     $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                      // $sales_count =  \App\Models\Sale::where('status','paid')->whereIn('store_id',$all_store_ids)->where('created_at', '>=', $date)->get()->count();
                                                       $sales_total =  \App\Models\Sale::where('status','paid')->where('store_id',$store_id)->where('created_at', '>=', $date)->get()->sum('total');
                                                      

                                                    
                                                       $sale_ids_q =  \App\Models\Sale::where('status','paid')->where('store_id',$store_id)->get();
                                                      $all_sale_ids2 = [];
                                                      foreach($sale_ids_q as $sale_ids_qqqq)
                                                      {
                                                        $all_sale_ids2[]=$sale_ids_qqqq->id;
                                                      }
                                                      $sales_count = \App\Models\SaleDetails::whereIn('sale_id',$all_sale_ids2)->get()->sum('qty');

                                                     ?>
                                               
                                                    <h3 class="text-light mb-3">Sales</h3>
                                                    <h5 class="text-light mb-1">Total Sales (This Month)</h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">₹{{$sales_total}}</h2>
                                                <h5 class="text-light mb-1">Total No of Book Sales</h5>
                                                <h2 class="pt-1 mb-1 text-light">{{$sales_count}}</h2>
                                              
                                                </div>
                                               
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                            
                    <div class="col">
                                        <div class="card card bg-secondary" style="">
                                             <div class="card-body d-flex justify-content-between">
                                                <div class="">

                                                    <?php  
                                                    $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                      $customers_total_this_month =  \App\Models\Customer::where('status','active')->where('store_id',$store_id)->where('created_at', '>=', $date)->get()->count();
                                                     
                                                      $customers_total =  \App\Models\Customer::where('status','active')->where('store_id',$store_id)->get()->count();
                                                     
                                                    ?>
                                               

                                                    <h3 class="text-light mb-3">Customers</h3>
                                                    <h5 class="text-light mb-1">Lifetime </h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">{{$customers_total}}</h2>
                                                <h5 class="text-light mb-1">This Month</h5>
                                                <h2 class="pt-1 mb-1 text-light"> {{$customers_total_this_month}}</h2>
                                              
                                                </div>
                                               
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                    
                    <div class="col">
                                        <div class="card bg-info" style="">
                                             <div class="card-body d-flex justify-content-between">
                                                <div class="">
                                                    <?php 
                                                        $sale_ids_q =  \App\Models\Sale::where('status','paid')->where('store_id',$store_id)->get();
                                                      $all_sale_ids2 = [];
                                                      foreach($sale_ids_q as $sale_ids_qqqq)
                                                      {
                                                        $all_sale_ids2[]=$sale_ids_qqqq->id;
                                                      }
                                                      $sales_payouts_total = \App\Models\Publisher_Payout::whereIn('sale_id',$all_sale_ids2)->get()->sum('amount');

                                                      $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                      $sale_ids_q7 =  \App\Models\Sale::where('status','paid')->where('store_id',$store_id)->where('created_at', '>=', $date)->get();
                                                      $all_sale_ids27 = [];
                                                      foreach($sale_ids_q7 as $sale_ids_qqqq7)
                                                      {
                                                        $all_sale_ids27[]=$sale_ids_qqqq7->id;
                                                      }
                                                      $sales_payouts_monthly = \App\Models\Publisher_Payout::whereIn('sale_id',$all_sale_ids27)->get()->sum('amount');


                                                   ?>
                                                    <h3 class="text-light mb-3">Payout</h3>
                                                    <h5 class="text-light mb-1">Lifetime </h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light"> ₹ {{$sales_payouts_total}}</h2>
                                                <h5 class="text-light mb-1">This Month - Received</h5>
                                                <h2 class="pt-1 mb-1 text-light">₹{{$sales_payouts_monthly}}</h2>
                                              
                                                </div>
                                               
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                                
                </div>
                

              
          
        </div>
       <?php 
       }
       else if(isRetail())
       {
        ?>
        <div class="page-content">
                <div class="container-fluid">

                      <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="">Hi, Retail Store !</h3>
                                <h4 class="">Welcome to Book POS</h4>
                                
                                
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row row-cols-md-2 row-cols-lg-4" id="dsh-stat-grid">
                        <div class="col">
                                        <div class="card bg-primary" style="">
                                            <div class="card-body d-flex justify-content-between">
                                                <div class="">
                                                    <?php 
                                                    $user_id= auth()->user()->id;
                                                  
                                                    $store_id = auth()->user()->store_id;
                                                     $total_no_of_books = \App\Models\Product::where('status','active')->get()->count();
                                                     

                                                      ?>
                                                    
                                                    <h3 class="text-light mb-3">Book</h3>
                                                    <h5 class="text-light mb-1">Total Active Books:</h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">{{$total_no_of_books}}</h2>
                                                <h5 class="text-light mb-1">&nbsp;</h5>
                                                <h2 class="pt-1 mb-1 text-light"> &nbsp;</h2>
                                              
                                                </div>
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                    
                    <div class="col">
                                        <div class="card bg-success" style="">
                                             <div class="card-body d-flex justify-content-between">
                                                <div class="">
                                                    <?php  
                                                     $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                      // $sales_count =  \App\Models\Sale::where('status','paid')->whereIn('store_id',$all_store_ids)->where('created_at', '>=', $date)->get()->count();
                                                       $sales_total =  \App\Models\Sale::where('status','paid')->where('store_id',$store_id)->where('created_at', '>=', $date)->get()->sum('total');
                                                      

                                                    
                                                       $sale_ids_q =  \App\Models\Sale::where('status','paid')->where('store_id',$store_id)->get();
                                                      $all_sale_ids2 = [];
                                                      foreach($sale_ids_q as $sale_ids_qqqq)
                                                      {
                                                        $all_sale_ids2[]=$sale_ids_qqqq->id;
                                                      }
                                                      $sales_count = \App\Models\SaleDetails::whereIn('sale_id',$all_sale_ids2)->get()->sum('qty');

                                                     ?>
                                               
                                                    <h3 class="text-light mb-3">Sales</h3>
                                                    <h5 class="text-light mb-1">Total Sales (This Month)</h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">₹{{$sales_total}}</h2>
                                                <h5 class="text-light mb-1">Total No of Book Sales</h5>
                                                <h2 class="pt-1 mb-1 text-light">{{$sales_count}}</h2>
                                              
                                                </div>
                                               
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                            
                    <div class="col">
                                        <div class="card card bg-secondary" style="">
                                             <div class="card-body d-flex justify-content-between">
                                                <div class="">

                                                    <?php  
                                                    $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                      $customers_total_this_month =  \App\Models\Customer::where('status','active')->where('store_id',$store_id)->where('created_at', '>=', $date)->get()->count();
                                                     
                                                      $customers_total =  \App\Models\Customer::where('status','active')->where('store_id',$store_id)->get()->count();
                                                     
                                                    ?>
                                               

                                                    <h3 class="text-light mb-3">Customers</h3>
                                                    <h5 class="text-light mb-1">Lifetime </h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light">{{$customers_total}}</h2>
                                                <h5 class="text-light mb-1">This Month</h5>
                                                <h2 class="pt-1 mb-1 text-light"> {{$customers_total_this_month}}</h2>
                                              
                                                </div>
                                               
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                    
                    <div class="col">
                                        <div class="card bg-info" style="">
                                             <div class="card-body d-flex justify-content-between">
                                                <div class="">
                                                    <?php 
                                                        $sale_ids_q =  \App\Models\Sale::where('status','paid')->where('store_id',$store_id)->get();
                                                      $all_sale_ids2 = [];
                                                      foreach($sale_ids_q as $sale_ids_qqqq)
                                                      {
                                                        $all_sale_ids2[]=$sale_ids_qqqq->id;
                                                      }
                                                      $sales_payouts_total = \App\Models\Publisher_Payout::whereIn('sale_id',$all_sale_ids2)->get()->sum('amount');

                                                      $date = \Illuminate\Support\Carbon::today()->subDays(30);
                                                      $sale_ids_q7 =  \App\Models\Sale::where('status','paid')->where('store_id',$store_id)->where('created_at', '>=', $date)->get();
                                                      $all_sale_ids27 = [];
                                                      foreach($sale_ids_q7 as $sale_ids_qqqq7)
                                                      {
                                                        $all_sale_ids27[]=$sale_ids_qqqq7->id;
                                                      }
                                                      $sales_payouts_monthly = \App\Models\Publisher_Payout::whereIn('sale_id',$all_sale_ids27)->get()->sum('amount');


                                                   ?>
                                                    <h3 class="text-light mb-3">Payout</h3>
                                                    <h5 class="text-light mb-1">Lifetime </h5>
                                                <h2 class="mb-3 pt-1 mb-1 text-light"> ₹ {{$sales_payouts_total}}</h2>
                                                <h5 class="text-light mb-1">This Month - Received</h5>
                                                <h2 class="pt-1 mb-1 text-light">₹{{$sales_payouts_monthly}}</h2>
                                              
                                                </div>
                                               
                                                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                                            </div>
                                            
                                        </div>
                                </div>
                                
                </div>
                

              
          
        </div>
       <?php 
       }
       ?>
           
        
        

            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> &copy; Vuesy.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

      



        </div>
    @endslot
    <!-- END layout-wrapper -->
</x-layout>
