<div>
    <div class="mt-5 text-4xl font-bold mb-4">
        Applications
    </div>
    <span class="italic">View your application details</span>
    <div class="mt-10">
        <ul role="list" class="space-y-3">
            @forelse ($applications as $item)
            <li class="overflow-hidden bg-white px-4 py-4 shadow-lg sm:rounded-md sm:px-6 hover:bg-gray-300 rounded-md">
                <a href="{{ route('user.view-application', ['record' => $item->id]) }}">
                    <span class="font-semibold text-lg text-green-600">{{$item->transaction_number }}</span>
                    <p class="font-normal text-lg">{{ Carbon\Carbon::parse($item->schedule->date)->format('F d, Y') }} - ({{$item->convertHour}})</p>
                    <p>Status: {{ $item->status }}</p>
                </a>
            </li>
            @empty
                <li class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                    <span>No application available</span>
                </li>
            @endforelse
            <!-- More items... -->
          </ul>

    </div>
