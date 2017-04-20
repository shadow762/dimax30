<?php
/**
 * Файл-шаблон шабки для раздела "Заказы"
 */
?>
@section('header')
<div class="search-block">
    <div>
        <input type="search" placeholder="Найдите, что искали...">
    </div>
</div>
<div class="btn-block clearfix">
    <div @click = "showAddForm=true" :class="showAddForm ? 'active' : ''"><div class="clearfix"><div class="add-order-i icon-i"></div>Новый заказ</div>
</div>
<div><div class="clearfix"><div class="filter-i icon-i"></div>Фильтр</div></div>
<div><div class="clearfix"><div class="person-i icon-i"></div>Выход</div></div>
</div>
    @stop
