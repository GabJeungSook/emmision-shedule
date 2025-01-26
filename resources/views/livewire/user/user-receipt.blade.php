<div>
    <div class="p-10 flex flex-col justify-center items-center">
        <div class="text-4xl font-bold mb-4 text-center">
            Receipt
        </div>
        @if($record->attachment)
        <img src="{{ asset('storage/' . $record->attachment) }}" alt="">
        <small class="mt-3 text-center uppercase font-bold text-md">{{$record->payment_method}}</small>
        <a href="{{ asset('storage/' . $record->attachment) }}" target="_blank" download="qr-code.png" class="mt-4 px-4 py-2 bg-gray-800 text-gray-100 rounded">
            Download Receipt
        </a>
        @endif
        <a href="{{route('user.transaction-details', $record->id)}}" class="mt-5 rounded-md bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Cancel</a>
    </div>
</div>
