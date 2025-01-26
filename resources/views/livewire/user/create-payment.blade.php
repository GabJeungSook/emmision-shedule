<div>
    <div class="mt-5 text-4xl font-bold mb-4">
        Payment
    </div>
    <div>
        {{$this->form}}
    </div>
    <div class="mt-3 flex items-center justify-start gap-x-3">
        <a href="{{route('user.view-application', $record->id)}}" class="rounded-md bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Cancel</a>
        <button wire:confirm="Are you sure you want to save this transaction?" wire:click="savePayment" type="button" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Save</button>
    </div>
</div>
