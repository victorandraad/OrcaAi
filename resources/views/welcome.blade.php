<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicativo de Orçamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Seção Hero -->
    <section class="relative bg-blue-600 text-white">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('path/to/your/image.jpg'); opacity: 0.7;"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-screen text-center fade-in">
            <h1 class="text-5xl font-bold mb-4">Seu App de Orçamentos Simples e Rápido!</h1>
            <p class="text-lg mb-6">Facilite a criação de orçamentos e gerencie seus materiais de forma eficiente.</p>
            <a href="{{ route('budget.create') }}" class="bg-green-500 text-white px-8 py-4 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 transform hover:scale-105">Criar Orçamento</a>
        </div>
    </section>

    <!-- Funcionalidades em Destaque -->
    <section class="py-12 fade-in">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8">Funcionalidades do Aplicativo</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <i class="fas fa-tools fa-2x text-blue-500 mb-2"></i>
                    <h3 class="text-xl font-semibold mb-2">Cadastro de Materiais</h3>
                    <p>Cadastre seus materiais ou serviços, atribua valores e defina a unidade de medida que preferir.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <i class="fas fa-file-invoice-dollar fa-2x text-green-500 mb-2"></i>
                    <h3 class="text-xl font-semibold mb-2">Criação de Orçamentos</h3>
                    <p>Selecione materiais e serviços, defina a quantidade e gere um orçamento personalizado rapidamente.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <i class="fas fa-ruler fa-2x text-orange-500 mb-2"></i>
                    <h3 class="text-xl font-semibold mb-2">Personalização de Unidades de Medida</h3>
                    <p>Utilize qualquer unidade de medida que faça sentido para seu negócio, como quilo, metro, hora, etc.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Depoimentos e Avaliações -->
    <section class="py-12 bg-gray-200 fade-in">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8">O que dizem nossos usuários</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <p class="italic">"O aplicativo facilitou muito a criação de orçamentos para meu negócio. Agora, posso gerenciar tudo de forma simples!"</p>
                    <p class="font-bold mt-4">- João Silva, Microempreendedor</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <p class="italic">"Com o app, consigo cadastrar meus materiais e gerar orçamentos em minutos. Recomendo!"</p>
                    <p class="font-bold mt-4">- Maria Oliveira, Pequena Empresária</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Exemplo de Orçamento -->
    <section class="py-12 fade-in">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8">Exemplo de Uso do Aplicativo</h2>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-2">Como funciona?</h3>
                <ol class="list-decimal list-inside">
                    <li>Cadastre materiais como tijolos, definindo o valor por milheiro ou metro cúbico.</li>
                    <li>Selecione os materiais desejados e defina a quantidade.</li>
                    <li>Gere rapidamente um orçamento para seu cliente, tudo de forma intuitiva!</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Chamada para Ação (CTA) -->
    <section class="py-12 bg-blue-600 text-white fade-in">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Pronto para transformar seu negócio?</h2>
            <a href="{{ route('budget.create') }}" class="bg-green-500 text-white px-8 py-4 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 transform hover:scale-105">Experimente Gratuitamente</a>
        </div>
    </section>

    <footer class="py-6 text-center">
        <p class="text-gray-600">© 2023 Seu App de Orçamentos. Todos os direitos reservados.</p>
    </footer>

</body>
</html>