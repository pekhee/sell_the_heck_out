<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users.view',  array( 'user_id' => $profile->user_id ))}}"> {{ $profile->user->username }} </a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to_route('users.profile.view',  array( 'user_id' => $profile->user_id ))}}">Profile</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Your Profile</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>User id:</strong>
	{{$profile->user_id}}
</p>
<p>
	<strong>Name:</strong>
	{{$profile->first_name}}
</p>
<p>
	<strong>Last name:</strong>
	{{$profile->last_name}}
</p>
<p>
	<strong>Phone</strong>
	{{$profile->phone}}
</p>
<p>
	<strong>Place</strong>
	{{$profile->place}}
</p>
<p>
	<strong>Map</strong>
	{{$profile->map}}
</p>
<section>
	<img src="{{ $profile->img_link }}">
</section>
<p>
	<strong>City:</strong>
	{{$profile->city}}
</p>
<p>
	<strong>Country:</strong>
	{{$profile->country}}
</p>
<p>
	<strong>Time zone:</strong>
	{{$profile->time_zone}}
</p>
<p>
	<strong>Pic link:</strong>
	{{$profile->pic_link}}
</p>

<p>
	<a href="{{URL::to_route('users.profile.edit', array( 'user_id' => $profile->user_id ))}}" class="btn">
		Edit
	</a>
	<a href="{{URL::to_route('users.profile.delete', array( 'user_id' => $profile->user_id ))}}" class="btn danger" onclick="return confirm('Are you sure?')">
		Delete
	</a>
</p>
