<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

class TransactionController extends Controller
{
    public function transactionOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'product_id' => 'required',
            'recipient' => 'required',
            'phone' => 'required',
            'place' => 'required',
            'origin' => 'required',
            'total_item' => 'required',
            'price' => 'required',
            'courier' => 'required',
            'service_type' => 'required',
            'estimation' => 'required',
            'cost' => 'required',
            'total_price' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return response()->json([
                'status' => FALSE,
                'message' => $error[0]
            ]);
        }

        $invoice_number = $this->getInvoiceNumber();
        $date = date('Y-m-d');

        $order = Transaction::create(array_merge($request->all(), [
            'invoice_number' => $invoice_number,
            'proof' => '',
            'status' => 'Belum dibayar',
            'date' => $date
        ]));

        if ($order) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil mengorder produk'
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal mengorder produk!'
            ]);
        }
    }

    public function transactionPaid($id)
    {
        $transactions = Transaction::where([
            ['user_id', $id],
            ['status', 'Belum dibayar']
        ])->with(['user', 'product'])->orderBy('id', 'DESC')->get();

        if($transactions->isNotEmpty()) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan transaksi',
                'transactions' => $transactions
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Transaksi dengan status belum dibayar tidak ada',
                'transactions' => $transactions
            ]);
        }
    }

    public function transactionPacked($id)
    {
        $transactions = Transaction::where([
            ['user_id', $id],
            ['status', 'Dikemas']
        ])->with(['user', 'product'])->orderBy('id', 'DESC')->get();

        if($transactions->isNotEmpty()) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan transaksi',
                'transactions' => $transactions
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Transaksi dengan status dikemas tidak ada',
                'transactions' => $transactions
            ]);
        }
    }

    public function transactionSent($id)
    {
        $transactions = Transaction::where([
            ['user_id', $id],
            ['status', 'Dikirim']
        ])->with(['user', 'product'])->orderBy('id', 'DESC')->get();

        if($transactions->isNotEmpty()) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan transaksi',
                'transactions' => $transactions
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Transaksi dengan status dikirim tidak ada',
                'transactions' => $transactions
            ]);
        }
    }

    public function transactionHistory($id)
    {
        $transactions = Transaction::where([
            ['user_id', $id],
            ['status', '!=', 'Belum dibayar'],
            ['status', '!=', 'Dikemas'],
            ['status', '!=', 'Dikirim']
        ])->with(['user', 'product'])->orderBy('id', 'DESC')->get();

        if($transactions->isNotEmpty()) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan transaksi',
                'transactions' => $transactions
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Transaksi dengan status belum dibayar tidak ada',
                'transactions' => $transactions
            ]);
        }
    }

    public function transactionProof(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'proof' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return response()->json([
                'status' => FALSE,
                'message' => $error[0]
            ]);
        }

        $proof = str_replace(' ', '', $request->proof->getClientOriginalName());
        $proofName = 'proof/'.date('mYdHs').rand(1, 10).'_'.$proof;
        $request->proof->storeAs('public/uploads/', $proofName);

        $transaction = Transaction::where('id', $id)->with(['user', 'product.user'])->first();

        if($transaction) {
            $update = $transaction->update([
                'proof' => $proofName,
                'status' => 'Dikemas'
            ]);
            if ($update) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Berhasil mengirim bukti pembayaran',
                ]);   
                $this->pushNotification('Order Masuk', $transaction->user->name.' membeli produk '.$transaction->product->name, $transaction->product->user->fcm);
            } else {
                return response()->json([
                    'status' => FALSE,
                    'message' => 'Gagal mengirim bukti pembayaran!',
                ]);
            }
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menemukan transaksi!',
            ]);
        }
    }

    public function transactionAccepted($id)
    {
        $transaction = Transaction::where('id', $id)->update([
            'status' => 'Selesai'
        ]);

        if($transaction) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menerima pesanan',
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menerima pesanan!',
            ]);
        }
    }

    private function getInvoiceNumber()
    {
        $query = \DB::select('SELECT MAX(RIGHT(invoice_number, 6)) AS max_invoice FROM transactions WHERE DATE(date)=CURDATE()');
        $kd = "";
        if (count($query) > 0) {
            foreach($query as $q)
            {
                $tmp = ((int)$q->max_invoice)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        $result = date('dmy').$kd;
        return $result;
    }


    // Manage

    public function transactionPackedManage($id)
    {
        $transactions = Transaction::whereHas('product', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->where('status', 'Dikemas')->orderBy('id', 'DESC')->with(['user', 'product'])->get();
        
        if($transactions->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Pembelian dengan status dikemas tidak ada',
                'transactions' => $transactions
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan pesanan',
                'transactions' => $transactions
            ]);
        }
    }

    public function transactionSentManage($id)
    {
        $transactions = Transaction::whereHas('product', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->where('status', 'Dikirim')->orderBy('id', 'DESC')->with(['user', 'product'])->get();
        
        if($transactions->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Pembelian dengan status dikirim tidak ada',
                'transactions' => $transactions
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan pesanan',
                'transactions' => $transactions
            ]);
        }
    }

    public function transactionHistoryManage($id)
    {
        $transactions = Transaction::whereHas('product', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->where([
            ['status', '!=', 'Dikemas'],
            ['status', '!=', 'Dikirim']
        ])->orderBy('id', 'DESC')->with(['user', 'product'])->get();
        
        if($transactions->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Pembelian dengan status selesai tidak ada',
                'transactions' => $transactions
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan pesanan',
                'transactions' => $transactions
            ]);
        }
    }

    public function transactionSend($id)
    {
        $transaction = Transaction::where('id', $id);

        if($transaction) {
            $update = $transaction->update([
                'status' => 'Dikirim'
            ]);
            if ($update) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Berhasil mengirim transaksi',
                ]);
                $this->pushNotification('Order Dikirim', $transaction->product->name.' sedang dalam tahap pengiriman ', $transaction->user->fcm);
            } else {
                return response()->json([
                    'status' => FALSE,
                    'message' => 'Gagal mengirim transaksi!',
                ]);
            }
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menemukan transaksi!',
            ]);
        }
    }

    // All

    public function transactionDetail($id)
    {
        $transaction = Transaction::where('id', $id)->with(['user', 'product'])->first();
        
        if($transaction) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan detail transaksi',
                'transaction' => $transaction
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menampilkan detail transaksi!',
                'transaction' => $transaction
            ]);
        }
    }

    public function pushNotification($title, $message, $mFcm)
    {
        $mData = [
            'title' => $title,
            'body' => $message
        ];

        $fcm[] = $mFcm;

        $payload = [
            'registration_ids' => $fcm,
            'notification' => $mData
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAA0UVx1dg:APA91bHNwIy0BlY4FpaBKzpeW36M1DTOMEEuBXfVIVmsXcFkpQ6AFE75OPP-LKpBKsr5vy-Tg08bkhmUdgGB6uYuPUI1HFx65Nzsle6gTt8WmQPeB6SVLUWg9JpcOn_L-2VHy1u0c7Lw"
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = [
            'success' => 1,
            'message' => "Push notif success",
            'data' => $mData,
            'firebase_response' => json_decode($response)
        ];
        return $data;
    }
}