<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

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
            for ($i = 0; $i < 100; $i++) {
                $created_at = Carbon::now();
                $userModel = new User;
                $userModel->full_name = Str::random(10);
                $userModel->email = Str::random(10) . '@gmail.com';
                $userModel->mobile = '01' . rand(000000001, 999999999);
                $userModel->created_at = $created_at;
                $userModel->save();
                $user_id = $userModel->id;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
