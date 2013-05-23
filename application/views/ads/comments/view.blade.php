<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users.view', array( 'user_id' => $comment->user_id ) )}}">User</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to_route('users.ads.comments', array( 'user_id' => $comment->user_id, 'ad_id' => $comment->ad_id) )}}">Ad Comments</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Ad Comment</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Todo id:</strong>
	{{$comment->ad_id}}
</p>
<p>
	<strong>User id:</strong>
	{{$comment->user_id}}
</p>
<p>
	<strong>Title:</strong>
	{{$comment->title}}
</p>
<p>
	<strong>Body:</strong>
	{{$comment->body}}
</p>

<p>
	<a href="{{URL::to_route('users.ads.comments.edit', array( 'user_id' => $comment->user_id, 'ad_id' => $comment->ad_id, 'comment_id' => $comment->id))}}" class="btn">
		Edit
	</a>
	
	<a href="{{URL::to_route('users.ads.comments.delete', array( 'user_id' => $comment->user_id, 'ad_id' => $comment->ad_id, 'comment_id' => $comment->id))}}" class="btn danger" onclick="return confirm('Are you sure?')">
		Delete
	</a>
</p>
