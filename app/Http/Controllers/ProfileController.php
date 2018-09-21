<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class ProfileController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id) {
        
        $user = User::find($id);
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request) {

        $this->validate($request, [
            'email' => 'required|string|email',
            'newPass' => 'nullable|min:6',
            'firstName' => 'required|string|max:30',
            'lastName' => 'required|string|max:30',
            'age' => 'required|numeric|max:100|min:12',
            'country' => 'required|string',
            'degree' => 'string|nullable',
            'job' => 'string|nullable',
            'profile_pic' => 'image|max:1999',
        ]);

        $user = User::find($request->id);

        //Handle File Upload
        if($request->hasFile('profile_pic')) { // if the user chose to upload a picture
            //get file name with extension
            $fileNameWithExt = $request->file('profile_pic')->getClientOriginalName();
            //get file name only
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get extension only
            $extension = $request->file('profile_pic')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //upload image
            $path = $request->file('profile_pic')->storeAs('public/profile_pics', $fileNameToStore);
        } else {
            if($user->image == NULL)
                $fileNameToStore = 'no-image.png';
            else
                $fileNameToStore = $user->image;
        }

        
        $user->firstName    = $request->firstName;
        $user->lastName     = $request->lastName;
        $user->email        = $request->email;
        $user->age          = $request->age;
        $user->gender       = $request->gender;
        $user->country      = $request->country;
        $user->job          = $request->job;
        $user->degree       = $request->degree;
        $user->image        = $fileNameToStore;

        if($request->newPass == $request->confPass && $request->newPass != NULL) {
            $user->password = Hash::make($request->newPass);
        }
        elseif ($request->newPass != $request->confPass && $request->newPass != NULL) {
            return redirect()->back()->with('password_error', 'The Two Passwords Don\'t Match');
        }

        $user->save();

        return redirect()->back()->with('msg_success', 'User Information Updated Succssfully'); 
    }
}
