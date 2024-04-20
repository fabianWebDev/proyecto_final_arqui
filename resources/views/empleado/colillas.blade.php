<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Colillas de Pago') }}
        </h2>
    </x-slot>
    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 divide-y dark:divide-gray-900 rounded-lg p-3">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Colillas de Pago</h2>
                        <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Consulta la lista de colillas de pago.") }}
                        </p>
                    </div>

                    @foreach ($pdfFiles as $pdfFile)
                    @if(strpos($pdfFile['filename'], Auth()->user()->empleado->nombre) !== false)
                    <div class="pt-6 pb-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">
                                        {{ $pdfFile['filename'] }}
                                    </span>
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
                                <x-dropdown-link :href="route('pdf.download', $pdfFile['filename'])">Descargar Colilla</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>