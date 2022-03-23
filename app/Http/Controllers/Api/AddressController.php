<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Validator;

class AddressController extends Controller
{
    public function addressCreate(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'user_id' => 'required',
        'name' => 'required',
        'phone' => 'required',
        'place' => 'required',
        'address' => 'required',
        'province_id' => 'required',
        'province_name' => 'required',
        'city_id' => 'required',
        'city_name' => 'required',
        'postal_code' => 'required',
      ]);

      if ($validator->fails()) {
        $error = $validator->errors()->all();
        return $this->error($error[0]);
      }

      $address = Address::create($request->all());
      
      if ($address) {
          return response()->json([
              'status' => TRUE,
              'message' => 'Berhasil menambahkan alamat'
          ]);
      } else {
          return response()->json([
            'status' => FALSE,
            'message' => 'Gagal menambahkan alamat!'
          ]);
      }
    }

    public function addressUpdate(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'phone' => 'required',
        'place' => 'required',
        'address' => 'required',
        'province_id' => 'required',
        'province_name' => 'required',
        'city_id' => 'required',
        'city_name' => 'required',
        'postal_code' => 'required',
      ]);
    
      if ($validator->fails()) {
        $error = $validator->errors()->all();
        return response()->json([
          'status' => FALSE,
          'message' => $error[0]
        ]);
      }
    
      $address = Address::where('id', $id)->update([
          'name' => $request->name,
          'phone' => $request->phone,
          'place' => $request->place,
          'address' => $request->address,
          'province_id' => $request->province_id,
          'province_name' => $request->province_name,
          'city_id' => $request->city_id,
          'city_name' => $request->city_name,
          'postal_code' => $request->postal_code
      ]);
      
      if ($account) {
          return response()->json([
              'status' => TRUE,
              'message' => 'Berhasil mengubah alamat'
          ]);
      } else {
          return response()->json([
            'status' => FALSE,
            'message' => 'Gagal mengubah alamat!'
          ]);
      }
    }

    public function addressDelete($id)
    {
      $address = Address::where('id', $id)->delete();

      if ($address) {
          return response()->json([
              'status' => TRUE,
              'message' => 'Berhasil menghapus alamat',
          ]);
      } else {
          return response()->json([
              'status' => FALSE,
              'message' => 'Gagal menghapus alamat!'
          ]);
      }
    }

    public function addressList($id)
    {
      $addresses = Address::where('user_id', $id)->get();

      if ($addresses->isEmpty()) {
        return response()->json([
            'status' => FALSE,
            'message' => 'Belum ada alamat yang ditambahkan',
            'addresses' => $addresses
        ]);
      } else {
        return response()->json([
          'status' => TRUE,
          'message' => 'Berhasil menampilkan tawaran',
          'addresses' => $addresses
        ]);
      }
    }

    public function addressNonActived($id)
    {
      $address = Address::where('user_id', $id)
        ->update(['status' => false]);

      if ($address) {
        return response()->json([
          'status' => TRUE,
          'message' => 'Berhasil menonaktifkan alamat'
        ]);
      } else {
        return response()->json([
          'status' => FALSE,
          'message' => 'Gagal menonaktifkan alamat!'
        ]);
      }
    }

    public function addressActived($id)
    {
      $address = Address::where('id', $id)
        ->update(['status' => true]);

      if ($address) {
        return response()->json([
          'status' => TRUE,
          'message' => 'Berhasil mengaktifkan alamat'
        ]);
      } else {
        return response()->json([
          'status' => FALSE,
          'message' => 'Gagal mengaktifkan alamat!'
        ]);
      }
    }

    public function addressChecked($id)
    {
      $address = Address::where([
        ['user_id', $id],
        ['status', true]
      ])->first();

      if ($address) {
        return response()->json([
            'status' => TRUE,
            'message' => 'Berhasil menampikan alamat',
            'address' => $address
        ]);
      } else {
        return response()->json([
          'status' => FALSE,
          'message' => '* Belum ada alamat yang ditambahkan',
          'address' => $address
        ]);
      }
  }
}
