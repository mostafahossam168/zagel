@extends('dashboard.layouts.backend', ['title' => 'إرسال إشعار'])

@section('contant')
    <div class="main-side">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="small">الإشعارات</div>/
                <div class="large">إرسال إشعار جديد</div>
            </div>
            <a class="main-btn btn-main-color fs-13px" href="{{ route('dashboard.notifications.index') }}">
                رجوع <i class="fa-solid fa-arrow-left fs-13px"></i>
            </a>
        </div>

        <x-alert-component></x-alert-component>

        <form action="{{ route('dashboard.notifications.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-12 col-md-8">
                    <label class="special-input">
                        <span>عنوان الإشعار <span class="text-danger">*</span></span>
                        <div class="box-input">
                            <input type="text" name="title" value="{{ old('title') }}" required>
                        </div>
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4">
                    <label class="special-label">الإرسال إلى <span class="text-danger">*</span></label>
                    <select name="target" id="targetSelect" class="form-select select-setting" required>
                        <option value="all" @selected(old('target') == 'all')>جميع المستخدمين</option>
                        <option value="specific" @selected(old('target') == 'specific')>مستخدمين محددين</option>
                    </select>
                    @error('target') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12" id="specificUsersWrapper" style="display:none">
                    <label class="special-label">اختر المستخدمين <span class="text-danger">*</span></label>
                    <select name="target_ids[]" class="form-select" multiple style="height:180px">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                @selected(in_array($user->id, old('target_ids', [])))>
                                {{ $user->name }} — {{ $user->email }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">اضغط Ctrl + Click لاختيار أكثر من مستخدم</small>
                    @error('target_ids') <span class="text-danger d-block">{{ $message }}</span> @enderror
                </div>

                <div class="col-12">
                    <label class="special-label">نص الإشعار <span class="text-danger">*</span></label>
                    <textarea name="body" class="form-control" rows="5" required
                        placeholder="اكتب نص الإشعار هنا...">{{ old('body') }}</textarea>
                    @error('body') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <button class="d-flex justify-content-center mt-4 mx-auto" type="submit">
                <a class="main-btn">
                    <i class="fa-solid fa-paper-plane me-2"></i> إرسال الإشعار
                </a>
            </button>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    const targetSelect = document.getElementById('targetSelect');
    const wrapper = document.getElementById('specificUsersWrapper');

    function toggleUsers() {
        wrapper.style.display = targetSelect.value === 'specific' ? 'block' : 'none';
    }

    targetSelect.addEventListener('change', toggleUsers);
    toggleUsers();
</script>
@endpush
