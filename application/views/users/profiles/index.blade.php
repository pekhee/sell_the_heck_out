@if(count($profiles) == 0)
	<p>No profiles.</p>
@else
	<table>
		<thead>
			<tr>
				<th>User Id</th>
				<th>Name</th>
				<th>Last Name</th>
				<th>City</th>
				<th>Country</th>
				<th>Time Zone</th>
				<th>Pic Link</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($profiles as $profile)
				<tr>
					<td><a href="{{URL::to('users/view/'.$profile->id)}}">User #{{$profile->user_id}}</a></td>
					<td>{{$profile->name}}</td>
					<td>{{$profile->last_name}}</td>
					<td>{{$profile->city}}</td>
					<td>{{$profile->country}}</td>
					<td>{{$profile->time_zone}}</td>
					<td>{{$profile->pic_link}}</td>
					<td>
						<a href="{{URL::to('users/profiles/view/'.$profile->id)}}" class="btn">View</a>
						<a href="{{URL::to('users/profiles/edit/'.$profile->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('users/profiles/delete/'.$profile->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('users/profiles/create')}}">Create new Users Profile</a></p>