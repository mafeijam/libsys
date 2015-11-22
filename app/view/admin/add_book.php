@extend('layout')

@start('body')
	@get('admin.header')

<h2>Add book</h2>
<form action="{! url('book/save') !}" method="POST" enctype="multipart/form-data">
	<table id="addbook">
		<tr>
			<td>Book title</td>
			<td><input type="text" name="title" autocomplete="off" value="{{ input('title') }}"></td>
		</tr>

		<tr>
			<td>Author</td>
			<td>
				<select name="author">
					<?php $input_a = input('author')?>
					<option value="">select author</option>
					@foreach ($authors as $author)
					<option value="{{ $author->id }}" <?php if ($input_a == $author->id) echo 'selected' ?>>
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
					<?php $input_b = input('publisher')?>
					<option value="">select publisher</option>
					@foreach ($publishers as $publisher)
					<option value="{{ $publisher->id }}" <?php if ($input_b == $publisher->id) echo 'selected' ?>>
						{{ $publisher->name }}
					</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>Book price</td>
			<td><input type="text" name="price" autocomplete="off"></td>
		</tr>

		<tr>
			<td>Book cover</td>
			<td><input type="file" name="cover"></td>
		</tr>

	</table>

	<button class="btn-b">Save</button>
	{! form_token() !}
</form>

@get('error.form_error')

</div>
@end