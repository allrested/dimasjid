<?php

namespace App\Http\Controllers\Admin\Content;

use Hash;
use App\Models\Masjid;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 1 ){
            $users = User::all();
        }else{
            $users = User::where('is_superuser',auth()->user()->is_superuser)->get();
        }
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role == 1 ){
            $roles = Role::all();
            $masjid = Masjid::all();
        }else{
            $roles = Role::where('id','>',1)->get();
            $masjid = Masjid::where('id',auth()->user()->is_superuser)->get();
        }
        return view('admin.users.form',compact('roles','masjid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $validate = Validator::make($input, [
            'password' => 'min:8|required_with:konfirmasi|same:konfirmasi',
            'konfirmasi' => 'min:8'
        ]);
        
        if($validate->fails()){

            return back()->withErrors($validate->errors())->withInput($input);
        }

        $input['password'] = Hash::make($request->password);
        $query = User::create($input);
        return redirect()->route('users.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $masjid = Masjid::all();
        return view('admin.users.form',compact('user','roles', 'masjid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if($request->role == NULL){
            $input = $request->except('role');

        }
        if($request->password == NULL){
            $input = $request->except('password','konfirmasi');

        }else{
            $input = $request->all();
            $validate = Validator::make($input, [
                'password' => 'min:8|required_with:konfirmasi|same:konfirmasi',
                'konfirmasi' => 'min:8'
            ]);
            
            if($validate->fails()){
                return back()->withErrors($validate->errors())->withInput($input);
            }
        }

        $user->update($input);
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
