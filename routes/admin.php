<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\Admin\RetailController;
use App\Http\Controllers\Admin\v1\GrnController;
use App\Http\Controllers\Admin\v1\PosController;
use App\Http\Controllers\CentralstoreController;
use App\Http\Controllers\PublishernewController;
use App\Http\Controllers\Admin\v1\RackController;
use App\Http\Controllers\Admin\v1\RoleController;
use App\Http\Controllers\Admin\v1\AdminController;
use App\Http\Controllers\admin\v1\BillController;
use App\Http\Controllers\Admin\v1\BrandController;
use App\Http\Controllers\Admin\v1\StoreController;
use App\Http\Controllers\CentralcustomerController;
use App\Http\Controllers\Admin\v1\GstSlabController;
use App\Http\Controllers\Admin\v1\ProductController;
use App\Http\Controllers\CustomerWishlistController;
use App\Http\Controllers\Admin\v1\CategoryController;
use App\Http\Controllers\Admin\v1\DispatchController;
use App\Http\Controllers\Admin\v1\DistrictController;
use App\Http\Controllers\Admin\v1\PurchaseController;
use App\Http\Controllers\Admin\v1\DashboardController;
use App\Http\Controllers\Admin\v1\DiscountController;
use App\Http\Controllers\Admin\v1\MannualGrnController;
use App\Http\Controllers\Admin\v1\PublisherController;
use App\Http\Controllers\Admin\v1\RequisitionController;
use App\Http\Controllers\Admin\v1\StorageSiteController;
use App\Http\Controllers\CentralcustomerlatestController;
use App\Http\Controllers\Admin\v1\PurchaseRequestController;
use App\Http\Controllers\Admin\v1\StorageLocationController;
use App\Http\Controllers\Admin\v1\RequisitionRequestController;
use App\Http\Controllers\Admin\v1\MasterStockInventerycontroller;
use App\Http\Controllers\Admin\v1\MunnualSaleController;
use App\Http\Controllers\Admin\v1\TransfersController;
use App\Http\Controllers\TranferController;
use App\Http\Controllers\AdjustMasterStockController;
use  App\Http\Controllers\AuthorController;
use  App\Http\Controllers\CustomergroupController;
use  App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\v1\EditionController;
use App\Http\Controllers\Admin\v1\ExchangeController;
use App\Http\Controllers\Admin\v1\GlobalSearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Getway\BillDeskController;
use App\Http\Controllers\PurchesInvoiceController;

// first i have grouping the middleware 
Route::redirect('/', '/login', 301);

