@extends('layouts.master')

@push('scripts')
    <script src="js/orgindex.js"></script>
@endpush

@section('title')
    List of contacts
@endsection

@section('styles')

.hidden {
    display: none;
}

.search-container {
    display: inline-block;
    position: relative;
}

.form-control-clear {
    position: absolute;
    top: 0;
    right: 0;
    padding: 12px;
    color: lightgrey;
    z-index: 10;
    pointer-events: auto;
    cursor: pointer;
}

.search-input {
    box-shadow: none;
}

@endsection

@section('content')

    <h1>Contacts</h1>

    @auth
    <p>
        <a href="/contacts/create">Add contact</a>
    </p>
    @endauth

    <div class="card w-75">
        <div class="card-body">

            {!! Form::open(['action' => 'ContactController@index', 'method' => 'GET', 'class' => 'form-inline']) !!}

            <div class="input-group mr-2">
                <div class="search-container">
                    {{Form::text('search_terms', $search_terms, ['class'=>'form-control search-input', 'placeholder'=>'Enter search text here'])}}
                    <span class="form-control-clear fa fa-times-circle fa-lg hidden"></span>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Search</button>
                </div>
            </div>

            {{Form::label('num_items', 'Show')}}
            {{Form::Select('num_items', [4=>4,6=>6,10=>10,50=>50], $num_items, ['class'=>'form-control ml-1 mr-1'])}}

            {!! Form::close() !!}

        </div>
    </div>

    @if(count($contacts) > 0)

        @foreach($contacts as $contact)
            <div class="mt-3">
                <h3><a href="{{ url('/contacts/' . $contact->id) }}">{{$contact->order_name}}</a></h3>
            </div>
        @endforeach

        {{$contacts->links()}}

        @if(Request::get('search_terms'))
            @include('includes.algolia')
        @endif

    @else
        <p>
            No contacts found
        </p>
    @endif

@endsection
