<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
USE App\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PERMISSION GIVE FOR POS SCREEN FOR RETAIL STORE
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.check',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.add_cart',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.cart.delete',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.cart.updateqty',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.cart.get.custom',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.search',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.searchcategory',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.customer-details',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.add_customer',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.cartstore',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.sale.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.sale.showprint',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.transaction',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'pos.success.payme',
            'status' => 'active',
            'created_by' => 1,
        ]);
        // END PERMISSION
        // FOR DASHBOARD
        Permission::create([
            'role_id' => 2,
            'name' => 'dashboard.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        // END DASHBOARD
        // START CUSTOMER PERMISSION
        Permission::create([
            'role_id' => 2,
            'name' => 'retail.customer',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'retail.view',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'retail.add',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'retail.customer.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'retail.customer.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'retail.customer.status',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'retail.billshow',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'retail.billshow',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'index.wish',
            'status' => 'active',
            'created_by' => 1,
        ]);
        // END PERMISSION 
        // START PERMISSION FOR PURCHASE
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.status',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.requisition.get',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.search',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.print',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase.pdf.download',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase_request.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase_request.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase_request.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase_request.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase_request.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase_request.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase_request.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'purchase_request.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.status',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.purchase.get',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.purchase.get',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.print',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.pdf.download',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'dispatch.status',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.status',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.search',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.product.price',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.dispatch.get',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.print',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.dispatch.get',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.print',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'grn.pdf.download',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'mannual-grn.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'mannual-grn.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'mannual-grn.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'mannual-grn.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'mannual-grn.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'mannual-grn.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'mannual-grn.status',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'mannual-grn.search',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'mannual-grn.product.price',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'manual.newbook',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'master-stock-inventery.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'master-stock-inventery.item-wise-stock',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'master-stock-inventery.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'master-stock-inventery.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'master-stock-inventery.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'master-stock-inventery.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'master-stock-inventery.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'adjust.stock',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'adjust.stock.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'adjust.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'transfer.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'transfer.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'transfer.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'transfer.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'transfer.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'transfer.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'transfer.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'transfer.getWarehouse',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.request',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.status',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.search',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.product.price',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.product.central',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.print',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.pdf.download',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition-request.index',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition-request.store',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition-request.show',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition-request.edit',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition-request.update',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition-request.destroy',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
        Permission::create([
            'role_id' => 2,
            'name' => 'requisition-request.create',
            'status' => 'active',
            'created_by' => 1,
        ]);
    }
}
