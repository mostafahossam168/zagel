@forelse ($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td style="max-width:280px">{{ Str::limit($item->question, 80) }}</td>
        <td style="max-width:320px">{{ Str::limit(strip_tags($item->answer), 80) }}</td>
        <td>
            <span class="badge {{ $item->status->color() }}">{{ $item->status->name() }}</span>
        </td>
        <td>
            <div class="d-flex align-items-center gap-2">
                @can('update_faqs')
                    <button type="button" class="btn btn-primary btn-sm text-white"
                        data-bs-toggle="modal" data-bs-target="#editFaq{{ $item->id }}">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                @endcan
                @can('delete_faqs')
                    <button type="button" class="btn btn-danger btn-sm"
                        data-bs-toggle="modal" data-bs-target="#deleteFaq{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endcan
            </div>
            @can('update_faqs')
                @include('dashboard.faqs.edit-modal', ['item' => $item])
            @endcan
            @can('delete_faqs')
                @include('dashboard.faqs.delete-modal', ['item' => $item])
            @endcan
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center py-4 text-muted">لا توجد أسئلة شائعة</td>
    </tr>
@endforelse
