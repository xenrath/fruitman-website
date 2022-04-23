<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = User::where('level', '!=', 'Admin')->orderBy('name', 'ASC')->paginate(4);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $users = User::where('name', 'LIKE', "%$filterKeyword%")
                ->orWhere('email', 'LIKE', "%$filterKeyword%")
                ->orWhere('phone', 'LIKE', "%$filterKeyword%")
                ->orWhere('address', 'LIKE', "%$filterKeyword%")
                ->paginate(4);
        }
        $filterLevel = $request->get('level');
        if ($filterLevel) {
            $users = User::where('level', $filterLevel)->paginate(4);
        }
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|unique:users',
            'address' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
            'level' => 'required'
        ]);

        $image = str_replace(' ', '', $request->image->getClientOriginalName());
        $imageName = 'user/' . date('mYdHs') . rand(1, 10) . '_' . $image;
        $request->image->storeAs('public/uploads/', $imageName);

        User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password),
            'image' => $imageName
        ]));

        alert()->success('User berhasil ditambahkan', 'Berhasil');

        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
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
}
