<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Validator;

class AccountController extends Controller
{
    public function accountCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'bank_id' => 'required',
            'bank_name' => 'required',
            'name' => 'required',
            'number' => 'required',
          ]);
    
          if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
          }
    
          $account = Account::create($request->all());
          
          if ($account) {
              return response()->json([
                  'status' => TRUE,
                  'message' => 'Berhasil menambahkan rekening'
              ]);
          } else {
              return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menambahkan rekening!'
              ]);
          }
    }

    public function accountUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'bank_id' => 'required',
            'bank_name' => 'required',
            'name' => 'required',
            'number' => 'required',
          ]);
    
          if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
          }
    
          $account = Account::where('id', $id)->update([
              'user_id' => $request->user_id,
              'bank_id' => $request->bank_id,
              'bank_name' => $request->bank_name,
              'name' => $request->name,
              'number' => $request->number
          ]);
          
          if ($account) {
              return response()->json([
                  'status' => TRUE,
                  'message' => 'Berhasil mengubah rekening'
              ]);
          } else {
              return response()->json([
                'status' => FALSE,
                'message' => 'Gagal mengubah rekening!'
              ]);
          }
    }

    public function accountDelete($id)
    {
      $account = Account::where('id', $id)->delete();

      if ($account) {
          return response()->json([
              'status' => TRUE,
              'message' => 'Berhasil menghapus rekening',
          ]);
      } else {
          return response()->json([
              'status' => FALSE,
              'message' => 'Gagal menghapus rekening!'
          ]);
      }
    }

    public function accountList($id)
    {
      $accounts = Account::where('user_id', $id)->with('bank')->get();

      if ($accounts->isEmpty()) {
        return response()->json([
            'status' => FALSE,
            'message' => 'Belum ada rekening yang ditambahkan',
            'accounts' => $accounts
        ]);
      } else {
        return response()->json([
          'status' => TRUE,
          'message' => 'Berhasil menampilkan tawaran',
          'accounts' => $accounts
        ]);
      }
    }

    public function accountDetail($id)
    {
        $account = account::where('id', $id)->first();
        
        if($account) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan detail rekening',
                'account' => $account
            ]);
        } else {
          return response()->json([
            'status' => FALSE,
            'message' => 'Gagal menampilkan detail rekening!',
            'account' => $account
        ]);
        }
    }
}
