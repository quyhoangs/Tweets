<?php

namespace App\Http\Controllers;

use Hash;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{   
    public function show(User $user)
    {   
        
        return view('profiles.show',[
            'user'=>$user,
            'tweets'=>$user->tweets()->withLikes()->paginate(3) 
        ]);
    }
    public function edit(User $user)
    {   
        return view('profiles.edit',compact('user'));
    }

    public function update(User $user)
    {   
        $attributes = request()->validate([
            'username' => [
                'string',
                'required',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($user),   // Đảm bảo username là duy nhất so sánh trong bảng user
            ],
            'name' => ['string', 'required', 'max:255'],
            'avatar' => ['file'],
            'email' => [
                'string',
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user),  // Đảm bảo email là duy nhất so sánh trong bảng user
            ],
            'password' => [
                'string',
                'required',
                'min:6',
                'max:255',
                'confirmed',
            ],
        ]);
        //Nếu thay đổi avatar khi edit profile thì sẻ vào đây
        if(request('avatar')){
            $attributes['avatar'] = request('avatar')->store('avatars');
        }
       $attributes['password'] = Hash::make(request('password'));
        $user->update($attributes);
        // ddd($user->avatar);
        return redirect($user->path());
    }
}
