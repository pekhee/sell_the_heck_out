<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users/view/'.$todo->user->id)}}">User</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('todos')}}">Todos</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Todo</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>User id:</strong>
	{{$todo->user_id}}
</p>
<p>
	<strong>What:</strong>
	{{$todo->what}}
</p>
<p>
	<strong>When:</strong>
	{{$todo->when}}
</p>
<p>
	<strong>Time started:</strong>
	{{$todo->time_started}}
</p>

<section class="row-fluid">
	@foreach($todo->comments as $comment)
		<section>
			<h4>{{ $comment->title }}</h4>
			<p>{{ $comment->body }}</p>
		</section>
	@endforeach
</section>

{{ Form::open('todos/comments/create', 'post', array('class' => 'form-stacked span16')) }}
<fieldset>
	<section class="row-fluid">
		<div class="span4">
			{{ Form::hidden('comment.todo_id', $todo->id, array( 'name' => 'todo_id' )) }}
			{{ Form::label('comment.title', 'Title: ') }}
			{{ Form::text('comment.title', Input::old('comment.title'), array( 'name' => 'title' )) }}
		</div>
		<div class="span8">
			{{ Form::label('comment.body', 'Body: ') }}
			{{ Form::textarea('body', Input::old('comment.title'), array( 'name' => 'body' )) }}
		</div>
		<section class="row-fluid">
			<div class="span8 offset2">
				{{ Form::submit('Send', array('class' => 'btn primary')) }}
			</div>
		</section>
	</section>
</fieldset>
{{ Form::close() }}

<p><a href="{{URL::to('todos/edit/'.$todo->id)}}" class="btn">Edit</a> <a href="{{URL::to('todos/delete/'.$todo->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
