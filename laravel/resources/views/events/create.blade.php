@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-3">
            {{ Form::open(['method' => 'post'], ['class'=>'horizontal-form']) }}
                <div class="form-group">
                    {{ Form::label('name', 'wpEvent') }}
                    {{ Form::text('name','', ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    {{ Form::label('location', 'Location:') }}
                    {{ Form::text('location','', ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    {{ Form::label('event_date', 'Date:') }}
                    {{ Form::text('event_date','', ['class'=>'form-control', 'id' =>'datetimepicker'])}}
                </div>
                <div class="form-group">
                    {{ Form::label('price', 'Registration Fee:') }}
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        {{ Form::number('price','', ['class'=>'form-control'])}}
                        <span class="input-group-addon">.00</span>
                    </div>
                </div>
            <div class="form-group">
                {{ Form::submit('Create New Event', ['class'=>'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div>
    </div>
@stop