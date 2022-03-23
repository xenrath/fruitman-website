<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Product;
use App\Http\Resources\BargainResource;
use Validator;
use function PHPUnit\Framework\isEmpty;

class OfferController extends Controller
{
    public function offerPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'product_id' => 'required',
            'price' => 'required',
            'price_offer' => 'required',
            'total_item' => 'required',
            'status' => 'required',
        ]);

        $offer = Offer::create(array_merge($request->all(), [
            'status' => 'Menunggu'
        ]));
        
        if ($offer) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menawar produk',
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menawar produk!',
            ]);
        }
    }

    public function offerWaiting($id)
    {
        $offers = Offer::where([
            ['user_id', $id],
            ['status', 'Menunggu']
        ])->with('product')->orderBy('id', 'DESC')->get();

        if($offers->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Tawaran dengan status menunggu tidak ada',
                'offers' => $offers
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan tawaran',
                'offers' => $offers
            ]);
        }
    }

    public function offerAccepted($id)
    {
        $offers = Offer::where([
            ['user_id', $id],
            ['status', 'Diterima']
        ])->with('product')->orderBy('id', 'DESC')->get();

        if($offers->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Tawaran dengan status diterima tidak ada',
                'offers' => $offers
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan tawaran',
                'offers' => $offers
            ]);
        }
    }

    public function offerHistory($id)
    {
        $offers = Offer::where([
            ['user_id', $id],
            ['status', '!=', 'Diterima'],
            ['status', '!=', 'Menunggu']
        ])->with('product')->orderBy('id', 'DESC')->get();

        if($offers->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Tawaran dengan status selesai tidak ada',
                'offers' => $offers
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan tawaran',
                'offers' => $offers
            ]);
        }
    }

    public function offerCanceled($id)
    {
        $offer = Offer::where('id', $id)->update([
            'status' => 'Dibatalkan'
        ]);
        
        if($offer) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menolak tawaran',
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menolak tawaran!',
            ]);
        }
    }

    // Manage

    public function offerWaitingManage($id)
    {
        $offers = Offer::whereHas('product', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->where('status', 'Menunggu')->orderBy('id', 'DESC')->with(['user', 'product'])->get();
        
        if($offers->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Tawaran dengan status menunggu tidak ada',
                'offers' => $offers
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan tawaran',
                'offers' => $offers
            ]);
        }
    }

    public function offerHistoryManage($id)
    {
        $offers = Offer::whereHas('product', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->where('status', '!=', 'Menunggu')->orderBy('id', 'DESC')->with(['user', 'product'])->get();
        
        if($offers->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Tawaran dengan status selesai tidak ada',
                'offers' => $offers
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan tawaran',
                'offers' => $offers
            ]);
        }
    }

    public function offerAccept($id)
    {
        $offer = Offer::where('id', $id)->update([
            'status' => 'Diterima'
        ]);

        if($offer) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menerima tawaran',
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menerima tawaran!',
            ]);
        }
    }

    public function offerReject($id)
    {
        $offer = Offer::where('id', $id)->update([
            'status' => 'Ditolak'
        ]);

        if($offer) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menolak tawaran',
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menolak tawaran!',
            ]);
        }
    }

    // All

    public function offerDetail($id)
    {
        $offer = Offer::where('id', $id)->with(['product.user', 'user'])->first();
        if($offer) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan detail tawaran',
                'offer' => $offer
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menampilkan detail tawaran!',
                'offer' => $offer
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
