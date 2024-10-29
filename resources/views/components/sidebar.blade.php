 <!-- Sidebar -->
 <div livewire:update id="hs-offcanvas-body-scrolling" 
     class="mt-12 hs-overlay [--body-scroll:true] [--overlay-backdrop:false]  hs-overlay-open:-translate-x-full translate-x-0  transition-all duration-300 transform w-[248px] h-full hidden
 fixed inset-y-0 start-0 z-[1]
 bg-white border-e border-gray-200
  lg:block  lg:end-auto lg:bottom-0
 dark:bg-neutral-800 dark:border-neutral-700"
     role="dialog" tabindex="-1" aria-label="Sidebar">
     <div class="relative flex flex-col h-full max-h-full">
         <div class="px-6 pt-2">
             <!-- Logo -->
             <!-- End Logo -->
         </div>

         <!-- Content -->
         <div class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
             <nav class="flex flex-col flex-wrap w-full p-3 hs-accordion-group" data-hs-accordion-always-open>
                 <ul class="flex flex-col space-y-1">
                     {{ $slot }}
                 </ul>
             </nav>
         </div>
         <!-- End Content -->
     </div>
 </div>
 <!-- End Sidebar -->
