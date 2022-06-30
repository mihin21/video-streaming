<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('partials/navbar') ?>
<div class="container pt-4">
	<?php if (isset($validation)) : ?>
		<div class="alert alert-danger">
			<?= $validation->listErrors() ?>
		</div>
	<?php endif; ?>
	<?php if (session()->get('success')) : ?>
		<div class="alert alert-success">
			<?= session()->get('success') ?>
		</div>
	<?php endif; ?>
	<div class="row">
		<form action="<?= route_to('storeVideos') ?>" method="post" enctype="multipart/form-data">
			<div class="form-group my-2">
				<label for="video">Choisir une video</label>
				<input type="file" class="form-control" name="video" id="">
			</div>
			<div class="form-group">
				<label for="image">Choisir une image</label>
				<input type="file" class="form-control" name="image" id="">
			</div>
			<div class="form-group pt-2">
				<label for="description">Description</label>
				<textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
			</div>
			<div class="form-group my-2">
				<button type="submit" class="btn btn-primary">
					Enregistrer
				</button>
			</div>
		</form>
	</div>

	<div class="row my-3">
		<?php if(empty($videos))  : ?>
			<div class="alert alert-danger">
				Aucune video disponible !!
			</div>
		<?php endif ; ?>
		<?php foreach($videos as $video) : ?>
				<div class="col">
					<div class="card" style="width: 18rem;">
						<img src="/uploads/image/<?= esc($video['image']) ?>" class="card-img-top" alt="" height="150px">
						<div class="card-body">
							<h5 class="card-title">Description</h5>
							<p class="card-text"><?= esc($video['description']) ?></p>
							<a href="/video/<?= esc($video['upload_id']) ?>" class="btn btn-primary">Regarder</a>
						</div>
					</div>
				</div>
		<?php endforeach ; ?>	
	</div>
</div>
<?= $this->endSection() ?>