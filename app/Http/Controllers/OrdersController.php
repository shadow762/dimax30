<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Models\Order $orderModel
     * @return \Illuminate\Http\Response
     */
    public function index(Models\Order $orderModel)
    {
        $orders = $orderModel->getAllWithAssoc();

        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Models\Client $clientModel
     * @param Models\Status $statusModel
     * @param Models\Lmodel $modelsModel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Models\Client $clientModel, Models\Status $statusModel, Models\Lmodel $modelsModel)
    {
        $clients = $clientModel->pluck('name', 'id')->toArray();
        $statuses = $statusModel->pluck('name', 'id')->toArray();
        $models = $modelsModel->with(['brend', 'type'])->get();
//dd($statuses);
        return view('orders.create', compact('statuses', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
