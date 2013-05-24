<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users')}}"> {{ $profile->user->username }}</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to_route('users.profile.new')}}">Profile</a> <span class="divider">/</span>
		</li>
		<li class="active">Edit</li>
	</ul>
</div>

{{Form::open_for_files(URL::to_route('users.profile.edit', array( 'user_id' => $user_id )), 'PUT', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('first_name', 'Name')}}

			<div class="input">
				{{Form::text('first_name', Input::old('first_name', $profile->first_name), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('last_name', 'Last Name')}}

			<div class="input">
				{{Form::text('last_name', Input::old('last_name', $profile->last_name), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="control-group">
			{{ Form::label( 'phone', 'Phone', array( 'class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text( 'phone', Input::old( 'phone', $profile->phone)) }}
			</div>
		</div>
		
		<div class="control-group">
			{{ Form::label( 'place', 'Place', array( 'class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text( 'place', Input::old( 'place', $profile->place)) }}
			</div>
		</div>
	
		<div class="control-group">
			{{ Form::label( 'map', 'Map', array( 'class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text( 'map', Input::old( 'map', $profile->map)) }}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('city', 'City')}}

			<div class="input">
				{{Form::text('city', Input::old('city', $profile->city), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('country', 'Country')}}

			<div class="input">
				{{Form::text('country', Input::old('country', $profile->country), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('time_zone', 'Time Zone')}}

			<div class="input">
				{{Form::text('time_zone', Input::old('time_zone', $profile->time_zone), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('pic', 'Picture')}}

			<div class="input">
				{{Form::file('pic', array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}