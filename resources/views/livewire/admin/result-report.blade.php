<div>
    <div class="flex justify-end m-10">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Print
        </button>
    </div>

    <div class="container mx-auto print-container">
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
        <div class="mt-5 p-5 bg-gray-300 w-full text-center">
            <span class="font-bold tracking-wider text-4xl">Testing Result</span>
        </div>
        <div class="mt-5 w-full p-4 border border-gray-600">
            <div class="grid grid-cols-2 space-x-3">
                <img src="{{ asset('storage/' . $record->attachment) }}" alt="">
                <div>
                    <div class="w-full p-2 border border-gray-600 text-center font-bold tracking-widest text-3xl">
                        SUMMARY
                    </div>
                    <div class="">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border border-gray-200 bg-gray-100 text-left">CO (%)</th>
                                    <th class="py-2 px-4 border border-gray-200 bg-white-100 text-left">{{$record->co}}</th>
                                </tr>
                                <tr>
                                    <th class="py-2 px-4 border border-gray-200 bg-gray-100 text-left">HC (%)</th>
                                    <th class="py-2 px-4 border border-gray-200 bg-white-100 text-left">{{$record->hc}}</th>
                                </tr>
                                <tr>
                                    <th class="py-2 px-4 border border-gray-200 bg-gray-100 text-left">CO2 (%)</th>
                                    <th class="py-2 px-4 border border-gray-200 bg-white-100 text-left">{{$record->co2}}</th>
                                </tr>
                                <tr>
                                    <th class="py-2 px-4 border border-gray-200 bg-gray-100 text-left">O2 (%)</th>
                                    <th class="py-2 px-4 border border-gray-200 bg-white-100 text-left">{{$record->o2}}</th>
                                </tr>
                                <tr>
                                    <th class="py-2 px-4 border border-gray-200 bg-gray-100 text-left">Lambda</th>
                                    <th class="py-2 px-4 border border-gray-200 bg-white-100 text-left">{{$record->lambda}}</th>
                                </tr>
                                <tr>
                                    <th class="py-2 px-4 border border-gray-200 bg-gray-100 text-left">NOx</th>
                                    <th class="py-2 px-4 border border-gray-200 bg-white-100 text-left">{{$record->nox}}</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="mt-3 w-full p-2 border border-gray-600 text-center font-bold tracking-widest text-md">
                            RESULT
                        </div>
                        <div class="mt-3 w-full p-2 border border-gray-600 text-center font-bold tracking-widest text-md {{ $record->passed_or_failed == 'Passed' ? 'text-green-500' : 'text-red-500' }}">
                            {{ $record->passed_or_failed }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <table class="mt-10 min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Purpose</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td class="py-2 px-4 border-b border-gray-200">{!! str($record->result)->sanitizeHtml() !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
            .print-container {
                position: absolute;
                top: 0;
                left: 0;
            }
        }
    </style>
</div>


