{{-- <x-dashboard-layout> --}}
<div>
    <div class="flex justify-between w-full max-w-full px-3 py-3 text-right">
        <div>
            @if (session()->has('message'))
                <div alert class="p-2 text-white border border-solid rounded-lg bg-gradient-lime border-slate-100">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <a class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-dark-gray hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25"
            href="{{ route('transaction.create') }}"> <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Add New
            Transaction</a>
    </div>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>List Transaction</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        No</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Name Product</th>
                                    <th <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Quantity</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Price Amount</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $item)
                                    <tr>
                                        <td
                                            class="p-2 leading-normal text-left align-middle bg-transparent border-b text-size-sm whitespace-nowrap shadow-transparent">
                                            <span class="font-semibold leading-tight text-size-xs text-slate-400">
                                                {{ $loop->iteration }}
                                            </span>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-left align-middle bg-transparent border-b text-size-sm whitespace-nowrap shadow-transparent">
                                            <span
                                                class="font-semibold leading-tight text-size-xs text-slate-400">{{ $item->product->title }}</span>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-left align-middle bg-transparent border-b text-size-sm whitespace-nowrap shadow-transparent">
                                            <span
                                                class="font-semibold leading-tight text-size-xs text-slate-400">{{ $item->quantity }}</span>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span
                                                class="font-semibold leading-tight text-size-xs text-slate-400">{{ $item->amount }}</span>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span
                                                class="font-semibold leading-tight text-size-xs text-slate-400">{{ Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }}</span>
                                        </td>
                                        <td @if (Auth::user()->name == 'admin') class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="{{ route('transaction.update', ['id' => $item->id]) }}"
                                                class="mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-orange uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-white">
                                                Edit </a>
                                            <button wire:click="destroy({{ $item->id }})"
                                                class="mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-red uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-white">
                                                Delete </button> @endif
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- </x-dashboard-layout> --}}
