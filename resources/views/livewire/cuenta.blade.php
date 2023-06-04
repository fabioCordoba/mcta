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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled">Save changes</button>
            </div>
        </div>
        </div>
    </div>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descripcion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{-- Action --}}
                        <button class="rounded-full bg-red-500" data-bs-toggle="modal" data-bs-target="#modal-Cuenta">Agragar</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($cuentas->count() > 0)
                    @foreach ($cuentas as $item)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->nombre}}
                            </th>
                            <td class="px-6 py-4">
                                {{$item->user->name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$item->descripcion}}
                            </td>
                            <td class="px-6 py-4">
                                {{$item->estado}}
                            </td>
                            <td class="px-6 py-4">
                                <button class="rounded-full font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="abrirModal({{$item->id}}, 'Cuenta')">Edit</button>
                                <button class="rounded-full font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="delCta({{$item->id}})">Del</button>
                            </td>
                        </tr>
                        
                    @endforeach
                    
                @endif
            </tbody>
        </table>
    </div>
  

</div>
