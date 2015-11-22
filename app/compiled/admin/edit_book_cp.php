<?php $this->extend('layout') ?>

<?php $this->start('body') ?>
	<?php $this->get('admin.header') ?>

<h2>Edit book</h2>
<form action="<?= url('book/edited/' . $book->id) ?>" method="POST" enctype="multipart/form-data">
	<table id="addbook">
		<tr>
			<td>Book title</td>
			<td><input type="text" name="title" autocomplete="off" value="<?=e( $book->title )?>"></td>
		</tr>

		<tr>
			<td>Author</td>
			<td>
				<select name="author">
					<option value="">select author</option>
					<?php foreach ($authors as $author) : ?>
					<option value="<?=e( $author->id )?>" <?php if ($book->author_id == $author->id) echo 'selected="selected"' ?>>
						<?=e( $author->name )?>
					</option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Publisher</td>
			<td>
				<select name="publisher">
					<option value="">select publisher</option>
					<?php foreach ($publishers as $publisher) : ?>
					<option value="<?=e( $publisher->id )?>" <?php if ($book->publisher_id == $publisher->id) echo 'selected="selected"' ?>>
						<?=e( $publisher->name )?>
					</option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Book price</td>
			<td><input type="text" name="price" autocomplete="off" value="<?=e( $book->price )?>"></td>
		</tr>

		<tr>
			<td>Book cover</td>
			<td>
				<div id="edit-img"><?=e( img($book->cover) )?> <a href="<?= url('book/image/' . $book->id) ?>" class="red"><i class="fa fa-trash-o red"></i> delete image</a></div>
				<input type="file" name="cover">
				<input type="hidden" name="cover_ori" value="<?=e( $book->cover )?>">
			</td>
		</tr>

	</table>

	<button class="btn-b">Save</button>
	<?= form_token() ?>
</form>

<?php $this->get('error.form_error') ?>

</div>
<?php $this->end() ?>