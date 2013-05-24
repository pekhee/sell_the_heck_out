<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users.view', array( 'user_id' => object_get($category->user,'id', null) ))}}">{{ object_get($category->user,'username', 'User') }}</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to_route('users.categories')}}">Categories</a> <span class="divider">/</span>
		</li>
		<li class="active">Editing {{ $category->name }} Category</li>
	</ul>
</div>

{{Form::open(URL::to_route('users.categories.edit', array( 'user_id' => $category->id )), 'PUT', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('name', 'Name')}}

			<div class="input">
				{{Form::text('name', Input::old('name', $category->name), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('description', 'Description')}}

			<div class="input">
				{{Form::textarea('description', Input::old('description', $category->description), array('class' => 'span10'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}