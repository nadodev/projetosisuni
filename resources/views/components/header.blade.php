<header class="flex items-center justify-between bg-white shadow-md p-4">
    <button id="toggleSidebar" class="text-gray-800 focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
    <div class="flex gap-4 items-center">
     <div class="gap-4 flex">
        <button class="text-lg bg-[#EFF4FB] border border-[#E2E8F0] h-8 w-8 p-4  flex justify-center items-center rounded-full">
          <i class="fa-regular fa-comment text-[#64748B]"></i>
        </button>
        <button class="text-lg bg-[#EFF4FB] border border-[#E2E8F0] h-8 w-8 p-4  flex justify-center items-center rounded-full">
        <i class="fa-regular fa-bell text-[#64748B]"></i>
      </button>
     </div>
      @include('components.user-menu')
    </div>
</header>