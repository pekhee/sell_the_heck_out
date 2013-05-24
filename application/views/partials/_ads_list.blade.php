<h2>Ads</h2>

@if(count($owner->ads) == 0)
	<p>No Ads.</p>
@else
	<table>
		<thead>
			<th>Title</th>
			<th>Description</th>
			<th>Price</th>
			<th>Image links</th>
		</thead>

		<tbody>
			@foreach($owner->ads as $ad)
				<tr>
					<td>{{$ad->title}}</td>
					<td>{{$ad->description}}</td>
					<td>{{$ad->price}}</td>
					<td>{{$ad->img_links}}</td>
					<td>
						<a href="{{URL::to_route('users.ads.view', array( 'user_id' => $ad->user_id, 'ad_id' => $ad->id ))}}">
							View
						</a>
					 	<a href="{{URL::to_route('users.ads.edit', array( 'user_id' => $ad->user_id, 'ad_id' => $ad->id ))}}">
					 		Edit
					 	</a> 
					 	<a href="{{URL::to_route('users.ads.delete', array( 'user_id' => $ad->user_id, 'ad_id' => $ad->id ))}}">
					 		Delete
					 	</a>
					 </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif