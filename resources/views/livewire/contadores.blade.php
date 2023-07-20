<div>
    <div class=" row ">
        <div class="col-md-2">
            <div class="flex flex-row bg-green-100 shadow-sm rounded p-2">
                <div class="flex items-center justify-center flex-shrink-0 h-10 w-10 rounded-xl bg-red-100 text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <div class="text-sm text-gray-500">Entradas</div>
                    <div class="font-bold text-sm">$ {{number_format($total_entradas, 2)}}</div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="flex flex-row bg-red-100 shadow-sm rounded p-2">
                <div class="flex items-center justify-center flex-shrink-0 h-10 w-10 rounded-xl bg-red-100 text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex flex-col flex-grow ml-4">
                    <div class="text-sm text-gray-500 ">Salidas</div>
                    <div class="font-bold text-sm">$ {{number_format($total_salidas, 2)}}</div>
                </div>
            </div>
        </div>

        
        @if ($cuentas->count() > 0)
            @foreach($cuentas->chunk(4) as $key => $ctas )
                @foreach ($ctas as $item)
                    <div class="col-md-2" @if($key != 0) style="padding-top: 10px;" @endif>
                        <div class="flex flex-row bg-white shadow-sm rounded p-2">
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
                                        @foreach ($item->movimiento->where('created_at', '>=', $start)->where('created_at', '<=', $end) as $item)
                                            @if ($item->tipo == 'Entrada' || $item->tipo == 'Prestamo')
                                                @php
                                                    $val = $val + $item->monto
                                                @endphp
                                            @elseif($item->tipo == 'Salida' || $item->tipo == 'Transfer' || $item->tipo == 'PagoAlex')
                                                @php
                                                    $val = $val - $item->monto
                                                @endphp
                                            @endif
                                        @endforeach 
                                    @endif
                                    $ {{ number_format($val, 2)}}
                                </div>
                            </div>
                        </div>
                    </div>
                    

                @endforeach

            @endforeach
        @endif
    </div>
</div>
