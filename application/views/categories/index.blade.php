@if(count($categories) == 0)
	<p>No categories.</p>
@else
	<table>
		<thead>
			<tr>
				<th>User ID</th>
				<th>Parent ID</th>
				<th>Parent</th>
				<th>Children</th>
				<th>Name</th>
				<th>Description</th>
				<th>Ads</th>
			</tr>
		</thead>

		<tbody>
			@foreach($categories as $category)
				<tr>
					<td><a href="{{URL::to_route('users.view', array('user_id' => $category->user_id))}}">
							User #{{$category->user_id}}
						</a>
					</td>
					<td>
						{{$category->parent_id}}
					</td><?php $parent = object_get($category, 'parent'); $children = object_get($category, 'children') ?>
					<td>
						@if (!is_null($parent))
							{{ $parent->name }}
						@endif
					</td>
					<td>
						@if ( count($children) > 0 )
							Number of children: {{ count($children) }}
							<ul>
								@foreach ($children as $child)
									<li><a href="{{URL::to_route('users.categories.view', array( 'category_id' => $category->id ) )}}">
										{{ $child->name }}
									</a></li>
								@endforeach
							</ul>
						@endif
					</td>
					<td>
						{{$category->name}}
					</td>
					<td>
						{{$category->description}}
					</td>
					<td>
						{{count($category->ads)}}
					</td>
					<td>
						<a href="{{URL::to_route('users.categories.view', array( 'category_id' => $category->id ) )}}" class="btn">
							View
						</a>
						<a href="{{URL::to_route('users.categories.edit', array( 'category_id' => $category->id) )}}" class="btn">
							Edit
						</a>
						<a href="{{URL::to_route('users.categories.delete', array( 'category_id' => $category->id) )}}" class="btn danger" onclick="return confirm('Are you sure?')">
							Delete
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to_route('users.categories.new')}}">Create a new Category</a></p>