<div x-data="{ sidebarOpen: true, sidebarPinned: false }" class="flex h-auto min-h-screen">
      <!-- Sidebar -->
      <div :class="sidebarOpen ? 'w-70' : 'w-0'" class="transition-all duration-300 bg-blue-950 text-white p-1 flex flex-col sidebar overflow-hidden">
        <div class="flex h-16 items-center justify-between ml-2">
          <a href="#">
              <h2 class="text-xl font-semibold">HGK Portal</h2>
          </a>
          <div class="flex gap-2">
           
            <!-- Hide Button -->
            <button @click="sidebarOpen = !sidebarOpen" class="rounded-full px-2 py-1 bg-gray-700 text-white text-xs font-bold" title="Hide Sidebar">
              <span x-show="sidebarOpen" x-cloak>⏴</span>
              <span x-show="!sidebarOpen" x-cloak class="fixed top-4 left-2 z-50 bg-gray-700 rounded-full px-2 py-1 shadow-lg">⏵</span>
            </button>
          </div>
        </div>
        <nav class="flex-1 flex flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-4" x-data="{ open: null }">
      <li>
      <div>
        <a href="{{ route('home') }}"
        class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-white hover:bg-gray-900">
        Home
      </a>   
      </div>
      </li>

    <li>
    <div>
      <a href="#"
      class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-white hover:bg-gray-900">
      Auditor Dashboard
    </a>   
    </div>
    </li>

    <li>
    <div>
      <a href="#"
      class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-white hover:bg-gray-900">
      Client Dashboard
      </a>   
    </div>
    </li>

    <li>
    <div>
      <a href="#"
      class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-white hover:bg-gray-900">
      Admin Dashboard
      </a>
    </div>
    </li>
{{-- //bikin kondisi jika client maka sebagian menu bakal ilang  --}}
          <li class="relative">
            <button type="button" @click="open = open === 'pre' ? null : 'pre'" class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-white hover:bg-gray-900">
              Data Request
              <svg :class="open === 'pre' ? 'rotate-90' : ''" class="w-4 h-4 ml-auto transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="open === 'pre'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute left-0 w-52 mt-2 bg-white border rounded shadow-lg z-20" x-cloak>
              <ul>
                <li @click="open = null"><a href="#" class="block rounded-md py-2 pl-2 text-sm text-blue-900 hover:bg-blue-100">List Data Request Client</a></li>
                <li @click="open = null"><a href="#" class="block rounded-md py-2 pl-2 text-sm text-blue-900 hover:bg-blue-100">List Data Request Auditor</a></li>
                <li @click="open = null"><a href="#" class="block rounded-md py-2 pl-2 text-sm text-blue-900 hover:bg-blue-100">List Data Request Partner</a></li>
                <li @click="open = null"><a href="#" class="block rounded-md py-2 pl-2 text-sm text-blue-900 hover:bg-blue-100">List Data Request Admin</a></li>
               
               
              </ul>
            </div>
          </li>
    
    <li>
    <div>
      <a href="#"
      class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-white hover:bg-gray-900">
      Notification
      </a>
      
    </div>
    </li>
         
          
          <li class="relative">
            <button type="button" @click="open = open === 'setting' ? null : 'setting'" class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-white hover:bg-gray-900">
              System Setting
              <svg :class="open === 'setting' ? 'rotate-90' : ''" class="w-4 h-4 ml-auto transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="open === 'setting'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute left-0 w-52 mt-2 bg-white border rounded shadow-lg z-20" x-cloak>
              <ul>

                
                <li @click="open = null"><a href="#" class="block rounded-md py-2 pl-2 text-sm text-blue-900 hover:bg-blue-100">My Profile</a></li>
                <li @click="open = null"><a href="#" class="block rounded-md py-2 pl-2 text-sm text-blue-900 hover:bg-blue-100">Setting</a></li>
              </ul>
            </div>
          </li>


          <li>
          <div>
            <a href="#"
            class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-white hover:bg-gray-900">
            Logout
            </a>
          </li>
        </ul>
      </nav>
    </div>

<script>
  // Toggle Submenu (tetap pakai JS vanilla)
  document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.querySelectorAll('[aria-controls]');
    menuButton.forEach(button => {
      button.addEventListener('click', () => {
        const submenu = document.getElementById(button.getAttribute('aria-controls'));
        submenu.classList.toggle('hidden');
      });
    });
  });
</script>

<main :class="sidebarOpen ? 'w-full' : 'w-full'" class="transition-all duration-300 bg-gray-300 p-4">