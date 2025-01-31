<div>
    <div class="mt-5 text-4xl font-bold mb-4">
        Create Application
    </div>
    <div class="p-4 mt-5 grid grid-cols-2 gap-y-6">
        <div class="col-span-2">
        <div class="mt-1">
            <label class="block text-sm font-medium text-gray-700">Select Available Time Slot</label>
            <div class="mt-2 space-y-4">
                <div class="space-y-4" x-data="{ selectedHour: @entangle('selected_hour') }">
                    @foreach(json_decode($record->hours) as $hour)
                        <div
                            class="grid grid-cols-1 gap-4 md:inline-flex items-center mx-4 p-2 rounded-md cursor-pointer bg-green-600"
                            :class="{'bg-yellow-700': selectedHour === '{{ $hour }}'}"
                            @click="selectedHour = '{{ $hour }}'; $wire.set('selected_hour', '{{ $hour }}')">
                            <input wire:model="selected_hour" name="hour" type="radio" value="{{ $hour }}" class="hidden">
                            <label for="{{ $hour }}" class="ml-1 block text-sm font-medium text-gray-50">
                                {{ \Carbon\Carbon::createFromTime($hour + 7)->format('gA') }} - {{ \Carbon\Carbon::createFromTime($hour + 8)->format('gA') }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1">
        {{$this->form}}
        </div>
        </div>
        <div class="mt-3 flex items-center justify-start gap-x-3">
            <a href="{{route('user.view-schedules')}}" class="rounded-md bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Cancel</a>
            <button wire:confirm="Are you sure you want to save this application?" wire:click="saveTransaction" type="button" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Save</button>
        </div>

    </div>
</div>
