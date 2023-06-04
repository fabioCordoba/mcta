<div>
    <div class=" row ">
        <div class="col-md-2">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
                <div class="flex flex-col flex-grow ml-4">
                    <div class="text-sm text-gray-500">Entradas</div>
                    <div class="font-bold text-sm">$ {{$total_entradas}}</div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
                <div class="flex flex-col flex-grow ml-4">
                    <div class="text-sm text-gray-500">Salidas</div>
                    <div class="font-bold text-sm">$ {{$total_salidas}}</div>
                </div>
            </div>
        </div>

        @if ($cuentas->count() > 0)
            @foreach ($cuentas as $item)
                <div class="col-md-2">
                    <div class="flex flex-row bg-white shadow-sm rounded p-4">
                        <div class="flex items-center justify-center flex-shrink-0 h-10 w-10 rounded-xl bg-red-100 text-red-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    <div class="flex flex-col flex-grow ml-4">
                        <div class="text-sm text-gray-500">{{$item->nombre}}</div>
                        <div class="font-bold text-sm">
                            @php
                                $val = 0;
                            @endphp

                            @if ($item->movimiento->count() > 0)
                                @foreach ($item->movimiento as $item)
                                    @if ($item->tipo == 'Entrada')
                                        @php
                                            $val = $val + $item->monto
                                        @endphp
                                    @elseif($item->tipo == 'Salida')
                                        @php
                                            $val = $val - $item->monto
                                        @endphp
                                    @endif
                                @endforeach 
                            @endif
                            $ {{ $val}}
                        </div>
                    </div>
                    </div>
                </div>

            @endforeach
        @endif


        {{-- <div class="col-span-12 sm:col-span-6 md:col-span-3">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-green-100 text-green-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <div class="text-sm text-gray-500">Orders</div>
                <div class="font-bold text-lg">230</div>
            </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 md:col-span-3">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-orange-100 text-orange-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <div class="text-sm text-gray-500">New Clients</div>
                <div class="font-bold text-lg">190</div>
            </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 md:col-span-3">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-red-100 text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <div class="text-sm text-gray-500">Revenue</div>
                <div class="font-bold text-lg">$ 32k</div>
            </div>
            </div>
        </div> --}}
    </div>
</div>