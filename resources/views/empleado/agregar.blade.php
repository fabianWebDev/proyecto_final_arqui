<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Crear Empleado') }}
        </h2>
    </x-slot>

    <div class="mt-2">
        <div class="w-full mx-auto p-1">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 rounded-lg dark:divide-gray-900 p-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Crear Colaborador</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Llena el formulario de foma correcta para crear un nuevo colaborador en la base de datos.") }}
                    </p>
                    <form class="w-full mt-4 space-y-6" method="POST" action="{{ route('empleado.store') }}">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-input-label for="nombre" value="Nombre" />
                                <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre')" required autofocus autocomplete="nombre" />
                                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <x-input-label for="fecha_ingreso" value="Fecha de Ingreso" />
                                <input class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="fecha_ingreso" type="date" value="{{ old('fecha_ingreso')}}" name="fecha_ingreso">
                                <x-input-error :messages="$errors->get('fecha_ingreso')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <x-input-label for="fecha_ingreso" value="Correo Electrónico" />
                                <input class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="correo_electronico" type="email" value="{{ old('correo_electronico')}}" name="correo_electronico">
                                <x-input-error :messages="$errors->get('correo_electronico')" class="mt-2" />
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <x-input-label for="cedula" value="Cédula" />
                                <input class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="cedula" type="number" value="{{ old('cedula')}}" name="cedula">
                                <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-4 mb-2">
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <x-input-label for="id_departamento" value="Departamento" />
                                <select name="id_departamento" id="id_departamento" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach($departamentos as $departamento)
                                    <option value="{{ $departamento->id}}">{{ $departamento->nombre}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_departamento')" class="mt-2" />
                            </div>
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <x-input-label for="id_perfil" value="Perfil" />
                                <select name="id_perfil" id="id_perfil" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach($perfiles as $perfil)
                                    <option value="{{ $perfil->id}}">{{ $perfil->nombre}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_perfil')" class="mt-2" />
                            </div>
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <x-input-label for="id_puesto" value="Puesto" />
                                <select name="id_puesto" id="id_puesto" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach($puestos as $puesto)
                                    <option value="{{ $puesto->id}}">{{ $puesto->nombre}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_puesto')" class="mt-2" />
                            </div>
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <x-input-label for="id_horario" value="Horario" />
                                <select name="id_horario" id="id_horario" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach($horarios as $horario)
                                    <option value="{{ $horario->id }}">{{ \Carbon\Carbon::parse($horario->hora_entrada)->format('H:i') }}- {{ \Carbon\Carbon::parse($horario->hora_salida)->format('H:i') }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_horario')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mt-4 mb-2">
                            <x-primary-button>Crear Usuario</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>