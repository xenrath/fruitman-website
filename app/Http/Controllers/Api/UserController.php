<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'level' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $email = $request->email;
        $password = $request->password;
        $level = $request->level;

        $user = User::where([
            ['email', $email],
            ['level', $level]
        ])->first();
        if ($user) {
            $user->update([
                'fcm' => $request->fcm
            ]);
            
            if (password_verify($password, $user->password)) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Selamat Datang '.$user->name,
                    'user' => $user
                ]);
            }else{
                return $this->error('Email dan password tidak sesuai!');
            }
        }else{
            return $this->error('Pengguna tidak ditemukan!');
        }
    }

    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|unique:users',
            'level' => 'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }
        $user = User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));
        if ($user) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Pendaftaran berhasil',
                'user' => $user
            ]);
        }
        return $this->error('Pendaftaran gagal');
    }

    public function userUpdateProfile(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id.',id',
            'phone' => 'required|unique:users,phone,'.$user->id.',id',
            'image' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }
        if ($request->image) {
            Storage::disk('local')->delete('public/uploads/'.$user->image);
            $image = str_replace(' ', '', $request->image->getClientOriginalName());
            $imageName = 'users/'.date('mYdHs').rand(1, 10).'_'.$image;
            $request->image->storeAs('public/uploads/', $imageName);
        }else{
            $imageName = '';
        }
        $user = User::where('id', $user->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $imageName
        ]);
        if ($user) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Profile berhasil diperbarui',
            ]);
        }
        return $this->error('Profile gagal diperbarui');
    }

    public function userUpdatePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }
        $user = User::where('id', $id)
        ->update([
            'password' => bcrypt($request->password)
        ]);
        if ($user) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Password berhasil diperbarui',
            ]);
        }
        return $this->error('Password gagal diperbarui');
    }

    public function userImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }
        $user = User::where('id', $id);
        if ($user) {
            $get = $user->first();
            if ($get->image != null) {
                Storage::disk('local')->delete('public/uploads/'.$get->image);
                $image = str_replace(' ', '', $request->image->getClientOriginalName());
                $imageName = 'users/'.date('mYdHs').rand(1, 10).'_'.$image;
                $request->image->storeAs('public/uploads/', $imageName);
            }else{
                $image = str_replace(' ', '', $request->image->getClientOriginalName());
                $imageName = 'users/'.date('mYdHs').rand(1, 10).'_'.$image;
                $request->image->storeAs('public/uploads/', $imageName);
            }
            $update = $user->update([
                'image' => $imageName
            ]);
            if ($update) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Berhasil memperbarui foto profile',
                ]);   
            } else {
                return $this->error('Gagal memperbarui foto profile');
            }
        }
        return $this->error('Gagal menemukan user');
    }

    public function userDetail($id)
    {
        $user = User::where('id', $id)->first();
        if($user) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan detail pengguna',
                'user' => $user
            ]);
        } else {
            return $this->error('Gagal menampilkan detail pengguna');
        }
    }

    public function error($message){
        return response()->json([
            'status' => FALSE,
            'message' => $message,
        ]);
    }
}
