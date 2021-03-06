<div class="form-row">
    <div class="form-group col-md-1">
        {{Form::label('title', 'Title')}}
        {{Form::select('title', ['' => ''] + $titles, $contact->title, ['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-3" id="first_name-input">
        {{Form::label('first_name', 'First name')}}
        {{Form::text('first_name', $contact->first_name, ['class'=>'form-control', 'placeholder'=>'First name', 'autocomplete' => 'no'])}}
    </div>

    <div class="form-group col-md-3" id="last_name-input">
        {{Form::label('last_name', 'Last name')}}
        {{Form::text('last_name', $contact->last_name, ['class'=>'form-control', 'placeholder'=>'Last name', 'autocomplete' => 'no'])}}
        <div id="matches">

        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{Form::label('line_1', 'Address')}}
        {{Form::text('line_1', $address->line_1, ['class'=>'form-control', 'placeholder'=>'First line of address'])}}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        {{Form::label('city', 'City')}}
        {{Form::select('city', ['' => ''] + $cities, $address->city, ['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-2">
        {{Form::label('postcode', 'Postcode')}}
        {{Form::text('postcode', $address->postcode, ['class'=>'form-control', 'placeholder'=>'Postcode'])}}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        {{Form::label('email', 'Email')}}
        {{Form::text('email', $contact->email, ['class'=>'form-control', 'placeholder'=>'Email'])}}
    </div>
    <div class="form-group col-md-2">
        {{Form::label('telephone', 'Telephone')}}
        {{Form::text('telephone', $contact->telephone, ['class'=>'form-control', 'placeholder'=>'Telephone'])}}
    </div>
</div>





{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
