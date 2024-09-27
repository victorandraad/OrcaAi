<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Fórmula') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('formulas.update', $formula) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nome:</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="name" id="name" value="{{ $formula->name }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="formula">Fórmula:</label>
                            <div class="flex flex-col">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="formula" id="formula" value="{{ $formula->formula }}" readonly>
                                <div class="grid grid-cols-4 gap-2 mt-2">
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('1')">1</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('2')">2</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('3')">3</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('+')">+</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('4')">4</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('5')">5</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('6')">6</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('-')">-</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('7')">7</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('8')">8</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('9')">9</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('*')">*</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('0')">0</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('.')">.</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('(')">(</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula(')')">)</button>
                                    <button type="button" class="bg-gray-200 p-2 rounded" onclick="addToFormula('/')">/</button>
                                    <button type="button" class="bg-red-500 text-white p-2 rounded" onclick="clearFormula()">C</button>
                                    <button type="button" class="bg-yellow-500 text-white p-2 rounded" onclick="openModal()">Definir Variável</button>
                                    <button type="button" class="bg-green-500 text-white p-2 rounded" onclick="openMaterialModal()">Adicionar Material</button>
                                </div>
                            </div>
                            @error('formula')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Salvar
                            </button>
                            <a href="{{ route('formulas.index') }}" class="text-gray-500 hover:text-gray-700">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para definir variável -->
    <div id="variableModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-lg font-bold mb-4">Definir Variável</h2>
            <input type="text" id="variableName" class="border rounded w-full py-2 px-3" placeholder="Digite o nome da variável">
            <div class="mt-4 flex justify-end">
                <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="defineVariable()">Adicionar</button>
                <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2" onclick="closeModal()">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Modal para adicionar material -->
    <div id="materialModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded shadow-lg w-96"> <!-- Aumentando a largura do modal -->
            <h2 class="text-lg font-bold mb-4">Adicionar Material</h2>
            <input type="text" id="materialSearch" class="border rounded w-full py-2 px-3 mb-4" placeholder="Pesquisar material..." onkeyup="filterMaterials()">
            <ul id="materialList" class="max-h-60 overflow-y-auto">
                <!-- A lista de materiais será preenchida dinamicamente -->
                @foreach($materials as $material)
                    <li class="material-item cursor-pointer" onclick="addMaterial('{{ $material->id }}', '{{ $material->name }}')">[{{ $material->id }}] {{ $material->name }}</li>
                @endforeach
            </ul>
            <div class="mt-4 flex justify-end">
                <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded" onclick="closeMaterialModal()">Fechar</button>
            </div>
        </div>
    </div>

    <script>
        function addToFormula(value) {
            const formulaInput = document.getElementById('formula');
            const currentFormula = formulaInput.value;

            // Validação para evitar {variavel} seguido de número ou ponto
            if (value.match(/^\d|\.$/) && currentFormula.match(/\{[a-zA-Z0-9_]+\}$/)) {
                alert('A variável não pode ser seguida diretamente por um número ou ponto decimal.');
                return; // Não adiciona o valor
            }

            // Validação para evitar [material_id] seguido de número ou ponto decimal
            if (value.match(/^\d|\.$/) && currentFormula.match(/\[\d+\]$/)) {
                alert('O material não pode ser seguido diretamente por um número ou ponto decimal.');
                return; // Não adiciona o valor
            }

            formulaInput.value += value; // Adiciona o valor ao campo de fórmula
        }

        function clearFormula() {
            const formulaInput = document.getElementById('formula');
            formulaInput.value = ''; // Limpa o campo de fórmula
        }

        function openModal() {
            document.getElementById('variableModal').classList.remove('hidden'); // Mostra o modal
        }

        function closeModal() {
            document.getElementById('variableModal').classList.add('hidden'); // Esconde o modal
        }

        function defineVariable() {
            const variableName = document.getElementById('variableName').value;
            if (variableName) {
                addToFormula('{' + variableName + '}'); // Adiciona a variável ao campo de fórmula
                closeModal(); // Fecha o modal
                document.getElementById('variableName').value = ''; // Limpa o campo de entrada
            }
        }

        function openMaterialModal() {
            document.getElementById('materialModal').classList.remove('hidden'); // Mostra o modal de materiais
        }

        function closeMaterialModal() {
            document.getElementById('materialModal').classList.add('hidden'); // Esconde o modal de materiais
        }

        function addMaterial(id, name) {
            addToFormula('[' + id + ']'); // Adiciona o material ao campo de fórmula com o ID
            closeMaterialModal(); // Fecha o modal
        }

        function filterMaterials() {
            const input = document.getElementById('materialSearch').value.toLowerCase();
            const items = document.querySelectorAll('.material-item');
            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(input) ? '' : 'none'; // Filtra a lista de materiais
            });
        }
    </script>
</x-app-layout>