@extends('layouts.scaffold')

@section('main')

<h2> Feel free to share your ideas</h2>
{{ Form::model($todo, array('method' => 'PATCH', 'route' => array('user.todos.update', $todo->id))) }}
	<ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
            {{ Form::label('content', 'content:') }}
            {{ Form::textarea('content') }}
        </li>

        
        <!-- <li>
            {{ Form::label('user_id', 'User_id:') }}
            {{ Form::input('number', 'user_id') }}
        </li> -->

		
	</ul>
    <div class="form-group" id="country" style="margin-top:-12px;">
            <label for="ddn_country" class="sr-only">Country</label>
            <select id="ddn_country class="form-control">
                <option value="beaux-arts-wa">sudan</option>
               
          <!--<option value="bellevue-wa" selected>Tanzania</option>-->
          <option value="#" selected>Kenya</option>
                <option value="bothell-wa">Nigeria</option>
                <option value="brier-wa">Ghana</option>
                <option value="burien-wa">Madagascar</option>
                <option value="issaquah-wa">Mozambique</option>
                <option value="kenmore-wa">Somalia</option>
                <option value="kirkland-wa">Ethiopia</option>
                <option value="kirkland-wa">Uganda</option>
                
            </select>
          </div>
         <div class="form-group" id="city" style="margin-top:-0px;">
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
            {{ link_to_route('user.todos.show', 'Cancel', $todo->id, array('class' => 'btn')) }}
        </li>
        </ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
   
@endif

@stop
