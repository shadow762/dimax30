<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 28.04.2017
 * Time: 13:10
 */

namespace App\Http\Controllers;
use App\Models\Account;
use Illuminate\Support\Facades\Request;

/**
 * Class AccountController
 * @package App\Http\Controllers
 * @brief Контроллер для ведения счетов
 */

class AccountController extends Controller
{
    public function index() {
        return view('accounts.index');
    }
    public function httpAddLine(Request $request) {
        //TODO Валидация

        $data = $request->all();
        $result = array();

        if(self::addLine($data))
            $result[] = ['status' => 'success', 'message' => 'Запись успешно добавлена'];
        else
            $result[] = ['status' => 'error', 'message' => 'Не удалось добавить запись'];
    }

    /**
     * @brief Метод для сохранения записи в кассу
     * @param array $data
     *
     * @return bool;
     */
    static public function addLine(array $data) {
        $accountModel = new Account();

        $accountModel->type = $data['type'];
        $accountModel->amount = $data['amount'];

        if(!empty($data['order_id']))
            $accountModel->order_id = $data['order_id'];

        try {
            $accountModel->save();
        }
        catch(\mysqli_sql_exception $e) {
            return false;
        }
        finally {
            unset($accountModel);
        }

        return true;
    }
}