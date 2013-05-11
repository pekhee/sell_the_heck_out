<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users/view/'.$comment->user->id)}}">User</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('todos/comments')}}">Todo Comments</a> <span class="divider">/</span>
		</li>
		<li class="active">Editing Todo Comment</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('todo_id', 'Todo Id')}}

			<div class="input">
				{{Form::text('todo_id', Input::old('todo_id', $comment->todo_id), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('title', 'Title')}}

			<div class="input">
				{{Form::text('title', Input::old('title', $comment->title), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('body', 'Body')}}

			<div class="input">
				{{Form::textarea('body', Input::old('body', $comment->body), array('class' => 'span10'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}