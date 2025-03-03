<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Admin Dashboard
    </div>
    <div>
        @php
            $transactions = App\Models\UserPayment::all();
            $users = App\Models\User::all();
            $schedules = App\Models\Schedule::all();
        @endphp
        {{-- <h3 class="text-base font-semibold text-gray-900">Last 30 days</h3> --}}
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
          <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total Users</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{$users->where('role', 'user')->count()}}</dd>
          </div>
          <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total Transactions</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{$transactions->count()}}</dd>
          </div>
          <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total Schedules</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{$schedules->count()}}</dd>
          </div>
        </dl>
      </div>
</div>
