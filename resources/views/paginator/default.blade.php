@if ($paginator->lastPage() !== 1)
    <div class="flex items-center justify-between mt-6">
        <a href="{{ $paginator->previousPageUrl() }}"
            @class([ "flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 "
            , "pointer-events-none opacity-50"=> ! $paginator->previousPageUrl()
            ])
            >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5 rtl:-scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>

            <span>
                previous
            </span>
        </a>

        <div class="items-center hidden md:flex gap-x-3">
            @for ($page = 1; $page <= $paginator->lastPage(); $page++)
                <a href="{{ $paginator->url($page) }}"
                    @class([
                        "px-2 py-1 text-sm text-blue-500 rounded-md bg-blue-100/60",
                        "bg-blue-700 text-white font-bold" => $page == $paginator->currentPage(),
                    ])
                    >
                    {{ $page }}
                </a>
                @endfor
        </div>

        <a href="{{ $paginator->nextPageUrl() }}"
            @class([ "flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 "
            , "pointer-events-none opacity-50"=> ! $paginator->nextPageUrl()
            ])
            >
            <span>
                Next
            </span>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5 rtl:-scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
        </a>
    </div>
@endif
