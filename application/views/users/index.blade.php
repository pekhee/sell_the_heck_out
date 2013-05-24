@if(count($users) == 0)
	<p>No users.</p>
@else
	<table>
		<thead>
			<tr>
				<th>Username</th>
				<th>Password</th>
				<th>Email</th>
				<th>Todos</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{$user->username}}</td>
					<td>{{$user->password}}</td>
					<td>{{$user->email}}</td>
					@if( isset($user->profile))
						<td>
							<a href="{{URL::to_route('users.profile.view', array( 'user_id' => $user->id ))}}">
								{{ $user->username }}'s profile 
							</a>
						</td>
					@else
						<td>
							<a href="{{URL::to_route('users.profile.new', array( 'user_id' => $user->id ))}}">
								Create {{ $user->username }}'s Profile
							</a>
						</td>
					@endif
					<td>{{count($user->ads)}}</td>
					<td>
						<a href="{{URL::to_route('users.view', array( 'user_id' => $user->id ))}}" class="btn">View</a>
						<a href="{{URL::to_route('users.edit', array( 'user_id' => $user->id ))}}" class="btn">Edit</a>
						<a href="{{URL::to_route('users.delete', array( 'user_id' => $user->id ))}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to_route('users.new')}}">Create new User</a></p>