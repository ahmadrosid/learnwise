@props(['input_name' => '', 'text' => ''])

<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css" />
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
<div class="py-2">
    <input id="x-trix-editor" type="hidden" name="{{$input_name}}" class="form-control" value="{{$text}}">
    <trix-editor input="x-trix-editor" class="trix-content rounded-3 bg-white my-2"></trix-editor>
</div>