<div>
    <div class="flex justify-end m-10">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Print
        </button>
    </div>

<div class="container mx-auto">
    <div class="text-center text-3xl font-bold mb-6">Emission Test Center</div>
    <div class="text-center text-xl font-bold mb-6">Result Report</div>
    <div class="flex justify-between">
        <div class="w-1/2 space-y-3">
            <div class="text-md font-semibold">Full Name: {{$record->user->userDetails->fullName}}</div>
            <div class="text-md font-semibold">Address: {{$record->user->userDetails->address}}</div>
            <div class="text-md font-semibold">Vehicle: {{$record->user_payment->vehicle->name}}</div>
            <div class="text-md font-semibold">Plate Number: {{$record->user->userDetails->plate_number}}</div>
        </div>
    </div>
    <table class="mt-10 min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Result</th>
            </tr>
        </thead>
        <tbody>
            <tr class="">
                <td class="py-2 px-4 border-b border-gray-200">{!! str($record->result)->sanitizeHtml() !!}</td>
            </tr>
        </tbody>
    </table>
</div>

</div>
</div>
