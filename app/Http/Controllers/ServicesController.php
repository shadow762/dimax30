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
     *
     * @return array result - id добавленных запчастей или false, в случае неудачи
     */
    public static function store($data) {
        if(!is_array($data)) {
            return false;
        }
        $result = array();
        foreach($data as $service) {

            //Если услуга выбрана из существующего списка, то просто добавляется в результат
            if(!empty($service['id']) && $service['id']) {
                $result[] = $service;
                continue;
            }
            $serviceModel = new Service();
            $serviceModel->name = $service['name'];

            if($serviceModel->save()) {
                $service['id'] = $serviceModel->id;
                $result[] = $service;
                unset($serviceModel);
            }
            else{
                return false;
            }
        }
        return $result;
    }
}
