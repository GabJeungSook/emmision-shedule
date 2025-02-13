<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Results
    </div>
    <div class="flex justify-end m-10">
        <a href="{{route('admin.all-result-report')}}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Print All
        </a>
    </div>
    <div class="p-4 mt-5">
        {{ $this->table }}
    </div>
</div>
