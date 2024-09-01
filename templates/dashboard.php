<div class="wrap collabpress-dashboard">
    <h1>CollabPress 🚀</h1>

    <!-- Add Task Form -->
    <div class="card">
        <h2>Add New Task</h2>
        <form id="add-task-form">
            <input type="text" name="task_name" placeholder="Task name" required>
            <textarea name="description" placeholder="Description"></textarea>
            <input type="text" name="assigned_to" placeholder="Assign to (e.g., user@example.com)">
            <input type="date" name="due_date">
            <select name="status">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
            <button type="submit" class="button button-primary">Add Task</button>
        </form>
    </div>

    <!-- Task List -->
    <div class="card">
        <h2>Tasks</h2>
        <table id="tasks-table">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tasks will be populated here via JavaScript -->
            </tbody>
        </table>
    </div>
</div>