{{-- =============================================
     resources/views/partials/page-header.blade.php

     Usage in any blade view:
     @include('partials.page-header', [
         'title'    => 'About Me',
         'subtitle' => 'Designer · Developer · Creator',
         'theme'    => 'about',   // about | contact | portfolio | works | default
         'breadcrumbs' => [
             ['label' => 'Home', 'url' => route('home')],
             ['label' => 'About'],
         ]
     ])
============================================== --}}

@php
    $theme       = $theme       ?? 'default';
    $title       = $title       ?? '';
    $subtitle    = $subtitle    ?? '';
    $breadcrumbs = $breadcrumbs ?? [];
@endphp

<div class="mn-page-header mn-page-header--{{ $theme }}">
    {{-- Animated blob backgrounds --}}
    <div class="mn-page-header__blobs" aria-hidden="true">
        <div class="mn-page-header__blob mn-page-header__blob--1"></div>
        <div class="mn-page-header__blob mn-page-header__blob--2"></div>
        <div class="mn-page-header__blob mn-page-header__blob--3"></div>
    </div>

    {{-- Grain/noise texture overlay --}}
    <div class="mn-page-header__noise"></div>

    {{-- Bottom-left content --}}
    <div class="mn-page-header__content">
        @if($title)
            <h1 class="mn-page-header__title">{{ $title }}</h1>
        @endif

        @if($subtitle)
            <p class="mn-page-header__subtitle">{{ $subtitle }}</p>
        @endif

        @if(count($breadcrumbs))
            <nav class="mn-page-header__breadcrumb" aria-label="Breadcrumb">
                @foreach($breadcrumbs as $crumb)
                    @if(!$loop->last)
                        <a href="{{ $crumb['url'] ?? '#' }}">{{ $crumb['label'] }}</a>
                        <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                    @else
                        <span class="current">{{ $crumb['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif
    </div>
</div>