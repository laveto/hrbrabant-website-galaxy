<div class="website::partials-menu-LevelNavbar-custom">

    <ul class="flex gap-6 text-black">

        {{-- Render website menu pages. --}}
        @foreach ($websiteMenuPages as $websiteMenuPage)
            <li
                @if($websiteMenuPage->children->isNotEmpty())
                    x-data="{
                    isOpen: false,
                }"
                x-on:mouseover="isOpen = true"
                x-on:mouseout="isOpen = false"
                @endif
            >

                {{-- Has children? --}}
                @if (count($childs = $websiteMenuPage->children))
                    @php
                        $hasActiveChild = false;
                        $websiteMenuPage->children->each(function ($child) use (&$hasActiveChild) {
                            if ( \Galaxy\Website\Services\WebsitePageService::activePage($child, false) ) {
                                $hasActiveChild = true;
                            }
                        });
                    @endphp

                    @php($websiteMenuPageActiveChild = \Galaxy\Website\Services\WebsitePageService::activePage($websiteMenuPage, $hasActiveChild))
                    <a class="inline-block px-2 py-3 hover:opacity-50 relative dropdown-toggle {{ $websiteMenuPageActiveChild ? "active" : '' }}"
                       href="{{ url()->websitePage($websiteMenuPage->websitePage) }}"
                       {{ $websiteMenuPage->websitePage->target_blank ? 'target="_blank"' : '' }} role="button"
                       aria-haspopup="true"
                       aria-expanded="false"
                    >
                        {{ $websiteMenuPage->websitePage->title_menu ?: $websiteMenuPage->websitePage->title_page }}

                        @if( $websiteMenuPageActiveChild )
                            <div class="absolute bg-palette-portizBlue bottom-0 h-2 left-4 right-4 translate-y-1/2"></div>
                        @endif
                    </a>

                    <div class="absolute bg-palette-portizBlue divide-gray-200 divide-opacity-25 divide-y dropdown-menu flex flex-col px-4 py-2"
                         aria-labelledby="navbarDropdown"
                         x-show="isOpen"
                         x-transition:enter="transition ease-out duration-100 transform"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75 transform"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                    >

                        {{-- Render children --}}
                        @foreach ($childs as $websiteMenuPageChild)
                            @php($websitePageChild = $websiteMenuPageChild->websitePage)
                            <a class="inline-block py-2 hover:opacity-50 {{ \Galaxy\Website\Services\WebsitePageService::activePage($websiteMenuPageChild, false) ? 'active' : '' }}"
                               href="{{ url()->websitePage($websitePageChild) }}"
                                {{ $websitePageChild->target_blank ? 'target="_blank"' : '' }}
                            >{{ $websitePageChild->title_menu ?: $websitePageChild->title_page }}</a>
                        @endforeach

                    </div>

                    {{-- No children? --}}
                @else
                    @php($page = $websiteMenuPage->websitePage)
                    @php($websiteMenuPageActive = \Galaxy\Website\Services\WebsitePageService::activePage($websiteMenuPage, false))
                    <a class="relative inline-block px-2 py-3 hover:opacity-50-fh {{ $websiteMenuPageActive && !$page->redirect
                        ? 'active'
                        : '' }}"
                       href="{{ url()->websitePage($page) }}" {{ @$page->target_blank ? 'target="_blank"' : '' }}
                    >
                        @if ($menuIsActive = config('website.pages.bar.menu.active') && ($icon = @$page->getFirstMediaUrl('icon')))
                            <span class="flex items-center">
                                <img class="img-fluid pr-4 h-1em" src="{{ $icon }}" alt="icon">
                        @endif

                                {{ $page->title_menu ?: $page->title_page }}

                                @if ($menuIsActive)
                            </span>
                        @endif

                        @if( $websiteMenuPageActive )
                            <div class="absolute bg-palette-portizBlue bottom-0 h-2 left-4 right-4 translate-y-1/2"></div>
                        @endif
                    </a>
                @endif

            </li>
        @endforeach

    </ul>

</div>
