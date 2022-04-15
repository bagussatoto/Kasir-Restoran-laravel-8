<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserSettingController extends Controller
{
    public function form()
    {
    	$data = User::where('id', Auth::id())->first();
    	return view('admin.pages.user.setting',['dt'=>$data]);
    }

    public function update(Request $req) {
    	$id = Auth::id();
    	\Validator::make($req->all(), [
    		'fullname'=>'required|between:3,100',
            'username'=>'required|between:4,50|unique:users,username,'.$id.',|alpha_dash',
    		'email'=>'required|email|unique:users,email,'.$id,
    		'password'=>'nullable|min:6',
    		'repassword'=>'same:password',
    	])->validate();

    	if(!empty($req->password)) {
    		$field = [
    			'fullname'=>$req->fullname,
                'username'=>$req->username,
    			'email'=>$req->email,
    			'password'=>bcrypt($req->password),
    		];
    	} else {
    		$field = [
    			'fullname'=>$req->fullname,
                'username'=>$req->username,
    			'email'=>$req->email,    		];
    	}

    	$result = User::where('id', $id)->update($field);

    	if ($result) {
    		return back()->with('result','success');
    	} else {
    		return back()->with('result','fail');
    	}
    	
    }
}
