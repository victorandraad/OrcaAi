<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Orçamento') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 ">

        <div class="bg-white p-10 rounded-lg shadow-lg flex flex-col gap-4 budget-form">
            
        </div>
        <div class="flex flex-row gap-4 flex flex-col mt-5">
            <button type="button" onclick="addItem()" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                Adicionar Item
            </button>
            <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                Criar Orçamento
            </button>
        </div>
        
    </div>


    <script>
        const budgetForm = document.querySelector('.budget-form');
        function addItem() {
            
        }
    </script>
</x-app-layout>
