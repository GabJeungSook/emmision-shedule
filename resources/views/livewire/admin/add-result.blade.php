<div>
   <div class="mt-5 text-4xl font-bold mb-4">
       Transaction Details
   </div>
   <div>
       <div>
           <div class="px-4 sm:px-0">
           </div>
           <div class="mt-6 border-t border-gray-100">
               @php
                   $user = App\Models\User::find(Auth::user()->id);
               @endphp
             <dl class="divide-y divide-gray-100">
               <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">User</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->user->userDetails->fullName}}</dd>
                </div>
               <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                 <dt class="text-sm/6 font-medium text-gray-900">Reference Number</dt>
                 <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->transaction_number}}</dd>
               </div>
               <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                <dt class="text-sm/6 font-medium text-gray-900">Vehicle</dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{ $record->vehicle->name }}</dd>
              </div>
              <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                <dt class="text-sm/6 font-medium text-gray-900">Plate Number</dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{ $record->user->userDetails->plate_number}}</dd>
              </div>
               <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                 <dt class="text-sm/6 font-medium text-gray-900">Schedule</dt>
                 <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{ Carbon\Carbon::parse($record->application->schedule->date)->format('F d, Y') }} - ({{$record->application->convertHour}})</dd>
               </div>
               <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                 <dt class="text-sm/6 font-medium text-gray-900">Date Created</dt>
                 <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ Carbon\Carbon::parse($record->created_at)->format('F d, Y h:i A') }}</dd>
               </div>
               <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                 <dt class="text-sm/6 font-medium text-gray-900">Status</dt>
                 <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$record->status}}</dd>
               </div>
               <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                <dt class="text-sm/6 font-medium text-gray-900">Payment</dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ '₱ '.number_format($record->amount, 2) }}</dd>
              </div>
             </dl>
           </div>
         </div>
         @if ($record->status === "Approved")
         <div class="mt-5 text-2xl font-bold mb-4">
            Add Result
        </div>
         <div class="mt-5">
            {{$this->form}}
         </div>
         <div class="mt-3 ml-2 flex items-center justify-start gap-x-3">
           <a href="{{route('admin.transactions')}}" class="rounded-md bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Cancel</a>
           <button wire:confirm="Are you sure you want to add this result?" wire:click="confirmTransactionResult" type="button" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Save</button>
           {{-- <a href="{{route('user.user-receipt', $record->id)}}" type="button" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">View Receipt</a>
           @if($record->status === "Approved")
           <a href="{{route('user.user-qr-code', $record->id)}}" type="button" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">View QR Code</a>
           @endif --}}
         </div>
         @endif

     </div>
</div>
