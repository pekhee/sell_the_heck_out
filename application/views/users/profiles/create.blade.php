<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('users/profiles')}}">Users Profiles</a> <span class="divider">/</span>
		</li>
		<li class="active">New Users Profile</li>
	</ul>
</div>

{{Form::open_for_files(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('name', 'Name')}}

			<div class="input">
				{{Form::text('name', Input::old('name'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('last_name', 'Last Name')}}

			<div class="input">
				{{Form::text('last_name', Input::old('last_name'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('city', 'City')}}

			<div class="input">
				{{Form::text('city', Input::old('city'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('country', 'Country')}}

			<div class="input">
				{{Form::text('country', Input::old('country'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('time_zone', 'Time Zone')}}

			<div class="input">
				{{Form::text('time_zone', Input::old('time_zone'), array('class' => 'span6'))}}
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