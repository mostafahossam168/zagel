@forelse ($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            <img style="width:60px;height:60px;object-fit:cover;border-radius:6px" src="{{ display_file($item->image) }}"
                alt="">
        </td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->phone }}</td>
        <td>
            <div class="d-flex align-items-center gap-2">
                @can('update_admins')
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input status-toggle" type="checkbox" role="switch"
                            @if ($item->status === \App\Enums\StatusUser::ACTIVE) checked @endif data-id="{{ $item->id }}"
                            data-url="{{ route('dashboard.admins.toggle-status', $item->id) }}">
                    </div>
                @endcan
            </div>
        </td>
        <td>
            <span class="badge bg-secondary">{{ $item->roles->first()?->name }}</span>
        </td>
        <td>
            <div class="btn-holder d-flex align-items-center gap-3">
                @can('update_admins')
                    <a href="{{ route('dashboard.admins.edit', $item->id) }}"
                        class="btn btn-primary btn-sm text-white mx-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                @endcan
                @can('delete_admins')
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#delete{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endcan
            </div>
            @include('dashboard.admins.delete-model', ['item' => $item])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center py-4 text-muted">لا توجد بيانات</td>
    </tr>
@endforelse
