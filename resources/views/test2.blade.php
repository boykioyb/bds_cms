<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CKEditor</title>
    <script src="{{ asset('js/ckeditor.js') }}"></script>
</head>
<body>
<textarea name="content" id="editor">This is some sample content.</textarea>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'),{
            ckfinder: {
                uploadUrl: '/ckfinder/connector'
            }
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>
