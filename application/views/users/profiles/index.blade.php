@if(count($profiles) == 0)
	<p>No profile.</p>
@else
	<table>
		<thead>
			<tr>
				<th>User Id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Phone</th>
				<th>Place</th>
				<th>Map</th>
				<th>Timezone</th>
				<th>Country</th>
				<th>City</th>
				<th>Image link</th>
			</tr>
		</thead>

		<tbody>
			@foreach($profiles as $profile)
				<tr>
					<td>
						<a href="{{URL::to_route('users.view', array( 'user_id' => $profile->user_id ))}}">
							{{$profile->first_name}} {{$profile->last_name}}
						</a>
					</td>
					<td>{{$profile->first_name}}</td>
					<td>{{$profile->last_name}}</td>
					<td>{{$profile->phone}}</td>
					<td>{{$profile->place}}</td>
					<td>{{$profile->map}}</td>
					<td>{{$profile->time_zone}}</td>
					<td>{{$profile->country}}</td>
					<td>{{$profile->city}}</td>
					<td>{{$profile->img_link}}</td>
					<td>
						<a href="{{URL::to_route('users.profile.view', array( 'user_id' => $profile->user_id ))}}" class="btn">
							View
						</a>
						<a href="{{URL::to_route('users.profile.edit', array( 'user_id' => $profile->user_id ))}}" class="btn">
							Edit
						</a>
						<a href="{{URL::to_route('users.profile.delete', array( 'user_id' => $profile->user_id ))}}" class="btn danger" onclick="return confirm('Are you sure?')">
							Delete
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to_route('users.profile.new',  array( 'user_id' => $profile->user_id ))}}">Create a new Profile</a></p>