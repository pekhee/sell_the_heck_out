@if(count($categories) == 0)
	<p>No categories.</p>
@else
	<table>
		<thead>
			<tr>
				<th>User Id</th>
				<th>Name</th>
				<th>Description</th>
				<th>Todos</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($categories as $category)
				<tr>
					<td><a href="{{URL::to('users/view/'.$category->id)}}">User #{{$category->user_id}}</a></td>
					<td>{{$category->name}}</td>
					<td>{{$category->description}}</td>
					<td>{{count($category->todos)}}</td>
					<td>
						<a href="{{URL::to('todos/categories/view/'.$category->id)}}" class="btn">View</a>
						<a href="{{URL::to('todos/categories/edit/'.$category->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('todos/categories/delete/'.$category->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('todos/categories/create')}}">Create new Todo Category</a></p>