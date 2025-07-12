<div class="relative flex flex-col items-start justify-center">
    <div class="flex gap-3">
        <div class="flex flex-col items-end justify-center">
            <h2 class="p-0 m-0 font-semibold leading-3 text-md">João Pedro</h2>
            <p class="text-sm text-[#637381]">Administrador</p>
        </div>
        <img src="{{ asset('assets/img/avatar.png') }}" />
        <button class="text-gray-800 focus:outline-none" id="open-user-menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    </div>
    <div id="user-menu"
        class="bg-gray-200 absolute right-0 top-full mt-2 hidden p-4 text-white rounded w-[300px] h-[200px] shadow-md">
    </div>
</div>

<script>
    const userMenu = document.getElementById("user-menu");
    const openUserMenuButton = document.getElementById("open-user-menu");

    function toggleUserMenu() {
        userMenu.classList.toggle("hidden");
    }

    function closeUserMenu(event) {
        if (!userMenu.contains(event.target) && !openUserMenuButton.contains(event.target)) {
            userMenu.classList.add("hidden");
        }
    }
    openUserMenuButton.addEventListener("click", toggleUserMenu);
    window.addEventListener("click", closeUserMenu);
</script>