Route::group(['middleware' => ['auth', 'routeGuard', 'permission'],], function () {

  Route::get('profile/view', [ProfileController::class, 'profile_view'])->name('profile.view');
  Route::get('profile/edit/{id}', [ProfileController::class, 'profile_edit'])->name('profile.edit');
  Route::post('profile/update/{id}', [ProfileController::class, 'profile_update'])->name('profile.update');
  Route::get('notification/list', [DashboardController::class, 'list_view'])->name('list.view');
  Route::get('notification/view/{id}', [DashboardController::class, 'view'])->name('notification.view');

  Route::get('publisher/self/view', [ProfileController::class, 'self_profile'])->name('publisher.self.view');
  Route::post('publisher/self/update/{id}', [ProfileController::class, 'self_pub_update'])->name('profile.self.update');

  Route::get('retail/self/view', [ProfileController::class, 'rs_profile'])->name('retail.self.view');
  Route::post('retail/self/update/{id}', [ProfileController::class, 'rs_profile_update'])->name('profile.rs.update');


  Route::get('central/self/view', [ProfileController::class, 'cs_profile'])->name('central.self.view');
  Route::post('central/self/update/{id}', [ProfileController::class, 'cs_profile_update'])->name('profile.cs.update');

  // x---------------------------------------Book Routes start -------------------------------------------------x
  Route::resource('books', ProductController::class);
  Route::get('books/status/{id}', [ProductController::class, 'status'])->name('books.status');
  Route::get('books/download/csv', [ProductController::class, 'csv_productDownload'])->name('books.csv.download');
  Route::get('books/download-publisher/csv', [ProductController::class, 'csv_productDownloadByPublisherId'])->name('download.books.csv');
  Route::get('upload-books/csv', [ProductController::class, 'csv_productUpload'])->name('books.csv.upload');
  Route::post('books/upload/csv', [ProductController::class, 'csv_productUploadMasterInventory'])->name('upload.books.csv');
  Route::post('books/upload/csv/chk', [ProductController::class, 'chkCsvProductUpload'])->name('chk.upload.books.csv');
  Route::post('books/search/{id?}', [ProductController::class, 'getProductById'])->name('books.search');
  Route::get('books/view/{id}', [ProductController::class, 'view'])->name('books.view');
  Route::post('/books/delete/{id}', [ProductController::class, 'destroy'])->name('books.delete');

  Route::get('books/uploads', [ProductController::class, 'books_uploads'])->name('books.uploads');
  Route::get('books/download', [ProductController::class, 'books_download'])->name('books.download');
  Route::get('books/search/universal/{id?}', [ProductController::class, 'books_search'])->name('book.search.universal');
  Route::get('/book/edition', [EditionController::class, 'edition'])->name('books.edition12');
  Route::get('/book/details/{id}', [EditionController::class, 'book_details'])->name('book.details');
  Route::get('/book-detail/{id}', [EditionController::class, 'bookget'])->name('book.get');
  Route::post('/book/edition/store', [EditionController::class, 'store'])->name('book.edition.store');
  // x---------------------------------------Book Routes end  --------------------------------------------------x

  // x--------------------------------------------------Exchange Controller ---------------------------------x
  Route::get('/exchange', [ExchangeController::class, 'index'])->name('exchange.index');
  Route::get('exchange/add', [ExchangeController::class, 'add'])->name('exchange.add');
  Route::get('exchange/sale/get/{invoice_no?}', [ExchangeController::class, 'get_sale'])->name('exchange.sale.get');
  Route::post('exchange/store', [ExchangeController::class, 'store'])->name('exchange.store');


  // x----------------------------------------Unit Controller ---------------------------------------------------x
  Route::get('/index/unit', [UnitController::class, 'index'])->name('admin.inx.unit');
  Route::post('/submit/unit', [UnitController::class, 'post'])->name('admin.sub.unit');
  Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
  Route::post('/unit/update/{id}', [UnitController::class, 'update'])->name('admin.unit.upd');
  Route::get('/unit/delete/{id}', [UnitController::class, 'delete'])->name('admin.unit auth');
  // x----------------------------------------Unit Controller ---------------------------------------------------x

  Route::get('/edit/user', [DashboardController::class, 'edit_user'])->name('edit.user');

  // /**************************************Author Module Start************************************** */
  Route::get('/author/index', [AuthorController::class, 'index'])->name('auth.index');
  Route::get('/author/index/add', [AuthorController::class, 'add'])->name('author.add');
  Route::post('/author/index/add', [AuthorController::class, 'author_add'])->name('admin.author.post');
  Route::get('/author/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');
  Route::get('/author/edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
  Route::post('/author/update/{id}', [AuthorController::class, 'update'])->name('author.index.update');
  Route::get('/author/status/{id}', [AuthorController::class, 'status'])->name('author.status');
  // /**************************************Author Module End************************************** */

  // /**************************************customer Group Module End************************************** */
  Route::get('/customer-group/index', [CustomergroupController::class, 'index'])->name('cgroup.index');
  Route::get('/customer-group/index/add', [CustomergroupController::class, 'add'])->name('cgroup.add');
  Route::get('/customer-group/index/delete/{id}', [CustomergroupController::class, 'delete'])->name('cgroup.delete');
  Route::post('/customer-group/index/add', [CustomergroupController::class, 'cgroup_add'])->name('cgroup.add.post');
  Route::get('/customer-group/index/edit/{id}', [CustomergroupController::class, 'cgroup_edit'])->name('cgroup.edit');
  Route::post('/customer-group/index/update/{id}', [CustomergroupController::class, 'cgroup_update'])->name('cgroup.update');

  // /**************************************customer Group Module End************************************** */

  // /**************************************Customer Route start************************************** */
  Route::get('/retail/index', [RetailController::class, 'index'])->name('retail.customer');
  Route::get('/view/retail', [RetailController::class, 'create'])->name('retail.view');
  Route::post('/add/customer', [RetailController::class, 'post'])->name('retail.add');
  Route::get('/retail/edit/{id}', [RetailController::class, 'edit'])->name('retail.customer.edit');
  Route::post('/retail/update', [RetailController::class, 'update'])->name('retail.customer.update');
  Route::get('/retail/status/{id}', [RetailController::class, 'status'])->name('retail.customer.status');
  // /***************************************customer route end*********************************** */
  // ********************************************Customer WishController********************************/
  Route::get('/customer/wish', [CustomerWishlistController::class, 'customerwish'])->name('index.wish');
  Route::get('/central/customer/wish', [CustomerWishlistController::class, 'centralwishlist'])->name('central.wishlist');
  Route::post('/customer/save',[CustomerWishlistController::class,'store'])->name('customer.save');
  Route::get('/customer/create',[CustomerWishlistController::class,'create'])->name('customer.craete');
  //  /********************************************End wishlist******************************** */
  // /********************************************centralcutomer controller********************* */
  Route::get('/central/index', [CentralcustomerController::class, 'index'])->name('central.customer');
  Route::get('/view/central', [CentralcustomerController::class, 'create'])->name('central.view');
  Route::post('/add/customer/central', [CentralcustomerController::class, 'post'])->name('central.add');
  Route::get('/centralc/edit/{id}', [CentralcustomerController::class, 'edit'])->name('central.customer.edit');
  Route::post('/central/update', [CentralcustomerController::class, 'update'])->name('central.customer.update');
  Route::get('/central/status/{id}', [CentralcustomerController::class, 'status'])->name('central.status');
  Route::get('/get/customer/phone/fetch/{phone?}', [CentralcustomerController::class, 'customerphonedetails'])->name('customer.phone');

  // x--------------------------------BookRequestController--------------------------------------//
  Route::get('/book/request', [BookRequestController::class, 'create'])->name('central.book.request');
  Route::post('/book/add', [BookRequestController::class, 'store'])->name('central.book.add');
  Route::get('/book/request/show', [BookRequestController::class, 'bookrequest'])->name('publisher.show.book');
  Route::get('/request/status/{id}', [BookRequestController::class, 'approve'])->name('request.show.active');

  // x--------------------------------BookRequestController---------------------------------------//
  // x---------------------------------------Categories Routes start -------------------------------------------x
  Route::resource('categories', CategoryController::class);
  Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
  Route::get('categories/status/{id}', [CategoryController::class, 'status'])->name('categories.status');
  // x---------------------------------------Categories Routes end  --------------------------------------------x
  // *****************************************publishernew Controller********************************** */
  Route::get('/publishernew/index', [PublishernewController::class, 'index'])->name('publisher.view');
  Route::get('/publisher/edit/{id}', [PublishernewController::class, 'edit'])->name('pub.edit');
  Route::post('/publisher/update/{id}', [PublishernewController::class, 'update'])->name('pub.update');

  // x---------------------------------------Brand Routes start -------------------------------------------x
  // ***********************************CentralstoreController**************************** */
  Route::resource('/indexcentral', CentralcustomerlatestController::class);
  Route::get('/create/central', [CentralcustomerlatestController::class, 'create']);
  Route::get('/central/showdetails', [CentralcustomerlatestController::class, 'showdetails'])->name('central.showdetail');
  Route::get('/central/edit/{id}', [CentralcustomerlatestController::class, 'edit'])->name('cen.edit');
  Route::post('/central/update/{id}', [CentralcustomerlatestController::class, 'update'])->name('cen.update');
  //  x----------------------------------------centralcustomerlastestController--------------------------------------------x
  // x-------------------------------------Checkoutcontroller-------------------------------------------------------------x
  Route::get('/checkout/pos', [CheckoutController::class, 'checkout'])->name('pos.check');
  // x-------------------------------------Checkoutcontroller-------------------------------------------------------------x
  Route::resource('brands', BrandController::class);
  Route::get('brands/status/{id}', [BrandController::class, 'status'])->name('brands.status');
  // x---------------------------------------Brand Routes end  --------------------------------------------x

  // x---------------------------------------Role Routes start -------------------------------------------x
  Route::resource('roles', RoleController::class);
  Route::get('roles/status/{id}', [RoleController::class, 'status'])->name('roles.status');
  Route::post('roles/update', [RoleController::class, 'update'])->name('roles.update');

  // x---------------------------------------Role Routes end  --------------------------------------------x

  // x------------------------------------------WarehouseController-----------------------------------------x

  Route::get('/index/ware', [WarehouseController::class, 'index'])->name('admin.list.ware');
  Route::get('/add/ware', [WarehouseController::class, 'add'])->name('admin.add.ware');
  Route::post('/post/ware', [WarehouseController::class, 'post'])->name('admin.post.ware');
  Route::get('/ware/edit/{id}', [WarehouseController::class, 'edit'])->name('admin.edit.ware');
  Route::post('/ware/update/{id}', [WarehouseController::class, 'update'])->name('admin.ware.update');
  //  x--------------------------------------------warehousecontroller---------------------------------------x
  //  x--------------------------------------------setting Controller-----------------------------------------x
  Route::get('/setting/index', [SettingsController::class, 'index'])->name('admin.setting');
  Route::post('/post/setting', [SettingsController::class, 'store'])->name('admin.post.set');


  Route::get('/setting/cms-page', [SettingsController::class, 'view'])->name('admin.cms-page');
  Route::get('/setting/cms-page/add', [SettingsController::class, 'add'])->name('admin.cms-add');
  Route::post('/setting/cms-page/post', [SettingsController::class, 'final_add'])->name('admin.post');
  Route::get('/setting/cms-page/delete/{id}', [SettingsController::class, 'delete'])->name('cms.delete');

  // Route::get('/setting/finance', [SettingsController::class, 'show'])->name('admin.finance');
  // Route::get('/setting/appkey', [SettingsController::class, 'show_data'])->name('admin.appkey');
  // Route::get('/setting/miscellaneous', [SettingsController::class, 'view_data'])->name('admin.miscellaneous');

  // Route::get('/setting/finance', [SettingsController::class, 'show'])->name('admin.finance');
  // Route::post('/setting/finance', [SettingsController::class, 'store_data'])->name('admin.finance.post');

  // Route::get('/setting/api-key', [SettingsController::class, 'view_data'])->name('admin.api-key');
  // Route::post('/setting/api-key', [SettingsController::class, 'post_data'])->name('post.api-key');

  // Route::get('/setting/miscellaneous', [SettingsController::class, 'show_data'])->name('admin.miscellaneous');

  //  x---------------------------------------------setting Controller-----------------------------------------x
  // x---------------------------------------Stores Routes start -------------------------------------------x
  Route::resource('stores', StoreController::class);
  Route::get('stores/type/{name}', [StoreController::class, 'index'])->name('stores.index');
  Route::get('stores/create/type/{name}', [StoreController::class, 'create'])->name('stores.create');
  Route::get('stores/status/{id}', [StoreController::class, 'status'])->name('stores.status');
  Route::get('store/get/publisher/{id}',[StoreController::class, 'getstore'])->name('store.get.publisher');
  // x---------------------------------------Stores Routes end  --------------------------------------------x

  // x---------------------------------------Publisher Routes start -------------------------------------------x
  Route::resource('publisher', PublisherController::class);
  Route::get('publisher/status/{id}', [PublisherController::class, 'status'])->name('publisher.status');
  Route::get('/publisher/view/{id}', [PublisherController::class, 'view'])->name('pub.view');
  Route::post('/publisher/update/{id}', [PublisherController::class, 'update'])->name('stores.update');
  // x---------------------------------------Publisher Routes end  --------------------------------------------x


  // x---------------------------------------District Routes start -------------------------------------------x
  Route::resource('districts', DistrictController::class);
  Route::get('districts/status/{id}', [DistrictController::class, 'status'])->name('districts.status');
  // x---------------------------------------District Routes end  --------------------------------------------x



  // Verify it before push

  // x---------------------------------------GstLab Routes start -------------------------------------------x
  Route::resource('gstslabs', GstSlabController::class);
  Route::get('gstslabs/status/{id}', [GstSlabController::class, 'status'])->name('gstslabs.status');
  Route::get('gstslabs/default/{id}', [GstSlabController::class, 'default'])->name('gstslabs.default');
  // x---------------------------------------GstLab Routes end  --------------------------------------------x

  // x---------------------------------------StorageSite Routes start -------------------------------------------x
  Route::resource('storagesites', StorageSiteController::class);
  Route::get('storagesites/status/{id}', [StorageSiteController::class, 'status'])->name('storagesites.status');
  Route::get('storagesites/default/{id}', [StorageSiteController::class, 'default'])->name('storagesites.default');
  // x---------------------------------------StorageSite Routes end  --------------------------------------------x

  // x---------------------------------------StorageLocation Routes start -------------------------------------------x
  Route::resource('storagelocations', StorageLocationController::class);
  Route::get('storagelocations/status/{id}', [StorageLocationController::class, 'status'])->name('storagelocations.status');
  Route::post('storagelocations/getlocation/{siteid?}', [StorageLocationController::class, 'getStorageLocationBySiteId'])->name('storagelocations.by.siteid');
  Route::get('storagelocations/default/{id}', [StorageLocationController::class, 'default'])->name('storagelocations.default');
  // x---------------------------------------StorageLocation Routes end  --------------------------------------------x

  // x---------------------------------------Rack Routes start -------------------------------------------x
  Route::resource('racks', RackController::class);
  Route::get('racks/status/{id}', [RackController::class, 'status'])->name('racks.status');
  Route::post('racks/storage-location/{id?}', [RackController::class, 'storageSite'])->name('racks.storage-location');
  Route::post('racks/getrack/{locid?}', [RackController::class, 'getRackByStorageLocationId'])->name('rack.by.locationid');
  Route::get('racks/default/{id}', [RackController::class, 'default'])->name('racks.default');
  // x---------------------------------------Rack Routes end  --------------------------------------------x

  // x---------------------------------------Rack Routes start -------------------------------------------x
  Route::resource('racks', RackController::class);
  Route::get('racks/status/{id}', [RackController::class, 'status'])->name('racks.status');
  Route::post('racks/storage-location/{id?}', [RackController::class, 'storageSite'])->name('racks.storage-location');
  // x---------------------------------------Rack Routes end  --------------------------------------------x
  // x--------------------------------------tranfer Controller------------------------------------------------x
  Route::get('/ps/tranfer', [TranferController::class, 'index'])->name('ps.trans');



  // x---------------------------------------Pos Routes start -------------------------------------------x
  /* Route::resource('pos', PosController::class);
  Route::post('pos/add/cart/{product_id}', [PosController::class, 'add_cart'])->name('pos.add_cart');
  Route::get('pos/add/cart/delete/{cart_id}', [PosController::class, 'delete_cart'])->name('pos.cart.delete');
  Route::get('pos/add/cart/get/{customer_id?}', [PosController::class, 'get_customer'])->name('pos.cart.get.customer');
 
  Route::get('pos/book/delete/{id}', [PosController::class, 'delete']);
  // Route::post('pos/add/cart',[PosController::class,'add_cart'])->name('pos.add_cart');
  Route::post('pos/customer-details', [PosController::class, 'customer_details'])->name('pos.customer-details');
  Route::post('pos/customer/add', [PosController::class, 'add_customer'])->name('pos.add_customer');
 */
  // x---------------------------------------Pos Routes start -------------------------------------------x
  Route::resource('pos', PosController::class);
  Route::post('pos/add/cart/{product_id}', [PosController::class, 'add_cart'])->name('pos.add_cart');
  Route::get('pos/add/cart/delete/{cart_id}', [PosController::class, 'delete_cart'])->name('pos.cart.delete');
  Route::get('pos/add/cart/update-cart-qty/{cart_id_qty}', [PosController::class, 'update_cart_qty'])->name('pos.cart.updateqty');
  Route::get('pos/add/cart/get/{customer_id?}', [PosController::class, 'get_customer'])->name('pos.cart.get.customer');
  Route::post('pos/item/search', [PosController::class, 'search'])->name('pos.search');
  Route::post('pos/item/category/search', [PosController::class, 'categorysearch'])->name('pos.searchcategory');
  Route::get('pos/book/delete/{id}', [PosController::class, 'delete']);
  // Route::post('pos/add/cart',[PosController::class,'add_cart'])->name('pos.add_cart');
  Route::post('pos/customer-details', [PosController::class, 'customer_details'])->name('pos.customer-details');
  Route::post('customer/pos/add', [PosController::class, 'add_customer'])->name('pos.add_customer');
  Route::get('book/search', [PosController::class, 'books'])->name('book.search');
  Route::post('/discount/apply/{id}', [PosController::class, 'discount'])->name('discount.apply');
  Route::post('pos/pos-sale-store', [PosController::class, 'pos_sale_store'])->name('pos.cartstore');

  Route::get('pos/dicount/coupan/{total}', [PosController::class, 'coupon'])->name('coupan.dispaly');
  Route::get('/pos/sale/show/{invno?}', [PosController::class, 'getSaleInvoiceData'])->name('pos.sale.show');
  Route::post('pos/bank/payment', [PosController::class, 'cashpayment'])->name('cashpayment.pos');
  Route::get('sale/customer/payment', [PosController::class, 'payment'])->name('customer.payment');
  Route::get('book/info/{bookId}', [PosController::class, 'bookinfo'])->name('book.info');
  Route::get('customer/unpaid/list', [PosController::class, 'custunpaid'])->name('cust.unpaid');
  Route::get('unpaid/customer/bill', [PosController::class, 'unpaidpos'])->name('unpaid.pos');
  Route::get('check/bill/status/{cus_id}', [PosController::class, 'billstatus'])->name('bill.status');
  Route::get('customer/print/list', [PosController::class, 'custprint'])->name('cust.print');
  Route::get('print/customer/bill', [PosController::class, 'printpos'])->name('print.pos');
  Route::get('/pos/sale/show/print/{invno?}', [PosController::class, 'getSaleInvoiceDataprint'])->name('pos.sale.showprint');
  Route::get('/pos/transaction/view/{id}', [PosController::class, 'transaction'])->name('pos.transaction');
  Route::post('pos/success/payment', [PosController::class, 'pos_success_payment'])->name('pos.success.payment');
  Route::get('pos/payment/retry/payment', [PosController::class, 'retryPayemnt'])->name('pos.retry.payment');
  Route::get('unset/payment/error',[PosController::class, 'unseterror'])->name('unset.payment.error');
  // x---------------------------------------Pos Routes end  --------------------------------------------x
  // x------------------------------------------BillController ---------------------------------------------x
  Route::get('/bill/retail', [BillController::class, 'bill'])->name('retail.billshow');
  // x------------------------------------------BillController ---------------------------------------------x
  // x---------------------------------------Requisition Routes start -------------------------------------------x
  Route::resource('requisition', RequisitionController::class);
  Route::get('requisition/request/list', [RequisitionController::class, 'request'])->name('requisition.request');
  Route::get('requisition/status/{id}', [RequisitionController::class, 'status'])->name('requisition.status');
  Route::get('requisition/search/{product?}', [RequisitionController::class, 'search'])->name('requisition.search');
  Route::get('requisition/product-price/{product?}', [RequisitionController::class, 'productPrice'])->name('requisition.product.price');
  Route::post('requisition/get-product-by-centralstore', [RequisitionController::class, 'getProductByCentralstore'])->name('requisition.product.central');
  // x---------------------------------------Pos Routes end  --------------------------------------------x
  // x------------------------------------------BillController ---------------------------------------------x
  Route::get('/bill/retail', [BillController::class, 'bill'])->name('retail.billshow');
  // x------------------------------------------BillController ---------------------------------------------x
  // x---------------------------------------Requisition Routes start -------------------------------------------x
  Route::resource('requisition', RequisitionController::class);
  Route::get('requisition/request/list', [RequisitionController::class, 'request'])->name('requisition.request');
  Route::get('requisition/status/{id}', [RequisitionController::class, 'status'])->name('requisition.status');
  Route::get('requisition/search/{product?}', [RequisitionController::class, 'search'])->name('requisition.search');
  Route::get('requisition/product-price/{product?}', [RequisitionController::class, 'productPrice'])->name('requisition.product.price');
  Route::get('requisition/print/{id}', [RequisitionController::class, 'print_req'])->name('requisition.print');
  Route::get('requisition/pdf/download/{id}', [RequisitionController::class, 'download_pdf'])->name('requisition.pdf.download');

  // x---------------------------------------Requisition Routes end  --------------------------------------------x

  // x---------------------------------------Requisition Request Routes start -------------------------------------------x
  Route::resource('requisition-request', RequisitionRequestController::class);
  Route::get('/availableqty', [RequisitionRequestController::class, 'availableqty'])->name('available.qty');
  Route::get('/all_discount_for_total_amount', [RequisitionRequestController::class, 'all_discount_for_total_amount'])->name('all_discount_for_total_amount');
  Route::get('/check_discount_for_total_amount', [RequisitionRequestController::class, 'check_discount_for_total_amount'])->name('check_discount_for_total_amount');

  Route::get('/reqisition/update/print/{id}', [RequisitionRequestController::class, 'reqcs_print'])->name('req.cs.print');
  Route::get('/reqisition/update/pdf/{id}', [RequisitionRequestController::class, 'reqcs_pdf'])->name('req.cs.pdf');
  // x---------------------------------------Requisition Request Routes end  --------------------------------------------x



  // x---------------------------------------Purchase Routes start -------------------------------------------x
  Route::resource('purchase', PurchaseController::class);
  Route::get('purchase/status/{id}', [PurchaseController::class, 'status'])->name('purchase.status');
  Route::get('purchase/requisition/get/{requisition_no?}', [PurchaseController::class, 'get_requisition'])->name('purchase.requisition.get');
  Route::get('purchase/search/{product?}', [PurchaseController::class, 'search'])->name('purchase.search');
  Route::get('purchase/search/{product?}', [PurchaseController::class, 'search'])->name('purchase.search');
  Route::resource('purchase_request', PurchaseRequestController::class);
  Route::get('purchase/print/{id}', [PurchaseController::class, 'purches_print'])->name('purches.print');
  Route::get('purchase/pdf/{id}', [PurchaseController::class, 'purches_pdf'])->name('purches.pdf.download');

  // x---------------------------------------Purchase Routes end  --------------------------------------------x


  // x---------------------------------------Dispatch Routes start -------------------------------------------x
  Route::resource('dispatch', DispatchController::class);
  Route::get('dispatch/status/{id}', [DispatchController::class, 'status'])->name('dispatch.status');
  Route::get('dispatch/purchase/get/{po_no?}', [DispatchController::class, 'get_purchase'])->name('dispatch.purchase.get');
  Route::get('dispatch/search/{product?}', [DispatchController::class, 'search'])->name('dispatch.search');
  Route::get('dispatch/print/{id}', [DispatchController::class, 'dis_print'])->name('dispatch.print');
  Route::get('dispatch/pdf/download/{id}', [DispatchController::class, 'dis_download'])->name('dispatch.pdf.download');

  // x---------------------------------------Dispatch Routes end  --------------------------------------------x


  // x---------------------------------------grn Routes start -------------------------------------------x
  Route::resource('grn', GrnController::class);
  Route::get('grn/status/{id}', [GrnController::class, 'status'])->name('grn.status');
  Route::get('grn/search/{product?}', [GrnController::class, 'search'])->name('grn.search');
  Route::get('grn/product-price/{product?}', [GrnController::class, 'productPrice'])->name('grn.product.price');
  Route::get('grn/dispatch/get/{po_no?}', [GrnController::class, 'get_purchase'])->name('grn.dispatch.get');
  Route::get('grn/print/{id}', [GrnController::class, 'grn_print'])->name('grn.print');
  Route::get('grn/pdf/{id}', [GrnController::class, 'grn_pdf'])->name('grn.pdf.download');
  // x---------------------------------------grn Routes end  --------------------------------------------x

  // x--------------------------------------- Mannual grn Routes start -------------------------------------------x
  Route::resource('mannual-grn', MannualGrnController::class);
  Route::get('mannual-grn/status/{id}', [MannualGrnController::class, 'status'])->name('mannual-grn.status');
  Route::get('mannual-grn/search/{product?}', [MannualGrnController::class, 'search'])->name('mannual-grn.search');
  Route::get('mannual-grn/product-price/{product?}', [MannualGrnController::class, 'productPrice'])->name('mannual-grn.product.price');
  Route::get('mannual-grn/dispatch/get/{po_no?}', [MannualGrnController::class, 'get_purchase'])->name('grn.dispatch.get');
  Route::get('manual/grn/books/{pub_id}', [MunnualSaleController::class, 'newbook'])->name('manual.newbook');

  Route::get('grncsv', [MannualGrnController::class, 'grncsv'])->name('grncsv.index');
  Route::get('grncsv/download', [MannualGrnController::class, 'grncsv_download'])->name('grncsv.download');
  Route::get('grncsv/upload', [MannualGrnController::class, 'grncsv_upload'])->name('grncsv.upload');
  Route::post('grncsv/upload_submit', [MannualGrnController::class, 'grncsv_upload_submit'])->name('grncsv.upload.submit');
  Route::post('grncsv/upload_submit_check', [MannualGrnController::class, 'chk_grncsv_upload_submit'])->name('chk.grncsv.upload.submit');

  Route::get('mannual-grn/print/{id}', [MannualGrnController::class, 'grn_print'])->name('grn.print');
  Route::get('mannual-grn/pdf/{id}', [MannualGrnController::class, 'grn_pdf'])->name('grn.pdf.download');
  // x--------------------------------------- Mannual grn Routes end  --------------------------------------------x


  // x---------------------------------------Dispatch Routes start -------------------------------------------x
  Route::get('master-stock-inventery', [MasterStockInventerycontroller::class, 'index'])->name('master-stock-inventery.index');
  Route::get('master-stock-inventery/status/{id}', [MasterStockInventerycontroller::class, 'status'])->name('master-stock-inventery.status');
  Route::get('master-stock-inventery/item-wise-stock', [MasterStockInventerycontroller::class, 'itemWiseStock'])->name('master-stock-inventery.item-wise-stock');
  Route::get('master-stock-inventery/adjust-stock/{stockid}', [MasterStockInventerycontroller::class, 'adjust_stock'])->name('adjust.stock');
  Route::post('master-stock-inventery/adjust-stock-add', [MasterStockInventerycontroller::class, 'adjust_stock_update'])->name('adjust.stock.store');
  Route::get('master-stock-inventery/adjust-stock-view/{stockid}', [MasterStockInventerycontroller::class, 'adjust_stock_show'])->name('view.adjust.stock');
  // x---------------------------------------Dispatch Routes end  --------------------------------------------x
  // x---------------------------------------Transfer Routes start -------------------------------------------x
  Route::resource('transfer', TransfersController::class);
  Route::post('gat_warehouse_on_produtid', [TransfersController::class, 'gatWarehouseOnProdutid'])->name('transfer.getWarehouse');
  // x---------------------------------------Transfer Routes end  --------------------------------------------x
  // x---------------------------------------Ajust Master Stock Routes start -------------------------------------------x
  Route::get('/adjust/index', [AdjustMasterStockController::class, 'index'])->name('adjust.index');
  Route::post('/post/adjust', [AdjustMasterStockController::class, 'store'])->name('post.adjust');

  // x---------------------------------------Sale Routes start -------------------------------------------x

  Route::resource('sale', MunnualSaleController::class);
  Route::get('sale/request/list', [MunnualSaleController::class, 'request'])->name('sale.request');
  Route::get('sale/status/{id}', [MunnualSaleController::class, 'status'])->name('sale.status');
  Route::any('search/sale/search/{product?}', [MunnualSaleController::class, 'search'])->name('sale.search');
  Route::post('sale/product-price/{product?}', [MunnualSaleController::class, 'productPrice'])->name('sale.product.price');
  Route::post('sale/discount-price', [MunnualSaleController::class, 'discountPrice'])->name('sale.discount.totalamt');
  //Route::get('sale/show/{invno?}', [MunnualSaleController::class, 'getSaleInvoiceData'])->name('sale.show');
  Route::post('sale/update-sale', [MunnualSaleController::class, 'updateSale'])->name('sale.update');
  Route::get('sale/sale-customer-invoice/{cusid?}', [MunnualSaleController::class, 'search_cus_invoice'])->name('sale.get_cus.invoice');
  Route::get('sale/sale-customer-pendinginvoice/{cusid?}', [MunnualSaleController::class, 'pendinginvoice_bycusid'])->name('sale.pendinginvoice.customer_id');
  Route::get('sale/sale-customer-invoice-dprint/{cusid?}', [MunnualSaleController::class, 'search_cus_invoice_dprint'])->name('dprint.sale.get_cus.invoice');
  Route::get('sale/sale-pdf-download/{id}', [MunnualSaleController::class, 'downloadSalePdf'])->name('sale.pdf.download');
  Route::get('publisher/transaction', [MunnualSaleController::class, 'show_publisher_transaction'])->name('pubi.trans');
  Route::get('sale/bill/print/{invo?}', [MunnualSaleController::class, 'download_pdf'])->name('download_salepdf');

  // x---------------------------------------Sale Routes end -------------------------------------------x

  // x---------------------------------------Dispatch Routes start -------------------------------------------x
  Route::resource('master-stock-inventery', MasterStockInventerycontroller::class);
  Route::get('master-stock-inventery/status/{id}', [MasterStockInventerycontroller::class, 'status'])->name('dispatch.status');
  // x---------------------------------------Dispatch Routes end  --------------------------------------------x

  // x---------------------------------------Transfer Routes start -------------------------------------------x
  // Route::resource('transfer', TransfersController::class);
  // Route::post('gat_warehouse_on_produtid', [TransfersController::class, 'gatWarehouseOnProdutid'])->name('transfer.getWarehouse');
  // x---------------------------------------Dispatch Routes end  --------------------------------------------x
  //  x------------------------------------------Purches Controller -------------------------------------------x
  Route::get('/purches/inv/index', [PurchesInvoiceController::class, 'index'])->name('purches.index');
  Route::get('/purches/create', [PurchesInvoiceController::class, 'create'])->name('purches.create.invoice');
  Route::get('purches/invoice/get/{po_no?}', [PurchesInvoiceController::class, 'get_purchase'])->name('purches.dispatch.get');
  Route::get('purchase/invoice/print/{id}', [PurchesInvoiceController::class, 'purchase_print'])->name('purchase.print');
  Route::get('purchase/invoice/pdf/{id}', [PurchesInvoiceController::class, 'purchase_pdf'])->name('purchase.pdf.download');
  Route::post('purchase/store', [PurchesInvoiceController::class, 'store'])->name('purchaseinv.store');
  //  x------------------------------------------Purches Controller -------------------------------------------x
  // x---------------------------------------Discount Route Start --------------------------------------------x
  Route::get('/admin/discount', [DiscountController::class, 'index'])->name('admin.discount');
  Route::post('/admin/discount/post', [DiscountController::class, 'add'])->name('admin.discount.add');
  Route::get('/admin/discount/edit/{id}', [DiscountController::class, 'edit'])->name('discount.edit');
  Route::delete('/admin/discount/delete/{id}', [DiscountController::class, 'destroy'])->name('discount.destroy');
  Route::put('/admin/discount/update/{id}', [DiscountController::class, 'update'])->name('discount.update');
  // X=============================================  Accounts ==================================================X
  Route::get('/account/payout-list-publisher', [MunnualSaleController::class, 'payout_pending'])->name('payout.list.pending');
  Route::get('/sale/view/{id}', [MunnualSaleController::class, 'sale_view'])->name('payout.sale.view');
  Route::get('/payout/pub/pdf/{id}', [MunnualSaleController::class, 'payout_pdf'])->name('payout.pub.pdf');
  Route::get('/payout/pub/print/{id}', [MunnualSaleController::class, 'payout_print'])->name('payout.pub.print');

  // x---------------------------------------Admin Routes start -------------------------------------------x
  Route::resource('admin', AdminController::class);
  //  Route::get('admin/type/{name}', [AdminController::class, 'index'])->name('admin.index');
  Route::get('admin/', [AdminController::class, 'index'])->name('admin.index');
  //  Route::get('admin/create/type/{name}', [AdminController::class, 'create'])->name('admin.create');
  Route::get('admin/create/type/{name?}', [AdminController::class, 'create'])->name('admin.create');
  Route::get('admin/status/{id}', [AdminController::class, 'status'])->name('admin.status');
  Route::get('auth/change-password-show', [AdminController::class, 'auth_change_password_show'])->name('admin.auth_change_password_show');
  Route::post('auth/change-password', [AdminController::class, 'auth_change_password'])->name('admin.auth_change_password');
  Route::get('/admin/changepassword/{id}', [AdminController::class, 'change_password'])->name('admin.changepassword');
  Route::post('/admin/updatepassword', [AdminController::class, 'updatepassword'])->name('admin.updatepassword');
  Route::get('admin/get/role/{role}', [AdminController::class, 'user_role'])->name('admin.get_role');



  // x---------------------------------------Admin Routes end  --------------------------------------------x

  // here i am adding the prefix on the url accroding the login user
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.show');
});

// x---------------------------------------Global Search Routes start -------------------------------------------x
Route::any('global/search', [GlobalSearchController::class, 'index'])->name('global.search');
// x---------------------------------------Global search Routes end  --------------------------------------------x

Route::get('billdesk/payment', [BillDeskController::class, 'payment'])->name('billdesk.payment.init');
Route::any('billdesk/payment/response', [BillDeskController::class, 'billDeskGetwayResponse'])->name('billdesk.payment.response');
