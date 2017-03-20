<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function getTypes() {
        return json_encode(Type::select('id', 'name')->get());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Type $typeModel
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Type $typeModel)
    {
        $this->validate($request, ['name' => 'required']);
        $typeModel->name = $request->input('name');
        if($typeModel->save()) {
            return json_encode(['success' => true, 'msg' => 'Тип устройства успешно добавлен']);
        }
    }
}
