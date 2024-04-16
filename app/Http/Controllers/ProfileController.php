<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\District;
use App\Models\Store;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public $page = 'Profile';
    public function profile_view(Request $request)
    {
        $page = $this->page;
        $data = User::where('id', auth()->user()->id)->first();
        return view('admin.v1.profile.profile',compact('data','page'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // public function profile_edit($id)
    // {
    //     $edit = User::where('id',$id)->first();
    //     return view('admin.v1.profile.profileedit',compact('edit'));
    // }

    public function profile_update(Request $request,$id)
    {
            User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone'=> $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'password' => bcrypt($request->password),
          
        ]);
        return redirect()->route('profile.view')->with('update','update successfull');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function self_profile(Request $request)
    {
        $id = auth()->user()->id;
        $publisher = Publisher::where('id', User::find($id)->publisher_id)->first();
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();
        $user = User::where('id',$id)->first();
        return view('admin.v1.profile.self_store_view', compact('publisher','districts','user'));
    }
    public function self_pub_update(Request $request , $id)
    {
        $fullPath = null;
        if ($request->hasFile('logo')) {
            $imageName = 'logo-pub' . '.' . $request->file('logo')->extension();
            $request->logo->move(public_path('upload/publisher'), $imageName);
            $fullPath = 'upload/publisher/' . $imageName;
        }

        $pub_user = Publisher::where('id',$id)->first();
       
        $pub_user->store_name = $request->name;
           $pub_user->state_id = $request->state_id;
           $pub_user->district_id = $request->district;
           $pub_user->address = $request->address;

            if($fullPath!=null){
                $pub_user->logo_image = $fullPath;
            }
            $pub_user->save();

        return redirect()->route('publisher.self.view')->with('update','update successfull');
    }

    public function rs_profile(Request $request)
    {
        $id = auth()->user()->id;
        $store = Store::where('id', User::find($id)->store_id)->first();
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();
        $user = User::where('id',$id)->first();
        return view('admin.v1.profile.rs_store_view', compact('store','districts','user'));
    }

    public function rs_profile_update(Request $request , $id)
    {
        $fullPath = null;
        if ($request->hasFile('logo')) {
            $imageName = 'logo-pub' . '.' . $request->file('logo')->extension();
            $request->logo->move(public_path('upload/store'), $imageName);
            $fullPath = 'upload/store/' . $imageName;
        }

        $rs_user = Store::where('id',$id)->first();
       
           $rs_user->store_name = $request->name;
           $rs_user->state_id = $request->state_id;
           $rs_user->district_id = $request->district;
           $rs_user->address = $request->address;

            if($fullPath!=null){
                $rs_user->logo_image = $fullPath;
            }
            $rs_user->save();
        return redirect()->route('retail.self.view')->with('update','update successfull');
    }


    public function cs_profile(Request $request)
    {
        $id = auth()->user()->id;
        $cs_store = Store::where('id', User::find($id)->store_id)->first();
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();
        $user = User::where('id',$id)->first();
        return view('admin.v1.profile.cs_store_view', compact('cs_store','districts','user'));
    }

    public function cs_profile_update(Request $request , $id)
    {
        $fullPath = null;
        if ($request->hasFile('logo')) {
            $imageName = 'logo-pub' . '.' . $request->file('logo')->extension();
            $request->logo->move(public_path('upload/store'), $imageName);
            $fullPath = 'upload/store/' . $imageName;
        }

        $cs_user = Store::where('id',$id)->first();
       
           $cs_user->store_name = $request->name;
           $cs_user->state_id = $request->state_id;
           $cs_user->district_id = $request->district;
           $cs_user->address = $request->address;

            if($fullPath!=null){
                $cs_user->logo_image = $fullPath;
            }
            $cs_user->save();
        return redirect()->route('central.self.view')->with('update','update successfull');
    }
    
}
