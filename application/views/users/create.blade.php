<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li class="active">New User</li>
	</ul>
</div>

{{Form::open(URL::to_route('users.new'), 'POST', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('username', 'Username')}}

			<div class="input">
				{{Form::text('username', Input::old('username'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('password', 'Password')}}

			<div class="input">
				{{Form::text('password', Input::old('password'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('email', 'Email')}}

			<div class="input">
				{{Form::text('email', Input::old('email'), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}