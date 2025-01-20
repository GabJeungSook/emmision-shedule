<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Create Schedule
    </div>
    <span class="text-xl">{{ Carbon\Carbon::parse($date)->format('F d, Y') }}</span>
    <p class="mt-5 italic">All schedules are selected by default</p>
    <div>
        @for ($hour = 8; $hour < 17; $hour++)
            @if ($hour != 12)
            @php
            $displayHour = $hour > 12 ? $hour - 12 : $hour;
            $period = $hour >= 11 ? 'pm' : 'am';
            @endphp
            <label class="inline-flex items-center m-2">
                <input type="checkbox" wire:model="selectedHours.{{ $hour-7 }}" class="form-checkbox">
                <span class="ml-2">{{ $displayHour }}-{{ $displayHour + 1 }}{{ $period }}</span>
            </label>
            @endif
        @endfor
    </div>
    <div class="mt-5 w-1/4">
        <div class="sm:col-span-1 ">
            <label for="slot" class="block text-sm/6 font-medium text-gray-900">Slots per schedule</label>
            <div class="mt-2">
              <input wire:model="slots" type="number" min="1" max="10" name="slot" id="slot" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            </div>
          </div>
    </div>
    <div class="mt-6 flex items-center justify-start gap-x-3">
        <a href="{{route('admin.calendar')}}" class="rounded-md bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Cancel</a>
        <button wire:confirm="Are you sure you want to create this schedule?" wire:click="confirmScheduleCreation" type="button" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Save</button>
      </div>
</div>
