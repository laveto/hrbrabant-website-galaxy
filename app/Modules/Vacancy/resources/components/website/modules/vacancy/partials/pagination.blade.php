<div x-data="{ 
    scrollToVacancy: () => {
        const vacancyElement = document.querySelector('#vacancies');
        if (vacancyElement) {
            window.scrollTo({
                top: vacancyElement.offsetTop - 25,
                behavior: 'smooth'  // Optional, for smooth scrolling
            });
        }
    } 
}">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default select-none">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <a href="?page={{ $paginator->currentPage() - 1 }}"
                           wire:click.prevent="previousPage('{{ $paginator->getPageName() }}'); scrollToVacancy()"
                           wire:loading.attr="disabled"
                           dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                           class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                            {!! __('pagination.previous') !!}
                        </a>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <a href="?page={{ $paginator->currentPage() + 1 }}"
                           wire:click.prevent="nextPage('{{ $paginator->getPageName() }}'); scrollToVacancy()"
                           wire:loading.attr="disabled"
                           dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                           class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                            {!! __('pagination.next') !!}
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default select-none">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">

                <div>
                    <span class="relative z-0 flex flex-wrap items-center">
                        <span class='mr-4'>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-400 bg-white border border-gray-300 rounded-full cursor-disabled" aria-hidden="true">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @else
                                <a href="?page={{ $paginator->currentPage() - 1 }}"
                                   wire:click.prevent="previousPage('{{ $paginator->getPageName() }}'); scrollToVacancy()"
                                   dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                   rel="prev"
                                   class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 bg-white border border-gray-300 rounded-full hover:bg-palette-lightblue hover:text-white hover:border-palette-lightblue"
                                   aria-label="{{ __('pagination.previous') }}">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 bg-white cursor-default select-none">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}" class='px-2'>
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span class="h-10 rounded-full min-w-[50px] relative inline-flex justify-center items-center px-4 py-2 text-sm bg-palette-lightblue font-medium text-white cursor-default leading-5 select-none">{{ $page }}</span>
                                            </span>
                                        @else
                                            <a href="?page={{ $page }}"
                                               wire:click.prevent="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}'); scrollToVacancy()"
                                               class="h-10 rounded-full min-w-[50px] relative inline-flex justify-center items-center px-4 py-2 text-sm font-medium hover:text-white bg-white leading-5 focus:z-10 focus:outline-none hover:bg-palette-lightblue"
                                               aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span class='ml-4'>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <a href="?page={{ $paginator->currentPage() + 1 }}"
                                   wire:click.prevent="nextPage('{{ $paginator->getPageName() }}'); scrollToVacancy()"
                                   dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                   rel="next"
                                   class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 bg-white border border-gray-300 rounded-full hover:bg-palette-lightblue hover:text-white hover:border-palette-lightblue"
                                   aria-label="{{ __('pagination.next') }}">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-400 bg-white border border-gray-300 rounded-full cursor-disabled" aria-hidden="true">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>