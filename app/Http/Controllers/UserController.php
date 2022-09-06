<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUpdateUser;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;
    protected $useraddress;

    public function __construct(User $user, UserAddress $useraddress)
    {
        $this->user = $user;
        $this->useraddress = $useraddress;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    // public function login(Request $request)
    // {
    //     if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
    //         $sucess = $this->user->createToken('MyApp')->accessToken;
    //         return response()->json(['sucess' => $sucess], 200);
    //     } else {
    //         return response()->json(['error' => 'Unauthorised'], 401);
    //     }
    // }
    
    

    public function register(StoreUpdateUser $request)
    {

        $user = $this->user->create([
            'name' => $request->name,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //$sucess = $user->createToken('MyApp')->accessToken;

        $address = $this->useraddress->create([
            'user_id' => $user->id,
            'address' => $request->address,
            'number' => $request->number,
            'city' => $request->city
        ]);

        
        return response()->json(['data' => [
            'user' => $user,
            'useraddress' => $address,
            //'token' => $sucess
        ]]);
    }


    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }

}
