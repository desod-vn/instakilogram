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
                    <h5 class="mt-3">Change Avatar</h5> 
                    <small class="mt-2 text-muted">
                        Please choose image < 5 MB. Allow (.jpg, jpeg, png)
                    </small>
                    <div class="form-input my-4">
                        <label for="avatar" class="mb-2">Choose avatar</label>
                        <br />
                        <input type="file" name="avatar" class="form-control-file" id="avatar" accept="image/*" required>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-primary mt-4 signup" value="Change Avatar" />
                    </div>
                </div>
            </form>
            <div class="mt-5 d-flex justify-content-center align-items-center">
                <a href="/home/logout" class="btn btn-danger signup">Log out</a>
            </div>
        </div>
    </div>
</div>
<?php $this->view('layouts/footer'); ?>