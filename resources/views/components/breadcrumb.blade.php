@props([
    'title'       => '',
    'subtitle'    => null,
    'bgImage'     => null,   // URL or null
    'breadcrumbs' => [],     // [['label' => 'Home', 'url' => '/'], …]
])

<header
    {{ $attributes->class([
        'page-header overflow-hidden py-5 py-lg-7',
        'bg-dark'   // darker fallback if no bg img
    ]) }}
>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8 text-center">

                {{-- Breadcrumbs (optional) --}}
                @if($breadcrumbs)
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb justify-content-center mb-0">
                            @foreach ($breadcrumbs as $item)
                                <li
                                    class="breadcrumb-item {{ $loop->last ? 'active' : '' }}"
                                    @if($loop->last) aria-current="page" @endif
                                >
                                    @if(!$loop->last)
                                        <a href="{{ $item['url'] ?? '#' }}" class="link-light text-decoration-none">
                                            {{ $item['label'] }}
                                        </a>
                                    @else
                                        {{ $item['label'] }}
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                @endif

                {{-- Title & subtitle --}}
                <h1 class="display-4 fw-bold text-white mb-3">{{ $title }}</h1>

                @isset($subtitle)
                    <p class="lead text-white-50 mb-0">{{ $subtitle }}</p>
                @endisset
            </div>
        </div>
    </div>

</header>

{{-- Inject one-off component-specific CSS --}}
@once
    @push('styles')
        <style>
            /* Keep SVG wave in sync with body background */
            .page-header .fill-body { fill: var(--bs-body-bg); }
        </style>
    @endpush
@endonce
