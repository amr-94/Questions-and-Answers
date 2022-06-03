<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
   public function index(){
       $user = User::all();
        return view('allusers', [
            'user' => $user,
        ]);

              }

    public function edit(){
        return view('user-edit-profile',[
            'user'=>Auth::user(),
            'citys' => countries::getNames('ar')
        ]);
    }
    public function update(Request $request){
        $user =Auth::user();
        $request->validate([
            'name' => ['required','string',
                                        "unique:users,name,$user->id"

             ],
             'city'=>['required','string'],
             'last_name'=>['required','string'],
            'email' => ['required', 'email',
                Rule::unique('users','email')->ignore($user->id),
                       ],
              'profile_photo' => ['nullable', 'mimes:png,jpg',

                   ],


        ]);
        $prev =$user->profile_photo_path;
        if($request->hasFile('profile_photo')){

            $fileName = time() . '.' . $request->profile_photo->extension();

            $request->profile_photo->move(public_path('images/profile_photo'), $fileName);
           $request->merge([
               'profile_photo_path' => $fileName,

           ]);
         }


             $user->update($request->all());

        if ($prev && $prev != $user->profile_photo_path) {

            unlink('images/profile_photo' . '/' . $prev);
        }
        return redirect (route('show.user',$user->id))->with('success','Profile Updated');

    }


    public function show($id){
        $quser= User::with('questions')->findorfail($id);

        return view('quser',[
                'quser' => $quser,
        ]);
    }


    public function makeadmin(Request $request, $id){


                 $user = User::findorfail($id);
                      $user->update([
                            'type' => $request->type,
                        ]);

             return redirect(route('all.user'))->with('success',"$user->name, Updated To $user->type");




    }

      public function destroy($id){

       User::findorfail($id);

      return redirect(route('all.user'))->with('success', 'user deleted');

    }
}
