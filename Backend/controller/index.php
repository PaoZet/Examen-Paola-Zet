<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <!-- CSS de Materialize -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .task-completed {
            text-decoration: line-through;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="center-align">To-Do List</h1>

        <form id="taskForm" class="row">
            <div class="input-field col s6">
                <input type="text" id="taskTitle" required>
                <label for="taskTitle">Nombre</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id="taskDescription">
                <label for="taskDescription">Descripcion</label>
            </div>
            <div class="input-field col s12">
                <button type="submit" class="btn waves-effect waves-light">Anadir</button>
                <button type="button" id="cancelButton" class="btn waves-effect waves-light red hide">Cancelar</button>
            </div>
        </form>

        <table class="highlight">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody id="taskList"></tbody>
        </table>
    </div>

    <!-- JS de Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        const form = document.getElementById('taskForm');
        const taskList = document.getElementById('taskList');
        let editingTaskId = null;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const title = document.getElementById('taskTitle').value;
            const description = document.getElementById('taskDescription').value;

            if (editingTaskId) {
                // Update task
                await fetch(`./api.php/tasks/${editingTaskId}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ title, description, status: false })
                });
                editingTaskId = null;
            } else {
                // Add new task
                await fetch('./api.php/tasks', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ title, description })
                });
            }

            form.reset();
            loadTasks();
        });

        async function loadTasks() {
            taskList.innerHTML = '';
            const response = await fetch('./api.php/tasks');
            const tasks = await response.json();

            tasks.forEach(task => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="${task.status ? 'task-completed' : ''}">${task.title}</td>
                    <td class="${task.status ? 'task-completed' : ''}">${task.description || 'No Description'}</td>
                    <td>${task.status ? 'Completed' : 'Pending'}</td>
                    <td>
                        <button class="btn yellow" onclick="showUpdateForm(${task.id}, '${task.title}', '${task.description}')">Update</button>
                        <button class="btn red" onclick="deleteTask(${task.id})">Delete</button>
                    </td>
                `;
                taskList.appendChild(row);
            });
        }

        async function deleteTask(id) {
            await fetch(`./api.php/tasks/${id}`, { method: 'DELETE' });
            loadTasks();
        }

        function showUpdateForm(id, title, description) {
            editingTaskId = id;
            document.getElementById('taskTitle').value = title;
            document.getElementById('taskDescription').value = description;

            const cancelButton = document.getElementById('cancelButton');
            cancelButton.classList.remove('hide');

            cancelButton.onclick = () => {
                editingTaskId = null;
                cancelButton.classList.add('hide');
                form.reset();
            };
        }

        window.onload = loadTasks;
    </script>
</body>
</html>