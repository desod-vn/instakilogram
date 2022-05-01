<?php $this->view('layouts/header'); ?>
<style>
.card {
    border: none;
    padding: 20px;
    background-color: #1c1e21;
    color: #fff
}
.circle {
    height: 20px;
    width: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #5855e7;
    color: #fff;
    font-size: 10px;
    border-radius: 50%
}
.form-input {
    position: relative;
    margin-bottom: 10px;
    margin-top: 10px
}
.form-control {
    height: 50px;
    background-color: #1c1e21;
    text-indent: 24px;
    color: #fff;
    font-size: 15px
}
.form-control:focus {
    background-color: #25272a;
    box-shadow: none;
    color: #fff;
    border-color: #4f63e7
}
.form-check-label {
    margin-top: 2px;
    font-size: 14px
}
.signup {
    height: 50px;
    font-size: 14px
}
</style>

<div class="container-xl">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-6">
        <?php
            if (isset($message)) {
                echo '<div class="alert alert-info">' . $message . '</div>';
            }
        ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="card px-5 py-5">
                    <span class="circle"></span>
                    <h5 class="mt-3">Đăng ký tài khoản<br />và chia sẻ những bức hình tuyệt vời ngay thôi</h5> 
                    <small class="mt-2 text-muted">
                        Điền đẩy đủ thông tin và tiến hành đăng ký tài khoản
                    </small>
                    <div class="form-input">
                        <input type="text" name="email" class="form-control" placeholder="Địa chỉ email">
                    </div>
                    <div class="form-input">
                        <input type="text" name="lastname" class="form-control" placeholder="Họ">
                    </div>
                    <div class="form-input">
                        <input type="text" name="firstname" class="form-control" placeholder="Tên">
                    </div>
                    <div class="form-input">
                        <label for="avatar" class="mb-2">Chọn ảnh đại diện</label>
                        <br />
                        <input type="file" name="avatar" class="form-control-file" id="avatar" accept="image/*">
                    </div>
                    <div class="form-input">
                        <input type="text" name="password" class="form-control" placeholder="Mật khẩu">
                    </div>
                    <div class="form-input">
                        <input type="text" class="form-control" placeholder="Nhập lại mật khẩu">
                    </div>
                    <input type="submit" class="btn btn-primary mt-4 signup" value="Đăng ký tài khoản" />
                    <input type="reset" class="btn btn-danger mt-4 signup" value="Xóa hết thông tin" />
                    <div class="text-center mt-4">
                        <span>Bạn đã có tài khoản?</span>
                        <a href="/home/login/" class="text-decoration-none">Đăng nhập</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->view('layouts/footer'); ?>