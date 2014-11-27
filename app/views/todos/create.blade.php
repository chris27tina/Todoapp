@extends('layouts.scaffold')

@section('mains')

<h1>Create your todos</h1>

@section('main')

{{ Form::open(array('route' => 'user.todos.create')) }}
    <ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
            {{ Form::label('content', 'content:') }}
            {{ Form::textarea('content') }}
        </li>

       
        <li>
            {{ Form::label('user_id', 'User_id:') }}
            {{ Form::input('number', 'user_id') }}
        </li> 

        
    </ul>
    <div class="form-group" id="country" style="margin-top:-12px;">
            <label for="ddn_country" class="sr-only">country</label>
            <select id="ddn_country" class="form-control">
                <option value="beaux-arts-wa">Sudan</option>
               
          <!--<option value="bellevue-wa" selected>Nigeria</option>-->
          <option value="#" selected>uganda</option>
                <option value="bothell-wa">Madagascar</option>
                <option value="brier-wa">Kenya</option>
                <option value="burien-wa">Tanzania</option>
                <option value="issaquah-wa">Morocco</option>
                <option value="kenmore-wa">Ethiopia</option>
                <option value="kirkland-wa">Cameroon</option>
                <option value="kirkland-wa">Ghana</option>
                
            </select>
          </div>
          <div class="form-group" id="city" style="margin-top:-0px 0px;">
            <label for="ddn_city" class="sr-only">City</label>
            <select id="ddn_city" class="form-control">
                <option value="beaux-arts-wa">Nairobi</option>
               
          <!--<option value="bellevue-wa" selected>Nairobi</option>-->
          <option value="#" selected>Konza</option>
                <option value="bothell-wa">Nyeri</option>
                <option value="brier-wa">Nanyuki</option>
                <option value="burien-wa">Nakuru</option>
                <option value="issaquah-wa">Mombasa</option>
                <option value="kenmore-wa">Kisii</option>
                <option value="kirkland-wa">Nyahururu</option>
                <option value="kirkland-wa">kisumu</option>
                
            </select>
          </div>
          


          <ul>
          <li>
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
        </li>
        </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif


@stop




