<div id="modal" v-if="types.showModal">
    <div class="row">
        {{ Form::open(['route' => 'types.store', 'method' => 'post', 'class' => 'col s12 ajax-form', 'data-url' => 'types', '@submit.prevent' => 'types.create']) }}
        @include('types._form')
        {{ Form::close() }}
    </div>
</div>