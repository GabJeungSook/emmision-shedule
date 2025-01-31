<div>
    <div class="p-10 flex flex-col justify-center items-center">
        <div class="text-4xl font-bold mb-4 text-center">
            OR\CR
        </div>
        @if($record->attachment)
        <img src="{{ asset('storage/' . $record->attachment) }}" alt="">
        <small class="mt-3 text-center uppercase font-bold text-md">{{$record->payment_method}}</small>
        <a href="{{ asset('storage/' . $record->attachment) }}" target="_blank" download="qr-code.png" class="mt-4 px-4 py-2 bg-gray-800 text-gray-100 rounded">
            Download OR\CR
        </a>
        @endif
    </div>
</div>
