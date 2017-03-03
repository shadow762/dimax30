<?php
/**
 * Сообщения для валидации
 */
return [
    'custom' => [
        /* orders */
        'sn' => [
            'required' => 'Необходимо заполнить серийный номер',
            'max' => 'Серийный номер должен быть не более :max-30 символов'
        ],
        'status_id' => [
            'required' => 'Необходимо выбрать статус заказа',
            'integer' => 'Статус заказа не целое число'
        ],
        'client_id' => [
            'required' => 'Необходимо выбрать клиента',
            'integer' => 'id клиента не целое число'
        ],
        'model_id' => [
            'required' => 'Необходимо выбрать устройство',
            'integer' => 'id устройства не целое число'
        ],
        'cost' => [
            'integer' => 'Стоимость должна быть целым числом'
        ],
        'pay' => [
            'integer' => 'Оплата должна быть целым числом'
        ],
        /* clients */
        'phone' => [
            'required' => 'Необходимо ввести номер телефона'
        ]
    ],
    'attributes' => [
        'max-30' => '30'
    ]
];