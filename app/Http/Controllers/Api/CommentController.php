<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function commentCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'comment' => 'required'
          ]);
    
          if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
          }
    
          $comment = Comment::create($request->all());
          
          if ($comment) {
              return response()->json([
                  'status' => TRUE,
                  'message' => 'Berhasil mengirim komentar'
              ]);
          } else {
              return response()->json([
                'status' => FALSE,
                'message' => 'Berhasil mengirim komentar!'
              ]);
          }
    }

    public function commentList($id)
    {
        $comments = Comment::whereHas('transaction', function ($query) use ($id) {
            $query->where('product_id', $id);
        })->with(['transaction.user'])->get();

      if ($comments->isEmpty()) {
        return response()->json([
            'status' => FALSE,
            'message' => 'Belum ada komentar mengenai produk ini',
            'comments' => $comments
        ]);
      } else {
        return response()->json([
          'status' => TRUE,
          'message' => 'Berhasil menampilkan komentar',
          'comments' => $comments
        ]);
      }
    }

    public function commentCheck($id)
    {
      $comment = Comment::where('transaction_id', $id)->first();

      if ($comment) {
        return response()->json([
            'status' => TRUE,
            'message' => 'Berhasil mengecek komentar',
            'comment' => $comment
        ]);
      } else {
        return response()->json([
          'status' => FALSE,
          'message' => 'Gagal mengecek komentar!',
          'comment' => $comment
        ]);
      }
    }
}