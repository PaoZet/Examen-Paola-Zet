# Examen-Paola-Zet
Aplicacion To-Do List

Instrucciones para ejecutar la aplicación To-Do List
Introducción
Esta aplicación es un sistema simple de gestión de tareas, o "To-Do List". Permite a los usuarios agregar, listar, actualizar y eliminar tareas. A continuación, se detallan los pasos necesarios para configurar y ejecutar la aplicación, así como cómo utilizarla.

1. Requisitos previos
Antes de comenzar, asegúrese de tener lo siguiente instalado en su computadora:

Servidor web (como Apache o Nginx) para alojar la aplicación.
PHP (versión 7.4 o superior) para ejecutar el código.
MySQL (o MariaDB) para almacenar las tareas.

2. Base de datos
Importar la Base de Datos Existente
La base de datos ya está creada y se proporcionará un archivo SQL que contiene la estructura y los datos necesarios. Para importar la base de datos, sigue estos pasos:

Abre tu herramienta de gestión de bases de datos como phpMyAdmin o un cliente MySQL.
Selecciona la base de datos examenfinal.
Busque la opción "Importar" y elija el archivo SQL proporcionado.
Haga clic en "Ejecutar" o "Importar" para cargar la estructura y los datos en la base de datos.

3. Archivos del Proyecto
La aplicación está compuesta por varios archivos importantes:

3.1db.php
Este archivo se encarga de conectar la aplicación a la base de datos. Contiene la información necesaria (como el nombre de la base de datos, el usuario y la contraseña) para que la aplicación pueda acceder y almacenar las tareas correctamente.

3.2index.php
Este es el archivo que presenta la interfaz de usuario. Aquí, los usuarios pueden ver la lista de tareas, agregar nuevas tareas y realizar acciones sobre las existentes. Es el punto de entrada para interactuar con la aplicación a través del navegador.

3.3api.php
Este archivo funciona como el backend de la aplicación. Maneja las operaciones sobre las tareas (agregar, obtener, actualizar y eliminar) cuando se envían solicitudes desde la interfaz. Es donde se gestionan los datos de las tareas en la base de datos.

4. Ejecutar la aplicación
Ubica los Archivos : Asegúrate de que db.php, index.phpy api.phpestén en la misma carpeta dentro de la raíz de tu servidor web (por ejemplo, en htdocsde MAMP o XAMPP).

Inicia el Servidor : Asegúrate de que el servidor web esté en funcionamiento y que el servicio de MySQL también esté activo.

Acceda a la Aplicación : Abra un navegador web y visite http://localhost/index.php(o la ruta correspondiente donde se guardarán los archivos).

5. Usar la aplicación
Agregar tareas
En la interfaz de index.php, complete los campos para el título y la descripción de la tarea.
Haz clic en el botón "Add Task" para guardar la tarea en la base de datos.
Listar tareas
Las tareas que se han agregado aparecerán automáticamente en la tabla en la misma página.
Actualizar Tareas
Para modificar una tarea existente, seleccione la opción de actualización que aparece junto a cada tarea.
Eliminar tareas
Para borrar una tarea, haga clic en el botón de eliminar al lado de la tarea correspondiente.
Consultar Todas las Tareas Completadas
Las tareas completadas se pueden obtener haciendo una solicitud mediante GET a http://localhost/api.php/tasks. Esto devolverá una lista de todas las tareas en formato JSON, pero esta acción puede realizarse generalmente a través del código sin interacción directa del usuario.

6. Notas importantes
Si encuentras algún problema al conectarte a la base de datos, verifica que las credenciales en db.phpsean correctas.
La aplicación incluye manejo de errores, por lo que si algo falla, se mostrarán mensajes para ayudarle a entender qué ha sucedido.

7. Conclusión
Esta aplicación es un ejemplo básico de cómo gestionar tareas utilizando PHP y MySQL. Puedes expandirla y mejorarla según tus necesidades, agregando características como autenticación de usuarios, validación de datos y una interfaz más sofisticada.
