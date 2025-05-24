<div class="page-header">
    <h2><?= $this->text->e($project['name']) ?> &gt; <?= $this->text->e($task['title']) ?></h2>
</div>
<form method="post" action="<?= $this->url->href('TaskModificationController', 'update', array('task_id' => $task['id'])) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>

    <div class="task-form-container">
        <div class="task-form-main-column">
            <?= $this->task->renderTitleField($values, $errors) ?>
            <?= $this->task->renderDescriptionField($values, $errors) ?>
            <?= $this->task->renderDescriptionTemplateDropdown($project['id']) ?>
            <?= $this->hook->render('template:task:form:first-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-secondary-column">
            <?= $this->task->renderColorField($values) ?>
            <?= $this->task->renderAssigneeField($users_list, $values, $errors) ?>
            <?= $this->hook->render('template:task:form:second-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-secondary-column">
            <?php 
            // Imposta l'ora di default a 09:30 se non è già impostata
            if (!isset($values['date_started']) || empty($values['date_started'])) {
                // Usa il formato data e ora dell'applicazione
                $dateFormat = $this->app->dateParser->getUserDateFormat();
                $timeFormat = $this->app->dateParser->getUserTimeFormat();
                $values['date_started'] = date($dateFormat).' '.date('H:i', strtotime('09:30'));
            }
            
            // Imposta l'ora di default a 18:30 per la data di scadenza se non è già impostata
            if (!isset($values['date_due']) || empty($values['date_due'])) {
                // Usa il formato data dell'applicazione
                $dateFormat = $this->app->dateParser->getUserDateFormat();
                $timeFormat = $this->app->dateParser->getUserTimeFormat();
                $values['date_due'] = date($dateFormat).' '.date('H:i', strtotime('18:30'));
            }
            ?>
            <?= $this->task->renderStartDateField($values, $errors) ?>
            <?= $this->task->renderDueDateField($values, $errors) ?>
            <?= $this->hook->render('template:task:form:third-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-bottom">

            <?= $this->hook->render('template:task:form:bottom-before-buttons', array('values' => $values, 'errors' => $errors)) ?>

            <?= $this->modal->submitButtons() ?>
        </div>
    </div>
</form>
