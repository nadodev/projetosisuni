@extends('layouts.master')

@section('content')

    <section class="">
        <div class="flex items-start gap-6">
            <div class="flex flex-col flex-shrink-0 gap-2 mt-4">
                <button class="px-4 py-2  text-white bg-[#3C50E0] rounded-full hover:bg-blue-700 flex items-center gap-2">
                    <i class="fa-regular fa-file"></i>
                    <a href="{{ route('plano.index') }}">Plano de Ensino</a>
                </button>
                <button class="px-4 py-2  text-[#3C50E0] bg-transparent border border-[#3C50E0] rounded-full hover:bg-blue-700 hover:text-white flex items-center gap-2">
                    <i class="fa-solid fa-brain"></i>
                    <a href="{{ route('plano.index') }}">Habilidades</a>
                </button>
                <button class="px-4 py-2  text-[#3C50E0] bg-transparent border border-[#3C50E0] rounded-full hover:bg-blue-700 hover:text-white flex items-center gap-2">
                    <i class="fa-solid fa-cube"></i>
                    <a href="{{ route('plano.index') }}">Medicamentos</a>
                </button>
            </div>

            <div class="flex flex-col w-full gap-2">
                <div class="flex items-center flex-grow gap-4 p-4 bg-white rounded">
                    <p class="flex w-[200px] text-gray-600">Procurar um estudante</p>
                    <div
                        class="border border-[#718ebf33] rounded-full w-[500px] flex gap-2 items-center pr-2 pl-2 focus-within:shadow-lg  focus-within:border-blue-500 transition-shadow bg-[#F5F7FA]">
                        <i class="fa-solid fa-search text-[#718ebf]"></i>
                        <input type="text" class="w-full py-2 bg-transparent outline-none placeholder:text-[15px] placeholder:text-[#8BA3CB] " placeholder="digite o nome do estudante ou código" />
                    </div>

                    <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700" id="procurarAluno">
                        Pesquisar
                    </button>
                </div>
                <div class="flex-col hidden gap-2" id="user-info">
                    <div class="bg-white rounded">
                        <div class="py-2 pb-2 pl-4 border-b border-gray-100">
                            <p>Perfil do Estudante</p>
                        </div>
                        <div class="flex items-center w-full gap-4 p-2 pl-4">
                            <div>
                                <img src="{{ asset('assets/img/avatar.png') }}" class="w-[93px] h-[93px]" />
                            </div>
                            <div class="flex flex-col ">
                                <h3 class="font-bold text-1xl">João Pedro</h3>
                                <p class="text-md text-[#4F4B4B] font-semibold">Estudante</p>
                                <span class="text-[#4F4B4B] text-sm">Escola Estadual Genésio</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded">
                        <form class="w-full p-6 bg-white max-w-[900px] rounded">

                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Setor</label>
                                <input type="text" id="name" name="name" required
                                       class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Observação</label>
                                <textarea name="email"
                                rows="6"
                                       class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" ></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Prioridades</label>
                                <textarea name="email"
                                rows="6"
                                       class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" ></textarea>
                            </div>
                            <button type="submit" class="py-2 pl-4 pr-4 font-bold text-white transition duration-200 bg-blue-500 rounded hover:bg-blue-600">
                              Salvar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @include('components.load')
@stop
