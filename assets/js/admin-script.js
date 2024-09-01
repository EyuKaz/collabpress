jQuery(document).ready(function($) {
    // Submit task form
    $('#add-task-form').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.post(collabpress_ajax.ajaxurl, {
            action: 'collabpress_save_task',
            data: formData
        }, function(response) {
            alert('Task added!');
            $('#add-task-form')[0].reset();
            loadTasks();
        });
    });

    // Load tasks on page load
    loadTasks();

    function loadTasks() {
        $.get(collabpress_ajax.ajaxurl, {
            action: 'collabpress_get_tasks'
        }, function(tasks) {
            let html = '';
            tasks.forEach(task => {
                html += `
                    <tr>
                        <td>${task.task_name}</td>
                        <td>${task.status}</td>
                        <td>${task.due_date}</td>
                        <td><button class="delete-task" data-id="${task.id}">Delete</button></td>
                    </tr>
                `;
            });
            $('#tasks-table tbody').html(html);
        });
    }

    // Delete task
    $(document).on('click', '.delete-task', function() {
        const taskId = $(this).data('id');
        $.post(collabpress_ajax.ajaxurl, {
            action: 'collabpress_delete_task',
            id: taskId
        }, function(response) {
            loadTasks();
        });
    });
});