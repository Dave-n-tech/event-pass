 <section class="py-16 bg-indigo-50">
     <div class="container mx-auto px-4">
         <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12">
             <div class="grid md:grid-cols-2 gap-8 items-center">
                 <div>
                     <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                         Ready to host your own event?
                     </h2>
                     <p class="text-gray-600 mb-6">
                         Create, promote, and manage your events with our easy-to-use
                         platform. Reach more attendees and streamline your event
                         management.
                     </p>
                     <div class="space-y-4">
                         {{-- Easy Event Creation --}}
                         <div class="flex items-start">
                             <div class="flex-shrink-0 p-1 bg-indigo-100 rounded-full text-indigo-600">
                                 {{-- Heroicon: CalendarDays --}}
                                 <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16M4 11v8a2 2 0 002 2h12a2 2 0 002-2v-8">
                                     </path>
                                 </svg>
                             </div>
                             <div class="ml-4">
                                 <h3 class="text-lg font-medium text-gray-900">
                                     Easy Event Creation
                                 </h3>
                                 <p class="text-sm text-gray-600">
                                     Set up your event in minutes with our intuitive tools.
                                 </p>
                             </div>
                         </div>

                         {{-- Ticket Management --}}
                         <div class="flex items-start">
                             <div class="flex-shrink-0 p-1 bg-indigo-100 rounded-full text-indigo-600">
                                 {{-- Heroicon: Ticket --}}
                                 <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M9 21H7a2 2 0 01-2-2v-2a1 1 0 010-2v-2a1 1 0 010-2V9a1 1 0 010-2V5a2 2 0 012-2h2a1 1 0 012 0h2a1 1 0 012 0h2a2 2 0 012 2v2a1 1 0 010 2v2a1 1 0 010 2v2a1 1 0 010 2v2a2 2 0 01-2 2h-2a1 1 0 01-2 0h-2a1 1 0 01-2 0z">
                                     </path>
                                 </svg>
                             </div>
                             <div class="ml-4">
                                 <h3 class="text-lg font-medium text-gray-900">
                                     Ticket Management
                                 </h3>
                                 <p class="text-sm text-gray-600">
                                     Sell tickets and track sales in real-time.
                                 </p>
                             </div>
                         </div>

                         {{-- Attendee Insights --}}
                         <div class="flex items-start">
                             <div class="flex-shrink-0 p-1 bg-indigo-100 rounded-full text-indigo-600">
                                 {{-- Heroicon: Users --}}
                                 <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 10-8 0 4 4 0 008 0zm6 0a4 4 0 00-3-3.87">
                                     </path>
                                 </svg>
                             </div>
                             <div class="ml-4">
                                 <h3 class="text-lg font-medium text-gray-900">
                                     Attendee Insights
                                 </h3>
                                 <p class="text-sm text-gray-600">
                                     Get valuable data about your attendees and their preferences.
                                 </p>
                             </div>
                         </div>
                     </div>
                     <div class="mt-8">
                         <a href="{{ route('register') }}"
                             class="inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                             Get Started for Free
                         </a>
                     </div>
                 </div>
                 <div class="hidden md:block">
                     <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1769&q=80"
                         alt="Event planning" class="w-full h-auto rounded-lg shadow-md" />
                 </div>
             </div>
         </div>
     </div>
 </section>
