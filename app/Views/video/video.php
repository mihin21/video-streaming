<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('partials/navbar') ?>

<div class="container my-4">
    <video src="/uploads/video/<?= esc($video['video']) ?>" controls width="100%"></video>
    <div class="my-4">
 
            <?php if($like_user['user_id']) :?>
                <a href="/like/<?= esc($video['upload_id']) ?>">
                    <button class="btn btn-primary" type="submit">Like</button>
                </a>
            <?php endif; ?>

        <span class="fw-bold">
            <?= esc($likes) ?> likes ||
        </span>    
        <?php if($video['user_id'] == auth()->user()->id) :?>
            <?php elseif($subscribe_user['user_id']  == auth()->user()->id) :?>
                <?php else:?>  
          <a href="/subscribe/<?= esc($video['upload_id']) ?>">
            <button class="btn btn-primary" type="submit">Souscrire</button>
          </a>
        <?php endif; ?>

        <span class="fw-bold">
            <?= esc($subscribe_count) ?> Abonnés
        </span> 
    </div>
    <div>
    <div class="my-2">
        Ajouter par : <?= esc($video['username']) ?>
    </div>
    Depuis : <h6><?php
            use CodeIgniter\I18n\Time;
            use Fluent\Auth\Facades\Auth;
            $time = Time::parse(esc($video['created_at']));
            echo $time->humanize();
            ?>
        </h6>
    </div>
    <div>
        <h5 class="text-uppercase">
            Description : <br>
        </h5>
        <p class="fw-bold">
            <?= esc($video['description']) ?>
        </p>
    </div>

    <hr>
      <b>Commentaire:</b>  <br> 
      <?php foreach($comments as $comment)  :?>
        <p class="fw-bolder"><?= esc($comment['username']) ?></p>  <p><?= esc($comment['comment']) ?></p>
      <?php endforeach; ?>
    <hr>

    <?php if(Auth::check()) : ?>
        <?php if (session()->get('success')) : ?>
            <div class="alert alert-success">
                <?= session()->get('success') ?>
            </div>
	    <?php endif; ?>
            <form action="" method="post">
            <div class="form-group">
                <label class="fw-bold text-uppercase" for="commentaire">Commentaire</label>
                <input type="text" class="form-control" name="comment"  placeholder='Entrer votre commentaire'>
                <input type="hidden"  name="user_id" value="<?= Auth::user()->id ?>">
                <button class="btn btn-primary my-2 text-white" type="submit">Commenter</button>
            </div>
        </form>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>