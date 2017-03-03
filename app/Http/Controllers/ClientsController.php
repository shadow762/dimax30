<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    protected $rules = [
        'name' => 'required|max:150',
        'phone' => 'required|max:30'
    ];

    protected $msgs = [
        'name.required' => 'Необходимо заполнить имя/наименование клиента',
        'name.max' => 'Имя/наименование клиента должно быть не более 150 символов',
        'phone.required' => 'Необходимо указать номер телефона клиента',
        'phone.max' => 'Номер телефона клиента должен быть не более 30 символов'
    ];
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
     * ajax
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Client $clientModel, Request $request)
    {
        $this->validate($request, $this->rules, $this->msgs);

        if($clientModel->create($request->all()))
            $result['success'] = true;

        return json_encode($result);
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
        $this->validate($request, $this->rules, $this->msgs);

        $clientData = $clientModel->find($id);

        $clientData->name = $request->name;
        $clientData->phone = (int)$request->phone;
        $clientData->email = $request->email;

        if($clientData->save())
            $result['success'] = true;

        return json_encode($result);
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
