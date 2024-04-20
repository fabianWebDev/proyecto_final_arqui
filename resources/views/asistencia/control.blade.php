<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Control de Asistencia') }}
        </h2>
    </x-slot>

    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-3">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Control de Asistencia</h2>
                        <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Consulta la lista de asistencia de los colaboradores registrados.") }}
                        </p>
                    </div>
                    <table id="control-asistencia" class="table-fixed w-full divide-y dark:divide-gray-900">
                        <thead class="divide-y dark:divide-gray-900">
                            <tr class="">
                                <th class="px-4 py-2 text-sm text-sm">Empleado
                                    <svg style="display: inline-block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </th>
                                <th class="px-4 py-2 text-sm text-sm">Total de asistencias
                                    <svg style="display: inline-block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </th>
                                <th class="px-4 py-2 text-sm text-sm">Ausencias
                                    <svg style="display: inline-block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </th>
                                <th class="px-4 py-2 text-sm text-sm">Omisiones de marca o marcas tardías
                                    <svg style="display: inline-block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-gray-900">
                            @foreach($asistencias_info as $empleado => $info)
                            <tr>
                                <td class="text-sm px-4 py-2 text-center">{{ $empleado }}</td>
                                <td class="text-sm px-4 py-2 text-center">{{ $info['presentes'] }}</td>
                                <td class="text-sm px-4 py-2 text-center">{{ $info['ausencia'] }}</td>
                                <td class="text-sm px-4 py-2 text-center">{{ $info['omisiones_o_tardanzas'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>