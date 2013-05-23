<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users.view', array( 'user_id' => object_get($ad->user, 'id', '1') ) )}}">{{object_get($ad->user, 'username', 'User')}}</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to_route('users.ads', array( 'user_id' => object_get($ad->user, 'id', '1') ) )}}">Ads</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Ad</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>User id:</strong>
	{{$ad->user_id}}
</p>
<p>
	<strong>Good Type:</strong>
	{{$ad->good_type}}
</p>
<p>
	<strong>Good ID:</strong>
	{{$ad->good_id}}
</p>
<p>
	<strong>category IDs:</strong>
	{{$ad->category_ids}}
</p>
<p>
	<strong>Title:</strong>
	{{$ad->title}}
</p>
<p>
	<strong>Links of images:</strong>
	{{$ad->img_links}}
</p>
<p>
	<strong>Description:</strong>
	{{$ad->description}}
</p>
<p>
	<strong>Price:</strong>
	{{$ad->price}}
</p>
<p>
	<strong>Number of visits:</strong>
	{{$ad->num_visits}}
</p>
<p>
	<strong>Promotions:</strong>
	{{$ad->promotions}}
</p>
<p>
	<strong>Type of price:</strong>
	{{$ad->price_type}}
</p>
<p>
	<strong>Type of offer:</strong>
	{{$ad->offer_type}}
</p>
<p>
	<strong>Type of seller:</strong>
	{{$ad->seller_type}}
</p>

<section class="row-fluid">
	@foreach($ad->comments as $comment)
		<section>
			<h4>{{ $comment->title }}</h4>
			<p>{{ $comment->body }}</p>
		</section>
	@endforeach
</section>

{{ Form::open(URL::to_route('users.ads.comments.new', array( 'user_id' => object_get($ad->user, 'id', '1'), 'ad_id' => $ad->id) ), 'POST', array('class' => 'form-stacked span16')) }}
<fieldset>
	<section class="row-fluid">
		<div class="span4">
			{{ Form::hidden('comment.ad_id', $ad->id, array( 'name' => 'ad_id' )) }}
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

<p><a href="{{URL::to_route('users.ads.edit', array( 'user_id' => object_get($ad->user, 'id', '1'), 'ad_id' => $ad->id ) )}}" class="btn">Edit</a> <a href="{{URL::to_route('users.ads.delete', array( 'user_id' => object_get($ad->user, 'id', '1'), 'ad_id' => $ad->id ) )}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
