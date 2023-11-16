<div class="py-2 px-4 d-flex justify-content-between align-items-center @if ($chapter->is_free) text-primary video-preview-link @endif"
    @if ($chapter->is_free) @click="previewChapter('{{ $chapter->video_url }}')" @endif>
    <div class="gap-2 d-flex align-items-center">
        <x-lucide-play-circle class="w-4 h-4" />
        <span>{{ $chapter->title }}</span>
    </div>
    <div class="gap-2 d-flex align-items-center">
        @if ($chapter->is_free)
            <span class="text-decoration-underline">Preview</span>
        @endif
        @if ($chapter->video_duration)
            <span class="video-duration">@sec2HMS($chapter->video_duration)</span>
        @endif

    </div>
</div>
