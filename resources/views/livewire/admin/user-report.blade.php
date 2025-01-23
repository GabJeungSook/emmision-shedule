<div>
    <div class="flex justify-end m-10">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Print
        </button>
    </div>

<div class="container mx-auto">
    <div class="text-center text-3xl font-bold mb-6">Emission Test Center</div>
    <div class="text-center text-xl font-bold mb-6">List of Users</div>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Full Name</th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Gender</th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Address</th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Phone</th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="">
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->userDetails->fullname }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->userDetails->address }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 uppercase">{{ $user->userDetails->gender }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->userDetails->phone }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->userDetails->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
</div>
