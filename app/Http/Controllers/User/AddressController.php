<?php

namespace App\Http\Controllers\User;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth ;
use App\Http\Requests\AddressRequest ;

class AddressController extends Controller
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
        $addresses = Auth::user()->addresses()->get();
        return view('home.user.address.index')->with('addresses', $addresses) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.user.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        Auth::user()->addresses()->create($request->all());
        return redirect()->route('address.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('home.user.address.create', ['address' => $address]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $this->authorize('update', $address);
        if($request->is_default)
        {
            $address->setDefaultAddress();
            return response()->json(['msg'=>'ok'], 200);
        }
        $address->update($request->all());
        return redirect()->route('address.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $this->authorize('delete', $address);
        $address->delete();
        return response()->json(['msg'=>'success'], 200);  
    }
}
