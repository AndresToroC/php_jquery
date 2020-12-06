<?php
	include './create.php';
	include './edit.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
    <!-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> -->
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
</head>
<body>
	<div>
		<nav class="bg-gray-800">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="flex items-center justify-between h-16">
					<div class="flex items-center">
						<div class="flex-shrink-0">
							<img class="h-8 w-8" src="../../resources/img/logo.svg" alt="Workflow logo">
						</div>
						<div class="hidden md:block">
							<div class="ml-10 flex items-baseline space-x-4">
								<a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Tareas</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<header class="bg-white shadow">
			<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
				<h1 class="text-3xl font-bold leading-tight text-gray-900">
					Tareas
				</h1>
			</div>
		</header>
		<main>
			<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
				<div class="px-4 py-6 sm:px-0">
					<div class="flex flex-col">
						<div class="grid grid-cols-3 gap-4">
							<div class="col-end-12">
								<button id="add_task" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
									Agregar tarea
								</button>
							</div>
						</div>
						<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 mt-4">
							<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-6">
                                    <table id="table-tasks">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
												<th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>    
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<script>
		// Listar datos
        $(document).ready( function () {
            $("#table-tasks").DataTable({
				"ajax": {
					url: "../../controllers/TaskController.php?tasks=listAll",
					type: "post",
					error: function(e) {
						console.log(e);
					},
				},
				"responsive": true,
				"language": {
					"emptyTable": "No se encontraron datos",
					"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
					"infoEmpty": "Mostrando 0 a 0 de 0 registros",
					"search": "Buscar:",
					"loadingRecords": "Cargando...",
					"processing": "Procesando...",
					"lengthMenu": "Mostrando _MENU_ registros",
					"zeroRecords": "No se encontraron registros",
					"infoFiltered": "",
					"paginate": {
						"first": "Primero",
						"last": "Ultimo",
						"next": "Siguiente",
						"previous": "Anterior"
					},
				}
			});
        } );


		// Modal create
		$('#add_task').on('click', function() {
			if (modal_create.className == 'hidden') {
				modal_create.className = 'block';
			}
		})


		let modal_create = document.getElementById('modal_create_task');
		var modal_edit = document.getElementById('modal_edit_task');

		// Crear tarea
		function create() {
			let name = $('#name').val();
			let description = $('#description').val();

			task = {
				'name': name,
				'description': description
			};

			$.post('../../controllers/TaskController.php?tasks=create', {task: task}, function(data, success) {
				$('#table-tasks').DataTable().ajax.reload();
				Swal.fire(
					'Se ha agregado correctamente',
					'',
					'success'
				);

				closeModalCreate();
			});
		}

		// Cerrar modal de crear tarea
		function closeModalCreate() {
				if (modal_create.className == 'block') {
					modal_create.className = 'hidden';
				}
		}

		// Actualizar tarea
		function edit($id) {
			$.post('../../controllers/TaskController.php?tasks=edit', {task_id: $id}, function(data, status) {
				data = JSON.parse(data);
				$('#id_edit').val(data.id);
				$('#name_edit').val(data.name);
				$('#description_edit').val(data.description);
			})
			
			if (modal_edit.className == 'hidden') {
				modal_edit.className = 'block';
			}
		}

		function update() {
			let id = $('#id_edit').val();
			let name = $('#name_edit').val();
			let description = $('#description_edit').val();

			task = {
				'id': id,
				'name': name,
				'description': description
			};

			$.post('../../controllers/TaskController.php?tasks=update', {task: task}, function(data, success) {
				$('#table-tasks').DataTable().ajax.reload();
				Swal.fire(
					'Se ha actualizado correctamente',
					'',
					'success'
				);
				closeModalEdit();
			});
		}

		// Cerrar modal de editar tarea
		function closeModalEdit() {
			if (modal_edit.className == 'block') {
				modal_edit.className = 'hidden';
			}
		}

		// Eliminar tarea
		function deletet($id) {
			Swal.fire({
				title: 'Eliminar',
				text: "¿Estas seguro de eliminar este registro?",
				icon: 'error',
				cancelButtonText: '<span>Cancelar</span>',
				confirmButtonText: 'Confirmar',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
			}).then((result) => {
				if (result.isConfirmed) {
					$.post('../../controllers/TaskController.php?tasks=delete', {task_id: $id}, function(data, status) {
						$('#table-tasks').DataTable().ajax.reload();
						Swal.fire('Registro eliminado', '', 'success');
					})
				}
			})
		}
    </script>
</body>
</html>