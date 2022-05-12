<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            for ($i = 0; $i < count($users['data']); $i++) {
                if (strlen($users['data'][$i]) < 10) {
                    continue;
                } else {
                    $user = explode(';', $users['data'][$i]);
                    echo '<tr>';
                    echo '<td>' . $i + 1 . '</td>';
                    echo '<td>' . str_replace('email=', '', $user[0]) . '</td>';
                    echo '<td>' . str_replace('lastname=', '', $user[1]) . '</td>';
                    echo '<td>' . str_replace('firstname=', '', $user[2]) . '</td>';
                    echo '<td><a href="/admin/find/' . str_replace('email=', '', $user[0]) . '">Đổi mật khẩu</a></td>';
                    echo '</tr>';
                }
            }
        ?>
    </tbody>
</table>
<nav aria-label="Page navigation">
  <ul class="pagination">
    <?php
        if($users['currentPage'] > 1) {
    ?>
        <li class="page-item">
            <a class="page-link" href="/admin/<?php echo $users['currentPage'] - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
    <?php 
        }
    ?>
    <li class="page-item active">
        <a class="page-link" href="#">
        <?php 
            echo $users['currentPage'];
        ?>
        <span class="sr-only">(current)</span></a>
    </li>
    <?php
        if($users['currentPage'] < ceil($users['all'] / $users['perPage'])) {
    ?>
        <li class="page-item">
            <a class="page-link" href="/admin/<?php echo $users['currentPage'] + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    <?php 
        }
    ?>
  </ul>
</nav>