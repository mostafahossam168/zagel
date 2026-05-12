@extends('front.layouts.app')
@section('title', 'خدماتي')

@section('content')

<div class="max-w-[1200px] mx-auto px-4 py-10">

    {{-- Success --}}
    @if(session('success'))
    <div class="flex items-start gap-3 bg-secondary-container text-on-secondary-fixed-variant rounded-xl p-4 mb-6">
        <span class="material-symbols-outlined text-secondary flex-shrink-0">check_circle</span>
        <p class="text-sm">{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

        {{-- Sidebar --}}
        <aside class="md:col-span-4 lg:col-span-3">
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6 flex flex-col items-center text-center">
                <div class="relative mb-4">
                    @if(auth()->user()->image)
                        <img src="{{ display_file(auth()->user()->image) }}" alt="{{ auth()->user()->name }}"
                             class="w-28 h-28 rounded-full object-cover border-4 border-surface-container">
                    @else
                        <div class="w-28 h-28 rounded-full bg-primary-fixed flex items-center justify-center border-4 border-surface-container">
                            <span class="material-symbols-outlined text-primary" style="font-size:48px">person</span>
                        </div>
                    @endif
                </div>
                <h2 class="font-semibold text-on-surface mb-1" style="font-size:18px">{{ auth()->user()->name }}</h2>
                <p class="text-on-surface-variant text-sm mb-6">{{ auth()->user()->email }}</p>

                <nav class="w-full space-y-1 text-right">
                    <a href="{{ route('user.profile') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-on-surface-variant hover:bg-surface-container-low transition-colors text-sm">
                        <span class="material-symbols-outlined" style="font-size:18px">person</span>
                        ملفي
                    </a>
                    <a href="{{ route('user.listings.index') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-primary-fixed text-primary font-semibold text-sm">
                        <span class="material-symbols-outlined" style="font-size:18px;font-variation-settings:'FILL' 1">work</span>
                        خدماتي
                    </a>
                    <a href="{{ route('user.listings.create') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-on-surface-variant hover:bg-surface-container-low transition-colors text-sm">
                        <span class="material-symbols-outlined" style="font-size:18px">add_circle</span>
                        أضف خدمة
                    </a>
                    <a href="{{ route('user.notifications.index') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-on-surface-variant hover:bg-surface-container-low transition-colors text-sm">
                        <span class="material-symbols-outlined" style="font-size:18px">notifications</span>
                        الإشعارات
                    </a>
                    <form action="{{ route('user.logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-error hover:bg-error-container transition-colors text-sm">
                            <span class="material-symbols-outlined" style="font-size:18px">logout</span>
                            تسجيل الخروج
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        {{-- Main --}}
        <section class="md:col-span-8 lg:col-span-9">
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-semibold text-primary border-r-4 border-primary pr-3 leading-none" style="font-size:18px">
                        خدماتي المقدمة
                    </h3>
                    <a href="{{ route('user.listings.create') }}"
                       class="flex items-center gap-2 bg-primary text-on-primary px-4 py-2 rounded-xl text-sm font-semibold hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined" style="font-size:16px">add</span>
                        خدمة جديدة
                    </a>
                </div>

                @forelse($listings as $listing)
                <div class="border border-outline-variant rounded-xl mb-4 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4 p-4">
                        {{-- Image --}}
                        <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                            @if($listing->image)
                                <img src="{{ display_file($listing->image) }}" alt="{{ $listing->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-primary-fixed flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary" style="font-size:24px">work</span>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-grow text-right min-w-0">
                            <div class="flex items-start justify-between gap-2 flex-wrap">
                                <h4 class="font-semibold text-on-surface text-sm leading-snug">{{ $listing->title }}</h4>
                                @php
                                    $statusMap = [
                                        'approved' => ['class' => 'bg-secondary-container text-on-secondary-fixed-variant', 'text' => 'مقبول'],
                                        'rejected' => ['class' => 'bg-error-container text-on-error-container',             'text' => 'مرفوض'],
                                        'pending'  => ['class' => 'bg-tertiary-fixed text-tertiary',                        'text' => 'قيد المراجعة'],
                                    ];
                                    $s = $statusMap[$listing->status->value] ?? $statusMap['pending'];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $s['class'] }}">{{ $s['text'] }}</span>
                            </div>
                            <p class="text-on-surface-variant text-xs mt-1 line-clamp-2">{{ Str::limit($listing->description, 100) }}</p>
                            <div class="flex items-center gap-3 mt-2 flex-wrap">
                                @if($listing->category)
                                <span class="text-xs text-outline">{{ $listing->category->name }}</span>
                                @endif
                                @if($listing->price)
                                <span class="text-xs text-primary font-semibold">{{ number_format($listing->price) }} {{ $listing->currency }}</span>
                                @endif
                                <span class="text-xs text-outline">{{ $listing->created_at->format('d M Y') }}</span>
                            </div>
                            @if($listing->admin_notes && $listing->status->value === 'rejected')
                            <div class="mt-2 bg-error-container text-on-error-container rounded-lg px-3 py-1.5 text-xs">
                                <span class="font-semibold">ملاحظة الإدارة:</span> {{ $listing->admin_notes }}
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="border-t border-outline-variant px-4 py-2.5 flex items-center justify-end gap-3 bg-surface-container-low">
                        <button type="button"
                            onclick="openEditModal({{ $listing->id }})"
                            class="flex items-center gap-1.5 text-primary text-xs font-semibold hover:underline">
                            <span class="material-symbols-outlined" style="font-size:15px">edit</span>
                            تعديل
                        </button>
                        <button type="button"
                            onclick="openDeleteModal({{ $listing->id }}, '{{ addslashes($listing->title) }}')"
                            class="flex items-center gap-1.5 text-error text-xs font-semibold hover:underline">
                            <span class="material-symbols-outlined" style="font-size:15px">delete</span>
                            حذف
                        </button>
                    </div>
                </div>
                @empty
                <div class="text-center py-16">
                    <span class="material-symbols-outlined text-outline mb-3" style="font-size:56px">work_off</span>
                    <p class="text-on-surface-variant text-sm mb-4">لم تقدم أي خدمات بعد</p>
                    <a href="{{ route('user.listings.create') }}"
                       class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined" style="font-size:16px">add</span>
                        أضف خدمتك الأولى
                    </a>
                </div>
                @endforelse
            </div>
        </section>
    </div>
