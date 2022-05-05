<div class="header">
  <h1>Danh sách hình ảnh mới nhất</h1>
</div>

<div class="row">
  <?php
    for ($i = 0; $i < count($posts); $i++) {
        if ($i == 0) {
            echo '<div class="column">';
        }
        if ($i == 8 || $i == 16 || $i == 24) {
            echo '</div><div class="column">';
        }
        if ($i == 32) {
            echo '</div>';
        }
        echo '<div class="show--image"><img src="/'. $posts[$i]["src"] .'" style="width:100%"></div>';
    }
    ?>