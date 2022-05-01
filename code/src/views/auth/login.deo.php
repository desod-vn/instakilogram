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
            <div class="card px-5 py-5">
                <span class="circle"></span>
                <h5 class="mt-3">Đăng nhập<br /></h5> 
                <small class="mt-2 text-muted">Điền đẩy đủ thông tin để tiến hành đăng nhập</small>
                <div class="form-input">
                    <input type="text" class="form-control" placeholder="Địa chỉ email">
                </div>
                <div class="form-input">
                    <input type="text" class="form-control" placeholder="Mật khẩu">
                </div>
                <button class="btn btn-primary mt-4 signup">Đăng nhập</button>
                <div class="text-center mt-4">
                    <span>Bạn chưa có tài khoản?</span>
                    <a href="/home/register/" class="text-decoration-none">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->view('layouts/footer'); ?>
