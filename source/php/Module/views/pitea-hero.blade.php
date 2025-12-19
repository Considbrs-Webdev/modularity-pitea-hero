@if ($hideTitle && !empty($postTitle))
    @typography([
        "element" => "h2",
        "classList" => ["u-margin--0"]
    ])
        {{ $postTitle }}
    @endtypography
@endif

@if (!empty($backgroundImage) || !empty($heading) || !empty($buttons))
    <section class="c-pitea-hero" style="@if(!empty($backgroundImage['url'])) background-image: url('{{ $backgroundImage['url'] }}'); @endif">
        <div class="c-pitea-hero__overlay" style="opacity: {{ ($overlayOpacity ?? 50) / 100 }};"></div>
        <div class="c-pitea-hero__container">
            <div class="c-pitea-hero__content">
                @if (!empty($heading))
                    @typography([
                        "element" => "h1",
                        "classList" => [
                            "c-pitea-hero__heading"
                        ]
                    ])
                        {{ $heading }}
                    @endtypography
                @endif

                @if (!empty($searchPlaceholder))
                    <form class="c-pitea-hero__search" role="search" method="get" action="{{ home_url('/') }}">
                        @field([
                            'type' => 'search',
                            'name' => 's',
                            'placeholder' => $searchPlaceholder,
                            'required' => false,
                            'shadow' => false,
                            'borderless' => true,
                            'hideLabel' => true,
                            'classList' => ['c-pitea-hero__search-input'],
                            'fieldAttributeList' => [
                                'aria-label' => $searchPlaceholder
                            ]
                        ])
                        @endfield
                        @button([
                            'type' => 'submit',
                            'text' => false,
                            'icon' => 'search',
                            'classList' => ['c-pitea-hero__search-button'],
                            'attributeList' => [
                                'aria-label' => __('Search', 'modularity-pitea-hero')
                            ]
                        ])
                        @endbutton
                    </form>
                @endif

                @if (!empty($buttons) && is_array($buttons))
                    <div class="c-pitea-hero__buttons">
                        @foreach ($buttons as $button)
                            @if (!empty($button->text) && !empty($button->url))
                                @button([
                                    'text' => $button->text,
                                    'href' => $button->url,
                                    'icon' => !empty($button->icon) ? $button->icon : '',
                                    'color' => 'default',
                                    'style' => 'filled',
                                    'size' => 'sm',
                                    'classList' => ['c-pitea-hero__button'],
                                    'attributeList' => !empty($button->target) ? ['target' => $button->target] : []
                                ])
                                @endbutton
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
