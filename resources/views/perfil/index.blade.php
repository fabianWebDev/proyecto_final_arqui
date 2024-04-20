<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfiles') }}
        </h2>
    </x-slot>
    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 divide-y dark:divide-gray-900 rounded-lg p-3">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Perfiles</h2>
                        <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Consulta la lista de perfiles registrados o crea nuevos.") }}
                        </p>
                    </div>
                    @foreach($perfiles as $perfil)
                    <div class="pt-6 pb-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">
                                        {{ $perfil->nombre }}
                                    </span>
                                    <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">Creado: {{ $perfil->created_at->format('j M Y, g:i a') }}</small>
                                    @unless($perfil->created_at->eq($perfil->updated_at))
                                    <small class="text-sm text-gray-600 dark:text-gray-400"> - {{ __('editado') }}</small>
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
                                <x-dropdown-link :href="route('perfil.edit', $perfil)">Editar perfil</x-dropdown-link>
                                <!-- <form method="POST" action="{{ route('perfil.destroy', $perfil) }}">
                                    @csrf @method('DELETE')
                                    <x-dropdown-link :href="route('perfil.destroy', $perfil)" onclick="event.preventDefault(); this.closest('form').submit();">Eliminar perfil</x-dropdown-link>
                                </form> -->
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endforeach
                    <div>
                        <x-primary-button class="mt-4 mb-2">
                            <a href="{{route('perfil.store')}}" active="{{request()->routeIs('perfil.store')}}}">Crear Perfil</a>
                        </x-primary-button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>