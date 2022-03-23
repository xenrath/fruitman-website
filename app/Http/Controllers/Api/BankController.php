<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    public function bankList()
    {
        $banks = Bank::get();

        if ($banks->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Belum ada rekening yang ditambahkan',
                'banks' => $banks
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan tawaran',
                'banks' => $banks
            ]);
        }
    }
}