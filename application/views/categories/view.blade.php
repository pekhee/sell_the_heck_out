<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to_route('users.view', array( 'user_id' => object_get($category->user, 'id') ))}}">{{ object_get($category->user,'username', 'User') }}</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to_route('users.categories')}}">Categories</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Category</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>User id:</strong>
	{{$category->user_id}}
</p>
<p>
	<strong>Name:</strong>
	{{$category->name}}
</p>
<p>
	<strong>Description:</strong>
	{{$category->description}}
</p>

<p><a href="{{URL::to_route('users.categories.edit', array( 'category_id' => $category->id ))}}" class="btn">Edit</a> <a href="{{URL::to_route('users.categories.delete', array( 'category_id' => $category->id) )}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>

<?php $owner = $category ?>
@include('partials._ads_list')

<p><a class="btn success" href="{{URL::to_route('users.categories.new')}}">Create new ad in this category</a></p>
