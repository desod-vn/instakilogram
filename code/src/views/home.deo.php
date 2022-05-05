<?php $this->view('layouts/header'); ?>
<div class="container" style="padding: 0 10%;">
    <?php
        if (isset($message)) {
            echo '<div class="alert alert-info">' . $message . '</div>';
        }
        if (isset($error)) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    ?>
    <?php 
        if (isset($_SESSION['email'])) {
            $this->view('home/post'); 
        }
    ?>
    <?php 
        $this->view('home/view', [
            'posts' => $posts
        ]);
    ?>
</div>
<?php $this->view('layouts/footer'); ?>