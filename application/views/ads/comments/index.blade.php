@if(count($comments) == 0)
	<p>No comments.</p>
@else
	<table>
		<thead>
			<tr>
				<th>Ad Id</th>
				<th>User Id</th>
				<th>Title</th>
				<th>Body</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($comments as $comment)
				<tr>
					<td><a href="{{URL::to_route('users.ads.view', array( 'user_id' => $comment->user_id, 'ad_id' => $comment->ad_id))}}">Ad #{{$comment->ad_id}}</a></td>
					<td><a href="{{URL::to_route('users.view', array( 'user_id' => $comment->user_id))}}">User #{{$comment->user_id}}</a></td>
					<td>{{$comment->title}}</td>
					<td>{{$comment->body}}</td>
					<td>
						<a href="{{URL::to_route('users.ads.comments.view', array( 'user_id' => $comment->user_id, 'ad_id' => $comment->ad_id, 'comment_id' => $comment->id))}}" class="btn">
							View
						</a>
						
						<a href="{{URL::to_route('users.ads.comments.edit', array( 'user_id' => $comment->user_id, 'ad_id' => $comment->ad_id, 'comment_id' => $comment->id))}}" class="btn">
							Edit
						</a>
						
						<a href="{{URL::to_route('users.ads.comments.delete', array( 'user_id' => $comment->user_id, 'ad_id' => $comment->ad_id, 'comment_id' => $comment->id))}}" class="btn danger" onclick="return confirm('Are you sure?')">
							Delete
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p>
	<a class="btn success" href="{{URL::to_route('users.ads.comments.new', array( 'user_id' => $user_id, 'ad_id' => $ad_id))}}">
		Create new Comment
	</a>
</p>