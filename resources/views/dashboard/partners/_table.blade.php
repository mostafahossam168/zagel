@forelse ($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            @if($item->image)
                <img style="width:60px;height:60px;object-fit:cover;border-radius:6px"
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
        <td>
            <div class="btn-holder d-flex align-items-center gap-3">
                @can('update_partners')
                    <a href="{{ route('dashboard.partners.edit', $item->id) }}"
                        class="btn btn-primary btn-sm text-white mx-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                @endcan
                @can('delete_partners')
                    <button type="button" class="btn btn-danger btn-sm"
                        data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endcan
            </div>
            @include('dashboard.partners.delete-model', ['item' => $item])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-4 text-muted">لا يوجد شركاء</td>
    </tr>
@endforelse
