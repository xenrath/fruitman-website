<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
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
    public function index()
    {
        $banks = Bank::paginate(3);
        return view('bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $image = str_replace(' ', '', $request->image->getClientOriginalName());
        $imageName = 'bank/'.date('mYdHs').rand(1, 10).'_'.$image;
        $request->image->storeAs('public/uploads/', $imageName);

        Bank::create(array_merge($request->all(), [
            'image' => $imageName
        ]));

        return redirect('bank')->with('status', 'Berhasil menambahkan Bank');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return view('bank.show', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view('bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($request->image) {
            Storage::disk('local')->delete('public/uploads/'.$bank->image);
            $image = str_replace(' ', '', $request->image->getClientOriginalName());
            $imageName = 'bank/'.date('mYdHs').rand(1, 10).'_'.$image;
            $request->image->storeAs('public/uploads/', $imageName);
        }else{
            $imageName = $bank->image;
        }

        bank::where('id', $bank->id)
            ->update([
                'name' => $request->name,
                'image' => $imageName
            ]);

        return redirect('bank')->with('status', 'Berhasil mengubah Bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        Storage::disk('local')->delete('public/uploads/'.$bank->image);
        $bank->delete();
        return redirect('bank')->with('status', 'Berhasil menghapus Bank');
    }
}
