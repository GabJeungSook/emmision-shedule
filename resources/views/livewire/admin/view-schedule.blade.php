<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Schedule Details
    </div>
    @if ($record->applications->count() <= 0)
    <div class="flex justify-end mr-5">
        <button wire:confirm="Are you sure you want to cancel this schedule?" wire:click="cancelSchedule" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-gray-50 shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
          <div class="flex space-x-1">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <span class="mt-1">Cancel Schedule</span>
          </div>
      </button>
</div>
    @endif

    <div class="p-4 mt-5">
        <div>
            <div class="px-4 sm:px-0">
              <p class="mt-1 max-w-2xl text-sm/6 text-gray-500"></p>
            </div>
            <div class="mt-6 border-t border-gray-100">
              <dl class="divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Date</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{Carbon\Carbon::parse($record->date)->format('F d, Y')}}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Total Slots</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->slots * count(json_decode($record->hours))}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    @php
                    $slot_taken = $transactions
                    ->where('application.schedule_id', $record->id)
                    ->where('status', 'Approved')
                    ->count();
                    @endphp
                  <dt class="text-sm/6 font-medium text-gray-900">Available Slots</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{($record->slots * count(json_decode($record->hours))) - $slot_taken}}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Available Hours</dt>
                  <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                      <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm/6">
                        @foreach(json_decode($record->hours) as $hour)
                        @php
                        $hour_display = match($hour) {
                            1 => '8-9am',
                            2 => '9-10am',
                            3 => '10-11am',
                            4 => '11am-12pm',
                            5 => '12-1pm',
                            6 => '1-2pm',
                            7 => '2-3pm',
                            8 => '3-4pm',
                            9 => '4-5pm',
                            default => 'Invalid hour',
                        };

                        $hour_slot_taken = $transactions
                        ->where('application.schedule_id', $record->id)
                        ->where('application.hour', $hour)
                        ->where('status', 'Approved')
                        ->count();
                        @endphp
                            <div class="flex w-0 flex-1 items-center">
                                {{-- <svg class="size-5 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 0 0-4.242 0l-7 7a3 3 0 0 0 4.241 4.243h.001l.497-.5a.75.75 0 0 1 1.064 1.057l-.498.501-.002.002a4.5 4.5 0 0 1-6.364-6.364l7-7a4.5 4.5 0 0 1 6.368 6.36l-3.455 3.553A2.625 2.625 0 1 1 9.52 9.52l3.45-3.451a.75.75 0 1 1 1.061 1.06l-3.45 3.451a1.125 1.125 0 0 0 1.587 1.595l3.454-3.553a3 3 0 0 0 0-4.242Z" clip-rule="evenodd" />
                                </svg> --}}
                                <div class="ml-3 text-center min-w-0 flex-1 gap-2 bg-green-200 p-1 rounded-md">
                                    <span class="truncate font-medium ">{{ \Carbon\Carbon::createFromTime($hour + 7)->format('gA') }} - {{ \Carbon\Carbon::createFromTime($hour + 8)->format('gA') }}</span>
                                    <span class="truncate font-medium ">Slots: {{ $record->slots - $hour_slot_taken }} </span>
                                </div>
                            </div>
                        @endforeach
                      </li>
                    </ul>
                  </dd>
                </div>
              </dl>
              <div class="px-4 sm:px-0">
                <h3 class="text-base/7 font-semibold text-gray-900">Occupied Slots</h3>
              </div>
              <div class="mt-5">
                {{$this->table}}
              </div>
              <div class="mt-6 flex items-center justify-start gap-x-3">
                <a href="{{route('admin.calendar')}}" class="rounded-md bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Cancel</a>
              </div>
            </div>
          </div>
    </div>
</div>
