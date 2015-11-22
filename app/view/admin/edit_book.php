@extend('layout')

@start('body')
	@get('admin.header')

<h2>Edit book</h2>
<form action="{! url('book/edited/' . $book->id) !}" method="POST" enctype="multipart/form-data">
	<table id="addbook">
		<tr>
			<td>Book title</td>
			<td><input type="text" name="title" autocomplete="off" value="{{ $book->title }}"></td>
		</tr>

		<tr>
			<td>Author</td>
			<td>
				<select name="author">
					<option value="">select author</option>
					@foreach ($authors as $author)
					<option value="{{ $author->id }}" <?php if ($book->author_id == $author->id) echo 'selected="selected"' ?>>
						{{ $author->name }}
					</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>Publisher</td>
			<td>
				<select name="publisher">
					<option value="">select publisher</option>
					@foreach ($publishers as $publisher)
					<option value="{{ $publisher->id }}" <?php if ($book->publisher_id == $publisher->id) echo 'selected="selected"' ?>>
						{{ $publisher->name }}
					</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>Book price</td>
			<td><input type="text" name="price" autocomplete="off" value="{{ $book->price }}"></td>
		</tr>

		<tr>
			<td>Book cover</td>
			<td>
				<div id="edit-img">{{ img($book->cover) }} <a href="{! url('book/image/' . $book->id) !}" class="red"><i class="fa fa-trash-o red"></i> delete image</a></div>
				<input type="file" name="cover">
				<input type="hidden" name="cover_ori" value="{{ $book->cover }}">
			</td>
		</tr>

	</table>

	<button class="btn-b">Save</button>
	{! form_token() !}
</form>

@get('error.form_error')

</div>
@end