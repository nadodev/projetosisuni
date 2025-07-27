@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-red-200 via-purple-100 to-white animate-fade-in">
    <div class="bg-white/90 rounded-3xl shadow-2xl p-10 flex flex-col items-center max-w-lg w-full border border-red-100 relative overflow-hidden">
        <div class="absolute -top-10 -left-10 opacity-20 animate-blob">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="60" r="60" fill="#f87171"/>
            </svg>
        </div>
        <div class="mb-6 animate-bounce-slow">
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="50" cy="50" rx="48" ry="48" fill="#fecaca"/>
                <text x="50%" y="54%" text-anchor="middle" fill="#ef4444" font-size="48" font-weight="bold" dy=".3em">500</text>
            </svg>
        </div>
        <h1 class="text-4xl font-extrabold mb-2 text-red-600 drop-shadow">Erro Interno do Servidor</h1>
        <p class="text-gray-600 mb-8 text-center text-lg">Ocorreu um erro inesperado.<br>Tente novamente mais tarde ou volte para a página inicial.</p>
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