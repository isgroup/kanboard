<div class="task-board color-<?= $task['color_id'] ?> <?= $task['date_modification'] > time() - $board_highlight_period ? 'task-board-recent' : '' ?>" style="padding: 8px;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 0 0 auto;">
            <?= $this->render('board/task_avatar', array('task' => $task)) ?>
        </div>
        
        <div style="flex: 0 0 auto;">
            <?php if (! empty($task['date_due'])): ?>
                <span class="task-date
                    <?php if (time() > $task['date_due']): ?>
                         task-date-overdue
                    <?php elseif (date('Y-m-d') == date('Y-m-d', $task['date_due'])): ?>
                         task-date-today
                    <?php endif ?>
                    " style="font-size: 0.8em;">
                    <i class="fa fa-calendar"></i>
                    <?= explode(" ", $this->dt->datetime($task['date_due']))[0] ?>
                </span>
            <?php endif ?>
        </div>
    </div>
    
    <div class="task-board-header" style="display: flex; align-items: center;">
        <?= $this->url->link('#'.$task['id'], 'TaskViewController', 'readonly', array('task_id' => $task['id'], 'token' => $project['token'])) ?>

        <?php if (! empty($task['owner_id'])): ?>
            <span class="task-board-assignee">
                <?= $this->text->e($task['assignee_name'] ?: $task['assignee_username']) ?>
            </span>
        <?php endif ?>
    </div>

    <?= $this->hook->render('template:board:public:task:before-title', array('task' => $task)) ?>
    <div class="task-board-title">
        <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'readonly', array('task_id' => $task['id'], 'token' => $project['token'])) ?>
    </div>
    <?= $this->hook->render('template:board:public:task:after-title', array('task' => $task)) ?>

    <?= $this->render('board/task_footer', array(
        'task' => $task,
        'not_editable' => $not_editable,
        'project' => $project,
    )) ?>
</div>
