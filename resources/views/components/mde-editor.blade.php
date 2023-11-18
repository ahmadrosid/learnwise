@props(['input_name' => '', 'text' => ''])

<div class="pb-2">
    <textarea name="{{$input_name}}" id="mde-editor">{{$text}}</textarea>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>
    const editor = document.querySelector("#mde-editor");
    var simplemde = new SimpleMDE({
        element: editor,
        hideIcons: ['heading', 'preview', 'side-by-side', 'fullscreen', 'guide'],
        spellChecker: false,
        status: false,
    });

    simplemde.codemirror.on("change", (e) => {
        console.log(this.text);
        this.text = simplemde.value();
    });
</script>