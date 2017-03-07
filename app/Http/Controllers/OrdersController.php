<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class OrdersController extends Controller
{
    /**
     * @var array $rules - правила валидации
     */
    protected $rules = array(
        'sn' => 'required|max:30',
        'status_id' => 'required|integer',
        'client_id' => 'required|integer',
        'model_id' => 'required|integer',
        'cost' => 'integer',
        'pay' => 'integer'
    );
    public function getPage() {
        return view('orders.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @param Models\Order $orderModel
     * @return \Illuminate\Http\Response
     */
    public function index(Models\Order $orderModel)
    {
        $orders = $orderModel->latest()->paginate(5);

        $response = [

            'pagination' => [

                'total' => $orders->total(),

                'per_page' => $orders->perPage(),

                'current_page' => $orders->currentPage(),

                'last_page' => $orders->lastPage(),

                'from' => $orders->firstItem(),

                'to' => $orders->lastItem()

            ],

            'data' => $orders

        ];

        return response()->json($response);/*view('orders.index', ['orders' => $orders])*/;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Models\Client $clientModel
     * @param Models\Status $statusModel
     * @param Models\Type $typesModel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Models\Client $clientModel, Models\Status $statusModel, Models\Type $typesModel)
    {
        $clients = $clientModel->pluck('name', 'id')->toArray();
        $statuses = $statusModel->pluck('name', 'id')->toArray();
        $types = $typesModel->pluck('name', 'id')->toArray();

        return view('orders.create', compact('statuses', 'clients', 'types'));
    }

    /**
     * ajax
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Models\Order $orderModel)
    {
        /** TODO После реализации модуля пользователей добавить подстановку текущего пользователя в user_created */
        $this->validate($request, $this->rules);
        $data = $request->all();
        $data['user_created'] = '1';
        $data['cost'] = $data['cost'] ? $data['cost'] : 0;
        $data['pay'] = $data['pay'] ? $data['pay'] : 0;

        if($orderModel->create($data))
            $result['success'] = true;
        return json_encode($result);
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
        $order = $orderModel->with('client', 'status', 'lmodel')->where('orders.id', '=', $id)->first();
        $brend = Models\Brend::where('id', '=', $order->lmodel->brend_id)->first();
        $type = Models\Type::where('id', '=', $brend->type_id)->first();

        return view('orders.show', compact('order', 'brend', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param Models\Order $orderModel
     * @param Models\Client $clientModel
     * @param Models\Status $statusModel
     * @param Models\Type $typeModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Models\Order $orderModel, Models\Client $clientModel, Models\Status $statusModel, Models\Type $typeModel)
    {
        $order = $orderModel->with('client', 'status', 'lmodel')->where('orders.id', '=', $id)->first();
        $clients = $clientModel->pluck('name', 'id')->toArray();
        $statuses = $statusModel->pluck('name', 'id')->toArray();

        $brends = Models\Brend::where('id', '=', $order->lmodel->brend_id)->pluck('name', 'id')->toArray();
        $current['brend'] = Models\Brend::select('id', 'type_id', 'name')->where('id', '=', $order->lmodel->brend_id)->first();

        $types = $typeModel->pluck('name', 'id')->toArray();
        $current['type'] = Models\Type::select('id', 'name')->where('id', '=', $current['brend']->type_id)->first();

        $models = Models\Lmodel::pluck('name', 'id')->toArray();

        return view('orders.edit', compact('order', 'clients', 'statuses', 'types', 'brends', 'models', 'current'));
    }

    /**
     * ajax
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param $ordersModel
     * @return json $result
     */
    public function update(Request $request, $id, Models\Order $ordersModel)
    {
        $this->validate($request, $this->rules);

        $data = $request->all();

        unset($data['_method']);
        unset($data['_token']);
        unset($data['type_id']);
        unset($data['brend_id']);

        if($ordersModel->where('id', '=', (int)$id)->update($data))
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

    /**
     * @param $brend_id
     */
    public function getModel($brend_id) {

    }
}
