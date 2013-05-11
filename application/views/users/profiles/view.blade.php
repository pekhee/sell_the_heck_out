<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users/view/'.$profile->user->id)}}">User</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('users/profiles')}}">Users Profiles</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Users Profile</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>User id:</strong>
	{{$profile->user_id}}
</p>
<p>
	<strong>Name:</strong>
	{{$profile->name}}
</p>
<p>
	<strong>Last name:</strong>
	{{$profile->last_name}}
</p>
<section>
	<img src="{{ $profile->pic_link }}">
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

<p><a href="{{URL::to('users/profiles/edit/'.$profile->id)}}" class="btn">Edit</a> <a href="{{URL::to('users/profiles/delete/'.$profile->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
