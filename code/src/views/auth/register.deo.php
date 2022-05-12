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
                    <h5 class="mt-3">Register the account<br />and share more images</h5> 
                    <small class="mt-2 text-muted">
                        Please type infomations to register
                    </small>
                    <div class="form-input">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-input">
                        <input type="text" name="lastname" class="form-control" placeholder="Last name" required>
                    </div>
                    <div class="form-input">
                        <input type="text" name="firstname" class="form-control" placeholder="First name" required>
                    </div>
                    <div class="form-input my-4">
                        <label for="avatar" class="mb-2">Choose avatar</label>
                        <br />
                        <input type="file" name="avatar" class="form-control-file" id="avatar" accept="image/*" required>
                    </div>
                    <div class="form-input">
                        <input type="password" id="ps" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-input">
                        <input type="password" id="ps2" class="form-control" placeholder="Confirm password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" id="submit" class="btn btn-primary mt-4 signup" value="Register" />
                        <input type="reset" class="btn btn-danger signup" value="Reset" />
                    </div>
                    <div class="text-center mt-4">
                        <span>Already have account?</span>
                        <a href="/home/login/" class="text-decoration-none">Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->view('layouts/footer'); ?>

<script>
    var ps = document.getElementById("ps")
    var ps2 = document.getElementById("ps2")
    var submit = document.getElementById("submit")

    submit.onmouseenter = function() {
        if(!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}/.test(ps.value)) {
            alert("Invalid password, password between 8 and 20 characters. Password contains at least 1 uppercase letter, 1 lowercase letter and 1 character");
        }
        if (ps.value != ps2.value) {
            alert("Please type same password");
        }
    }

</script>