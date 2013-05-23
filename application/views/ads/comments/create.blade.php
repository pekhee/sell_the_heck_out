<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users.view', array( 'user_id' => $user_id ) )}}">
				User
			</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to_route('users.ads.comments', array( 'user_id' => $user_id, 'ad_id' => $ad_id) )}}">
				Ad Comments
			</a> <span class="divider">/</span>
		</li>
		<li class="active">New Ad Comment</li>
	</ul>
</div>

{{Form::open(URL::to_route('users.ads.comments.new', array( 'user_id' => $user_id, 'ad_id' => $ad_id) ), 'POST', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('ad_id', 'Ad Id')}}

			<div class="input">
				{{Form::text('ad_id', Input::old('ad_id', $ad_id), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('title', 'Title')}}

			<div class="input">
				{{Form::text('title', Input::old('title'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('body', 'Body')}}

			<div class="input">
				{{Form::textarea('body', Input::old('body'), array('class' => 'span10'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}