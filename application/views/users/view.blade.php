<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users')}}">Users</a> <span class="divider">/</span>
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

<p>
	<a href="{{URL::to_route('users.edit', array( 'user_id' => $user->id ))}}" class="btn">
		Edit
	</a> 
	<a href="{{URL::to_route('users.delete', array( 'user_id' => $user->id ))}}" class="btn danger" onclick="return confirm('Are you sure?')">
		Delete
	</a>
</p>

<?php $owner = $user ?>
@include('partials._ads_list')

<p><a class="btn success" href="{{URL::to_route('users.ads.new', array( 'user_id' => $user->id))}}">Create a new Ad</a></p>
