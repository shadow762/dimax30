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
     *
     * @return array result - id добавленных запчастей или false, в случае неудачи
     */
    public static function store($data) {
        if(!is_array($data)) {
            return false;
        }
        $result = array();
        foreach($data as $part) {

            //Если запчасть выбрана из существующего списка, то просто добавляется в результат
            if(!empty($part['data']['id'])) {
                $part['id'] = $part['data']['id'];
                $part['name'] = $part['data']['name'];
                unset($part['data']);
                $result[] = $part;
                continue;
            }
            $partModel = new Part();
            $partModel->name = $part['data']['name'];
            $partModel->numbers = $part['numbers'];

            if($partModel->save()) {
                $part['id'] = $partModel->id;
                $part['name'] = $partModel->name;

                unset($part['data']);
                unset($partModel);

                $result[] = $part;
            }
            else{
                return false;
            }
        }
        return $result;
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
