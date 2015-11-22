<?php $this->extend('layout') ?>

<?php $this->start('body') ?>
	<?php $this->get('admin.header') ?>

<h2>Add book</h2>
<form action="<?= url('book/save') ?>" method="POST" enctype="multipart/form-data">
	<table id="addbook">
		<tr>
			<td>Book title</td>
			<td><input type="text" name="title" autocomplete="off" value="<?=e( input('title') )?>"></td>
		</tr>

		<tr>
			<td>Author</td>
			<td>
				<select name="author">
					<?php $input_a = input('author')?>
					<option value="">select author</option>
					<?php foreach ($authors as $author) : ?>
					<option value="<?=e( $author->id )?>" <?php if ($input_a == $author->id) echo 'selected' ?>>
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
					<?php $input_b = input('publisher')?>
					<option value="">select publisher</option>
					<?php foreach ($publishers as $publisher) : ?>
					<option value="<?=e( $publisher->id )?>" <?php if ($input_b == $publisher->id) echo 'selected' ?>>
						<?=e( $publisher->name )?>
					</option>
					<?php endforeach ?>
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
	<?= form_token() ?>
</form>

<?php $this->get('error.form_error') ?>

</div>
<?php $this->end() ?>