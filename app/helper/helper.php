<?php

use App\Models\Setting;
use App\Models\Notification;
use App\Models\CmsPage;
use Illuminate\Support\Facades\DB;
use App\Models\Publisher;
use App\Auth\Permission;


function responseData($data, $message = "", $status = true)
{
    return [
        "success" => $status,
        "message" => $message,
        "data" => $data
    ];
}

function get_admin_role($type)
{
    $data =  DB::table('roles')->where('type', $type)->where('name', 'admin')->first();
    return $data->id ?? '';
}

function loginStore()
{
    $data = DB::table('stores')->find(auth()->user()->store_id);
    return $data;
}

function isAdmin()
{
    if (auth()->user()->type == "admin") {
        return true;
    } else {
        return false;
    }
}
function isPublisher()
{
    if (auth()->user()->type == "publisher") {
        return true;
    } else {
        return false;
    }
}
function isCentral()
{
    if (auth()->user()->type == "central-store") {
        return true;
    } else {
        return false;
    }
}
function isRetail()
{
    if (auth()->user()->type == "retail-store") {
        return true;
    } else {
        return false;
    }
}

function setting()
{
    $setting = Setting::get('value');
    return [
        'value_footer_right' => $setting[0]->value ?? '',
        'value_footer_left' => $setting[1]->value ?? '',
    ];
    //return $setting[0]->value;
}
// {{quickreport()['customer']}}

function notification()
{
    $notifi_count = Notification::where('is_read', 'unread')->get()->count();
    return ['notifi_count' => $notifi_count];
}
function notifi()
{

    $notification = Notification::where('is_read', 'unread')->get();
    // $notification = Notification::where('is_read','unread')->with(['pubnotic' => function ($query){
    //     $query->where('deleted_at', null)->get();
    // }]);
    // $publisher = Publisher::where('deleted_at', null)->get();
    return  $notification;
}

function footer_content()
{
    $data = CmsPage::all();
    return  $data;
}


function isAutherized(...$permission_route_name)
{
    return  Permission::check($permission_route_name);
}
