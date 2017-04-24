<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    protected $rules = [
        'name' => 'required',
        'numbers' => 'integer'
    ];
    protected $message = [
        'name.required' => 'Необходимо заполнить наименование запчасти',
        'numbers.integer' => 'Укажите количество целым числом'
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

        foreach($data as $key=>$part) {
            //Отделяем несуществующие запчасти
            if ($part['id'] === -1) {
                $adding[] = $part;
                unset($data[$key]);
            }
        }
        //Получаем все привязанные к заказу запчасти
        $addedParts = Part::select('id')->where('order_id', '=', $order_id);

        //Сравниваем запчасти в запросе с привязанными запчастями. Удаляем лишние.
        foreach($addedParts as $added) {
            if(array_search($added['id'], $data) === false) {
                Part::destroy($added['id']);
            }
        }

        //Добавляем несуществующие запчасти
        foreach($adding as $add) {
            $partModel = new Part();

            $partModel->name = $add['name'];
            $partModel->numbers = $add['numbers'];
            $partModel->own_price = $add['own_price'];
            $partModel->sell_price = $add['sell_price'];
            $partModel->order_id = $order_id;
        }

        return true;

        //TODO Реализовать проверку наличия запчастей на складе
    }

    /**
     * @brief Метод для получения списка запчастей
     * @return string
     */
    public function getParts() {
        //TODO Реализовать выборку запчастей по id компании
        return json_encode(Part::select('id', 'name')->get());
    }
}
