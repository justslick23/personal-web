@extends('admin.layouts.app')

@section('title', $release->exists ? 'Edit Release' : 'Add Release')
@section('breadcrumb', 'Music')
@section('breadcrumb-current', $release->exists ? 'Edit Release' : 'Add Release')

@push('head')
<style>
.track-row {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .85rem 1.25rem;
    border-bottom: 1px solid var(--border);
    transition: background .15s;
}
.track-row:last-child { border-bottom: none; }
.track-row:hover { background: rgba(255,255,255,.02); }
.track-row__num   { flex-shrink: 0; }
.track-row__title { flex: 1; }
.track-row__file  {
    display: flex; align-items: center; gap: .5rem;
    flex-shrink: 0;
}
.track-row__current {
    display: flex; align-items: center; gap: .35rem;
    max-width: 160px; overflow: hidden;
    white-space: nowrap; text-overflow: ellipsis;
    font-size: .65rem; color: var(--text-dim);
}
.track-row__upload-label {
    font-size: .6rem; color: var(--accent);
    cursor: pointer; white-space: nowrap;
    display: inline-flex; align-items: center; gap: .25rem;
    border: 1px solid rgba(0,230,118,.3);
    padding: .25rem .6rem; border-radius: 4px;
}
.track-row__upload-label:hover { background: rgba(0,230,118,.07); }
.adm-input--sm { padding: .4rem .6rem; font-size: .75rem; }
</style>
@endpush

@section('content')

