@extends('admin.layouts.app')

@section('title', $item->exists ? 'Edit Portfolio Item' : 'Add Portfolio Item')
@section('breadcrumb', 'Portfolio')
@section('breadcrumb-current', $item->exists ? 'Edit Item' : 'Add Item')

@section('content')

<div class="adm-page-hd">
    <div>
        <div class="adm-page-hd__title">{{ $item->exists ? 'EDIT ITEM' : 'ADD ITEM' }}</div>
        <div class="adm-page-hd__sub">{{ $item->exists ? 'Update portfolio item details' : 'Add a new portfolio project' }}</div>
    </div>
    <a href="{{ route('admin.portfolio.index') }}" class="btn btn--ghost">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<form action="{{ $item->exists ? route('admin.portfolio.update', $item) : route('admin.portfolio.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <div class="adm-form-layout">

        {{-- ── Left: Main fields ── --}}
        <div style="display:flex;flex-direction:column;gap:1.5rem;">

            <div class="adm-card">
                <div class="adm-card__head">
                    <span class="adm-card__title">Project Details</span>
                </div>
                <div class="adm-card__body">
                    <div class="adm-form-grid" style="gap:1.25rem;">

                        {{-- Title --}}
                        <div class="adm-field adm-form-full">
                            <label class="adm-label" for="title">Title <sup>*</sup></label>
                            <input class="adm-input" type="text" id="title" name="title"
                                   value="{{ old('title', $item->title) }}"
                                   placeholder="e.g. CBS Intranet Portal" required>
                            @error('title') <span class="adm-error">{{ $message }}</span> @enderror
                        </div>

                        {{-- Category --}}
                        <div class="adm-field">
                            <label class="adm-label" for="category">Category <sup>*</sup></label>
                            <select class="adm-select" id="category" name="category" required>
                                <option value="">— Select —</option>
                                @foreach(['Graphic Design', 'Software Dev'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $item->category) === $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category') <span class="adm-error">{{ $message }}</span> @enderror
                        </div>

                        {{-- Year --}}
                        <div class="adm-field">
                            <label class="adm-label" for="year">Year</label>
                            <input class="adm-input" type="number" id="year" name="year"
                                   value="{{ old('year', $item->year) }}"
                                   min="2000" max="2099" placeholder="{{ date('Y') }}">
                            @error('year') <span class="adm-error">{{ $message }}</span> @enderror
                        </div>

                        {{-- Description --}}
                        <div class="adm-field adm-form-full">
                            <label class="adm-label" for="description">Description</label>
                            <textarea class="adm-textarea" id="description" name="description"
                                      placeholder="Brief description of the project...">{{ old('description', $item->description) }}</textarea>
                            @error('description') <span class="adm-error">{{ $message }}</span> @enderror
                        </div>

                        {{-- Tags --}}
                        <div class="adm-field adm-form-full">
                            <label class="adm-label" for="tags">Tags</label>
                            <input class="adm-input" type="text" id="tags" name="tags"
                                   value="{{ old('tags', $item->tags) }}"
                                   placeholder="Laravel, Figma, Brand Identity (comma separated)">
                            <span class="adm-hint">Separate tags with commas</span>
                            @error('tags') <span class="adm-error">{{ $message }}</span> @enderror
                        </div>

                        {{-- Link --}}
                        <div class="adm-field adm-form-full">
                            <label class="adm-label" for="link">Project Link</label>
                            <input class="adm-input" type="url" id="link" name="link"
                                   value="{{ old('link', $item->link) }}"
                                   placeholder="https://...">
                            @error('link') <span class="adm-error">{{ $message }}</span> @enderror
                        </div>

                        {{-- Sort Order --}}
                        <div class="adm-field">
                            <label class="adm-label" for="sort_order">Sort Order</label>
                            <input class="adm-input" type="number" id="sort_order" name="sort_order"
                                   value="{{ old('sort_order', $item->sort_order ?? 0) }}" min="0">
                            <span class="adm-hint">Lower = shown first</span>
                            @error('sort_order') <span class="adm-error">{{ $message }}</span> @enderror
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- ── Right: Image ── --}}
        <div style="display:flex;flex-direction:column;gap:1.5rem;">

            <div class="adm-card">
                <div class="adm-card__head">
                    <span class="adm-card__title">Cover Image</span>
                </div>
                <div class="adm-card__body">
                    <div class="adm-upload">
                        <input type="file" name="image" accept="image/*"
                               onchange="previewImage(this,'portfolio-preview')">
                        <div class="adm-upload__icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <div class="adm-upload__lbl">Click to upload image<br>JPG, PNG, WEBP · Max 4MB</div>
                        @if($item->image)
                            <img id="portfolio-preview" class="adm-upload__preview"
                                 src="{{ $item->image_url }}" alt="Current image">
                        @else
                            <img id="portfolio-preview" class="adm-upload__preview" style="display:none;" src="" alt="">
                        @endif
                    </div>
                    @error('image') <span class="adm-error" style="margin-top:.5rem;display:block;">{{ $message }}</span> @enderror

                    @if($item->image)
                        <div style="margin-top:.75rem;font-family:var(--mono);font-size:.6rem;color:var(--text-dim);">
                            Current: {{ basename($item->image) }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Save --}}
            <div class="adm-card">
                <div class="adm-card__body">
                    <button type="submit" class="btn btn--primary" style="width:100%;justify-content:center;">
                        <i class="fas fa-save"></i>
                        {{ $item->exists ? 'Update Item' : 'Save Item' }}
                    </button>
                    @if($item->exists)
                        <form action="{{ route('admin.portfolio.destroy', $item) }}" method="POST"
                              style="margin-top:.75rem;"
                              onsubmit="return confirm('Delete this item permanently?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn--danger" style="width:100%;justify-content:center;">
                                <i class="fas fa-trash"></i> Delete Item
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>

    </div>
</form>

@endsection