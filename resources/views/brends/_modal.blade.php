<div id="modal" v-if="brends.showModal">
    <div class="row">
        {{ Form::open(['route' => 'brends.store', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'brends.create', 'v-if' => 'brends.showModal']) }}
        @include('brends._form')
        {{ Form::close() }}
    </div>
</div>