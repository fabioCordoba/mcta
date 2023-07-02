<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modal-Cuenta" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Cuenta</h1>
            <button type="button" class="btn-close" wire:click="closeModal('Cuenta')"  aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if ($errors->any())
                   <div class="alert alert-warning" role="alert">
                       <strong class="font-bold">Error!</strong>
                       <ul>
                           @foreach ($errors->all() as $error)
                               <li>{{$error}}</li>
                           @endforeach
                       </ul>
                       </span>
                   </div>
                   <br>
               @endif

                <form action="">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Davivienda" wire:model="nombre">
                            </div>
    
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="email" class="form-control" id="descripcion" placeholder="Cuenta de Nomina" wire:model="descripcion">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary text-gray-700" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary text-blue-700" wire:click="store" wire:loading.attr="disabled">Save changes</button>
            </div>
        </div>
        </div>
    </div>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Descripcion
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        {{-- Action --}}
                        <button class="rounded-full bg-red-500" data-bs-toggle="modal" data-bs-target="#modal-Cuenta">
                            <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Agregar</span> 
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($cuentas->count() > 0)
                    @foreach ($cuentas as $item)
                        <tr class="bg-white border-b text-gray-900">
                            <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                {{$item->nombre}}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                {{$item->user->name}}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                {{$item->descripcion}}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                {{$item->estado}}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                <button class="rounded-full font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="abrirModal({{$item->id}}, 'Cuenta')">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </button>
                                <button class="rounded-full font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="delCta({{$item->id}})">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        
                    @endforeach
                    
                @endif
            </tbody>
        </table>
    </div>
  

</div>
