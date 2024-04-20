<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Horarios') }}
        </h2>
    </x-slot>

    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 divide-y dark:divide-gray-900 rounded-lg p-3">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Horarios</h2>
                        <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Consulta la lista de horarios registrados o crea nuevos.") }}
                        </p>
                    </div>
                    @foreach($horarios as $horario)
                    <div class="pt-6 pb-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">
                                        <p> Hora de entrada: {{ \Carbon\Carbon::parse($horario->hora_entrada)->format('H:i') }} </p>
                                        <p> Hora de salida: {{ \Carbon\Carbon::parse($horario->hora_salida)->format('H:i') }} </p>
                                    </span>
                                    <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">Creado: {{ $horario->created_at->format('j M Y, g:i a') }}</small>
                                    @unless($horario->created_at->eq($horario->updated_at))
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
                                <x-dropdown-link :href="route('horario.edit', $horario)">Editar Horario</x-dropdown-link>
                                <!-- <form method="POST" action="{{ route('horario.destroy', $horario) }}">
                                    @csrf @method('DELETE')
                                    <x-dropdown-link :href="route('horario.destroy', $horario)" onclick="event.preventDefault(); this.closest('form').submit();">Eliminar Horario</x-dropdown-link>
                                </form> -->
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endforeach
                    <div>
                        <x-primary-button class="mt-4 mb-2">
                            <a href="{{route('horario.store')}}" active="{{request()->routeIs('horario.store')}}}">Crear Horario</a>
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>