@forelse ($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            @if($item->image)
                <img style="width:50px;height:50px;object-fit:cover;border-radius:6px"
                    src="{{ display_file($item->image) }}" alt="">
            @else
                <span class="text-muted">---</span>
            @endif
        </td>
        <td>{{ $item->title_ar }}</td>
        <td>{{ $item->category?->name ?? '---' }}</td>
        <td>
            @if($item->is_purchasable && $item->price)
                {{ number_format($item->price, 0) }} {{ $item->currency ?? 'ر.س' }}
            @else
                <span class="text-muted">---</span>
            @endif
        </td>
        <td>
            <span class="badge {{ $item->status->color() }}">{{ $item->status->name() }}</span>
        </td>
        <td class="d-flex gap-2">
            @can('update_services')
                <a href="{{ route('dashboard.services.edit', $item->id) }}" class="btn btn-primary btn-sm text-white">
                    <i class="fa-solid fa-pen"></i>
                </a>
            @endcan
            @can('delete_services')
                <button type="button" class="btn btn-danger btn-sm"
                    data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            @endcan
            @include('dashboard.services.delete-modal', ['item' => $item])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center py-4 text-muted">لا توجد خدمات</td>
    </tr>
@endforelse
