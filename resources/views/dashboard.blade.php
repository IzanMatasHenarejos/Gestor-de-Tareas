{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class=" text-3xl text-purple-800">Bienvenido al gestor de tareas</h1>
                    {{-- <p>Cantidad de Tareas = {{Auth::user()->tasks->count()}}</p> --}}
                    {{-- <p>@foreach ($tasks as $task)
                        <p>Titulo de la Tarea = {{ $task->title }}</p>
                        <p>Descripcion de la tarea = {{ $task->description }}</p>
                        @endforeach</p> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- </div> --}}
    {{-- @livewire('task-component') --}}
{{-- </x-app-layout> --}}
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class=" text-3xl text-purple-800">Bienvenido al gestor de tareas</h1>
                    @foreach ($tasks as $task)

                        <p class="mt-4 text-lg text-purple-800">
                            {{ $task->title }}
                        </p>
                        <p>
                            {{ $task->description }}

                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class=" text-3xl text-purple-800">Bienvenido al gestor de tareas</h1>
                    <livewire:task-component />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
