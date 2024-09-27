<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fórmulas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Fórmulas</h1>
                    <div class="mb-4">
                        <form action="{{ route('formulas.index') }}" method="GET" class="flex items-center">
                            <input type="text" name="search" value="{{ request('search') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Pesquisar fórmulas...">
                            <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($formulas as $formula)
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h2 class="text-xl font-semibold mb-2">{{ $formula->name }}</h2>
                                <p class="text-gray-600 mb-4">{{ $formula->formula }}</p>
                                <div class="flex justify-end">
                                    <a href="{{ route('formulas.edit', $formula) }}" class="text-blue-500 hover:text-blue-700 mr-4">Editar</a>
                                    <form action="{{ route('formulas.destroy', $formula) }}" method="POST" onsubmit="return confirm('Tem certeza de que deseja excluir esta fórmula?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('formulas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Adicionar Fórmula
                        </a>
                    </div>
                    <div class="mt-6">
                        {{ $formulas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
