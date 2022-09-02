<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;


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
    
    public function index()
    {
        dd("Cheguei");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        //dd($request->all());

        $user = $this->user->create([
            'name' => $request->name,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'email' => $request->email,
            'password' => $request->password,

        ]);

        $address = $this->useraddress->create([
            'user_id' => $user->id,
            'address' => $request->address,
            'number' => $request->number,
            'city' => $request->city
        ]);

        
        return response()->json(['data' => [
            'user' => $user,
            'useraddress' => $address
        ]]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
