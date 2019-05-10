<?php

namespace DevChallenge\Http\Controllers;

use Illuminate\Http\Request;
use DevChallenge\Http\Requests\SellerRequest;
use DevChallenge\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DevChallenge\User;

class SellerController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->sendResponse($users->toArray(), '');
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
    public function store(SellerRequest $request)
    {
        $seller = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->sendResponse($seller->toArray(), 'Vendedor adicionado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = User::find($id);

        if(!$seller) {
            return $this->sendError('Vendedor não encontrado');
        }

        return $this->sendResponse($seller->toArray(), '');
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
    public function update(SellerRequest $request, $id)
    {
        $seller = User::find($id);

        if(!$seller) {
            return $this->sendError('Vendedor não encontrado');
        }

        $seller->name = $request->name;
        $seller->email = $request->email;
        if($request->password){
            $seller->password = Hash::make($request->password);
        }
        $seller->save();

        return $this->sendResponse($seller->toArray(), 'Vendedor atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = User::find($id);

        if(!$seller) {
            return $this->sendError('Vendedor não encontrado');
        }
        $seller->delete();

        return $this->sendResponse('', 'Vendedor deletado com sucesso');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
