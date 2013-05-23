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
					</td>
					<td>
						@if ( $pre->get('categories.parent' . $category->id) )
							Parent Name{{ $pre->get('categories.parent' . $category->id)->name }}
						@endif
					</td>
					<td>
						@if ( !is_null( $pre->get('categories.children' . $category->id) ))
							Number of children: {{ count($children) }}
							@foreach ($category->children() as $child)
								<a href="{{URL::to_route('users.categories.view', array( 'category_id' => $category->id ) )}}">
									{{ $child->name }}
								</a>
							@endforeach

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