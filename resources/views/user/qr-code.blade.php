<div>
    <div class="p-10 flex flex-col justify-center items-center">
        <div class="text-4xl font-bold mb-4 text-center">
            QR Code
        </div>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{$record->transaction_number}}" alt="">
        <small class="mt-3 text-center">{{$record->transaction_number}}</small>
        <a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{$record->transaction_number}}" target="_blank" download="qr-code.png" class="mt-4 px-4 py-2 bg-gray-800 text-gray-100 rounded">
            Download QR Code
        </a>
    </div>
</div>
