@extends('layouts.main')
@section('h1', 'Добавить статью')
@section('content')
<div class="col-sm-8 mx-auto">
    <form onsubmit="sendForm(this); return false;">
        @csrf
        <div class="mb-3">
            <input value="@if(isset($article)){{$article->title}}@endif" name="title" type="text" class="form-control" placeholder="Заголовок">
        </div>
        <div class="mb-3">
            <textarea id="sample" class="form-control" placeholder="Текст статьи"></textarea>
        </div>
        <div class="mb-3">
            <input value="@if(isset($article)){{$article->author}}@endif" name="author" type="text" class="form-control" placeholder="Автор">
        </div>
        @if(isset($article))
            <input type="hidden" name="id" value="{{$article->id}}">
        @endif
        <div class="mb-3">
            <input type="submit" class="form-control btn btn-primary" value="@if(isset($article))Применить изменения@elseДобавить статью@endif">
        </div>
    </form>
</div>
<link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
<!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor.css" rel="stylesheet"> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor-contents.css" rel="stylesheet"> -->
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
<!-- languages (Basic Language: English/en) -->
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/ru.js"></script>
<script>
    /**
     * ID : 'suneditor_sample'
     * ClassName : 'sun-eidtor'
     */
// ID or DOM object
    const editor = SUNEDITOR.create((document.getElementById('sample') || 'sample'),{
        // All of the plugins are loaded in the "window.SUNEDITOR" object in dist/suneditor.min.js file
        // Insert options
        // Language global object (default: en)
        lang: SUNEDITOR_LANG['ru'],
        height: '25rem',
        buttonList: [
            ['undo', 'redo'],
            ['font', 'fontSize', 'formatBlock'],
            ['paragraphStyle', 'blockquote'],
            ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
            ['fontColor', 'hiliteColor', 'textStyle'],
            ['removeFormat'],
            '/', // Line break
            ['outdent', 'indent'],
            ['align', 'horizontalRule', 'list', 'lineHeight'],
            ['table', 'link', 'image', 'video', 'audio' /** ,'math' */], // You must add the 'katex' library at options to use the 'math' plugin.
            /** ['imageGallery'] */ // You must add the "imageGalleryUrl".
            ['fullScreen', 'showBlocks', 'codeView'],
            ['preview', 'print'],
            ['save', 'template'],
            /** ['dir', 'dir_ltr', 'dir_rtl'] */ // "dir": Toggle text direction, "dir_ltr": Right to Left, "dir_rtl": Left to Right
        ]
    });
    @if(isset($article))
        editor.setContents('{!!$article->content!!}');
    @endif
    function sendForm(form){
        console.log(form);
        const content = editor.getContents();
        let formData = new FormData(form);
        formData.append('content', content);
        fetch('/addArticle',{
            method: "POST",
            body: formData
        }).then(response=>response.json())
            .then(result=>{
                if(result.result == 'success'){
                    location.href = '/';
                }
            })
    }
</script>
@endsection