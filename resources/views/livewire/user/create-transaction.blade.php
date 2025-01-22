<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Create Transaction
    </div>
    <div class="p-4 mt-5 grid grid-cols-2 gap-y-6">
        <div class="col-span-2">
            {{-- <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="border-t border-gray-100">
                  <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                      <dt class="text-sm font-medium text-gray-900">Full name</dt>
                      <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$user->userDetails->fullName}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                      <dt class="text-sm font-medium text-gray-900">Gender</dt>
                      <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$user->userDetails->gender}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                      <dt class="text-sm font-medium text-gray-900">Phone Number</dt>
                      <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$user->userDetails->phone}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-900">Email</dt>
                        <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$user->userDetails->email}}</dd>
                      </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                      <dt class="text-sm font-medium text-gray-900">Address</dt>
                      <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$user->userDetails->address}}</dd>
                    </div>
                  </dl>
                </div>
              </div> --}}
        </div>
        <div class="col-span-2">
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Select Time Slot</label>
            <div class="mt-2 space-y-4">
           @foreach(json_decode($record->hours) as $hour)
            <div class="inline-flex items-center ml-4">
            <input wire:model="selected_hour" name="hour" type="radio" value="{{ $hour }}" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
            <label for="{{ $hour }}" class="ml-1 block text-sm font-medium text-gray-700">
                {{ \Carbon\Carbon::createFromTime($hour + 7)->format('gA') }} - {{ \Carbon\Carbon::createFromTime($hour + 8)->format('gA') }}
            </label>
            </div>
            @endforeach
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1">
        {{$this->form}}
        </div>
        </div>
        <div class="mt-3 flex items-center justify-start gap-x-3">
            <a href="{{route('user.view-schedules')}}" class="rounded-md bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Cancel</a>
            <button wire:confirm="Are you sure you want to save this transaction?" wire:click="saveTransaction" type="button" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Save</button>
          </div>

    </div>
</div>
