@extends('admin.layouts.app')

@section('title', 'Portfolio Items')
@section('breadcrumb', 'Portfolio')
@section('breadcrumb-current', 'All Items')

@section('content')

<div class="adm-page-hd">
    <div>
        <div class="adm-page-hd__title">PORTFOLIO</div>
        <div class="adm-page-hd__sub">{{ $items->count() }} item{{ $items->count() !== 1 ? 's' : '' }} total</div>
    </div>
    <a href="{{ route('admin.portfolio.create') }}" class="btn btn--primary">
        <i class="fas fa-plus"></i> Add Item
    </a>
</div>

<div class="adm-card">
    <div class="adm-card__head">
        <span class="adm-card__title">All Portfolio Items</span>
        <div style="display:flex;gap:.5rem;">
            <span class="adm-tag adm-tag--green">Design: {{ $items->where('category','Graphic Design')->count() }}</span>
            <span class="adm-tag adm-tag--orange">Dev: {{ $items->where('category','Software Dev')->count() }}</span>
        </div>
    </div>

    @if($items->isEmpty())
        <div class="adm-empty">
            <div class="adm-empty__icon"><i class="fas fa-folder-open"></i></div>
            <div class="adm-empty__title">No Portfolio Items</div>
            <div class="adm-empty__sub" style="margin-bottom:1.5rem;">Start adding your work</div>
            <a href="{{ route('admin.portfolio.create') }}" class="btn btn--primary">
                <i class="fas fa-plus"></i> Add First Item
            </a>
        </div>
    @else
        <div class="adm-table-wrap">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th style="width:60px;">Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Year</th>
                        <th>Link</th>
                        <th style="width:140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td class="text-dim">{{ $loop->iteration }}</td>
                        <td>
                            <div class="adm-thumb">
                                @if($item->image)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                                @else
                                    {{ strtoupper(substr($item->title,0,2)) }}
                                @endif
                            </div>
                        </td>
                        <td>
                            <span style="color:var(--text);font-weight:500;">{{ $item->title }}</span>
                            @if($item->description)
                                <div style="font-size:.6rem;color:var(--text-dim);margin-top:.15rem;
                                            white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px;">
                                    {{ $item->description }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="adm-tag {{ $item->category === 'Graphic Design' ? 'adm-tag--green' : 'adm-tag--orange' }}">
                                {{ $item->category }}
                            </span>
                        </td>
                        <td>
                            @foreach($item->tags_array as $tag)
                                <span class="adm-tag" style="margin:.1rem .1rem 0 0;">{{ $tag }}</span>
                            @endforeach
                        </td>
                        <td>{{ $item->year ?? '—' }}</td>
                        <td>
                            @if($item->link)
                                <a href="{{ $item->link }}" target="_blank"
                                   style="color:var(--accent);font-size:.65rem;">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            @else
                                <span class="text-dim">—</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:.4rem;">
                                <a href="{{ route('admin.portfolio.edit', $item) }}" class="btn btn--ghost btn--sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.portfolio.destroy', $item) }}" method="POST"
                                      class="adm-del-form"
                                      onsubmit="return confirm('Delete \'{{ addslashes($item->title) }}\'?')">
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