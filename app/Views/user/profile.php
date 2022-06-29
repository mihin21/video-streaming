<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('partials/navbar') ?>


<div class="container-lg my-4 ">

    <div class="row justify-content-center">
        
        <div class="col-md-5">
            <?php if(empty($getUser->image)) : ?>
                <img src="/uploads/image/user.png" width="75%" alt="">
            <?php else: ?>
                ffqdfq
            <?php endif;?>        
        </div>
        <div class="col-md-5">
            <h1>
                <div class="fw-bold"><?= esc($getUser->username) ?></div>
                <div class="fw-bold text-muted"><?= esc($getUser->email) ?></div>
            </h1>
            <form action="" method="post" enctype="multipart/form-data">
               <div class="card">
                    <div class=" form-control p-3">
                            <div class="form-group">
                                <label for="username">Identifiant</label>
                                <input type="text" name="username" class="form-control my-2" value="<?= esc($getUser->username) ?>" id="">
                            </div>
                    
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control  my-2" value="<?= esc($getUser->email) ?>" id="">
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control  my-2">
                            </div>

                           <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" name="password" class="form-control my-2" placeholder="Saisir mot de passe" id="">
                           </div>

                           <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    Modifier
                                </button>
                           </div>
                        </div>
                    </div>
               </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>