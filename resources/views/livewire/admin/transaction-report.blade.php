<div>
    <div class="flex justify-end m-10">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Print
        </button>
    </div>

    <div class="flex justify-end m-10">
        <select wire:model.live="filter" class="bg-white border border-gray-300 text-gray-700 py-2 px-8 rounded">
            <option value="">All</option>
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Annually</option>
        </select>
    </div>

    <div class="container mx-auto">
        <div class="text-center text-3xl font-bold mb-6">Emission Test Center</div>
        <div class="text-center text-xl font-bold mb-6">List of Transactions</div>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Full Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Transaction Number</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Vehicle</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Schedule</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Payment Method</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Amount</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Date Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr class="">
                        <td class="py-2 px-4 border-b border-gray-200">{{ $transaction->user->userDetails->fullName }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $transaction->transaction_number }}</td>
                        <td class="py-2 px-4 border-b border-gray-200 uppercase">{{ $transaction->vehicle->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ Carbon\Carbon::parse($transaction->application->schedule->date)->format('F d, Y') }} ({{$transaction->application->convert_hour}})</td>
                        <td class="py-2 px-4 border-b border-gray-200 uppercase">{{ $transaction->payment_method }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">₱ {{ number_format($transaction->amount, 2) }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ Carbon\Carbon::parse($transaction->created_at)->format('F d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
