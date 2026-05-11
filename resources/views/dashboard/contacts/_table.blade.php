@forelse ($items as $item)
    <tr class="{{ $item->status === \App\Enums\ContactStatus::UNREAD ? 'fw-bold' : '' }}">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->phone ?? '---' }}</td>
        <td>{{ Str::limit($item->message, 60) }}</td>
        <td>
            <span class="badge {{ $item->status->color() }}">{{ $item->status->name() }}</span>
        </td>
        <td>{{ date('Y-m-d h:ia', strtotime($item->created_at)) }}</td>
        <td>
            <div class="btn-holder d-flex align-items-center gap-3">
                @can('read_contacts')
                    <a href="{{ route('dashboard.contacts.show', $item->id) }}"
                        class="btn btn-info btn-sm text-white mx-1">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                @endcan
                @can('delete_contacts')
                    <button type="button" class="btn btn-danger btn-sm"
                        data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endcan
            </div>
            @include('dashboard.contacts.delete-model', ['item' => $item])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center py-4 text-muted">لا توجد رسائل</td>
    </tr>
@endforelse
