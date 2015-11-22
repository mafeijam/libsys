@extend('layout')

@start('body')
	@get('admin.header')

	<div id="addbook"><a href="{! url('book/add') !}" class="btn-b"><i class="fa fa-plus mr-5"></i>add book</a></li></div>
	<h2>Book list</h2>
	<table>
	<tr>
		<th>Cover</th><th>Title</th><th>Author</th><th>Publisher</th><th>Price</th><th>Action</th>
	</tr>

	@foreach ($books as $book)
	<tr>
		<td>{{ img($book->cover) }}</td>
		<td>{{ $book->title }}</td>
		<td>{{ relate('authors', $book->author_id)->name }}</td>
		<td>{{ relate('publishers', $book->publisher_id)->name }}</td>
		<td>${{ $book->price }}</td>
		<td><i class="fa fa-pencil-square-o greed"></i> <a href="{! url('book/edit/' . $book->id) !}" class="greed">edit</a> | <i class="fa fa-trash-o red"></i>
		<a href="{! url('book/delete/' . $book->id) !}" class="red">delete</a></td>
	</tr>
	@endforeach

	</table>

</div>

@end