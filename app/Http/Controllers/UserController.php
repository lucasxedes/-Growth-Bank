<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUpdateUser;

class UserController extends Controller
{
    protected $user;
    protected $useraddress;
   

    public function __construct(User $user, UserAddress $useraddress)
    {
        $this->user = $user;
        $this->useraddress = $useraddress;
    }
    

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
            'password' => bcrypt($request->password),
            
        ]);

        $address = $this->useraddress->create([
            'user_address' => $user->id,
            'address' => $request->address,
            'number' => $request->number,
            'city' => $request->city
        ]);
        
        return response()->json(['data' => [
            'user' => $user,
            'useraddress' => $address
        ]]);
    }


    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }

}
