<?php

namespace App\Http\Controllers\Backend;

use App\Resource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $profile = User::find(1);
        return view('dashboard.profile.edit', [
            'profile' => $profile,
            'title' => 'Редактируем: ' . $profile->name ? $profile->name : $profile->email
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::find(1);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->pass)) {
            $user->password = bcrypt($request->pass);
        }
        $user->save();

        $data = ['msg' => 'Пользователь успешно сохранен'];
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
    }
}
