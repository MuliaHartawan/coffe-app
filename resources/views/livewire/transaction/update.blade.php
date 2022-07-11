{{-- <x-dashboard-layout> --}}
@error('message')
    <div alert class="p-2 text-white border w-2/5 border-solid rounded-lg bg-gradient-red border-slate-100">
        {{ $message }}
    </div>
@enderror
<div class="w-full max-w-full px-3 mt-6 md:w-5/12 md:flex-none">
    <div
        class="relative flex flex-col h-full min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
            <div class="flex flex-wrap -mx-3">
                <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                    <h6 class="mb-0">Create New Transaction</h6>
                </div>
                <div class="flex items-center justify-end max-w-full px-3 md:w-1/2 md:flex-none">
                </div>
            </div>
        </div>
        <div class="flex-auto p-4 pt-6">
            <form wire:submit.prevent="update">
                <input type="hidden" wire:model="transactionId">
                <div class="flex gap-4">
                    <div class="w-full">
                        <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Name Product</label>
                        <div class="mb-4">
                            <select
                                class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                name="" id="" wire:model="productId">
                                @foreach ($products as $item)
                                    <option value="{{ $item->id }}"
                                        @if ($item->id === $productId) selected @endif>{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('productId')
                                <span class="text-red-500 text-xs">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full">
                        <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Quantity</label>
                        <div class="mb-4">
                            <input type="number" wire:model="quantity"
                                class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                placeholder="Input name product" aria-label="text" aria-describedby="text-addon">
                            @error('quantity')
                                <span class="text-red-500 text-xs">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-right mr-4">
                    <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Price</label>
                    <span>{{ $price }}</span>
                </div>
                <div class="text-right mr-4">
                    <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Amount</label>
                    <span>{{ $amount }}</span>
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-size-xs ease-soft-in tracking-tight-soft bg-gradient-cyan hover:scale-102 hover:shadow-soft-xs active:opacity-85">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- </x-dashboard-layout> --}}