<div class="adm-page-hd">
    <div>
        <div class="adm-page-hd__title">{{ $release->exists ? 'EDIT RELEASE' : 'ADD RELEASE' }}</div>
        <div class="adm-page-hd__sub">{{ $release->exists ? 'Update release details' : 'Add a new music release' }}</div>
    </div>
    <a href="{{ route('admin.music.index') }}" class="btn btn--ghost">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<form action="{{ $release->exists ? route('admin.music.update', $release) : route('admin.music.store') }}"
      method="POST" enctype="multipart/form-data" id="music-form">
    @csrf
    @if($release->exists) @method('PUT') @endif

    {{-- Hidden delete_tracks accumulator --}}
    <div id="delete-tracks-inputs"></div>

    <div class="adm-form-layout">

        {{-- ── Left ─────────────────────────────────── --}}
        <div style="display:flex;flex-direction:column;gap:1.5rem;">

            {{-- Core Info --}}
            <div class="adm-card">
                <div class="adm-card__head"><span class="adm-card__title">Release Info</span></div>
                <div class="adm-card__body">
                    <div class="adm-form-grid" style="gap:1.25rem;">

                        <div class="adm-field adm-form-full">
                            <label class="adm-label" for="title">Title <sup>*</sup></label>
                            <input class="adm-input" type="text" id="title" name="title"
                                   value="{{ old('title', $release->title) }}" required>
                            @error('title') <span class="adm-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="type">Type <sup>*</sup></label>
                            <select class="adm-select" id="type" name="type" required>
                                <option value="">— Select Type —</option>
                                @foreach(['Single','EP','Album','Compilation','Beat Tape','Mixtape'] as $t)
                                    <option value="{{ $t }}" {{ old('type', $release->type) === $t ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="adm-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="year">Year</label>
                            <input class="adm-input" type="number" id="year" name="year"
                                   value="{{ old('year', $release->year) }}"
                                   min="2000" max="2099" placeholder="{{ date('Y') }}">
                        </div>

                        <div class="adm-field adm-form-full">
                            <label class="adm-label" for="note">Note / Subtitle</label>
                            <input class="adm-input" type="text" id="note" name="note"
                                   value="{{ old('note', $release->note) }}"
                                   placeholder="e.g. UMA Winner · Best Compilation">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="sort_order">Sort Order</label>
                            <input class="adm-input" type="number" id="sort_order" name="sort_order"
                                   value="{{ old('sort_order', $release->sort_order ?? 0) }}" min="0">
                            <span class="adm-hint">Lower = shown first</span>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Streaming Links --}}
            <div class="adm-card">
                <div class="adm-card__head"><span class="adm-card__title">Streaming Links</span></div>
                <div class="adm-card__body">
                    <div class="adm-form-grid" style="gap:1.25rem;">
                        @foreach([
                            ['soundcloud_url',  'fab fa-soundcloud','var(--orange)','SoundCloud URL', 'https://soundcloud.com/just-slick/...'],
                            ['spotify_url',     'fab fa-spotify',   '#1DB954',      'Spotify URL',    'https://open.spotify.com/...'],
                            ['apple_music_url', 'fab fa-apple',     '#fc3c44',      'Apple Music URL','https://music.apple.com/...'],
                            ['youtube_url',     'fab fa-youtube',   '#ff0000',      'YouTube URL',    'https://youtube.com/...'],
                        ] as [$field, $icon, $color, $label, $ph])
                        <div class="adm-field adm-form-full">
                            <label class="adm-label" for="{{ $field }}">
                                <i class="{{ $icon }}" style="color:{{ $color }};"></i> {{ $label }}
                            </label>
                            <input class="adm-input" type="url" id="{{ $field }}" name="{{ $field }}"
                                   value="{{ old($field, $release->$field) }}" placeholder="{{ $ph }}">
                            @error($field) <span class="adm-error">{{ $message }}</span> @enderror
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Tracks --}}
            <div class="adm-card">
                <div class="adm-card__head">
                    <span class="adm-card__title">Tracks</span>
                    <button type="button" id="add-track-btn" class="btn btn--ghost btn--sm">
                        <i class="fas fa-plus"></i> Add Track
                    </button>
                </div>
                <div class="adm-card__body" style="padding:0;">

                    <div id="tracks-list">
                        @if($release->exists && $release->tracks->count())
                            @foreach($release->tracks as $track)
                            <div class="track-row">
                                <input type="hidden" name="tracks[{{ $loop->index }}][id]" value="{{ $track->id }}">
                                <div class="track-row__num">
                                    <input type="number" name="tracks[{{ $loop->index }}][track_number]"
                                           value="{{ $track->track_number }}" min="1"
                                           class="adm-input adm-input--sm" style="width:56px;text-align:center;">
                                </div>
                                <div class="track-row__title">
                                    <input type="text" name="tracks[{{ $loop->index }}][title]"
                                           value="{{ $track->title }}" placeholder="Track title"
                                           class="adm-input adm-input--sm" style="width:100%;">
                                </div>
                                <div class="track-row__file">
                                    <div class="track-row__current">
                                        <i class="fas fa-music" style="color:var(--accent);font-size:.6rem;flex-shrink:0;"></i>
                                        <span>{{ basename($track->audio_file) }}@if($track->duration_formatted !== '—') · {{ $track->duration_formatted }}@endif</span>
                                    </div>
                                    <label class="track-row__upload-label">
                                        <i class="fas fa-upload"></i> Replace
                                        <input type="file" name="tracks[{{ $loop->index }}][audio_file]"
                                               accept=".mp3,.wav,.flac,.ogg" style="display:none;"
                                               onchange="showFileName(this)">
                                    </label>
                                </div>
                                <button type="button" class="btn btn--danger btn--sm remove-track"
                                        data-id="{{ $track->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <div id="tracks-empty"
                         style="{{ ($release->exists && $release->tracks->count()) ? 'display:none;' : '' }}padding:2.5rem;text-align:center;color:var(--text-dim);font-size:.72rem;">
                        <i class="fas fa-music" style="font-size:1.75rem;margin-bottom:.6rem;display:block;opacity:.2;"></i>
                        No tracks yet — click <strong>Add Track</strong> above
                    </div>

                </div>
            </div>

        </div>

        {{-- ── Right ────────────────────────────────── --}}
        <div style="display:flex;flex-direction:column;gap:1.5rem;">

            {{-- Cover Art --}}
            <div class="adm-card">
                <div class="adm-card__head"><span class="adm-card__title">Cover Art</span></div>
                <div class="adm-card__body">
                    <div class="adm-upload">
                        <input type="file" name="cover_art" id="cover-input" accept="image/*"
                               onchange="previewCover(this)" style="display:none;">
                        <label for="cover-input" style="cursor:pointer;display:block;">
                            @if($release->exists && $release->cover_art_url)
                                <img id="cover-preview" class="adm-upload__preview"
                                     src="{{ $release->cover_art_url }}" alt="Cover">
                            @else
                                <div class="adm-upload__icon"><i class="fas fa-image"></i></div>
                                <div class="adm-upload__lbl">Click to upload cover art<br>JPG, PNG, WEBP · Max 4MB</div>
                                <img id="cover-preview" class="adm-upload__preview" style="display:none;" src="" alt="">
                            @endif
                        </label>
                    </div>
                    @error('cover_art') <span class="adm-error" style="margin-top:.5rem;display:block;">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- ZIP --}}
            <div class="adm-card">
                <div class="adm-card__head"><span class="adm-card__title">Download ZIP</span></div>
                <div class="adm-card__body">
                    @if($release->exists && $release->zip_url)
                        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;
                                    padding:.75rem 1rem;background:rgba(0,230,118,.06);
                                    border:1px solid rgba(0,230,118,.15);border-radius:6px;">
                            <i class="fas fa-file-zipper" style="color:var(--accent);"></i>
                            <span style="font-size:.7rem;color:var(--text);flex:1;">ZIP already uploaded</span>
                            <a href="{{ $release->zip_url }}" target="_blank"
                               style="color:var(--accent);font-size:.65rem;">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    @endif
                    <label class="adm-label">{{ ($release->exists && $release->zip_url) ? 'Replace ZIP' : 'Upload ZIP' }}</label>
                    <input class="adm-input" type="file" name="zip_file" accept=".zip">
                    <span class="adm-hint">ZIP of all tracks · Max 512 MB</span>
                    @error('zip_file') <span class="adm-error" style="margin-top:.5rem;display:block;">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Flags --}}
            <div class="adm-card">
                <div class="adm-card__head"><span class="adm-card__title">Flags</span></div>
                <div class="adm-card__body" style="display:flex;flex-direction:column;gap:1rem;">
                    <div class="adm-toggle-row">
                        <label class="adm-toggle" for="is_featured">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                   {{ old('is_featured', $release->is_featured) ? 'checked' : '' }}>
                            <div class="adm-toggle__dot"></div>
                        </label>
                        <div>
                            <div class="adm-toggle-lbl">Featured Release</div>
                            <div style="font-size:.58rem;color:var(--text-dim);">Highlighted on discography page</div>
                        </div>
                    </div>
                    <div class="adm-toggle-row">
                        <label class="adm-toggle" for="is_uma_winner">
                            <input type="hidden" name="is_uma_winner" value="0">
                            <input type="checkbox" id="is_uma_winner" name="is_uma_winner" value="1"
                                   {{ old('is_uma_winner', $release->is_uma_winner) ? 'checked' : '' }}>
                            <div class="adm-toggle__dot"></div>
                        </label>
                        <div>
                            <div class="adm-toggle-lbl" style="color:var(--red);">
                                <i class="fas fa-trophy" style="font-size:.7rem;margin-right:.3rem;"></i> UMA Award Winner
                            </div>
                            <div style="font-size:.58rem;color:var(--text-dim);">Shows award badge on release card</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Save --}}
            <div class="adm-card">
                <div class="adm-card__body">
                    <button type="submit" class="btn btn--primary" style="width:100%;justify-content:center;">
                        <i class="fas fa-save"></i>
                        {{ $release->exists ? 'Update Release' : 'Save Release' }}
                    </button>
                    @if($release->exists)
                        <form action="{{ route('admin.music.destroy', $release) }}" method="POST"
                              style="margin-top:.75rem;"
                              onsubmit="return confirm('Delete this release permanently?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn--danger" style="width:100%;justify-content:center;">
                                <i class="fas fa-trash"></i> Delete Release
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    var idx         = {{ $release->exists ? $release->tracks->count() : 0 }};
    var list        = document.getElementById('tracks-list');
    var emptyMsg    = document.getElementById('tracks-empty');
    var deletesWrap = document.getElementById('delete-tracks-inputs');

    function syncEmpty() {
        emptyMsg.style.display = list.children.length ? 'none' : 'block';
    }

    function makeRow(i, num) {
        var row = document.createElement('div');
        row.className = 'track-row';
        row.innerHTML =
            '<div class="track-row__num">' +
                '<input type="number" name="tracks[' + i + '][track_number]" ' +
                       'value="' + num + '" min="1" ' +
                       'class="adm-input adm-input--sm" style="width:56px;text-align:center;">' +
            '</div>' +
            '<div class="track-row__title">' +
                '<input type="text" name="tracks[' + i + '][title]" ' +
                       'placeholder="Track title" ' +
                       'class="adm-input adm-input--sm" style="width:100%;">' +
            '</div>' +
            '<div class="track-row__file">' +
                '<label class="track-row__upload-label">' +
                    '<i class="fas fa-upload"></i> ' +
                    '<span class="file-label">Choose audio</span>' +
                    '<input type="file" name="tracks[' + i + '][audio_file]" ' +
                           'accept=".mp3,.wav,.flac,.ogg" style="display:none;">' +
                '</label>' +
            '</div>' +
            '<button type="button" class="btn btn--danger btn--sm remove-track">' +
                '<i class="fas fa-trash"></i>' +
            '</button>';

        row.querySelector('input[type="file"]').addEventListener('change', function () {
            this.closest('label').querySelector('.file-label').textContent =
                this.files.length ? this.files[0].name : 'Choose audio';
        });

        return row;
    }

    document.getElementById('add-track-btn').addEventListener('click', function () {
        list.appendChild(makeRow(idx++, list.children.length + 1));
        syncEmpty();
    });

    list.addEventListener('click', function (e) {
        var btn = e.target.closest('.remove-track');
        if (!btn) return;
        var row = btn.closest('.track-row');
        var id  = btn.dataset.id;
        if (id) {
            var inp   = document.createElement('input');
            inp.type  = 'hidden';
            inp.name  = 'delete_tracks[]';
            inp.value = id;
            deletesWrap.appendChild(inp);
        }
        row.remove();
        syncEmpty();
    });

    syncEmpty();
});

function previewCover(input) {
    if (!input.files || !input.files[0]) return;
    var reader  = new FileReader();
    var preview = document.getElementById('cover-preview');
    reader.onload = function (e) {
        preview.src           = e.target.result;
        preview.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}

function showFileName(input) {
    var label = input.closest('label');
    if (label && input.files[0]) {
        var span = label.querySelector('.file-label');
        if (span) span.textContent = input.files[0].name;
    }
}
</script>
@endpush