</div>

{{-- ── Edit Modals (one hidden form per listing) ─────────────────────────── --}}
@foreach($listings as $listing)
<div id="edit-modal-{{ $listing->id }}"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
     onclick="if(event.target===this) closeEditModal({{ $listing->id }})">
    <div class="bg-surface-container-lowest rounded-2xl premium-shadow w-full max-w-2xl max-h-[90vh] overflow-y-auto">

        <div class="flex items-center justify-between p-5 border-b border-outline-variant sticky top-0 bg-surface-container-lowest z-10">
            <h3 class="font-bold text-primary text-base">تعديل الخدمة</h3>
            <button onclick="closeEditModal({{ $listing->id }})" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-surface-container transition-colors text-on-surface-variant">
                <span class="material-symbols-outlined" style="font-size:18px">close</span>
            </button>
        </div>

        <form method="POST" action="{{ route('user.listings.update', $listing) }}" enctype="multipart/form-data" class="p-5 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-label-lg text-on-surface mb-1.5">عنوان الخدمة <span class="text-error">*</span></label>
                <input type="text" name="title" value="{{ old('title', $listing->title) }}" required
                       class="w-full bg-surface-container-low border-none rounded-xl h-11 px-4 text-sm focus:ring-2 focus:ring-primary text-right">
            </div>

            <div>
                <label class="block text-label-lg text-on-surface mb-1.5">الوصف <span class="text-error">*</span></label>
                <textarea name="description" rows="4" required
                          class="w-full bg-surface-container-low border-none rounded-xl p-4 text-sm focus:ring-2 focus:ring-primary text-right">{{ old('description', $listing->description) }}</textarea>
            </div>

            <div>
                <label class="block text-label-lg text-on-surface mb-1.5">تغيير صورة الخدمة</label>
                @if($listing->image)
                <div class="mb-2">
                    <img src="{{ display_file($listing->image) }}" class="h-16 w-24 object-cover rounded-lg" alt="">
                </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full bg-surface-container-low border-none rounded-xl px-4 py-2.5 text-sm text-on-surface-variant">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">التصنيف</label>
                    <select name="category_id" class="w-full bg-surface-container-low border-none rounded-xl h-11 px-4 text-sm focus:ring-2 focus:ring-primary">
                        <option value="">اختر التصنيف...</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $listing->category_id) == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">السعر</label>
                    <div class="flex gap-0">
                        <input type="number" name="price" value="{{ old('price', $listing->price) }}"
                               class="flex-1 bg-surface-container-low border-none rounded-r-xl h-11 px-4 text-sm focus:ring-2 focus:ring-primary"
                               placeholder="0.00" min="0" step="0.01">
                        <select name="currency" class="w-20 bg-surface-container-high border-none rounded-l-xl h-11 px-2 text-sm focus:ring-2 focus:ring-primary">
                            <option value="ر.س" {{ old('currency', $listing->currency) == 'ر.س' ? 'selected' : '' }}>ر.س</option>
                            <option value="$"   {{ old('currency', $listing->currency) == '$'   ? 'selected' : '' }}>$</option>
                            <option value="€"   {{ old('currency', $listing->currency) == '€'   ? 'selected' : '' }}>€</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="pt-3 border-t border-outline-variant">
                <h4 class="font-semibold text-primary text-sm mb-3">معلومات التواصل</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-label-lg text-on-surface mb-1.5">رقم الهاتف <span class="text-error">*</span></label>
                        <input type="tel" name="contact_phone" value="{{ old('contact_phone', $listing->contact_phone) }}" required dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl h-11 px-4 text-sm focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-label-lg text-on-surface mb-1.5">واتساب</label>
                        <input type="tel" name="contact_whatsapp" value="{{ old('contact_whatsapp', $listing->contact_whatsapp) }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl h-11 px-4 text-sm focus:ring-2 focus:ring-primary">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-label-lg text-on-surface mb-1.5">البريد الإلكتروني</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $listing->contact_email) }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl h-11 px-4 text-sm focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-label-lg text-on-surface mb-1.5">LinkedIn</label>
                        <input type="url" name="contact_linkedin" value="{{ old('contact_linkedin', $listing->contact_links['linkedin'] ?? '') }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl h-11 px-4 text-sm focus:ring-2 focus:ring-primary" placeholder="https://...">
                    </div>
                    <div>
                        <label class="block text-label-lg text-on-surface mb-1.5">X (Twitter)</label>
                        <input type="url" name="contact_twitter" value="{{ old('contact_twitter', $listing->contact_links['twitter'] ?? '') }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl h-11 px-4 text-sm focus:ring-2 focus:ring-primary" placeholder="https://...">
                    </div>
                    <div>
                        <label class="block text-label-lg text-on-surface mb-1.5">Facebook</label>
                        <input type="url" name="contact_facebook" value="{{ old('contact_facebook', $listing->contact_links['facebook'] ?? '') }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl h-11 px-4 text-sm focus:ring-2 focus:ring-primary" placeholder="https://...">
                    </div>
                </div>
            </div>

            <div class="bg-primary-fixed rounded-xl p-3 flex items-start gap-2">
                <span class="material-symbols-outlined text-primary flex-shrink-0" style="font-size:16px">info</span>
                <p class="text-on-surface-variant text-xs">بعد الحفظ، ستُعاد الخدمة للمراجعة وسيتم إشعارك عند موافقة الإدارة.</p>
            </div>

            <div class="flex gap-3 pt-1">
                <button type="submit"
                    class="flex-1 bg-primary text-on-primary h-11 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined" style="font-size:16px">save</span>
                    حفظ التعديلات
                </button>
                <button type="button" onclick="closeEditModal({{ $listing->id }})"
                    class="flex-shrink-0 bg-surface-container-low text-on-surface-variant h-11 px-5 rounded-xl text-sm hover:bg-surface-container transition-colors">
                    إلغاء
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- ── Delete Confirmation Modal ─────────────────────────────────────────── --}}
<div id="delete-modal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
     onclick="if(event.target===this) closeDeleteModal()">
    <div class="bg-surface-container-lowest rounded-2xl premium-shadow w-full max-w-sm p-6 text-center">
        <div class="w-14 h-14 bg-error-container rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-error" style="font-size:28px">delete_forever</span>
        </div>
        <h3 class="font-bold text-on-surface mb-2" style="font-size:17px">حذف الخدمة</h3>
        <p class="text-on-surface-variant text-sm mb-6" id="delete-modal-msg">هل تريد حذف هذه الخدمة؟ لا يمكن التراجع عن هذا الإجراء.</p>
        <div class="flex gap-3">
            <form id="delete-form" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full bg-error text-on-error h-11 rounded-xl font-bold text-sm hover:opacity-90 transition-opacity">
                    نعم، احذف
                </button>
            </form>
            <button onclick="closeDeleteModal()"
                class="flex-1 bg-surface-container-low text-on-surface-variant h-11 rounded-xl text-sm hover:bg-surface-container transition-colors">
                إلغاء
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openEditModal(id) {
    const modal = document.getElementById('edit-modal-' + id);
    if (modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); document.body.style.overflow = 'hidden'; }
}
function closeEditModal(id) {
    const modal = document.getElementById('edit-modal-' + id);
    if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); document.body.style.overflow = ''; }
}
function openDeleteModal(id, title) {
    const form = document.getElementById('delete-form');
    const msg  = document.getElementById('delete-modal-msg');
    form.action = '/my-services/' + id;
    msg.textContent = 'هل تريد حذف خدمة "' + title + '"؟ لا يمكن التراجع عن هذا الإجراء.';
    const modal = document.getElementById('delete-modal');
    modal.classList.remove('hidden'); modal.classList.add('flex'); document.body.style.overflow = 'hidden';
}
function closeDeleteModal() {
    const modal = document.getElementById('delete-modal');
    modal.classList.add('hidden'); modal.classList.remove('flex'); document.body.style.overflow = '';
}

// Auto-open edit modal if validation errors returned for it
@if(isset($editListing))
openEditModal({{ $editListing->id }});
@endif
</script>
@endpush

@endsection
