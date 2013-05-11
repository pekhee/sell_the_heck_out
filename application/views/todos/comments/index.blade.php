@if(count($comments) == 0)
	<p>No comments.</p>
@else
	<table>
		<thead>
			<tr>
				<th>Todo Id</th>
				<th>User Id</th>
				<th>Title</th>
				<th>Body</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($comments as $comment)
				<tr>
					<td><a href="{{URL::to('todos/view/'.$comment->id)}}">Todo #{{$comment->todo_id}}</a></td>
					<td><a href="{{URL::to('users/view/'.$comment->id)}}">User #{{$comment->user_id}}</a></td>
					<td>{{$comment->title}}</td>
					<td>{{$comment->body}}</td>
					<td>
						<a href="{{URL::to('todos/comments/view/'.$comment->id)}}" class="btn">View</a>
						<a href="{{URL::to('todos/comments/edit/'.$comment->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('todos/comments/delete/'.$comment->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('todos/comments/create')}}">Create new Todo Comment</a></p>