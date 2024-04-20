<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Perfiles') }}
        </h2>
    </x-slot>

    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 rounded-lg dark:divide-gray-900 p-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Crear Perfil</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Crea un nuevo Perfil en la base de datos.") }}
                    </p>
                    <form class="w-full mt-4 space-y-6" method="POST" action="{{ route('perfil.store') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="nombre" value="Nombre" />
                            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-96" :value="old('nombre')" required autofocus autocomplete="nombre" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>
                        <!-- Add more form fields here as needed -->
                        <div class="mt-4 mb-2">
                            <x-primary-button>Crear Perfil</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>