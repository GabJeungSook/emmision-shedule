<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        @filamentStyles
        @vite('resources/css/app.css')

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<div x-data="{ open: false }">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
      <!--
        Off-canvas menu backdrop, show/hide based on off-canvas menu state.

        Entering: "transition-opacity ease-linear duration-300"
          From: "opacity-0"
          To: "opacity-100"
        Leaving: "transition-opacity ease-linear duration-300"
          From: "opacity-100"
          To: "opacity-0"
      -->
      <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80" aria-hidden="true"></div>

      <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed inset-0 flex">
        <!--
          Off-canvas menu, show/hide based on off-canvas menu state.

          Entering: "transition ease-in-out duration-300 transform"
            From: "-translate-x-full"
            To: "translate-x-0"
          Leaving: "transition ease-in-out duration-300 transform"
            From: "translate-x-0"
            To: "-translate-x-full"
        -->
        <div class="relative mr-16 flex w-full max-w-xs flex-1">
          <!--
            Close button, show/hide based on off-canvas menu state.

            Entering: "ease-in-out duration-300"
              From: "opacity-0"
              To: "opacity-100"
            Leaving: "ease-in-out duration-300"
              From: "opacity-100"
              To: "opacity-0"
          -->
          <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
            <button @click="open = false" type="button" class="-m-2.5 p-2.5">
              <span class="sr-only">Close sidebar</span>
              <svg class="size-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Sidebar component, swap this element with another sidebar if you like -->
          <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-green-600 px-6 pb-2">
            <div class="flex h-16 shrink-0 items-center font-extrabold text-white text-2xl tracking-wider">
                    Emission Test Center
              {{-- <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=white" alt="Your Company"> --}}
            </div>
            <nav class="flex flex-1 flex-col">
              <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                      <li>
                        <a wire:navigate href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                          <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                          </svg>
                          My Profile
                        </a>
                      </li>
                      <li>
                        <a href="{{ route('user.view-schedules') }}" class="{{ request()->routeIs('user.view-schedules') || request()->routeIs('admin.create-schedule') || request()->routeIs('admin.view-schedule') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                            <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Schedules
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('user.view-transaction') }}" class="{{ request()->routeIs('user.view-transaction') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                          <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                          </svg>
                          Transactions
                        </a>
                      </li>
                      <li>
                        <div class="text-xs/6 font-semibold text-green-200">Reports</div>
                        <ul role="list" class="-mx-2 mt-2 space-y-1">
                          <li>
                            <!-- Current: "bg-green-700 text-white", Default: "text-green-200 hover:text-white hover:bg-green-700" -->
                            <a wire:navigate href="{{ route('user.my-transactions') }}" class="{{ request()->routeIs('user.my-transactions') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                              <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">M</span>
                              <span class="truncate">My Transactions</span>
                            </a>
                          </li>
                          {{-- <li>
                            <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white">
                              <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">T</span>
                              <span class="truncate">Tailwind Labs</span>
                            </a>
                          </li>
                          <li>
                            <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white">
                              <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">W</span>
                              <span class="truncate">Workcation</span>
                            </a>
                          </li> --}}
                        </ul>
                      </li>
                      <li class="mr-16 mt-auto">
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="m-4 w-full group flex gap-x-3 rounded-md py-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-gray-100 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                  </svg>
                                Logout
                            </button>
                        </form>
                      </li>
                    </ul>
                  </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-green-600 px-6">
        <div class="flex h-16 shrink-0 items-center font-extrabold text-white text-2xl tracking-wider">
            Emission Test Center
        </div>
        <nav class="flex flex-1 flex-col">
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            @if(Auth::user()->role == 'admin')
            <li>
              <ul role="list" class="-mx-2 space-y-1">
                <li>
                  <a wire:navigate href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                    <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                  </a>
                </li>
                <li>
                  <a wire:navigate href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                    <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Users
                  </a>
                </li>
                <li>
                    <a href="{{ route('admin.vehicle-type') }}" class="{{ request()->routeIs('admin.vehicle-type') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                        <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                          </svg>
                        Vehicle Types
                    </a>
                  </li>
                <li>
                <li>
                    <a href="{{ route('admin.calendar') }}" class="{{ request()->routeIs('admin.calendar') || request()->routeIs('admin.create-schedule') || request()->routeIs('admin.view-schedule') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                        <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        Manage Schedules
                    </a>
                  </li>
                <li>
                  <a wire:navigate href="{{ route('admin.transactions') }}" class="{{ request()->routeIs('admin.transactions') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                    <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                    </svg>
                    Transactions
                  </a>
                </li>
              </ul>
            </li>
            <li>
              <div class="text-xs/6 font-semibold text-green-200">Reports</div>
              <ul role="list" class="-mx-2 mt-2 space-y-1">
                <li>
                  <!-- Current: "bg-green-700 text-white", Default: "text-green-200 hover:text-white hover:bg-green-700" -->
                  <a wire:navigate href="{{ route('admin.user-report') }}" class="{{ request()->routeIs('admin.user-report') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">U</span>
                    <span class="truncate">User Report</span>
                  </a>
                </li>
                <li>
                  <a wire:navigate href="{{ route('admin.transaction-report') }}" class="{{ request()->routeIs('admin.transaction-report') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">T</span>
                    <span class="truncate">Transaction Report</span>
                  </a>
                </li>
                {{-- <li>
                  <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">W</span>
                    <span class="truncate">Workcation</span>
                  </a>
                </li> --}}
              </ul>
            </li>


            <li class="-mx-6 mt-auto">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="w-full group flex gap-x-3 rounded-md py-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white">
                        <svg class="h-6 w-6 shrink-0 text-gray-100 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                          </svg>
                        Logout
                    </button>
                </form>
              </li>
              @else
              <li>
                <ul role="list" class="-mx-2 space-y-1">
                  <li>
                    <a wire:navigate href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                      <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                      </svg>
                      My Profile
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('user.view-schedules') }}" class="{{ request()->routeIs('user.view-schedules') || request()->routeIs('admin.create-schedule') || request()->routeIs('admin.view-schedule') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                        <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        Schedules
                    </a>
                  </li>
                  <li>
                    <a wire:navigate href="{{ route('user.view-transaction') }}" class="{{ request()->routeIs('user.view-transaction') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                      <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                      </svg>
                      Transactions
                    </a>
                  </li>
                  <li>
                    <div class="text-xs/6 font-semibold text-green-200">Reports</div>
                    <ul role="list" class="-mx-2 mt-2 space-y-1">
                      <li>
                        <!-- Current: "bg-green-700 text-white", Default: "text-green-200 hover:text-white hover:bg-green-700" -->
                        <a wire:navigate href="{{ route('user.my-transactions') }}" class="{{ request()->routeIs('user.my-transactions') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                          <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">M</span>
                          <span class="truncate">My Transactions</span>
                        </a>
                      </li>
                      {{-- <li>
                        <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white">
                          <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">T</span>
                          <span class="truncate">Tailwind Labs</span>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white">
                          <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">W</span>
                          <span class="truncate">Workcation</span>
                        </a>
                      </li> --}}
                    </ul>
                  </li>
                  <li class="mr-16 mt-auto">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="m-4 w-full group flex gap-x-3 rounded-md py-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white">
                            <svg class="h-6 w-6 shrink-0 text-gray-100 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                              </svg>
                            Logout
                        </button>
                    </form>
                  </li>
                  @endif
                </ul>
              </li>
          </ul>
        </nav>
      </div>
    </div>

    <div @click="open = true" class="sticky top-0 z-40 flex items-center gap-x-6 bg-green-600 px-4 py-4 shadow-sm sm:px-6 lg:hidden">
      <button type="button" class="-m-2.5 p-2.5 text-green-200 lg:hidden">
        <span class="sr-only">Open sidebar</span>
        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
      <div class="flex-1 text-sm/6 font-semibold text-white">Dashboard</div>
      <a href="#">
        <span class="sr-only">Your profile</span>
        {{-- <img class="size-8 rounded-full bg-green-700" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt=""> --}}
      </a>
    </div>

    <main class="py-10 lg:pl-72">
      <div class="px-4 sm:px-6 lg:px-8">
        {{$slot}}
      </div>
    </main>
  </div>
  @livewireScripts
  @livewire('notifications')
  @filamentScripts
  @vite('resources/js/app.js')
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    </body>
</html>
