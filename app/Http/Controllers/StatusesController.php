<?php
namespace App\Http\Controllers;

use App\Models\Status;

class StatusesController extends Controller
{
    public function getStatuses(){
        return json_encode(Status::select('name', 'id')->get());
    }
}
