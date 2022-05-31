<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.member.register');
    }

    public function showLogin()
    {
        return view('frontend.member.login');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(Auth::check()==true){
            $id = auth::user()->id;
            $data = user::find($id);
            return view('frontend.member.profile',compact('data'));
        } else {
            return redirect('/member-login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $data = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }

        if($data['password']){
            $data['password'] = bcrypt($data['password']);
        }
        else {
            $data['password'] = $user->password;
        }
        
        if($user->update($data)){
            if(!empty($file)){
                $file->move('upload',$file->getClientOriginalName());
            }
            return redirect()->back()->with('success',__('Update profile success'));
        }
        else {
            return redirect()->back()->withErrors('Update profile errors');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 0;
        $user->save();
        return redirect()->route('frontend.member.login');
    }

    public function login(MemberLoginRequest $request)
    {
        $login = [
            'email' =>$request->email,
            'password' =>$request->password,
            'level' => 0
        ];

        $remember = false;

        if($request->remember_me){
            $remember = true;
        }
        if(Auth::attempt($login, $remember)){
            return redirect('/');
        } else {
            return redirect()->back()->withErrors('Email or Password is not correct.');
        }   
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/member-login');
    }
}
