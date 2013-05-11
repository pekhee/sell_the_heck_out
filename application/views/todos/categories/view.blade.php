<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users/view/'.$category->user->id)}}">User</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('todos/categories')}}">Todo Categories</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Todo Category</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>User id:</strong>
	{{$category->user_id}}
</p>
<p>
	<strong>Name:</strong>
	{{$category->name}}
</p>
<p>
	<strong>Description:</strong>
	{{$category->description}}
</p>

<p><a href="{{URL::to('todos/categories/edit/'.$category->id)}}" class="btn">Edit</a> <a href="{{URL::to('todos/categories/delete/'.$category->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
<h2>Todos</h2>

@if(count($category->todos) == 0)
	<p>No todos.</p>
@else
	<table>
		<thead>
			<th>User Id</th>
			<th>What</th>
			<th>When</th>
			<th>Time Started</th>
			<th></th>
		</thead>

		<tbody>
			@foreach($category->todos as $todo)
				<tr>
					<td>{{$todo->user_id}}</td>
					<td>{{$todo->what}}</td>
					<td>{{$todo->when}}</td>
					<td>{{$todo->time_started}}</td>
					<td><a href="{{URL::to('todos/view/'.$todo->id)}}">View</a> <a href="{{URL::to('todos/edit/'.$todo->id)}}">Edit</a> <a href="{{URL::to('todos/delete/'.$todo->id)}}">Delete</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('todos/create/'.$category->id)}}">Create new todo</a></p>
