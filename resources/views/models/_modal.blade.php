<div id="modal" v-if="models.showModal">
    <div class="row">
        {{ Form::open(['route' => 'models.store', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'models.create', 'v-if' => 'models.showModal']) }}
        @include('models._form')
        {{ Form::close() }}
        <a @click.prevent="models.showModal=false">Закрыть</a>
    </div>
</div>