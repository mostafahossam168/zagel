@forelse ($items as $item)
    <tr class="{{ $item->status === \App\Enums\ProjectSubmissionStatus::NEW ? 'fw-bold' : '' }}">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ Str::limit($item->project_title, 50) }}</td>
        <td>
            <span class="badge {{ $item->status->color() }}">{{ $item->status->name() }}</span>
        </td>
        <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
        <td>
            <div class="btn-holder d-flex align-items-center gap-2">
                @can('read_project_submissions')
                    <a href="{{ route('dashboard.project-submissions.show', $item->id) }}"
                        class="btn btn-info btn-sm text-white">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                @endcan
                @can('delete_project_submissions')
                    <button type="button" class="btn btn-danger btn-sm"
                        data-bs-toggle="modal" data-bs-target="#deleteSubmission{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endcan
            </div>
            @can('delete_project_submissions')
                @include('dashboard.project-submissions.delete-modal', ['item' => $item])
            @endcan
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center py-4 text-muted">لا توجد مشاريع مقدمة</td>
    </tr>
@endforelse
