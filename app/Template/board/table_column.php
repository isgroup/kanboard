<!-- column titles -->

<?= $this->hook->render('template:board:table:column:before-header-row', array('swimlane' => $swimlane)) ?>

<tr class="board-swimlane-columns-<?= $swimlane['id'] ?>">
    <?php foreach ($swimlane['columns'] as $column): ?>
    <th class="board-column-header board-column-header-<?= $column['id'] ?>" data-column-id="<?= $column['id'] ?>">
        <!-- column in expanded mode -->
        <div class="board-column-expanded board-column-expanded-header">
            <?php if (! $not_editable && $this->projectRole->canCreateTaskInColumn($column['project_id'], $column['id'])): ?>
                <?= $this->task->getNewBoardTaskButton($swimlane, $column) ?>
            <?php endif ?>

            <span class="board-column-title">
                <?= $this->text->e($column['title']) ?>
            </span>
            <?= $this->hook->render('template:board:column:header', array('swimlane' => $swimlane, 'column' => $column)) ?>
        </div>
    </th>
    <?php endforeach ?>
</tr>

<?= $this->hook->render('template:board:table:column:after-header-row', array('swimlane' => $swimlane)) ?>
