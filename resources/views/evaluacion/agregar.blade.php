<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Evaluación') }}
        </h2>
    </x-slot>
    <div class="text-gray-900 dark:text-gray-100 w-full mx-auto p-1 mt-2">
        <div class="bg-white dark:bg-gray-800  rounded-lg  dark:divide-gray-900 p-3">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Evaluacion de Colaborador</h2>
            <form class="w-full" method="POST" action="{{ route('evaluacion.store') }}">
                @csrf
                <div class="w-full px-3">
                    <x-input-label for="user_id" value="Colaborador" />
                    <select name="user_id" id="user_id" class="mt-1 block w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @foreach($empleados as $empleado)
                        <option value="{{ $empleado->id }}">{{ $empleado->nombre}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                </div>
                @foreach($preguntas as $key => $pregunta)
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <x-input-label for="pregunta[{{ $key }}]" :value="$pregunta" />
                    <div class="mt-3 flex flex-wrap justify-between">
                        @for ($i = 1; $i <= 10; $i++) <label class="inline-flex items-center mt-2 mb-2 mr-2">
                            <input type="radio" name="pregunta[{{ $key }}]" value="{{ $i }}" class="form-radio h-5 w-5 text-indigo-600">
                            <span class="ml-2">{{ $i }}</span>
                            </label>
                            @endfor
                    </div>
                    <x-input-error :messages="$errors->get('pregunta')" class="mt-2" />
                </div>
                @endforeach
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="text-center">
                    <x-primary-button>Crear Evaluación</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>