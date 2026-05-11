@forelse ($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            <img style="width:60px;height:60px;object-fit:cover;border-radius:6px"
                 src="{{ display_file($item->image) }}" alt="">
        </td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->phone ?? '---' }}</td>
        <td>
            <div class="d-flex align-items-center gap-2">
                <span class="badge status-badge {{ $item->status->color() }}">
                    {{ $item->status->name() }}
                </span>
                @can('update_users')
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input status-toggle" type="checkbox" role="switch"
                            @if($item->status === \App\Enums\StatusUser::ACTIVE) checked @endif
                            data-id="{{ $item->id }}"
                            data-url="{{ route('dashboard.users.toggle-status', $item->id) }}">
                    </div>
                @endcan
            </div>
        </td>
        <td>
            <div class="btn-holder d-flex align-items-center gap-3">
                @can('update_users')
                    <a href="{{ route('dashboard.users.edit', $item->id) }}"
                        class="btn btn-primary btn-sm text-white mx-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                @endcan
                @can('delete_users')
                    <button type="button" class="btn btn-danger btn-sm"
                        data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endcan
            </div>
            @include('dashboard.users.delete-model', ['item' => $item])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center py-4 text-muted">لا يوجد مستخدمون</td>
    </tr>
@endforelse
