@extends('layouts.scaffold')

@section('main')

<h1>Show comments</h1>

<p>{{ link_to_route('user.todos.index', 'Return to see all comments') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Title</th>
				<th>Content</th>
				
				<!-- <th>User_id</th> -->
		</tr>
	</thead>

	<tbody>
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
	</tbody>
</table>


@stop
