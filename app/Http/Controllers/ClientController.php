<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Only Admins can access client management
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    // Show list of clients
    public function index()
    {
        $clients = Client::latest()->get();
        return view('Admin.Clients.index', compact('clients'));
    }

    // Show client creation form
    public function create()
    {
        return view('Admin.Clients.create');
    }

    // Store new client
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client created successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('Admin.Clients.edit', compact('client'));
    }

    // Update client
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully');
    }

    // Delete client
    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully');
    }
}
