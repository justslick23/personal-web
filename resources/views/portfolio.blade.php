@extends('layouts.app')

@section('title', 'Portfolio')
@section('meta-description', 'Selected graphic design and software development work by Tokelo Foso.')

@push('head')
<style>

</style>
@endpush

@section('content')

{{-- ── Page Header ──────────────────────────────────────── --}}
@include('partials.page-header', [
    'title'    => 'Portfolio',
    'subtitle' => 'Graphic design & software development work',
    'theme'    => 'portfolio',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Portfolio'],
    ]
])

{{-- ── Intro ─────────────────────────────────────────────── --}}
<section class="pf-intro">
    <div class="mn-container">
        <div class="pf-intro__inner">
            <div class="scroll-reveal">
                <div class="pf-intro__eyebrow">
                    <div class="pf-intro__eyebrow-icon"><i class="fas fa-layer-group"></i></div>
                    <span class="t-eyebrow">My Cases</span>
                </div>
                <h2 class="pf-intro__headline">
                    I work across graphic design and software development,
                    building things that are both visually purposeful and
                    technically solid.
                    <span> Below are selected projects that reflect the kind of work I do.</span>
                </h2>
            </div>
            <div class="scroll-reveal scroll-reveal-delay-1">
                <p class="pf-intro__desc">
                    From brand identities and editorial layouts to full-stack web apps
                    and APIs — each project is approached with the same principle:
                    clarity of intent, attention to detail, and work that holds up.
                </p>
                <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="{{ route('contact') }}" class="mn-btn mn-btn--primary">
                        <i class="fas fa-paper-plane"></i> Start a Project
                    </a>
                    <a href="{{ asset('cv/tokelo-foso-cv.pdf') }}" target="_blank" class="mn-btn mn-btn--outline">
                        <i class="fas fa-file-arrow-down"></i> Download CV
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Main layout ──────────────────────────────────────── --}}
<section class="mn-section" style="padding-top:0;">
    <div class="mn-container">
        <div class="pf-layout">

            {{-- Sidebar ──────────────────────────────────── --}}
            <aside class="pf-sidebar">

                {{-- Filter --}}
                <div>
                    <p class="pf-sidebar__label">Filter by</p>
                    <div class="pf-filter-list">
                        <button class="pf-filter-btn active" data-filter="all" type="button">
                            All work <span class="pf-count">{{ $categoryCounts['All'] }}</span>
                        </button>
                        <button class="pf-filter-btn" data-filter="Graphic Design" type="button">
                            Graphic Design <span class="pf-count">{{ $categoryCounts['Graphic Design'] }}</span>
                        </button>
                        <button class="pf-filter-btn" data-filter="Software Dev" type="button">
                            Software Dev <span class="pf-count">{{ $categoryCounts['Software Dev'] }}</span>
                        </button>
                    </div>
                </div>

                {{-- Disciplines --}}
                <div>
                    <p class="pf-sidebar__label">Disciplines</p>
                    <div class="pf-disciplines">
                        @foreach([
                            ['dot'=>'#6366f1','label'=>'Brand Identity'],
                            ['dot'=>'#f59e0b','label'=>'Editorial / Print'],
                            ['dot'=>'#ec4899','label'=>'Motion Graphics'],
                            ['dot'=>'#38bdf8','label'=>'UI / Icon Design'],
                            ['dot'=>'#00e676','label'=>'Full-Stack Web'],
                            ['dot'=>'#3b82f6','label'=>'SaaS Apps'],
                            ['dot'=>'#facc15','label'=>'APIs & Backend'],
                            ['dot'=>'#a3e635','label'=>'CLI / DevOps'],
                        ] as $d)
                        <div class="pf-discipline">
                            <span class="pf-discipline-dot" style="background:{{ $d['dot'] }};"></span>
                            {{ $d['label'] }}
                        </div>
                        @endforeach
                    </div>
                </div>

            </aside>

            {{-- Works ────────────────────────────────────── --}}
            <div id="pf-works">

                {{-- ── Graphic Design block ──────────────── --}}
                <div class="pf-section-block" data-section="Graphic Design">
                    <div class="pf-section-divider">
                        <div class="pf-section-divider__icon" style="color:#ec4899;">
                            <i class="fas fa-pen-ruler"></i>
                        </div>
                        <span class="pf-section-divider__title">Graphic Design</span>
                        <div class="pf-section-divider__line"></div>
                        <span class="pf-section-divider__count">
                            {{ $categoryCounts['Graphic Design'] }} projects
                        </span>
                    </div>

                    <div class="pf-grid">
                        @foreach($works->where('category', 'Graphic Design') as $i => $work)
                            @include('portfolio._card', ['work' => $work, 'i' => $loop->index])
                        @endforeach
                    </div>
                </div>

                {{-- ── Software Dev block ────────────────── --}}
                <div class="pf-section-block" data-section="Software Dev" style="margin-top:3.5rem;">
                    <div class="pf-section-divider">
                        <div class="pf-section-divider__icon" style="color:#00e676;">
                            <i class="fas fa-code"></i>
                        </div>
                        <span class="pf-section-divider__title">Software Development</span>
                        <div class="pf-section-divider__line"></div>
                        <span class="pf-section-divider__count">
                            {{ $categoryCounts['Software Dev'] }} projects
                        </span>
                    </div>

                    <div class="pf-grid">
                        @foreach($works->where('category', 'Software Dev') as $i => $work)
                            @include('portfolio._card', ['work' => $work, 'i' => $loop->index])
                        @endforeach
                    </div>
                </div>

            </div>{{-- /#pf-works --}}

        </div>{{-- /.pf-layout --}}
    </div>{{-- /.mn-container --}}
</section>

@endsection

@section('scripts')
<script>
(function () {
    'use strict';

    var filterBtns = document.querySelectorAll('.pf-filter-btn');
    var sections   = document.querySelectorAll('.pf-section-block');
    var cards      = document.querySelectorAll('.pf-card');

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {

            // Update active button
            filterBtns.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');

            var filter = btn.dataset.filter;

            if (filter === 'all') {
                // Show everything
                sections.forEach(function (s) { s.classList.remove('pf-hidden'); });
                cards.forEach(function (c)    { c.classList.remove('pf-hidden'); });
            } else {
                // Show only matching section + cards
                sections.forEach(function (s) {
                    s.dataset.section === filter
                        ? s.classList.remove('pf-hidden')
                        : s.classList.add('pf-hidden');
                });
            }
        });
    });

})();
</script>
@endsection