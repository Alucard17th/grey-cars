@props([
    'title'       => '',
    'subtitle'    => null,
    'bgImage'     => null,   // URL or null
    'breadcrumbs' => [],     // [['label' => 'Home', 'url' => '/'], …]
    'eyebrow'     => null,   // small label above title
])

<header
    {{ $attributes->class(['page-header-modern']) }}
    @if($bgImage) style="background-image: url('{{ $bgImage }}');" @endif
>
    <div class="page-header-overlay"></div>
    <div class="page-header-grid"></div>
    <div class="page-header-glow"></div>

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 text-center page-header-content">

                @if($eyebrow)
                    <span class="page-header-eyebrow">
                        <span class="dot"></span> {{ $eyebrow }}
                    </span>
                @endif

                <h1 class="page-header-title">{{ $title }}</h1>

                @isset($subtitle)
                    <p class="page-header-subtitle">{{ $subtitle }}</p>
                @endisset

                {{-- Breadcrumbs (optional) --}}
                @if($breadcrumbs)
                    <nav aria-label="breadcrumb" class="page-header-breadcrumb mt-4">
                        <ol class="breadcrumb justify-content-center mb-0">
                            @foreach ($breadcrumbs as $item)
                                <li
                                    class="breadcrumb-item {{ $loop->last ? 'active' : '' }}"
                                    @if($loop->last) aria-current="page" @endif
                                >
                                    @if(!$loop->last)
                                        <a href="{{ $item['url'] ?? '#' }}">
                                            @if($loop->first)<i class="bi bi-house-fill me-1"></i>@endif
                                            {{ $item['label'] }}
                                        </a>
                                    @else
                                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $item['label'] }}
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                @endif
            </div>
        </div>
    </div>
</header>
