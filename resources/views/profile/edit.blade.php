<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">
                <!-- Sidebar -->
                <div class="col-span-12 md:col-span-3">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="text-center mb-6">
                            <div class="relative w-24 h-24 mx-auto mb-4">
                                @if($user->photo_path)
                                    <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                                        class="w-24 h-24 rounded-full object-cover">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-3xl text-gray-600">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif

                                <button type="button"
                                    onclick="document.getElementById('photo-input').click()"
                                    class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow-lg hover:bg-gray-100">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                            <form id="photo-form" action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" class="hidden">
                                @csrf
                                <input type="file"
                                    id="photo-input"
                                    name="photo"
                                    accept="image/*"
                                    class="hidden"
                                    onchange="document.getElementById('photo-form').submit()">
                            </form>
                            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                            <p class="text-gray-600">{{ $user->email }}</p>
                        </div>
                        <nav class="space-y-2">
                            <a href="#profile-info" class="block px-4 py-2 rounded-md hover:bg-gray-50 text-gray-700 font-medium">
                                Informações Pessoais
                            </a>
                            <a href="#address" class="block px-4 py-2 rounded-md hover:bg-gray-50 text-gray-700 font-medium">
                                Endereço
                            </a>
                            <a href="#security" class="block px-4 py-2 rounded-md hover:bg-gray-50 text-gray-700 font-medium">
                                Segurança
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-span-12 md:col-span-9 space-y-6">
                    @if($showAddressAlert)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Por favor, complete seu endereço para continuar usando o sistema.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Profile Information -->
                    <div id="profile-info" class="bg-white rounded-lg shadow">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informações Pessoais</h3>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Address -->
                    <div id="address" class="bg-white rounded-lg shadow">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Endereço</h3>
                            @include('profile.partials.update-address-form')
                        </div>
                    </div>

                    <!-- Security -->
                    <div id="security" class="bg-white rounded-lg shadow">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Segurança</h3>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
