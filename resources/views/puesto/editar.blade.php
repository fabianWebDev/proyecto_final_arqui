<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Puesto') }}
        </h2>
    </x-slot>

    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 rounded-lg dark:divide-gray-900 p-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Editar Puesto</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Edita un Puesto.") }}
                    </p>
                    <form class="w-full mt-4 space-y-6" method="POST" action="{{ route('puesto.update', $puesto) }}">
                        @csrf @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="nombre" value="Nombre" />
                            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-96" :value="old('nombre', $puesto->nombre)" required autofocus autocomplete="nombre" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="salario" class="block text-gray-800 dark:text-white mb-2">Salario:</label>
                            <input type="number" name="salario" id="salario" class="mt-1 block w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm0" value="{{ old('salario', $puesto->salario) }}" min="0">
                            <x-input-error :messages="$errors->get('salario')" class="mt-2" />
                        </div>
                        <div class="mt-4 mb-2">
                            <x-primary-button>Editar Puesto</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



</x-app-layout>