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
        // $user=auth()->user();
        // ddd($user->name);
        return view('profiles.show',compact('user'));
    }
    public function edit(User $user)
    {   
       // $user=auth()->user();
        return view('profiles.edit',compact('user'));
    }

    public function update(User $user)
    {   
       // $user=auth()->user(); //Đang có vấn đề với $user trên Model không truyền được id vào đây nên cần khai báo tạm như này
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
