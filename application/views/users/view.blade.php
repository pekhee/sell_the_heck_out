<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing User</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Username:</strong>
	{{$user->username}}
</p>
<p>
	<strong>Password:</strong>
	{{$user->password}}
</p>
<p>
	<strong>Email:</strong>
	{{$user->email}}
</p>

<p><a href="{{URL::to('users/edit/'.$user->id)}}" class="btn">Edit</a> <a href="{{URL::to('users/delete/'.$user->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
<h2>Todos</h2>

@if(count($user->todos) == 0)
	<p>No todos.</p>
@else
	<table>
		<thead>
			<th>What</th>
			<th>When</th>
			<th>Time Started</th>
			<th></th>
		</thead>

		<tbody>
			@foreach($user->todos as $todos)
				<tr>
					<td>{{$todos->what}}</td>
					<td>{{$todos->when}}</td>
					<td>{{$todos->time_started}}</td>
					<td><a href="{{URL::to('todos/view/'.$todos->id)}}">View</a> <a href="{{URL::to('todos/edit/'.$todos->id)}}">Edit</a> <a href="{{URL::to('todos/delete/'.$todos->id)}}">Delete</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('todos/create/'.$user->id)}}">Create new todos</a></p>
