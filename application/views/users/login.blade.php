{{ Form::open(null, 'post', array('class' => 'form-stacked span16') ) }}
	<div class="row-fluid">
		<div class="hero offset2 span8">
			<h1>Please log-in</h1>
			<p>Todomaniac, is a simple todo noting system.</p>
		</div>
	</div>
	<div class="row-fluid">
		<div class="offset2 span8">
			<fieldset>
				<div class="row-fluid">
					<div class="clearfix">
						{{Form::label('username', 'User Name: ')}}

						<div class="input">
							{{Form::text('username', Input::old('username'), array('class' => 'span6'))}}
						</div>
					</div>
				
					<div class="clearfix">
						{{Form::label('password', 'User Name: ')}}

						<div class="input">
							{{Form::text('password', Input::old('password'), array('class' => 'span6'))}}
						</div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
{{ Form::close() }}