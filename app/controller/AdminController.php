<?php

class AdminController
{
	public function addBook()
	{
		$authors = table('authors')->all();
		$publishers = table('publishers')->all();
		return view('admin.add_book', compact('authors', 'publishers'));
	}

	public function saveBook(Request $request, Validator $validator)
	{
		$request->postOnly();

		$rules = $this->getRules();
		$validator->checkData($request->all(), $rules);

		$file = File::cover();
		$tmp = File::tmp('cover');

		$this->checkFile($validator, $file, $tmp);

		$cover = File::shortName('cover');

		if ($cover == '')
			$cover = 'noimage.jpg';

		$data = $this->getData($request, $cover);

		if ($validator->pass()) {
			table('books')->insert($data);
			move_uploaded_file($tmp, $file);
			$request->clean();
			return redirect();
		}

		Session::set('error', $validator->getErrors());
		return redirect('book/add');
	}

	public function editBook($id)
	{
		$book = table('books')->whereId($id)->first();
		$authors = table('authors')->all();
		$publishers = table('publishers')->all();

		return view('admin.edit_book', compact('book', 'authors', 'publishers'));
	}

	public function saveEditedBook(Request $request, Validator $validator, $id)
	{
		$request->postOnly();

		$rules = $this->getRules();
		$validator->checkData($request->all(), $rules);

		$file = File::cover();
		$tmp = File::tmp('cover');

		$this->checkFile($validator, $file, $tmp);

		$cover = File::shortName('cover');

		if ($cover == '')
			$cover = $request->cover_ori;

		$data = $this->getData($request, $cover);

		if ($validator->pass()) {
			table('books')->update($data, $id);
			move_uploaded_file($tmp, $file);
			$request->clean();
			return redirect();
		}

		Session::set('error', $validator->getErrors());
		return redirect('book/edit/' . $id);
	}

	public function deleteBook($id)
	{
		$this->deleteFile($id);
		table('books')->delete($id);
		return redirect();
	}

	public function deleteImage($id)
	{
		$this->deleteFile($id);
		table('books')->update(['cover' => 'noimage.jpg'], $id);
		return redirect('book/edit/' . $id);
	}

	public function author()
	{
		$authors = table('authors')->all();
		return view('admin.author', compact('authors'));
	}

	protected function getData($request, $cover)
	{
		return [
			'title' => $request->title,
			'author_id' => $request->author,
			'publisher_id' => $request->publisher,
			'price' => $request->price,
			'cover' => $cover
		];
	}

	protected function getRules()
	{
		return ['title' => 'required', 'author' => 'required', 'publisher' => 'required', 'price' => 'required|num'];
	}

	protected function checkFile($validator, $file, $tmp)
	{
		if ($tmp != '') {
			if (!getimagesize($tmp))
				$validator->addErrors('The file must be an image');

			if (file_exists($file))
				$validator->addErrors('The file already exists');
		}
	}

	protected function deleteFile($id)
	{
		$cover = table('books')->whereId($id)->first()->cover;
		if ($cover != 'noimage.jpg')
			File::delete($cover);
	}
}