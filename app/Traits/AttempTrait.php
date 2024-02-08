<?php


namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait AttemptTrait
{
    public function checkData($email, $password, $table)
    {
        $user = DB::table($table)
            ->where('email', $email)
            ->first();
        if (!$user) {
            return false; // User not found
        }

        return Hash::check($password, $user->password);
    }
}
