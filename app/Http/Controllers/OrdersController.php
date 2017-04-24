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
        $orders = $orderModel->getAllWithAssoc()->paginate(5);

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

        return response()->json($response);
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

        $this->validate($request, $this->rules);

        $data = $request->all();
        //dd($data);
        //Если добавлены запчасти и работы - проверяем на наличие в бд и добавляем
        if(!empty($data['parts'])) {
            $data['parts'] = PartsController::store($data['parts']);
        }
        if(!empty($data['services'])) {
            $data['services'] = ServicesController::store($data['services']);
        }
        //dd($data);
        $data['user_created'] = '1';
        $data['cost'] = $data['cost'] ? $data['cost'] : 0;
        $data['pay'] = $data['pay'] ? $data['pay'] : 0;

        $orderModel->status_id = (int)$request->status_id;
        $orderModel->client_id = (int)$request->client_id;
        $orderModel->model_id = (int)$request->model_id;

        /** TODO После реализации модуля пользователей добавить подстановку текущего пользователя в user_created */
        $orderModel->user_created = 1;

        $orderModel->sn = $request->sn;
        $orderModel->description = $request->description;
        $orderModel->cost = (int)$request->cost;
        $orderModel->pay = (int)$request->pay;

        if($orderModel->save()) {
            //После сохранения заказа - привязываем запчасти и работы
            if($data['parts']) {
                $partAttach = [];
                foreach ($data['parts'] as $part) {
                    $partAttach[$part['id']]['price_own'] = $part['price_own'];
                    $partAttach[$part['id']]['price_sell'] = $part['price_sell'];
                    $partAttach[$part['id']]['quantity'] = $part['numbers'];

                }
                $orderModel->part()->sync($partAttach);
            }
            if($data['services']) {
                $serviceAttach = [];
                foreach ($data['services'] as $service) {
                    $serviceAttach[$service['id']]['price'] = $service['price'];
                    $serviceAttach[$service['id']]['quantity'] = $service['numbers'];

                }
                $orderModel->service()->sync($serviceAttach);
            }
            $result['success'] = true;
        }

        return json_encode($result);
    }

    /**
     * Метод возвращает данные заказа в json.
     *
     * @param  int  $id
     * @param Models\Order $orderModel
     * @return \Illuminate\Http\Response
     */
    public function getOrder(Models\Order $orderModel, $id)
    {
        // TODO Добавить к запросу информацию об участвующих пользователях
        $order = $orderModel->with('parts', 'services')->where('orders.id', '=', $id)->first();
        $order->brend_id = $order->lmodel->brend_id;
        $order->type_id = $order->lmodel->brend->type_id;

        //$order->parts = $order->part->withPivot();

        return json_encode($order);
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
     * @return json $result
     */
    public function update(Request $request)
    {
        if($request->id) {
            $this->validate($request, $this->rules);

            $data = $request->all();

            $data['cost'] = $data['cost'] ? $data['cost'] : 0;
            $data['pay'] = $data['pay'] ? $data['pay'] : 0;

            //отличие от $this->store
            $orderModel = Models\Order::find((int)$request->id);
            //отличие от $this->store


            $orderModel->status_id = (int)$request->status_id;
            $orderModel->client_id = (int)$request->client_id;
            $orderModel->model_id = (int)$request->model_id;

            // TODO После реализации модуля пользователей добавить подстановку текущего пользователя в user_created

            $orderModel->sn = $request->sn;
            $orderModel->description = $request->description;
            $orderModel->cost = (int)$request->cost;
            $orderModel->pay = (int)$request->pay;

            if ($orderModel->save()) {
                if ($data['parts']) {
                    PartsController::store($data['parts']);
                }
                $result['success'] = true;
            }

            return json_encode($result);
        }
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
    public function attachPart(Request $request){

    }
}
