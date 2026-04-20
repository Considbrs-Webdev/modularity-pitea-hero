@if (!empty($backgroundImage) || !empty($heading) || !empty($buttons))
    <section class="c-pitea-hero"
        @if (!empty($heading)) aria-labelledby="c-pitea-hero-heading" @else aria-label="{{ __('Introduction and site search', 'modularity-pitea-hero') }}" @endif
        style="@if (!empty($backgroundImage['url'])) background-image: url('{{ $backgroundImage['url'] }}'); @endif">
        <div class="c-pitea-hero__overlay" aria-hidden="true" style="opacity: {{ ($overlayOpacity ?? 50) / 100 }};"></div>
        <div class="c-pitea-hero__container">
            <div class="c-pitea-hero__content">
                @if (!empty($heading))
                    @typography([
                        'element' => 'h1',
                        'id' => 'c-pitea-hero-heading',
                        'classList' => ['c-pitea-hero__heading']
                    ])
                        {{ $heading }}
                    @endtypography
                @endif
                <form class="c-pitea-hero__search" role="search" method="get" action="{{ $searchUrl }}">
                    @field([
                        'id' => 'c-pitea-hero-search-field',
                        'type' => 'search',
                        'name' => 's',
                        'label' => $searchFieldLabel ?? __('Search on the website', 'modularity-pitea-hero'),
                        'placeholder' => !empty($searchPlaceholder) ? $searchPlaceholder : __('Search', 'modularity-pitea-hero'),
                        'required' => false,
                        'shadow' => false,
                        'borderless' => true,
                        'hideLabel' => false,
                        'classList' => ['c-pitea-hero__search-input', 'c-pitea-hero__search-input--label-hidden']
                    ])
                    @endfield
                    @button([
                        'type' => 'submit',
                        'text' => false,
                        'icon' => 'fa-solid fa-magnifying-glass',
                        'classList' => ['c-pitea-hero__search-button'],
                        'attributeList' => [
                            'aria-label' => __('Submit search', 'modularity-pitea-hero'),
                        ],
                    ])
                    @endbutton
                </form>

                @if (!empty($buttons) && is_array($buttons))
                    <h2 id="c-pitea-hero-quicklinks-heading" class="visually-hidden">
                        {{ __('Quick links in the hero', 'modularity-pitea-hero') }}
                    </h2>
                    <nav class="c-pitea-hero__buttons" aria-labelledby="c-pitea-hero-quicklinks-heading">
                        @foreach ($buttons as $button)
                            @if (!empty($button->text) && !empty($button->url))
                                @php
                                    $heroBtnAttrs = [];
                                    if (!empty($button->target)) {
                                        $heroBtnAttrs['target'] = $button->target;
                                        if ($button->target === '_blank') {
                                            $heroBtnAttrs['rel'] = 'noopener noreferrer';
                                        }
                                    }
                                @endphp
                                @button([
                                    'text' => $button->text,
                                    'href' => $button->url,
                                    'icon' => !empty($button->icon) ? $button->icon : '',
                                    'color' => 'default',
                                    'style' => 'filled',
                                    'size' => 'sm',
                                    'reversePositions' => true,
                                    'classList' => ['c-pitea-hero__button'],
                                    'attributeList' => $heroBtnAttrs,
                                    'ariaLabel' => !empty($button->linkAccessSuffix)
                                        ? trim($button->text . ' ' . $button->linkAccessSuffix)
                                        : '',
                                ])
                                @endbutton
                            @endif
                        @endforeach
                    </nav>
                @endif
            </div>
        </div>
    </section>
@endif
