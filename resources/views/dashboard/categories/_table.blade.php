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
        <td>{{ $item->name }}</td>
        <td>{{ Str::limit($item->description, 60) }}</td>
        <td>
            <span class="badge {{ $item->status->color() }}">{{ $item->status->name() }}</span>
        </td>
        <td class="d-flex gap-2">
            @can('update_categories')
                <button type="button" class="btn btn-primary btn-sm text-white"
                    data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                    <i class="fa-solid fa-pen"></i>
                </button>
            @endcan
            @can('delete_categories')
                <button type="button" class="btn btn-danger btn-sm"
                    data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            @endcan
            @include('dashboard.categories.delete-modal', ['item' => $item])
            @include('dashboard.categories.edit-modal', ['item' => $item])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-4 text-muted">لا توجد أقسام</td>
    </tr>
@endforelse
