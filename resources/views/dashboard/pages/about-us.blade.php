@extends('dashboard.layouts.backend', ['title' => 'من نحن'])

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .note-editor.note-frame { border-radius: 8px; border: 1px solid #dee2e6; }
        .note-toolbar { background: #f8f9fa !important; border-radius: 8px 8px 0 0; padding: 8px !important; }
        .note-toolbar .note-btn { border: 1px solid #dee2e6 !important; background: #fff !important; color: #333 !important; border-radius: 4px !important; margin: 2px !important; }
        .note-toolbar .note-btn:hover { background: #e9ecef !important; }
        .note-editable { min-height: 400px; font-size: 15px; line-height: 1.8; padding: 20px !important; }
        .note-statusbar { border-radius: 0 0 8px 8px; }
    </style>
@endsection

@section('contant')
    <div class="main-side">
        <div class="main-title mb-4">
            <div class="small">الرئيسية</div>/
            <div class="large">من نحن</div>
        </div>

        <x-alert-component></x-alert-component>

        <form action="{{ route('dashboard.pages.about-us.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card border-0 shadow-sm p-3">
                <textarea id="summernote" name="content">{!! $page->content !!}</textarea>
            </div>
            <button class="d-flex justify-content-center mt-4 mx-auto" type="submit">
                <a class="main-btn px-5">حفظ المحتوى</a>
            </button>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script>
    $('#summernote').summernote({
        height: 450,
        direction: 'rtl',
        toolbar: [
            ['style',  ['style']],
            ['font',   ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['color',  ['color']],
            ['para',   ['ul', 'ol', 'paragraph']],
            ['table',  ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view',   ['fullscreen', 'codeview', 'help']],
        ],
        styleTags: ['p', 'h1', 'h2', 'h3', 'h4'],
        callbacks: {
            onImageUpload: function (files) {
                var formData = new FormData();
                formData.append('file', files[0]);
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    url: '{{ route('dashboard.pages.upload-image') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        $('#summernote').summernote('insertImage', res.url);
                    }
                });
            }
        }
    });
    </script>
@endpush
