<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modal-Movimiento" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Movimineto</h1>
            <button type="button" class="btn-close" wire:click="closeModal('Movimiento')"  aria-label="Close"></button>
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
                                <label for="nombre" class="form-label">Cuenta</label>
                                <select class="form-control" name="cuenta_id" id="cuenta_id" style="background-color: white; color: black;" wire:model="cuenta_id">
                                    <option  selected>Seleccione una opcion</option>
                                    @foreach ($cuentas as $cuenta)
                                        <option value="{{ $cuenta->id }}">{{ $cuenta->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo" style="background-color: white; color: black;" wire:model="tipo">
                                    <option  selected>Seleccione una opcion</option>
                                    <option value="Salida" selected>Salida</option>
                                    <option value="Entrada" >Entrada</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" placeholder="gasto de Nomina" wire:model="descripcion">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Monto</label>
                                <input type="number" class="form-control" id="monto" placeholder="$27000" wire:model="monto">
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
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cuenta name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descripcion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Monto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{-- Action --}}
                        <button class="rounded-full bg-red-500" data-bs-toggle="modal" data-bs-target="#modal-Movimiento">Agragar</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($movimientos->count() > 0)
                    @foreach ($movimientos as $item)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ date('F j, Y', strtotime($item->created_at)); }}
                            </th>
                            <td class="px-6 py-4">
                                {{$item->cuenta->nombre}}
                            </td>
                            <td class="px-6 py-4">
                                {{$item->user->name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$item->descripcion}}
                            </td>
                            <td class="px-6 py-4">
                                $ {{$item->monto}}
                            </td>
                            <td class="px-6 py-4">
                                {{$item->tipo}}
                            </td>
                            <td class="px-6 py-4">
                                {{$item->estado}}
                            </td>
                            <td class="px-6 py-4">
                                <button class="rounded-full font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="abrirModal({{$item->id}}, 'Movimiento')">Edit</button>
                                <button class="rounded-full font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="delMovimiento({{$item->id}})">Del</button>
                            </td>
                        </tr>
                        
                    @endforeach
                    
                @endif
            </tbody>
        </table>
    </div>

</div>
