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
                        <button wire:click="destroy({{ $item->id }})"
                            class="mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-red uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-white">
                            Delete </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $products->links() }}
</div>
{{-- </x-dashboard-layout> --}}
