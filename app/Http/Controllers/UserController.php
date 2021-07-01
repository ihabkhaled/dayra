<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all users here
        $user = User::all();
        foreach ($user as $row) {
            echo $row . "<br>";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $created_at = Carbon::now();

        if (!isset($request->email) || !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return array('status' => 'error', 'msg' => 'Invalid Email');
        }

        if (!isset($request->full_name)) {
            return array('status' => 'error', 'msg' => 'Invalid Name');
        }

        if (!isset($request->mobile) || !is_numeric($request->mobile)) {
            return array('status' => 'error', 'msg' => 'Invalid Mobile');
        }

        $email = $request->email;
        $full_name = $request->full_name;
        $mobile = $request->mobile;

        //handle email duplication error
        $user = User::where('email', $email)->limit(1)->get();
        if (sizeof($user) == 1) {
            return array('status' => 'error', 'msg' => 'Email already exists');
        }

        //handle mobile duplication error
        $user = User::where('mobile', $mobile)->limit(1)->get();
        if (sizeof($user) == 1) {
            return array('status' => 'error', 'msg' => 'Mobile number already exists');
        }

        $userModel = new User;
        try {
            //Save the user
            $userModel->full_name = $full_name;
            $userModel->email = $email;
            $userModel->mobile = $mobile;
            $userModel->created_at = $created_at;
            $userModel->save();
            return array('status' => 'success', 'msg' => 'User saved');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
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
