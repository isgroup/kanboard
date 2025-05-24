<?php $_title = $this->render('header/title', array(
    'project' => isset($project) ? $project : null,
    'task' => isset($task) ? $task : null,
    'description' => isset($description) ? $description : null,
    'title' => $title,
)) ?>

<?php $_top_right_corner = implode('&nbsp;', array(
        $this->render('header/user_notifications'),
        $this->render('header/creation_dropdown'),
        $this->render('header/user_dropdown')
    )) ?>

<header>
    <div class="title-container">
        <?= $_title ?>
    </div>
    <div class="menus-container">
        <?= $_top_right_corner ?>
    </div>
</header>
