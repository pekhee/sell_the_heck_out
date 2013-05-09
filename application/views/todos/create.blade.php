<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('todos')}}">Todos</a> <span class="divider">/</span>
		</li>
		<li class="active">New Todo</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('user_id', 'User Id')}}

			<div class="input">
				{{Form::text('user_id', Input::old('user_id', $user_id), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('what', 'What')}}

			<div class="input">
				{{Form::textarea('what', Input::old('what'), array('class' => 'span10'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('when', 'When')}}

			<div class="input">
				{{Form::text('when', Input::old('when'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('time_started', 'Time Started')}}

			<div class="input">
				{{Form::text('time_started', Input::old('time_started'), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}