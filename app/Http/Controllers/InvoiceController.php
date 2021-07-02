<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\InvoiceCreated;
use App\Mail\UserCreated;
use Mail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!isset($request->amount) || !is_numeric($request->amount)) {
            return array('status' => 'error', 'msg' => 'Invalid Amount');
        }

        if (!isset($request->invoice_date)) {
            return array('status' => 'error', 'msg' => 'Invalid Invoice date');
        }

        if (!isset($request->email) || !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return array('status' => 'error', 'msg' => 'Invalid Email');
        }

        $amount = $request->amount;
        $invoice_date = $request->invoice_date;
        $email = $request->email;
        $created_at = Carbon::now();

        $user = User::where('email', $email)->limit(1)->get();
        $invoice = new Invoice;

        //If user already exists, then save invoice and retrieve user's ID
        if (sizeof($user) == 1) {
            $user_id = $user[0]->id;

            try {
                $invoice->user_id = $user_id;
                $invoice->amount = $amount;
                $invoice->invoice_date = $invoice_date;
                $invoice->created_at = $created_at;
                $invoice->save();

                //Send Invoice Email
                Mail::to($email)->send(new InvoiceCreated($invoice, $user[0]));

                return array('status' => 'success', 'msg' => 'Invoice Saved');
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            $userModel = new User;

            try {

                if (!isset($request->full_name)) {
                    return array('status' => 'error', 'msg' => 'Invalid Name');
                }

                if (!isset($request->mobile) || !is_numeric($request->mobile)) {
                    return array('status' => 'error', 'msg' => 'Invalid Mobile');
                }

                $full_name = $request->full_name;
                $mobile = $request->mobile;

                //handle mobile duplication error
                $user = User::where('mobile', $mobile)->limit(1)->get();
                if (sizeof($user) == 1) {
                    return array('status' => 'error', 'msg' => 'Mobile number already exists and related to another user');
                }

                //Save the user
                $userModel->full_name = $full_name;
                $userModel->email = $email;
                $userModel->mobile = $mobile;
                $userModel->created_at = Carbon::now();
                $userModel->save();

                //Send Registeration Email
                Mail::to($userModel->email)->send(new UserCreated($userModel));

                //get the inserted id of the user
                $user_id = $userModel->id;

                //Save the invoice
                $invoice->user_id = $user_id;
                $invoice->amount = $amount;
                $invoice->invoice_date = $invoice_date;
                $invoice->created_at = $created_at;
                $invoice->save();

                //Send Invoice Email
                Mail::to($userModel->email)->send(new InvoiceCreated($invoice, $userModel));
                return array('status' => 'success', 'msg' => 'User and Invoice are saved');
            } catch (\Exception $e) {
                return $e->getMessage();
            }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
