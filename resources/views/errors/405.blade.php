@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-yellow-100 via-purple-50 to-white animate-fade-in">
    <div class="bg-white/90 rounded-3xl shadow-2xl p-10 flex flex-col items-center max-w-lg w-full border border-yellow-100 relative overflow-hidden">
        <div class="absolute -top-10 -right-10 opacity-20 animate-blob">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="60" r="60" fill="#facc15"/>
            </svg>
        </div>
        <div class="mb-6 animate-bounce-slow">
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="50" cy="50" rx="48" ry="48" fill="#fef9c3"/>
                <text x="50%" y="54%" text-anchor="middle" fill="#eab308" font-size="48" font-weight="bold" dy=".3em">405</text>
            </svg>
        </div>
        <h1 class="text-4xl font-extrabold mb-2 text-yellow-600 drop-shadow">Página não Encontrada</h1>
        <p class="text-gray-600 mb-8 text-center text-lg">A página que você está procurando não existe ou foi removida.<br>Por favor, volte para a página inicial.</p>
        <a href="/" class="btn btn-primary btn-lg shadow-lg transition-transform hover:scale-105"><i class="fas fa-home mr-2"></i> Voltar para o início</a>
    </div>
</div>
<style>
@keyframes fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}
.animate-fade-in { animation: fade-in 1s ease; }
@keyframes bounce-slow {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}
.animate-bounce-slow { animation: bounce-slow 2.5s infinite; }
@keyframes blob {
  0%,100% { transform: scale(1) translate(0,0); }
  33% { transform: scale(1.1) translate(10px,-10px); }
  66% { transform: scale(0.95) translate(-10px,10px); }
}
.animate-blob { animation: blob 7s infinite; }
</style>
@endsection 