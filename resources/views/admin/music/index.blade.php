@extends('admin.layouts.app')

@section('title', 'Discography')
@section('breadcrumb', 'Music')
@section('breadcrumb-current', 'Discography')

@section('content')

<div class="adm-page-hd">
    <div>
        <div class="adm-page-hd__title">DISCOGRAPHY</div>
        <div class="adm-page-hd__sub">{{ $releases->count() }} release{{ $releases->count() !== 1 ? 's' : '' }} total</div>
    </div>
    <a href="{{ route('admin.music.create') }}" class="btn btn--primary">
        <i class="fas fa-plus"></i> Add Release
    </a>
</div>

<div class="adm-card">
    <div class="adm-card__head">
        <span class="adm-card__title">All Music Releases</span>
        <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
            @foreach(['Single','EP','Album','Compilation','Beat Tape','Mixtape'] as $type)
                @php $count = $releases->where('type',$type)->count(); @endphp
                @if($count)
                    <span class="adm-tag">{{ $type }}: {{ $count }}</span>
                @endif
            @endforeach
        </div>
    </div>

    @if($releases->isEmpty())
        <div class="adm-empty">
            <div class="adm-empty__icon"><i class="fas fa-music"></i></div>
            <div class="adm-empty__title">No Music Releases</div>
            <div class="adm-empty__sub" style="margin-bottom:1.5rem;">Add your first release to the discography</div>
            <a href="{{ route('admin.music.create') }}" class="btn btn--primary">
                <i class="fas fa-plus"></i> Add First Release
            </a>
        </div>
    @else
        <div class="adm-table-wrap">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th style="width:60px;">Art</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Year</th>
                        <th>Note</th>
                        <th>Links</th>
                        <th>Flags</th>
                        <th style="width:140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($releases as $release)
                    <tr>
                        <td class="text-dim">{{ $loop->iteration }}</td>
                        <td>
                            <div class="adm-thumb" style="{{ $release->is_red ? 'border-color:rgba(232,38,26,.3);color:rgba(232,38,26,.5);' : '' }}">
                                @if($release->cover_art_url)
                                    <img src="{{ $release->cover_art_url }}" alt="{{ $release->title }}">
                                @else
                                    {{ $release->initials ?? strtoupper(substr($release->title,0,2)) }}
                                @endif
                            </div>
                        </td>
                        <td>
                            <span style="color:var(--text);font-weight:500;">{{ $release->title }}</span>
                        </td>
                        <td>
                            <span class="adm-tag adm-tag--red">{{ $release->type }}</span>
                        </td>
                        <td>{{ $release->year ?? '—' }}</td>
                        <td>
                            <span style="font-size:.65rem;color:var(--text-dim);">{{ $release->note ?? '—' }}</span>
                        </td>
                        <td>
                            <div style="display:flex;gap:.5rem;align-items:center;">
                                @if($release->soundcloud_url)
                                    <a href="{{ $release->soundcloud_url }}" target="_blank" title="SoundCloud"
                                       style="color:var(--orange);"><i class="fab fa-soundcloud"></i></a>
                                @endif
                                @if($release->spotify_url)
                                    <a href="{{ $release->spotify_url }}" target="_blank" title="Spotify"
                                       style="color:#1DB954;"><i class="fab fa-spotify"></i></a>
                                @endif
                                @if($release->apple_music_url)
                                    <a href="{{ $release->apple_music_url }}" target="_blank" title="Apple Music"
                                       style="color:#fc3c44;"><i class="fab fa-apple"></i></a>
                                @endif
                                @if($release->youtube_url)
                                    <a href="{{ $release->youtube_url }}" target="_blank" title="YouTube"
                                       style="color:#ff0000;"><i class="fab fa-youtube"></i></a>
                                @endif
                                @if(!$release->soundcloud_url && !$release->spotify_url && !$release->apple_music_url && !$release->youtube_url)
                                    <span class="text-dim">—</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;gap:.3rem;flex-wrap:wrap;">
                                @if($release->is_featured)
                                    <span class="adm-tag adm-tag--green">Featured</span>
                                @endif
                                @if($release->is_uma_winner)
                                    <span class="adm-tag adm-tag--red">UMA</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;gap:.4rem;">
                                <a href="{{ route('admin.music.edit', $release) }}" class="btn btn--ghost btn--sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.music.destroy', $release) }}" method="POST"
                                      class="adm-del-form"
                                      onsubmit="return confirm('Delete \'{{ addslashes($release->title) }}\'?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn--danger btn--sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection