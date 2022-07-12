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
            href="{{ route('product.create') }}"> <i class="fas fa-plus" aria-hidden="true"> </i>&nbsp;&nbsp;Add New
            Product</a>
    </div>
    <div class="p-6 pb-0 mb-0">
        <h6>List Product</h6>
    </div>
    <div class="flex flex-wrap gap-4 mb-5">
        @foreach ($products as $item)
            <div class="w-full px-8 my-4 max-w-full mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="relative">
                        @if ($item->image)
                            <a class="block shadow-xl rounded-2xl">
                                <img src="{{ asset('storage/' . $item->image . '') }}" alt="img-blur-shadow"
                                    class="max-w-full shadow-soft-2xl rounded-2xl" />
                            </a>
                        @else
                            <a class="block shadow-xl rounded-2xl">
                                <img src="http://www.sitech.co.id/assets/img/products/default.jpg" alt="img-blur-shadow"
                                    class="max-w-full shadow-soft-2xl rounded-2xl" />
                            </a>
                        @endif
                    </div>
                    <div class="flex-auto px-1 pt-6">

                        <h5>{{ $item->title }}</h5>
                        <div class="flex justify-between">
                            <p
                                class="mb-2 leading-normal text-transparent bg-gradient-dark-gray text-size-md  bg-clip-text">
                                Stock : {{ $item->stock }}</p>
                            <p class="mb-2 leading-normal font-bold text-size-xl pr-4">${{ $item->price }}</p>
                        </div>
                    </div>
                    <div class="flex justify-end p-4">
                        <a href="{{ route('product.update', ['id' => $item->id]) }}"
                            class="mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-orange uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-white">
                            Edit </a>
                        <button wire:click="deleteId({{ $item->id }})"
                            class="mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-red uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-white"
                            data-modal-toggle="popup-modal">
                            Delete </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $products->links() }}
    <div id="popup-modal" tabindex="-1" wire:ignore.self
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="popup-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        delete this product?</h3>
                    <button data-modal-toggle="popup-modal" type="button" wire:click.prevent="destroy()"
                        class="text-gray-500 bg-red-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Yes, I'm sure
                    </button>
                    <button data-modal-toggle="popup-modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- </x-dashboard-layout> --}}
