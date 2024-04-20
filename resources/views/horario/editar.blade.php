<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Horario') }}
        </h2>
    </x-slot>

    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 rounded-lg dark:divide-gray-900 p-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Editar Horario</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Edita un Horario.") }}
                    </p>
                    <form class="w-full mt-4 space-y-6" method="POST" action="{{ route('horario.update', $horario) }}">
                        @csrf @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="hora_entrada" value="Hora de entrada" />
                            <input type="time" id="hora_entrada" name="hora_entrada" type="text" class="mt-1 block w-24 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('hora_entrada', $horario->hora_entrada)" required autofocus autocomplete="hora_entrada" />
                            <x-input-error :messages="$errors->get('hora_entrada')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="hora_salida" value="Hora de Salida" />
                            <input type="time" id="hora_salida" name="hora_salida" type="text" class="mt-1 block w-24 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('hora_salida', $horario->hora_salida)" required autofocus autocomplete="hora_salida" />
                            <x-input-error :messages="$errors->get('hora_salida')" class="mt-2" />
                        </div>
                        <div class="mt-4 mb-2">
                            <x-primary-button>Crear Horario</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>