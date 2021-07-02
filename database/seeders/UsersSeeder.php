<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            for ($i = 0; $i < 50; $i++) {
                $userModel = new User;
                $created_at = Carbon::now()->subMinutes(rand(100, 200));
                $userModel->full_name = Str::random(10);
                $userModel->email = Str::random(10) . '@gmail.com';
                $userModel->mobile = '01' . rand(000000001, 999999999);
                $userModel->created_at = $created_at;
                $userModel->save();
                $user_id = $userModel->id;

                for ($j = 0; $j < 15; $j++) {
                    $invoice = new Invoice;
                    $created_at = Carbon::now()->subMinutes(rand(1, 900));
                    $invoice_date = $created_at->subMinutes(rand(10, 25));
                    $invoice->user_id = $user_id;
                    $invoice->amount = rand(10, 500);
                    $invoice->invoice_date = $invoice_date;
                    $invoice->created_at = $created_at;
                    $invoice->save();
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
