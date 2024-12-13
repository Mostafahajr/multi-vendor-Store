<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;

class ProfileController extends Controller
{
    //
    public function edit() {

        $user = Auth::user();
        $countries = Countries::getNames();
        // dd($countries);
        $locales = Locales::getNames();
        return view('admin.profile.edit',compact('user','countries','locales'));
    }

    public function update(Request $request){
        $user = Auth::user();

        if ($user->profile) {
            # code...
            $user->profile->fill($request->all())->save();
        }else{
            $request->merge([
                'user_id' => $user->id
            ]);

            Profile::create($request->all());
        }




        return redirect()->back()->with('msg','profile edit successfully');
    }
}
