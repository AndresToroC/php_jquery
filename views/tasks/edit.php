<div class="hidden" id="modal_edit_task">
	<div class="fixed z-10 inset-0 overflow-y-auto">
		<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
			<div class="fixed inset-0 transition-opacity">
				<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
			</div>
			<span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
			<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
				<form id="form_edit_task" action="#">
					<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
						<div class="sm:flex sm:items-start">
							<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
								<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
									Editar tarea
								</h3>
								<div class="mt-3">
									<div class="grid grid-cols-6 gap-6">
										<input type="hidden" name="id_edit" id="id_edit">
										<div class="col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-6">
											<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
												Nombre
											</label>
											<input id="name_edit" type="text" name="name_edit" class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight" placeholder="Tarea">
										</div>
										<div class="col-span-6 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-6">
											<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
												Descripción
											</label>
											<textarea id="description_edit" type="text" name="description_edit" class="block w-full bg-gray-200 text-gray-700 resize border border-red-500 rounded py-4 px-1 mb-3 focus:outline-none focus:shadow-outline"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
						<span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
							<button type="button" onClick="update()" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
								Actualizar
							</button>
						</span>
						<span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
							<button type="button" onClick="closeModalEdit()" id="close_modal_edit" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
								Cerrar
							</button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>