@if(count($todos) == 0)
	<p>No todos.</p>
@else
	<table>
		<thead>
			<tr>
				<th>User Id</th>
				<th>What</th>
				<th>When</th>
				<th>Time Started</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($todos as $todo)
				<tr>
					<td><a href="{{URL::to('users/view/'.$todo->id)}}">User #{{$todo->user_id}}</a></td>
					<td>{{$todo->what}}</td>
					<td>{{$todo->when}}</td>
					<td>{{$todo->time_started}}</td>
					<td>
						<a href="{{URL::to('todos/view/'.$todo->id)}}" class="btn">View</a>
						<a href="{{URL::to('todos/edit/'.$todo->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('todos/delete/'.$todo->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
				@foreach($todo->comments as $comment)
				<tr>
					<td colspan="2">
						{{ $comment->title }}
					</td>
					<td colspan="3">
						{{ $comment->body }}
					</td>				
				</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('todos/create')}}">Create new Todo</a></p>