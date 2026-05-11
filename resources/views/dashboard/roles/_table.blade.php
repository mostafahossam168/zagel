@forelse ($items as $item)
    <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $item->name }}</td>
        <td>
            <div class="btn-holder d-flex align-items-center gap-3">
                @can('read_roles')
                    <a href="{{ route('dashboard.roles.show', $item->id) }}"
                        class="btn btn-info btn-sm text-white mx-1">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                @endcan
                @can('update_roles')
                    <a href="{{ route('dashboard.roles.edit', $item->id) }}"
                        class="btn btn-primary btn-sm text-white mx-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                @endcan
                @can('delete_roles')
                    <button type="button" class="btn btn-danger btn-sm"
                        data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endcan
            </div>
            @include('dashboard.roles.delete-model', ['item' => $item])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="text-center py-4 text-muted">لا توجد صلاحيات</td>
    </tr>
@endforelse
