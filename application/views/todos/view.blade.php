<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users/view/'.$todo->user->id)}}">User</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('todos')}}">Todos</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Todo</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>User id:</strong>
	{{$todo->user_id}}
</p>
<p>
	<strong>What:</strong>
	{{$todo->what}}
</p>
<p>
	<strong>When:</strong>
	{{$todo->when}}
</p>
<p>
	<strong>Time started:</strong>
	{{$todo->time_started}}
</p>

<p><a href="{{URL::to('todos/edit/'.$todo->id)}}" class="btn">Edit</a> <a href="{{URL::to('todos/delete/'.$todo->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
