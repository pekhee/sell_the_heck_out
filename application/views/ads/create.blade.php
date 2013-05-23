<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('todos')}}">Todos</a> <span class="divider">/</span>
		</li>
		<li class="active">New Todo</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('good_id', 'ID of goods type: ')}}

			<div class="input">
				{{Form::text('good_id', Input::old('good_id'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('good_type', 'Goods tpye: ')}}

			<div class="input">
				{{Form::text('good_type', Input::old('good_type'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('title', 'Title: ')}}
		
			<div class="input">
				{{Form::text('title', Input::old('title'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('img_links', 'Image Links: ')}}
		
			<div class="input">
				{{Form::text('img_links', Input::old('img_links'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('description', 'Description: ')}}
		
			<div class="input">
				{{Form::textarea('description', Input::old('description'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('category_ids', 'IDS of categories: ')}}
		
			<div class="input">
				{{Form::text('category_ids', Input::old('category_ids'), array('class' => 'span6'))}}
			</div>
		</div>
		
		<div class="clearfix">
			{{Form::label('price', 'Price: ')}}
		
			<div class="input">
				{{Form::text('price', Input::old('price'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('num_visits', 'Number Of Visits: ')}}
		
			<div class="input">
				{{Form::text('num_visits', Input::old('num_visits'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('promotions', 'Promotions: ')}}
		
			<div class="input">
				{{Form::text('promotions', Input::old('promotions'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('price_type', 'Type of your price: ')}}
		
			<div class="input">
				{{Form::text('price_type', Input::old('price_type'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('offer_type', 'Your offer type: ')}}
		
			<div class="input">
				{{Form::text('offer_type', Input::old('offer_type'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('seller_type', 'seller Type: ')}}
		
			<div class="input">
				{{Form::text('seller_type', Input::old('seller_type'), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}