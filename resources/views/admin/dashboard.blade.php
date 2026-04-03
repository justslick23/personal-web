@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

<div class="adm-page-hd">
    <div>
        <div class="adm-page-hd__title">DASHBOARD</div>
        <div class="adm-page-hd__sub">Overview of your content</div>
    </div>
    <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
        <a href="{{ route('admin.portfolio.create') }}" class="btn btn--ghost btn--sm">
            <i class="fas fa-plus"></i> Add Portfolio Item
        </a>
        <a href="{{ route('admin.music.create') }}" class="btn btn--primary btn--sm">
            <i class="fas fa-plus"></i> Add Music Release
        </a>
    </div>
</div>

{{-- ── Stats ──────────────────────────────────────── --}}
<div class="adm-stats">
    <div class="adm-stat">
        <div class="adm-stat__num">{{ $stats['portfolio_total'] }}</div>
        <div class="adm-stat__lbl">Portfolio Items</div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat__num adm-stat__accent">{{ $stats['portfolio_design'] }}</div>
        <div class="adm-stat__lbl">Design Works</div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat__num adm-stat__accent">{{ $stats['portfolio_dev'] }}</div>
        <div class="adm-stat__lbl">Dev Projects</div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat__num adm-stat__red">{{ $stats['music_total'] }}</div>
        <div class="adm-stat__lbl">Music Releases</div>
    </div>
</div>

{{-- ── Recent Items ───────────────────────────────── --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">

    {{-- Portfolio Recent --}}
    <div class="adm-card">
        <div class="adm-card__head">
            <span class="adm-card__title"><i class="fas fa-layer-group" style="color:var(--accent);margin-right:.5rem;"></i>Latest Portfolio Item</span>
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn--ghost btn--sm">View All</a>
        </div>
        <div class="adm-card__body">
            @if($stats['portfolio_recent'])
                @php $p = $stats['portfolio_recent']; @endphp
                <div style="display:flex;gap:1rem;align-items:center;">
                    <div class="adm-thumb">
                        @if($p->image)
                            <img src="{{ $p->image_url }}" alt="{{ $p->title }}">
                        @else
                            {{ strtoupper(substr($p->title,0,2)) }}
                        @endif
                    </div>
                    <div>
                        <div style="font-family:var(--sans);font-size:.9rem;color:var(--text);font-weight:600;margin-bottom:.2rem;">{{ $p->title }}</div>
                        <div style="font-family:var(--mono);font-size:.6rem;color:var(--text-dim);">{{ $p->category }} &nbsp;·&nbsp; {{ $p->year ?? '—' }}</div>
                    </div>
                    <a href="{{ route('admin.portfolio.edit', $p) }}" class="btn btn--ghost btn--sm" style="margin-left:auto;">Edit</a>
                </div>
            @else
                <div class="adm-empty">
                    <div class="adm-empty__icon"><i class="fas fa-folder-open"></i></div>
                    <div class="adm-empty__title">No Items Yet</div>
                    <div class="adm-empty__sub" style="margin-bottom:1rem;">Add your first portfolio item</div>
                    <a href="{{ route('admin.portfolio.create') }}" class="btn btn--primary btn--sm">Add Item</a>
                </div>
            @endif
        </div>
    </div>

    {{-- Music Recent --}}
    <div class="adm-card">
        <div class="adm-card__head">
            <span class="adm-card__title"><i class="fas fa-compact-disc" style="color:var(--red);margin-right:.5rem;"></i>Latest Music Release</span>
            <a href="{{ route('admin.music.index') }}" class="btn btn--ghost btn--sm">View All</a>
        </div>
        <div class="adm-card__body">
            @if($stats['music_recent'])
                @php $m = $stats['music_recent']; @endphp
                <div style="display:flex;gap:1rem;align-items:center;">
                    <div class="adm-thumb" style="{{ $m->is_red ? 'border-color:rgba(232,38,26,.3);color:var(--red);' : '' }}">
                        @if($m->cover_art_url)
                            <img src="{{ $m->cover_art_url }}" alt="{{ $m->title }}">
                        @else
                            {{ $m->initials ?? strtoupper(substr($m->title,0,2)) }}
                        @endif
                    </div>
                    <div>
                        <div style="font-family:var(--sans);font-size:.9rem;color:var(--text);font-weight:600;margin-bottom:.2rem;">{{ $m->title }}</div>
                        <div style="font-family:var(--mono);font-size:.6rem;color:var(--text-dim);">{{ $m->type }} &nbsp;·&nbsp; {{ $m->year ?? '—' }}</div>
                        @if($m->is_uma_winner)
                            <span class="adm-tag adm-tag--red" style="margin-top:.3rem;">UMA Winner</span>
                        @endif
                    </div>
                    <a href="{{ route('admin.music.edit', $m) }}" class="btn btn--ghost btn--sm" style="margin-left:auto;">Edit</a>
                </div>
            @else
                <div class="adm-empty">
                    <div class="adm-empty__icon"><i class="fas fa-music"></i></div>
                    <div class="adm-empty__title">No Releases Yet</div>
                    <div class="adm-empty__sub" style="margin-bottom:1rem;">Add your first music release</div>
                    <a href="{{ route('admin.music.create') }}" class="btn btn--primary btn--sm">Add Release</a>
                </div>
            @endif
        </div>
    </div>

</div>

{{-- ── Quick Links ─────────────────────────────────── --}}
<div style="margin-top:1.5rem;display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--border);border:1px solid var(--border);">
    @foreach([
        ['icon'=>'fa-layer-group','label'=>'Portfolio Items','route'=>'admin.portfolio.index','accent'=>'var(--accent)'],
        ['icon'=>'fa-plus','label'=>'Add Portfolio','route'=>'admin.portfolio.create','accent'=>'var(--accent)'],
        ['icon'=>'fa-compact-disc','label'=>'Discography','route'=>'admin.music.index','accent'=>'var(--red)'],
        ['icon'=>'fa-plus','label'=>'Add Release','route'=>'admin.music.create','accent'=>'var(--red)'],
    ] as $ql)
    <a href="{{ route($ql['route']) }}"
       style="background:var(--bg-card);padding:1.5rem;display:flex;align-items:center;gap:.85rem;
              font-family:var(--mono);font-size:.68rem;letter-spacing:.06em;color:var(--text-mid);
              transition:background .2s,color .2s;"
       onmouseover="this.style.background='rgba(255,255,255,.03)';this.style.color='var(--text)';"
       onmouseout="this.style.background='var(--bg-card)';this.style.color='var(--text-mid)';">
        <i class="fas {{ $ql['icon'] }}" style="color:{{ $ql['accent'] }};font-size:.85rem;width:16px;text-align:center;"></i>
        {{ $ql['label'] }}
        <i class="fas fa-arrow-right" style="margin-left:auto;font-size:.6rem;"></i>
    </a>
    @endforeach
</div>

@endsection