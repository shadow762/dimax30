<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceDictionary;

class DevicesController extends Controller
{
    /**
     * @brief Метод для получения списка устройств из словаря в json через ajax
     * @return string
     */
    public function getDevices() {
        return $devices = DeviceDictionary::select('model', 'type', 'brend')->get()->toJson();
    }

    /**
     * @brief Метод для сохранения устройства в словать
     * @param array $data
     * @return bool
     */
    public static function setToDictionary(array $data) {
        $deviceDicModel = new DeviceDictionary();

        $deviceDicModel->model = $data['model'];
        $deviceDicModel->type = $data['type'];
        $deviceDicModel->brend = $data['brend'];

        try {
            $deviceDicModel->save();
        }
        catch(\mysqli_sql_exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @brief Метод для сохранения и привязки устройства к заказу
     * @param array $data
     * @return bool
     */
    public static function bindToOrder(array $data) {
        $deviceModel = new Device();

        $deviceModel->model = $data['model'];
        $deviceModel->type = $data['type'];
        $deviceModel->brend = $data['brend'];
        $deviceModel->order_id = $data['order_id'];

        try {
            $deviceModel->save();
        }
        catch(\mysqli_sql_exception $e) {
            return false;
        }
        return true;
    }
}
