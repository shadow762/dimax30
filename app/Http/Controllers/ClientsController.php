<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Client $clientModel
     * @return \Illuminate\Http\Response
     */
    public function index(Client $clientModel)
    {
        $clients = $clientModel->all();

        return view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Client $clientModel, Request $request)
    {
        $clientModel->create($request->all());

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  Client  $clientModel
     * @return \Illuminate\Http\Response
     */
    public function show(Client $clientModel, $id)
    {
        $client = $clientModel->where('id', $id)->first();
        //dd($client);

        return view('clients.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  Client $clientModel
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $clientModel, $id)
    {
        $client = $clientModel->where('id', $id)->first();

        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  Client $clientModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $clientModel, $id)
    {
        $clientData = $clientModel->find($id);

        // TODO сделать валидацию входящих данных перед сохранением
        $clientData->name = $request->name;
        $clientData->phone = (int)$request->phone;
        $clientData->email = $request->email;

        $clientData->save();

        return redirect()->route('clients.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
