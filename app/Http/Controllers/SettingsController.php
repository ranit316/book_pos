<?php

namespace App\Http\Controllers;

use App\Models\AppInfo;
use App\Models\CompanyInfo;
use App\Models\Finance;
use App\Models\ApiKey;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public $page ="Cms Page";
    public function index()
    {
        $app_setting = AppInfo::first();
        return view('admin.v1.setting.add',compact('app_setting'));
    }
    
    public function store(Request $request)
    { 
        if($request->id == null)
        {
            $appinfo= new AppInfo();
        }
        else
        {
            $appinfo = AppInfo::find($request->id);
        }

        $fullPath = null;
        $dark_logo = null;
        $fav_icon = null;
        
        $validator = Validator::make($request->all(), [
            'app_logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'dark_logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'fab_icon' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        else
        {
            if($validator->passes())
            {
                if ($request->hasFile('app_logo')) {
                    $imageName = 'logo-lg1' . '.' . $request->file('app_logo')->extension();
                    $request->app_logo->move(public_path('images/setting'), $imageName);
                    $fullPath = 'images/setting/' . $imageName;
                }

                if($request->hasFile('dark_logo')){

                 

                    $dark_logo ='logo-sm1' . '.' . $request->file('dark_logo')->extension();
                    $request ->dark_logo->move(public_path('images/setting'),$dark_logo);
                    $dark_logo = 'images/setting/' . $dark_logo;
                }
  
                if ($request->hasFile('fab_icon')) {
                    $fav_icon = 'favicon1' . '.' . $request->file('fab_icon')->extension();
                    $request->fab_icon->move(public_path('images/setting'), $fav_icon);
                    $fav_icon = 'images/setting/' . $fav_icon;

                }
            }

            $appinfo->title = $request->app_title;
            $appinfo->description = $request->app_description;
            $appinfo->version = $request->app_version;

            $appinfo->purchase_tnc = $request->purchase_tnc;
            $appinfo->sale_tnc = $request->sale_tnc;
            $appinfo->footer_left = $request->footer_left;
            $appinfo->email_sign_name = $request->email_name;
            $appinfo->cc = $request->cc;
            $appinfo->bcc = $request->bcc;
            $appinfo->email = $request->email;
            $appinfo->email2 = $request->email2;
            $appinfo->live_url = $request->live_url;
            if($dark_logo!=null){
                $appinfo->dark_logo = $dark_logo;
            }
            if($fav_icon!=null){
                $appinfo->fav_icon = $fav_icon;
            }
            if($fullPath!=null){
                $appinfo->logo = $fullPath;
            }
            $appinfo->save();

            if ($appinfo) {
                Session::flash('message', "Settings data are updated successfully.");
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', "Something is wrong to update settings data.");
                Session::flash('alert-class', 'alert-danger');
            }

            return redirect()->back();

        }

    }

    public function view()
    {
        $cms_page = CmsPage::all();
        return view('admin.v1.setting.company_info',compact('cms_page'));
    
    }

    public function add()
    {
       $page =  $this->page;
        return view ('admin.v1.setting.add_cms',compact('page'));
    }

    public function final_add(Request $request)
    {
        $cms_page = new CmsPage;
        
        $cms_page->name=$request->title;
        $cms_page->description=$request->description;

        $cms_page->save();
        return redirect()->route('admin.cms-page');
    }

    public function delete($id)
    {
        $page = CmsPage::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.cms-page')->with('success', 'Page deleted successfully.');
    }

    public function load(Request $request)
    {
        if ($request->id == null) {
            $c_info = new CompanyInfo();
         
        } else {
            $c_info = CompanyInfo::find($request->id);
        }

        $validator = Validator::make($request->all(), [
            'c_logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            // 'gst' => 'required|numeric|digits:15',
        ]);

        $fullPath = null;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if ($validator->passes()) {
                if ($request->hasFile('c_logo')) {
                    $imageName = time() . '.' . $request->file('c_logo')->extension();
                    $request->c_logo->move(public_path('images/company'), $imageName);
                    $fullPath = 'images/company/' . $imageName;
                }
            }

            $c_info->company_name = $request->c_name;
            $c_info->address = $request->c_address;
            $c_info->city = $request->city;
            $c_info->state = $request->state;
            $c_info->country_name = $request->country_name;
            $c_info->phone = $request->phone;
            $c_info->email = $request->email;
            $c_info->gst_number = $request->gst;
            $c_info->company_header = $request->header;
           
            if($fullPath!=null){
                $c_info->company_logo = $fullPath;
            }
            $c_info->save();

            if ($c_info) {
                Session::flash('message', "Company data are updated successfully.");
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', "Something is wrong to update settings data.");
                Session::flash('alert-class', 'alert-danger');
            }

            return redirect()->back();
        }
    }


    public function show()
    {
        $finance = Finance::first();
        return view('admin.v1.setting.finance',compact('finance'));
    }

    public function store_data(Request $request)
    {
        if ($request->id == null) {
            $finance = new Finance();
         
        } else {
            $finance = Finance::find($request->id);
        }

        $validator = Validator::make($request->all(), [
            'currency' => 'required',
            'bank_account' => 'required',
            'terms_condition' => 'required',
        ]);

        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $finance->curreency = $request->currency;
            $finance->bank_accounts = $request->bank_account;
            $finance->terms_condition = $request->terms_condition;

            $finance->save();
            
            if ($finance) {
                Session::flash('message', "Company data are updated successfully.");
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', "Something is wrong to update settings data.");
                Session::flash('alert-class', 'alert-danger');
            }

            return redirect()->back();
        }

    }


    public function view_data()
    {
        $api_setting = ApiKey::first();
        return view('admin.v1.setting.api_key',compact('api_setting'));
    
    }

    public function post_data(Request $request)
    {
        if ($request->id == null) {
            $api_setting = new ApiKey();
         
        } else {
            $api_setting = ApiKey::find($request->id);
        }

        $api_setting->api_key = $request->s_key;
        $api_setting->google_key = $request->google_key;

        $api_setting->save();

        if ($api_setting) {
            Session::flash('message', "Company data are updated successfully.");
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', "Something is wrong to update settings data.");
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->back();
    }



    public function show_data()
    {
        //$setting = Setting::get();
        return view('admin.v1.setting.miscellaneus',compact('setting'));
    
    }


    // public function view()
    // {
    //     $setting = Setting::get();
    //     return view('admin.v1.setting.company_info',compact('setting'));
    
    // }

    // public function show()
    // {
    //     $setting = Setting::get();
    //     return view('admin.v1.setting.finance',compact('setting'));
    
    // }

    // public function show_data()
    // {
    //     $setting = Setting::get();
    //     return view('admin.v1.setting.app_key',compact('setting'));
    
    // }

    // public function view_data()
    // {
    //     $setting = Setting::get();
    //     return view('admin.v1.setting.miscellaneous',compact('setting'));
    
    // }
}
