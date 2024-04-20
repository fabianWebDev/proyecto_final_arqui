<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asistencia') }}
        </h2>
    </x-slot>
    <div class="mt-2 flex justify-center">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-3">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Marca Asistencia</h2>
                        <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("No olvides marcar la entrada y la salida, el no hacerlo, podría tener repercusiones en tu salario.") }}
                        </p>
                    </div>
                    <div class="inline-block">
                        <form method="POST" action="{{ route('asistencia.store') }}">
                            @csrf
                            <div>
                                <button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 @if($asistencia_fecha_hoy && $marca_entrada_not_null) button-disabled @endif" @if($asistencia_fecha_hoy && $marca_entrada_not_null) disabled @endif>
                                    Marcar Entrada
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="inline-block">
                        <form method="POST" action="{{ route('asistencia.update') }}">
                            @csrf
                            @method('PUT')
                            <div>
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 @if($asistencia_fecha_hoy && $marca_salida_not_null) button-disabled @endif" @if($asistencia_fecha_hoy && $marca_salida_not_null) disabled @endif>
                                    Marcar Salida
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>