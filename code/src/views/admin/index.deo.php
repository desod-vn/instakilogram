<?php $this->view('layouts/header'); ?>
<?php 
    if (isset($_SESSION['admin']) && !$_SESSION['admin']) {
        $this->backHome();
    }
?>
<div class="container" style="padding: 0 10%;">
    <?php
        if (isset($message)) {
            echo '<div class="alert alert-info">' . $message . '</div>';
        }
        if (isset($error)) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    ?>
    <h1 class="text-center mb-5">Manage Users</h1>
    <?php $this->view('admin/user', [
        'users' => $users
    ]); ?>

    <?php
        $this->view('home/view', [
            'posts' => $posts
        ]);
    ?>
</div>
<?php $this->view('layouts/footer'); ?>