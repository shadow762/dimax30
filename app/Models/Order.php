<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @return mixed
     */
    public function getAllWithAssoc() {
        return $this->select(
            'orders.id',
            'orders.created',
            'orders.updated',
            'orders.description',
            'orders.cost',
            'orders.sn',
            's.name as status',
            's.id as status_id',
            'cu.name as closer_name',
            'cu.id as closer_id',
            'ru.name as resp_name',
            'ru.id as resp_id',
            'cru.name as creator_name',
            'cru.id as creator_id',
            'm.name as model_name',
            'b.name as brend_name',
            't.name as type_name',
            'c.name as client_name'
        )
            ->leftJoin('users as ru', 'orders.user_resp', '=', 'ru.id')
            ->leftJoin('users as cu', 'orders.user_closed', '=', 'cu.id')
            ->leftJoin('users as cru', 'orders.user_created', '=', 'cru.id')
            ->leftJoin('statuses as s', 'orders.status_id', '=', 's.id')
            ->leftJoin('lmodels as m', 'orders.model_id', '=', 'm.id')
            ->leftJoin('clients as c', 'orders.client_id', '=', 'c.id')
            ->leftJoin('brends as b', 'm.brand_id', '=', 'b.id')
            ->leftJoin('types as t', 'm.type_id', '=', 't.id')
            ->get();
    }
    /** One-to-many relationships with Client
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client() {
        return $this->belongsTo('App\Models\Client');
    }

    /** One-to-many relationships with Status
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status() {
        return $this->belongsTo('App\Models\Status');
    }

    /** One-to-many relationships with Lmodel
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lmodel() {
        return $this->belongsTo('App\Models\Lmodel', 'model_id');
    }

    /** One-to-many relationships with User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_created');
    }

    /*public function cuser() {
        return $this->belongsTo('App\Models\User', 'user_closed');
    }

    public function ruser() {
        return $this->belongsTo('App\Models\User', 'user_resp');
    }*/
}