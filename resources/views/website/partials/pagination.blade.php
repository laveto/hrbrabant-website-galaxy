@if ($paginator->hasPages())
    <ul class="{{ $cssNs }} flex justify-center" role="navigation">
        <li class="relative inline-flex justify-center items-center rounded-l-full border-l border-b border-t bg-white text-base font-medium text-gray-300 {{ $paginator->onFirstPage() ? 'cursor-not-allowed' : 'hover:bg-gray-50' }} leading-none "
            @if($paginator->onFirstPage()) aria-disabled="true" @endif
            aria-label="@lang('pagination.previous')"
        >
            @if(!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}"
                   rel="prev"
                   class="text-black"
                >
                    @endif

                    <span class="px-4 py-3" @if ($paginator->onFirstPage()) aria-hidden="true" @endif>
                    <i class="far fa-chevron-left"></i>
                </span>

                    @if(!$paginator->onFirstPage())
                </a>
            @endif
        </li>

        <li class="flex-1 md:flex-[initial]">
            <ul class="w-full h-full grid md:flex flex-wrap grid-cols-[repeat(auto-fit,_minmax(40px,_1fr))] relative z-0 bg-white border-b border-t">

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="relative inline-flex justify-center items-center bg-white text-base font-medium text-gray-700 leading-none "
                            aria-disabled="true">
                            <span class="px-4 py-3">
                                {{ $element }}
                            </span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="relative justify-center inline-flex items-center bg-blue-500 text-base font-medium text-white leading-none "
                                    aria-current="page">
                                    <span class="px-4 py-3">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li class="relative justify-center inline-flex items-center bg-white text-base font-medium text-gray-700 hover:bg-gray-50 leading-none ">
                                    <a class="text-gray-700 px-4 py-3"
                                       href="{{ $url }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="relative inline-flex justify-center items-center rounded-r-full border-r border-b border-t bg-white text-base font-medium text-gray-300 leading-none  {{ $paginator->hasMorePages() ? 'cursor-disabled' : 'hover:bg-gray-50' }}"
            @if ($paginator->hasMorePages()) aria-disabled="true" @endif
            aria-label="@lang('pagination.next')"
        >
            @if($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   rel="prev"
                   class="text-black"
                >
                    @endif
                    <span class="px-4 py-3" @if (!$paginator->hasMorePages()) aria-hidden="true" @endif>
                    <i class="far fa-chevron-right"></i>
                </span>
                    @if($paginator->hasMorePages())
                </a>
            @endif
        </li>
    </ul>
@endif
