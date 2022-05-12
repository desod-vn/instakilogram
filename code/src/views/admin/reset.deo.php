<?php $this->view('layouts/header'); ?>

<div class="container-xl">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-6">
            <?php
                if (isset($message)) {
                    echo '<div class="alert alert-info">' . $message . '</div>';
                }
                if (isset($error)) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
            ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="card--black px-5 py-5">
                    <span class="circle"></span>
                    <h5 class="mt-3">RESET PASSWORD: <?php echo $email; ?></h5> 
                    <div class="form-input">
                        <input type="text" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary mt-4 signup">RESET</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->view('layouts/footer'); ?>
