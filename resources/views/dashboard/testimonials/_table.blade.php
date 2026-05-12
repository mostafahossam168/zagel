@forelse ($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            @if($item->image)
                <img style="width:50px;height:50px;object-fit:cover;border-radius:50%"
                    src="{{ display_file($item->image) }}" alt="">
            @else
                <span class="text-muted">---</span>
            @endif
        </td>
        <td>{{ $item->name }}</td>
        <td>
            {{ $item->company ?? '' }}
            @if($item->company && $item->position) / @endif
            {{ $item->position ?? '' }}
        </td>
        <td>
            @for ($i = 1; $i <= 5; $i++)
                <i class="fa-star {{ $i <= $item->rating ? 'fa-solid text-warning' : 'fa-regular text-muted' }}"></i>
            @endfor
        </td>
        <td>
            <span class="badge {{ $item->status->color() }}">{{ $item->status->name() }}</span>
        </td>
        <td>
            <div class="d-flex align-items-center gap-2">
                @can('update_testimonials')
                    <button type="button" class="btn btn-primary btn-sm text-white"
                        data-bs-toggle="modal" data-bs-target="#editTestimonial{{ $item->id }}">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                @endcan
                @can('delete_testimonials')
                    <button type="button" class="btn btn-danger btn-sm"
                        data-bs-toggle="modal" data-bs-target="#deleteTestimonial{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endcan
            </div>
            @can('update_testimonials')
                @include('dashboard.testimonials.edit-modal', ['item' => $item])
            @endcan
            @can('delete_testimonials')
                @include('dashboard.testimonials.delete-modal', ['item' => $item])
            @endcan
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center py-4 text-muted">لا توجد شهادات</td>
    </tr>
@endforelse
