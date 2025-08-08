<?php if (session('validation')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session('validation')->listErrors() ?>
    </div>
    <br />
<?php endif; ?>