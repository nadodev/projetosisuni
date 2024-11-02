<div id="overlay" class="fixed inset-0 items-center justify-center hidden bg-gray-800 bg-opacity-50">
    <div class="w-16 h-16 border-t-4 border-blue-500 border-solid rounded-full loader animate-spin"></div>
</div>
<script>
    const procurarAluno = document.querySelector('#procurarAluno');

    console.log(procurarAluno);
    const userInfo = document.querySelector("#user-info");
    const medicamentos = document.querySelector("#medicamentos");
    const habilidades = document.querySelector("#habilidades");
    function toggleOverlay() {
        userInfo.classList.add("hidden")
        userInfo.classList.remove("flex")
        const overlay = document.getElementById("overlay");
        overlay.classList.toggle("hidden");
        overlay.classList.add("flex");

        setTimeout(() => {
            overlay.classList.remove("flex");
            overlay.classList.add("hidden");
            userInfo.classList.remove("hidden")
            userInfo.classList.add("flex")
        }, 3000);
    }

    if (procurarAluno) {
        procurarAluno.addEventListener('click', () => toggleOverlay()); // Chama a função ao clicar no botão
    }
</script>
