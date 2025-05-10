<?php

namespace App\Services;

use App\Models\User;


class DeleteAccountService
{

    public function deleteAccount()
    {
        $delete_account = auth()->user();
        $delete_account->delete();
        return response()->json(['message' => 'Account deleted successfully','status'=>true], 200);
    }
}
