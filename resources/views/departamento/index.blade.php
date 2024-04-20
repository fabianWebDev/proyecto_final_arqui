<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departamentos') }}
        </h2>
    </x-slot>

    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 divide-y dark:divide-gray-900 rounded-lg p-3">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Departamentos</h2>
                        <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Consulta la lista de departamentos registrados o crea nuevos.") }}
                        </p>
                    </div>
                    @foreach($departamentos as $departamento)
                    <div class="pt-6 pb-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">
                                        {{ $departamento->nombre }}
                                    </span>
                                    <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">Creado: {{ $departamento->created_at->format('j M Y, g:i a') }}</small>
                                    @unless($departamento->created_at->eq($departamento->updated_at))
                                    <small class="text-sm text-gray-600 dark:text-gray-400"> - {{ __('editado') }}</small>
                                    @endunless
                                </div>
                            </div>
                        </div>
                        <x-dropdown>
                            <x-slot name="trigger">
                                <svg class="w-6 h-6 text-gray-500 dark:text-gray-300 cursor-pointer cursor-pointer" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                </svg>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('departamento.edit', $departamento)">Editar departamento</x-dropdown-link>
                                <!-- <form method="POST" action="{{ route('departamento.destroy', $departamento) }}">
                                    @csrf @method('DELETE')
                                    <x-dropdown-link :href="route('departamento.destroy', $departamento)" onclick="event.preventDefault(); this.closest('form').submit();">Eliminar departamento</x-dropdown-link>
                                </form> -->
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endforeach
                    <div>
                        <x-primary-button class="mt-4 mb-2">
                            <a href="{{route('departamento.store')}}" active="{{request()->routeIs('departamento.store')}}}">Crear Departamento</a>
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>