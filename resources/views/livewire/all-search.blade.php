<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Cuenta name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Descripcion
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Monto
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Estado
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 text-center">
                        <button class="rounded-full bg-red-500" data-bs-toggle="modal" data-bs-target="#modal-Movimiento">
                            <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Agregar</span> 
                        </button>
                    </th> --}}
                </tr>
            </thead>
            <tbody >
                @if ($movimientos->count() > 0)
                    @foreach ($movimientos as $item)

                        <tr class="border-b text-gray-900 @if($item->tipo == 'Entrada')bg-green-100 @elseif($item->tipo == 'Salida')bg-red-100 @else bg-yellow-100 @endif" >
                            <th scope="row" class="px-6 py-4 text-center font-medium whitespace-nowrap">
                                {{ date('F j, Y', strtotime($item->created_at)); }}
                            </th>
                            <td class="px-6 py-4 text-center font-medium">
                                {{$item->cuenta->nombre}}
                            </td>
                            <td class="px-6 py-4 text-center font-medium">
                                {{$item->descripcion}}
                            </td>
                            <td class="px-6 py-4 text-center font-medium">
                                $ {{number_format($item->monto, 2)}}
                            </td>
                            <td class="px-6 py-4 text-center font-medium">
                                @if ($item->tipo == 'Entrada')
                                    <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">{{$item->tipo}}</span>    
                                @elseif($item->tipo == 'Salida')
                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{$item->tipo}}</span> 
                                @else
                                    <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">{{$item->tipo}}</span>
                                @endif
                                
                            </td>
                            <td class="px-6 py-4 text-center font-medium">
                                {{$item->estado}}
                            </td>
                            {{-- <td class="px-6 py-4">
                                <button class="rounded-full font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="abrirModal({{$item->id}}, 'Movimiento')">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </button>
                                <button class="rounded-full font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="delMovimiento({{$item->id}})">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </button>
                            </td> --}}
                        </tr>
                        
                    @endforeach
                    
                @endif
            </tbody>
        </table>
    </div>
</div>
