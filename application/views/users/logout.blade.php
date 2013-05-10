{{ Form::open(null, 'post', array('class' => 'form-stacked span16') ) }}
	<div class="row-fluid">
		<div class="hero offset2 span8">
			<h1>Are you sure, do you want to log-out?</h1>
			<p>Todomaniac, is a simple todo noting system.</p>
		</div>
	</div>
	<div class="row-fluid">
		<div class="offset2 span8">
			<fieldset>
				<div class="row-fluid">
					<div class="input">
						{{Form::hidden('null', Input::old('null'), array('class' => 'span6'))}}
					</div>
					<div class="actions">
						{{Form::submit('Save', array('class' => 'btn primary'))}}

						or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
{{ Form::close() }}