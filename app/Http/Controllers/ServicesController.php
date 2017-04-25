<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    protected $rules = [
        'name' => 'required'
    ];
    protected $message = [
        'name.required' => 'Необходимо заполнить наименование запчасти'
    ];

    /**
     * @brief Оболочка для метода store для сохранения через http
     * @param Request $request
     * @return bool
     */
    public function http_store(Request $request) {
        $this->validate($request, $this->rules, $this->message);

        if(self::store($request->all())) {
            return true;
        }
    }

    /**
     * @brief Перебирает и сохраняет переданные запчасти. Возвращает список добавленных запчастей
     * @param array $data
     * @param int $order_id
     *
     * @return array result - id добавленных запчастей или false, в случае неудачи
     */
    public static function store($data, $order_id) {
        if(!is_array($data) || !count($data)) {
            return false;
        }

        $result = array();
        $adding = array();

        foreach($data as $key=>$service) {
            //Отделяем несуществующие услуги
            if ($service['id'] === -1) {
                $adding[] = $service;
                unset($data[$key]);
            }
        }
        //Получаем все привязанные к заказу услуги
        $addedServices = Service::select('id')->where('order_id', '=', $order_id);

        //Сравниваем услуги в запросе с привязанными запчастями. Удаляем лишние.
        $toDestroy = array();
        foreach($addedServices as $added) {
            if(array_search($added['id'], $data) === false) {
                $toDestroy[] = $added['id'];
            }
        }
        Service::destroy($toDestroy);
        unset($toDestroy);
        unset($addedServices);

        //Добавляем несуществующие услуги
        foreach($adding as $add) {
            $serviceModel = new Service();

            $serviceModel->name = $add['name'];
            $serviceModel->numbers = $add['numbers'];
            $serviceModel->price = $add['price'];
            $serviceModel->order_id = $order_id;

            $serviceModel->save();

            unset($serviceModel);
        }

        return true;
    }

    /**
     * @brief Метод для получения списка работ
     * @return string
     */
    public function getServices() {
        //TODO Реализовать выборку работ по id компании
        return json_encode(Service::select('id', 'name')->get());
    }
}
