<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Alert;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function daftar(Request $req)
    {
    	$data = User::where('fullname','like',"%{$req->keyword}%")
        ->orderBy('updated_at','desc')
        ->get();
    	return view('admin.pages.user.daftar', ['data'=>$data]);
    }

    //  public function add()
    // {
        
    // 	return view('admin.pages.user.add');
    // }

     public function save(Request $req)
    {
    	\Validator::make($req->all(), [
    		'fullname'=>'required|between:3,100',
    		'email'=>'required|email|unique:users,email',
            'username'=>'required|between:4,50|unique:users,username|alpha_dash',
    		'password'=>'nullable|min:6',
    		'repassword'=>'same:password',
    		'level'=>'required',
    	])->validate();

    	$result = new User;
    	$result->fullname = $req->fullname;
        $result->username = $req->username;
    	$result->email = $req->email;
    	$result->password = bcrypt($req->password);
    	$result->level = $req->level;

    	if ($result->save()) {
    		alert()->success('Data Berhasil Tersimpan ke Database.', 'Tersimpan!')->autoclose(4000);
            return redirect()->route('admin.user');
    	} else {
    		alert()->info('Harap Periksa lagi data Formulir anda.','Tidak Tersimpan!')->autoclose(4000);
    	}
    	
    }

    public function edit($id)
    {
    	$data = User::where('id',$id)->first();
    	return view('admin.pages.user.edit', ['rc'=>$data]);
    }

    public function update(Request $req) {
    	\Validator::make($req->all(), [
    		'fullname'=>'required|between:3,100',
            'username'=>'required|between:4,50|unique:users,username,'.$req->id.',|alpha_dash',
    		'email'=>'required|email|unique:users,email,'.$req->id,
    		'password'=>'nullable|min:6',
    		'repassword'=>'same:password',
            'level'=>'required',
    	])->validate();

    	if(!empty($req->password)) {
    		$field = [
    			'fullname'=>$req->fullname,
                'username'=>$req->username,
    			'email'=>$req->email,
    			'level'=>$req->level,
    			'password'=>bcrypt($req->password),
    		];
    	} else {
    		$field = [
    			'fullname'=>$req->fullname,
                'username'=>$req->username,
    			'email'=>$req->email,
                'level'=>$req->level,
    		];
    	}

    	$result = User::where('id',$req->id)->update($field);

    	if ($result) {
    		alert()->success('Berhasil Mengupdate Data.', 'Terupdate!')->autoclose(4000);
            return redirect()->route('admin.user');
    	} else {
    		alert()->info('Harap Periksa lagi data Formulir anda.','Tidak Tersimpan!')->autoclose(4000);
    	}
    	
    }

    public function delete(Request $req)
    {
    	$result = User::find($req->id);

    	if ($result->delete() ){
    		alert()->success('Data Berhasil Terhapus dari Database.', 'Terhapus!')->autoclose(3000);
            return redirect()->route('admin.user');
    	}
    	
    }

    public function exportExcel() 
    {
        return Excel::download(new UsersExport, 'DataUsers.xlsx');
    }

}
