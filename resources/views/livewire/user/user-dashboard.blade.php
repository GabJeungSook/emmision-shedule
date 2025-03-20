<div>
    <div class="mt-5 text-4xl font-bold mb-4">
        My Profile
    </div>
    <div>
        <div>
            <div class="px-4 sm:px-0">
              {{-- <h3 class="text-base/7 font-semibold text-gray-900">Applicant Information</h3> --}}
              <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">Personal details.</p>
            </div>
            <div class="mt-6 border-t border-gray-100">
                @php
                    $user = App\Models\User::find(Auth::user()->id);
                @endphp
              <dl class="divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Full name</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$user->userDetails->fullName}}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Gender</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$user->userDetails->gender}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Full Address</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$user->userDetails->address}}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Phone</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$user->userDetails->phone}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm/6 font-medium text-gray-900">Email</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$user->userDetails->email}}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm/6 font-medium text-gray-900">Vehicle</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$user->userDetails->vehicle->name}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm/6 font-medium text-gray-900">Plate Number</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$user->userDetails->plate_number}}</dd>
                </div>
              </dl>
            </div>
          </div>

      </div>

</div>
