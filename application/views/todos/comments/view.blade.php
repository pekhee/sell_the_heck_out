<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users/view/'.$comment->user->id)}}">User</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('todos/comments')}}">Todo Comments</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Todo Comment</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Todo id:</strong>
	{{$comment->todo_id}}
</p>
<p>
	<strong>User id:</strong>
	{{$comment->user_id}}
</p>
<p>
	<strong>Title:</strong>
	{{$comment->title}}
</p>
<p>
	<strong>Body:</strong>
	{{$comment->body}}
</p>

<p><a href="{{URL::to('todos/comments/edit/'.$comment->id)}}" class="btn">Edit</a> <a href="{{URL::to('todos/comments/delete/'.$comment->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
