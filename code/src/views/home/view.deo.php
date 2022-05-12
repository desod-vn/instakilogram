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
            echo '<div class="show--image" onclick="showModal(this)" id="' . $posts[$i]['id'] . '">';
            echo '<img id="img-' . $posts[$i]['id'] . '" src="/'. $posts[$i]['src'] .'" alt="' . $posts[$i]['description'] . '" style="width:100%">';
            echo '</div>';
            if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                echo '<div class="d-flex justify-content-center">';
                echo '<a href="/admin/delete/' .  $posts[$i]['id'] . '" class="btn btn-danger">Xóa ảnh</a>';
                echo '</div>';
            }
        }
    ?>

    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>
</div>

<script>
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

function showModal(e) {
    var img = document.getElementById(`img-${e.id}`);
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;
}

span.onclick = function() {
    modal.style.display = "none";
}

</script>