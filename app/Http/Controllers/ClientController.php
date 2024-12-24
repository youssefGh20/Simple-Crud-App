<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Client::all();
        return view('client.home', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:clients',
            'passwrod' => 'required|min:6',
        ]);
        $data['passwrod'] = Hash::make($data['passwrod']);
        // dd($data);
        Client::create($data);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Client::findorFail($id);
        return view('client.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findorFail($id);
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'passwrod' => 'nullable|min:6',
        ]);
        if ($data['passwrod'] == null) {
            $data['passwrod'] = $client->passwrod;
        }
        $data['passwrod'] = Hash::make($data['passwrod']);
        // dd($data);
        $client->update($data);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Client::findorFail($id)->delete();
        return redirect('/');
    }
}
