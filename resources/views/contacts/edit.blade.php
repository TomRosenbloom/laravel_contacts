@extends('layouts.master')

@section('title')
    Contact edit
@endsection


@section('content')

    <h1>Edit contact</h1>

    {!! Form::model($contact,['action' => ['ContactController@update', $contact->id], 'method' => 'POST']) !!}
        @include('contacts._form')
        {{Form::hidden('_method','PUT')}}
    {!! Form::close() !!}

@endsection

@section('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor', {
        customConfig: '/vendor/unisharp/laravel-ckeditor/my_config.js'
    });
</script>
@endsection
