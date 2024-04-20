<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Empleados') }}
    </x-slot>

    <div class="text-gray-900 dark:text-gray-100 w-full mx-auto p-1 mt-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg dark:divide-gray-900 p-3">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Colaboradores</h2>
            <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Consulta la lista de colaboradores registrados o crea nuevos.") }}
            </p>
            <table id="empleado_table" class="table-fixed w-full divide-y dark:divide-gray-900">
                <thead class="divide-y dark:divide-gray-900">
                    <tr class="divide-y dark:divide-gray-900">
                        <th class="px-4 py-2  text-sm text-sm">Nombre
                            <svg style="display: inline-block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </th>
                        <th class="px-4 py-2  text-sm">Departamento
                            <svg style="display: inline-block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </th>
                        <th class="px-4 py-2  text-sm">Fecha de Ingreso
                            <svg style="display: inline-block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </th>
                        <th class="px-4 py-2  text-sm">Perfil
                            <svg style="display: inline-block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </th>
                        <th class="px-4 py-2  text-sm">Puesto
                            <svg style="display: inline-block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </th>
                        <th class="px-4 py-2  text-sm">Opciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-900">
                    @foreach($empleados as $empleado)
                    <tr class="">
                        <td class="text-sm px-4 py-2 text-center">{{ $empleado->nombre }}</td>
                        <td class="text-sm px-4 py-2 text-center">{{ $empleado->departamento->nombre }}</td>
                        <td class="text-sm px-4 py-2 text-center">{{ $empleado->fecha_ingreso }}</td>
                        <td class="text-sm px-4 py-2 text-center">{{ $empleado->perfil->nombre }}</td>
                        <td class="text-sm px-4 py-2 text-center">{{ $empleado->puesto->nombre }}</td>
                        <td class="text-sm px-4 py-2 text-center">
                            <ul>
                                <li>
                                    <a href="{{ route('empleado.edit', $empleado) }}" class="text-white mr-2">
                                        Editar
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('empleado.destroy', $empleado) }}" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">Eliminar</button>
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <x-primary-button class="mt-4 mb-2">
                <a href="{{route('empleado.store')}}" active="{{request()->routeIs('empleado.store')}}">Crear Colaborador</a>
            </x-primary-button>
        </div>
</x-app-layout>