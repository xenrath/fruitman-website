<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Validator;
use Storage;

class ProductController extends Controller
{
    public function productCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'province_name' => 'required',
            'city_id' => 'required',
            'city_name' => 'required',
            'postal_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,jpg,png|max:2048',
            'stock' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $product = Product::create($request->all());

        // $image = str_replace(' ', '', $request->image->getClientOriginalName());
        // $imageName = 'products/'.date('mYdHs').rand(1, 10).'_'.$image;
        // $request->image->storeAs('public/uploads/', $imageName);

        if($request->has('image')) {
            $images = $request->file('image');
            foreach($images as $image) {
                $name = str_replace(' ', '', $image->getClientOriginalName());
                $nameImage = 'product/'.date('mYdHs').rand(1, 10).'_'.$name;
                $image->storeAs('public/uploads', $nameImage);

                Image::create([
                    'product_id' => $product->id,
                    'image' => $nameImage
                ]);
            }
        }

        // if($request->hasFile('image'))
        // {
        //     foreach($request->file('image') as $image)
        //     {
        //         $name = str_replace(' ', '', $image->getClientOriginalName());
        //         $imageName = 'products/'.date('mYdHs').rand(1, 10).'_'.$name;
        //         $image->move(public_path('/uploads/'), $imageName); 
        //         $imageData[] = $imageName;
        //     }
        // }

        // $product = Product::create(array_merge($request->all(), [
        //     'image' => json_encode($imageData)
        // ]));
        
        if ($product) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Produk berhasil ditambahkan'
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menambahkan produk!'
            ]);
        }
    }

    public function productUpdate(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'province_name' => 'required',
            'city_id' => 'required',
            'city_name' => 'required',
            'postal_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        if ($request->image) {
            Storage::disk('local')->delete('public/uploads/'.$product->image);
            $image = str_replace(' ', '', $request->image->getClientOriginalName());
            $imageName = 'products/'.date('mYdHs').rand(1, 10).'_'.$image;
            $request->image->storeAs('public/uploads/', $imageName);
        }else{
            $imageName = $product->image;
        }

        $product = Product::where('id', $product->id)
        ->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'address' => $request->address,
            'province_id' => $request->province_id,
            'province_name' => $request->province_name,
            'city_id' => $request->city_id,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $imageName,
        ]);

        if ($product) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil mengubah produk',
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal mengubah produk!'
            ]);
        }
    }

    public function productDelete(Product $product)
    {
        $product->delete();

        Storage::disk('local')->delete('public/uploads/'.$product->image);

        if ($product) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menghapus produk',
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menghapus produk!'
            ]);
        }
    }

    public function productList($id)
    {
        $products = Product::where('user_id', $id)->get();

        if ($products->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Belum ada produk yang ditambahkan',
                'products' => $products
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan produk',
                'products' => $products
            ]);
        }
    }

    public function productSell(Request $request)
    {
        $user_id = $request->user_id;
        $category = $request->category;

        $products = Product::where([
            ['user_id', '!=', $user_id],
            ['category', $category],
            ['stock', '>', '0'],
        ])->get();

        if ($products->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Belum ada produk yang dijual',
                'products' => $products
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan produk',
                'products' => $products
            ]);
        }
    }

    public function productSearch(Request $request)
    {
        $keyword = $request->keyword;
        
        $products = Product::where('name', 'LIKE', "%$keyword%")->get();

        if ($products->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Produk yang dicari tidak ada',
                'products' => $products
            ]);
        } else {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan produk',
                'products' => $products
            ]);
        }
    }

    public function productDetail($id)
    {
        $product = Product::where('id', $id)->with(['user'])->first();
        if ($product) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Berhasil menampilkan detail produk',
                'product' => $product
            ]);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Gagal menampilkan detail produk!',
                'product' => $product
            ]);
        }
    }

    public function productIn(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stock' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $stockIn = $request->stock;
        $product = Product::where('id', $id);

        if ($product) {
            $stock = $product->stock;
            $count = $stock + $stockIn;
        
            $update = $product->update([
                'stock' => $count
            ]);
            if ($update) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Berhasil menambahkan stok produk',
                ]);
            } else {
                return $this->error('Gagal menambahkan stok produk!');
            }
        } else {
            return $this->error('Gagal menemukan produk!');
        }
    }
    
    public function productOut(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'total_item' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return $this->error($error[0]);
        }

        $total_item = $request->total_item;

        $data = Product::find($id);
        $stock = $data->stock;

        if ($stock >= $total_item) {
            
            $count = $stock - $total_item;

            $product = Product::where('id', $id)->update([
                'stock' => $count
            ]);

            if ($product) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Berhasil mengubah stok produk',
                ]);
            } else {
                return $this->error('Gagal mengubah stok produk!');
            }
        } else {
            return $this->error('Stok produk tidak mencukupi!');
        }
    }

    public function error($message)
    {
        return response()->json([
            'status' => FALSE,
            'message' => $message,
        ]);
    }
}