<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users.view',  array( 'user_id' => object_get($ad->user, 'id', '1') ) )}}"> {{object_get($ad->user, 'username', 'User')}} </a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to_route('users.ads', array( 'user_id' => object_get($ad->user, 'id', '1') ) )}}">Ads</a> <span class="divider">/</span>
		</li>
		<li class="active">Editing Ad</li>
	</ul>
</div>

{{Form::open(URL::to_route('users.ads.edit', array( 'user_id' => object_get($ad->user, 'id', '1'), 'ad_id' => $ad->id) ), 'PUT', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('user_id', 'User Id')}}

			<div class="input">
				{{Form::text('user_id', Input::old('user_id', $ad->user_id), array('class' => 'span6'))}}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('good_id', 'ID of goods type: ')}}
		
			<div class="input">
				{{Form::text('good_id', Input::old('good_id', object_get($ad, 'good_id', '0')), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="clearfix">
			{{Form::label('good_type', 'Type of goods: ')}}
		
			<div class="input">
				{{Form::text('good_type', Input::old('good_type', object_get($ad, 'good_type', 'typeless')), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="clearfix">
			{{Form::label('title', 'Title: ')}}
		
			<div class="input">
				{{Form::text('title', Input::old('title', object_get($ad, 'title', '')), array('class' => 'span6'))}}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('img_links', 'Links of images: ')}}
		
			<div class="input">
				{{Form::text('img_links', Input::old('img_links', object_get($ad, 'img_links', '')), array('class' => 'span6'))}}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('description', 'Description: ')}}
		
			<div class="input">
				{{Form::text('description', Input::old('description', object_get($ad, 'description', '')), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="clearfix">
			{{Form::label('category_ids', 'IDS of categories: ')}}
		
			<div class="input">
				{{Form::text('category_ids', Input::old('category_ids', object_get($ad, 'category_ids', '')), array('class' => 'span6'))}}
			</div>
		</div>
		
		
		<div class="clearfix">
			{{Form::label('price', 'Price: ')}}
		
			<div class="input">
				{{Form::text('price', Input::old('price', object_get($ad, 'price', '')), array('class' => 'span6'))}}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('num_visits', 'Number of visits: ')}}
		
			<div class="input">
				{{Form::text('num_visits', Input::old('num_visits', object_get($ad, 'num_visits', '')), array('class' => 'span6'))}}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('promotions', 'Promotions: ')}}
		
			<div class="input">
				{{Form::text('promotions', Input::old('promotions', object_get($ad, 'promotions', '')), array('class' => 'span6'))}}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('price_type', 'Type of price: ')}}
		
			<div class="input">
				{{Form::text('price_type', Input::old('price_type', object_get($ad, 'price_type', '')), array('class' => 'span6'))}}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('offer_type', 'Type of offer: ')}}
		
			<div class="input">
				{{Form::text('offer_type', Input::old('offer_type', object_get($ad, 'offer_type', '')), array('class' => 'span6'))}}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('seller_type', 'Type of seller: ')}}
		
			<div class="input">
				{{Form::text('seller_type', Input::old('seller_type', object_get($ad, 'seller_type', '')), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}