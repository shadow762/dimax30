<div id="modal" v-if="clients.showModal">
    <div class="row">
        {{ Form::open(['route' => 'clients.store', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'clients.create', 'v-if' => 'clients.showModal']) }}
        @include('clients._form')
        {{ Form::close() }}
    </div>
</div>
