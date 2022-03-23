<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\City;
use App\Models\Image;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::paginate(2);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $products = Product::where('name', 'LIKE', "%$filterKeyword%")->paginate(2);
        }
        $filterCategory = $request->get('category');
        if ($filterCategory) {
            $products = Product::where('category', $filterCategory)->paginate(2);
        }
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where([
            ['level', '!=', 'Admin'],
            ['level', '!=', 'Buyer']
        ])->get();
        $provinces = Province::pluck('id', 'name');
        return view('product.create', compact('users', 'provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'stock' => 'required',
        ]);

        $product = Product::create($data);

        if ($request->has('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                $name = str_replace(' ', '', $image->getClientOriginalName());
                $imageName = 'product/' . date('mYdHs') . rand(1, 10) . '_' . $name;
                $image->storeAs('public/uploads', $imageName);

                Image::create([
                    'product_id' => $product->id,
                    'image' => $imageName
                ]);
            }
        }

        alert()->success('Produk berhasil ditambahkan', 'Berhasil');

        return redirect('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $result = [
            ['name' => $product->name],
            ['latitude' => $product->latitude],
            ['longitude' => $product->longitude],
        ];
        
        $result_lat_long = json_encode($result);
        
        return view('product.show', compact('product', 'result_lat_long'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $users = User::where([
            ['level', '!=', 'Admin'],
            ['level', '!=', 'Buyer']
        ])->get();
        $provinces = Province::pluck('id', 'name');
        $cities = City::where('province_id', $product->city->province_id)->get();
        return view('product.edit', compact('product', 'users', 'provinces', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|',
            'category_id' => 'required',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);
        if ($request->image) {
            if ($product->image != 'product.png') {
                Storage::disk('local')->delete('public/uploads/' . $product->image);
            }
            $image = str_replace(' ', '', $request->image->getClientOriginalName());
            $imageName = 'product/' . date('mYdHs') . rand(1, 10) . '_' . $image;
            $request->image->storeAs('public/uploads/', $imageName);
        } else {
            $imageName = $product->image;
        }
        Product::where('id', $product->id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'image' => $imageName,
            ]);
        return redirect('product')->with('status', 'Produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image != 'product.png') {
            Storage::disk('local')->delete('public/uploads/' . $product->image);
        }
        $product->delete();
        return redirect('product')->with('status', 'Produk berhasil dihapus');
    }

    public function getCities($id)
    {
        $city = City::where('province_id', $id)->get();
        return json_encode($city);
    }

    public function getCategory($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->level == 'Seller') {
            $category = ['Eceran' => 'Eceran'];
        } else {
            $category = ['Tebasan' => 'Tebasan'];
        }
        return json_encode($category);
    }

    public function getPostalCode($id)
    {
        $postal_code = City::where('id', $id)->first();
        return json_encode($postal_code);
    }

    public function submit(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin' => $request->city_origin,
            'destination' => $request->city_destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ])->get();
    }
}
