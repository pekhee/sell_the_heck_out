@if(count($ads) == 0)
	<p>No ads.</p>
@else
	<table>
		<thead>
			<tr>
				<th>User Id</th>
				<th>Good ID</th>
				<th>Good type</th>
				<th>Category IDs</th>
				<th>Title</th>
				<th>Links of images</th>
				<th>Description</th>
				<th>Price</th>
				<th>Number of visits</th>
				<th>Promotions</th>
				<th>Price type</th>
				<th>Offer type</th>
				<th>Seller type</th>

			</tr>
		</thead>

		<tbody>
			@foreach($ads as $ad)
				<tr>
					<td><a href="{{URL::to_route('users.ads.view', array( 'user_id' => object_get($ad, 'user_id', '1'), 'ad_id' => $ad->id ) )}}">User #{{ object_get($ad, 'user_id', 'unknown')}}</a></td>
					<td>{{$ad->good_id}}</td>
					<td>{{$ad->good_type}}</td>
					<td>{{$ad->category_ids}}</td>
					<td>{{$ad->title}}</td>
					<td>{{$ad->img_links}}</td>
					<td>{{$ad->description}}</td>
					<td>{{$ad->price}}</td>
					<td>{{$ad->num_visits}}</td>
					<td>{{$ad->promotions}}</td>
					<td>{{$ad->price_type}}</td>
					<td>{{$ad->offer_type}}</td>
					<td>{{$ad->seller_type}}</td>
					<td>
						<a href="{{URL::to_route('users.ads.view', array('user_id' => object_get($ad, 'user_id', '1'), 'ad_id' => $ad->id))}}" class="btn">View</a>
						<a href="{{URL::to_route('users.ads.edit', array('user_id' => object_get($ad, 'user_id', '1'), 'ad_id' => $ad->id))}}" class="btn">Edit</a>
						<a href="{{URL::to_route('users.ads.delete', array('user_id' => object_get($ad, 'user_id', '1'), 'ad_id' => $ad->id))}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
				@foreach($ad->comments as $comment)
				<tr>
					<td colspan="2">
						{{ $comment->title }}
					</td>
					<td colspan="3">
						{{ $comment->body }}
					</td>				
				</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to_route('users.ads.new', array('user_id' => object_get(Auth::user(), 'id', 1) ))}}">Create new Ad</a></p>