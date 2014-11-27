@extends('layouts.scaffold')

@section('main')
<div class="app_users">
<h1>Taka app users</h1>

<p>{{ link_to_route('user.todos.create', 'Add new user') }}</p>

@if ($todos->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Content</th>
				<!-- <th>User_id</th> -->
			</tr>
		</thead>

		<tbody>
			@foreach ($todos as $todo)
				<tr>
					<td>{{{ $todo->title }}}</td>
					<td>{{{ $todo->content }}}</td>
					
					<!-- <td>{{{ $todo->user_id }}}</td> -->
                    <td>{{ link_to_route('user.todos.edit', 'Edit', array($todo->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('user.todos.destroy', $todo->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no todos
@endif

<?php echo $todos->links(); ?>

<br><br>
	<div>Welcome, {{ Sentry::getUser()->first_name }}</div>
<a href="/logout">Logout</a>

@stop
</div>