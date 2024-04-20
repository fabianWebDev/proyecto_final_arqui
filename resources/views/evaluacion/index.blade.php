<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('evaluaciones') }}
        </h2>
    </x-slot>

    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 divide-y dark:divide-gray-900 rounded-lg p-3">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Evaluaciones</h2>
                        <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Consulta la lista de evaluaciones registrados o crea nuevos.") }}
                        </p>
                    </div>
                    @foreach($evaluaciones as $evaluacion)
                    <div class="pt-6 pb-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                        @php
                        $user = \App\Models\User::find($evaluacion['user_id']);
                        @endphp
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">
                                        Evaluación: {{ $user->name}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">
                                        Calificación: {{ $evaluacion['total'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div>
                        <x-primary-button class="mt-4 mb-2">
                            <a href="{{route('evaluacion.store')}}" active="{{request()->routeIs('evaluacion.store')}}">Crear evaluacion</a>
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>