@extend('layout')

@start('body')
	@get('admin.header')
	<div id="addbook"><a href="{! url('author/add') !}" class="btn-b"><i class="fa fa-plus mr-5"></i>add author</a></li></div>
	<h2>Author list</h2>
	<table id="author-table">
		<tr>
			<th>Name</th><th>Action</th>
		</tr>
		@foreach ($authors as $author)
		<tr>
			<td>{{ $author->name }}</td>
			<td><i class="fa fa-pencil-square-o greed"></i> <a href="{! url('auhtor/edit/' . $author->id) !}" class="greed">edit</a> | <i class="fa fa-trash-o red"></i>
		<a href="{! url('auhtor/delete/' . $author->id) !}" class="red">delete</a></td>
		</tr>
		@endforeach
	</table>

@end