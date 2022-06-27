<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('partials/navbar') ?>

<div class="container my-4">
    <video src="/uploads/video/<?= esc( $video['video'] ) ?>" controls width="100%"></video>
    <div class="my-4">
        <button class="btn btn-primary" type="submit">Like</button>
        <button class="btn btn-primary" type="submit">Souscrire</button>
    </div>
    <div>
        <h5 class="text-uppercase">
            Description : <br>
        </h5>
        <p class="fw-bold">
         <?= $video['description'] ?>
        </p>
    </div>
</div>


<?= $this->endSection() ?>