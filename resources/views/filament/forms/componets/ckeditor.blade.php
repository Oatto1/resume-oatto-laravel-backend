@php
    $id = $getId();
    $statePath = $getStatePath();
@endphp

<div wire:ignore>
    <textarea id="ckeditor-{{ $id }}" class="w-full border rounded">
        {!! $getState() !!}
    </textarea>
</div>

{{-- โหลด CKEditor 5 (ฟรี) --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const el = document.getElementById('ckeditor-{{ $id }}');

        if (!el) return;

        ClassicEditor.create(el, {
            ckfinder: {
                uploadUrl: "{{ url('/admin/ckeditor/upload') }}?_token={{ csrf_token() }}"
            },
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                'insertTable', 'imageUpload', 'blockQuote', '|',
                'undo', 'redo'
            ],
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:inline',
                    'imageStyle:block',
                    'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            }
        })
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('{{ $statePath }}', editor.getData());
            });
        })
        .catch(error => {
            console.error(error);
        });
    });
</script>
