<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Empleados') }}
    </x-slot>

    <div class="mt-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{route('empleado.store')}}" active="{{request()->routeIs('empleado.store')}}">
                <button class="mb-1 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Crear
                </button>
            </a>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                        @foreach($empleados as $empleado)
                        <div class="p-6 flex space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="text-gray-800 dark:text-gray-200">
                                            {{ $empleado->nombre }}
                                        </span>
                                        <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $empleado->created_at->format('j M Y, g:i a') }}</small>
                                        @unless($empleado->created_at->eq($empleado->updated_at))
                                        <small class="text-sm text-gray-600 dark:text-gray-400"> &middot; {{ __('edited') }}</small>
                                        @endunless
                                    </div>
                                </div>
                            </div>
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-300 cursor-pointer" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                    </svg>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('empleado.edit', $empleado)">Editar Empleado</x-dropdown-link>
                                    <form method="POST" action="{{ route('empleado.destroy', $empleado) }}">
                                        @csrf @method('DELETE')
                                        <x-dropdown-link :href="route('empleado.destroy', $empleado)" onclick="event.preventDefault(); this.closest('form').submit();">Eliminar Empleado</x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>