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
     * @param Models\Order $orderModel
     * @return \Illuminate\Http\Response
     */
    public function show(Models\Order $orderModel, $id)
    {
        // TODO Добавить к запросу информацию об участвующих пользователях
        $order = $orderModel->with('client', 'status')->where('orders.id', '=', $id)->first();

        return view('orders.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param Models\Order $orderModel
     * @param Models\Client $clientModel
     * @param Models\Status $statusModel
     * @param Models\Lmodel $modelsModel
     * @param Models\Type $typeModel
     * @param Models\Brend $brendmodel
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Models\Order $orderModel, Models\Client $clientModel, Models\Status $statusModel, Models\Lmodel $modelsModel, Models\Type $typeModel, Models\Brend $brendmodel)
    {
        $order = $orderModel->with('client', 'status')->where('orders.id', '=', $id)->first();
        $clients = $clientModel->pluck('name', 'id')->toArray();
        $statuses = $statusModel->pluck('name', 'id')->toArray();
        $models = $modelsModel->with(['brend', 'type'])->get();
        $types = $typeModel->pluck('name', 'id')->toArray();

        return view('orders.edit', compact('order', 'clients', 'statuses', 'types'));
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
