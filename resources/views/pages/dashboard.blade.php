@extends('layout.index')

@section('page')

<div class="flex w-full">
   <div class="">

      <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-white rounded-lg sm:hidden hover:bg-[#38419D] focus:outline-none focus:ring-2 focus:ring-gray-200   dark:focus:ring-gray-600">
         <span class="sr-only">Open sidebar</span>
         <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
         <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
         </svg>
      </button>
      
      <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-10 w-[15%] h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
         <div class="h-full px-3 py-4 overflow-y-auto bg-blue-500">
            <div class="my-5 mx-3">
                <div class="inline-block relative shrink-0 cursor-pointer rounded-[.95rem] flex gap-3">
                <img class="w-[40px] h-[40px] shrink-0 inline-block rounded-[.95rem]" src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/riva-dashboard-tailwind/img/avatars/avatar1.jpg" alt="avatar image">
                <p class="font-medium text-center my-auto text-gray-50">{{auth()->user()->userName}}</p>
               </div>
            </div>
            <ul class="space-y-2 font-medium">
               <li>
                  <a href="{{route('dashboard')}}" class="flex items-center p-2 text-white rounded-lg group transition ease-in delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50">
                     <svg class="w-5 h-5 text-white transition duration-75   " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                     </svg>
                     <span class="ms-3">Dashboard</span>
                  </a>
               </li>
               <li>
                  <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50" aria-controls="dropdown-order" data-collapse-toggle="dropdown-order">
                     <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                        <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                     </svg>
                     <span  class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Orders</span>
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                     </svg>
                  </button>
                     <ul id="dropdown-order" class="hidden py-2 space-y-2 transition ease-in-out delay-100 hover:-translate-y-1 duration-250 " >
                        <li>
                           <a href="{{route('orderProductList')}}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50 ">
                              Receive Orders
                           </a>
                        </li>
                        <li>
                           <a href="{{route('orderProductList')}}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50 ">
                              Order Story
                           </a>
                        </li>
                     </ul>

               </li>
               <li>
                  <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                     </svg>
                     <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Product</span>
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                     </svg>
                  </button>
                  <ul id="dropdown-example" class="hidden py-2 space-y-2 transition ease-in-out delay-100 hover:-translate-y-1 duration-250 ">
                        <li>
                           <a href="{{route('showProduct')}}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50  ">Product Available</a>
                        </li>
                        <li>
                           <a href="{{route('showManagementProduct')}}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50  ">Manage Product</a>
                        </li>
                        <li>
                           <a href="{{route('showCategory')}}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50">Category</a>
                        </li>
                  </ul>
               </li>
      
               <li>
                  <div class="flex items-center p-2 text-white rounded-lg  transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50 group">
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                     </form>
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit()"  class="flex items-center p-2 text-white rounded-lg  transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-60 hover:bg-[#38419D] duration-50 group">
                           <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75   " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                           </svg>
                           <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
                        </button>
                  </div>
               </li>
      
            </ul>
         </div>
      </aside>

   </div>

   <div class="sm:ml-[15%] w-full ">
   @yield('content')
   </div>
</div>

<script>
 const toggleButton = document.querySelector('[aria-controls="dropdown-example"]');
   const dropdown = document.getElementById('dropdown-example');
   toggleButton.addEventListener('click', function(event) {
       dropdown.classList.toggle('hidden');
   });
   document.addEventListener('click', function(event) {
       if (!toggleButton.contains(event.target) && !dropdown.contains(event.target)) {
           dropdown.classList.add('hidden');
       }
   });
   const toggleOrderButton = document.querySelector('[aria-controls="dropdown-order"]');
   const dropdownOrder = document.getElementById('dropdown-order');
   toggleOrderButton.addEventListener('click', function(event) {
       dropdownOrder.classList.toggle('hidden');
   });
   document.addEventListener('click', function(event) {
       if (!toggleOrderButton.contains(event.target) && !dropdownOrder.contains(event.target)) {
           dropdownOrder.classList.add('hidden');
       }
   });


</script>
@endsection
