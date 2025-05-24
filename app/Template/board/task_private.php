<div class="
        task-board
        <?= $task['is_draggable'] ? 'draggable-item ' : '' ?>
        <?= $task['is_active'] == 1 ? 'task-board-status-open '.($task['date_modification'] > (time() - $board_highlight_period) ? 'task-board-recent' : '') : 'task-board-status-closed' ?>
        color-<?= $task['color_id'] ?>"
     style="padding: 8px 8px 6px 8px;"
     data-task-id="<?= $task['id'] ?>"
     data-column-id="<?= $task['column_id'] ?>"
     data-swimlane-id="<?= $task['swimlane_id'] ?>"
     data-position="<?= $task['position'] ?>"
     data-owner-id="<?= $task['owner_id'] ?>"
     data-category-id="<?= $task['category_id'] ?>"
     data-due-date="<?= $task['date_due'] ?>"
     data-task-url="<?= $this->url->href('TaskViewController', 'show', array('task_id' => $task['id'])) ?>">

    <div class="task-board-sort-handle" style="display: none;"><i class="fa fa-arrows-alt"></i></div>

    <?php if ($this->board->isCollapsed($task['project_id'])): ?>
        <div class="task-board-collapsed">
            <div class="task-board-saving-icon" style="display: none;"><i class="fa fa-spinner fa-pulse"></i></div>
            <?php if (! empty($task['assignee_username'])): ?>
                <span title="<?= $this->text->e($task['assignee_name'] ?: $task['assignee_username']) ?>">
                    <?= $this->text->e($this->user->getInitials($task['assignee_name'] ?: $task['assignee_username'])) ?>
                </span> -
            <?php endif ?>
            <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id']), false, '', $this->text->e($task['title'])) ?>
        </div>
    <?php else: ?>
        <div class="task-board-expanded">
            <div class="task-board-saving-icon" style="display: none;"><i class="fa fa-spinner fa-pulse fa-2x"></i></div>
            <div class="task-board-header" style="display: flex; align-items: center;">
                <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
                    <?php if ($this->projectRole->canUpdateTask($task)): ?>
                        <?= $this->hook->render('template:board:private:task:before-title', array('task' => $task)) ?>
                        <?= $this->modal->large('', $this->text->e($task['title']), 'TaskModificationController', 'edit', array('task_id' => $task['id'])) ?>
                        <?= $this->hook->render('template:board:private:task:after-title', array('task' => $task)) ?>
                    <?php endif ?>
                <?php else: ?>
                    <strong><?= '#'.$task['id'] ?></strong>
                    <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'])) ?>
                <?php endif ?>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 5px;">
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
            
            <?= $this->render('board/task_footer', array(
                'task' => $task,
                'not_editable' => $not_editable,
                'project' => $project,
            )) ?>
        </div>
    <?php endif ?>
</div>
