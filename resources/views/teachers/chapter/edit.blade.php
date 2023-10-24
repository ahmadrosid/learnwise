@php
    function completionProgress($chapter)
    {
        $count = 0;
        if (!empty($chapter['title'])) {
            $count++;
        }
        if (!empty($chapter['description'])) {
            $count++;
        }
        if (!empty($chapter['video_url'])) {
            $count++;
        }
        return $count;
    }
    $completionProgressValue = completionProgress($chapter);
@endphp
<x-teacher-layout>

    @if (!$chapter->is_published)
        <div class="alert alert-warning" role="alert">
            <div class="gap-4 d-flex">
                <span><i class="fa-solid fa-circle-exclamation text-warning"></i></span>
                <div class="gap-2 d-flex flex-column">
                    <p class="mb-0">This chapter is unpublished. It will not be visible in the course.</p>
                </div>
            </div>
        </div>
    @endif

    <div class="py-2 px-4">
        <a class="btn" href="/teacher/course/setup/{{ $slug }}">
            <x-lucide-move-left class="h-5" />
            <span class="px-2 font-bold">Back to course setup</span>
        </a>
    </div>

    <div class="py-4 px-5">
        <div class="d-flex justify-content-between">
            <div>
                <h2>Chapter Creation</h2>
                <div>Complete all fields ({{ $completionProgressValue }}/3)</div>
            </div>
            <div class="gap-1 d-flex">
                <form action="/teacher/chapter/publish/{{ $chapter->id }}" method="POST">
                    @csrf
                    @method('put')

                    <button {{ $completionProgressValue < 3 ? 'disabled' : '' }} class="btn btn-secondary"
                        type="submit">
                        {{ $chapter->is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                </form>

                <!-- regarding the following action below, we might want to have a confirmation pop-up or
                     something similar just to notify the user that the action they are about to take
                     could have irreversible impact -->
                <form action="/teacher/chapter/delete/{{ $chapter->id }}" method="POST">

                    @csrf
                    @method('delete')
                    <input type="hidden" name="slug" value="{{ $slug }}" />

                    <button class="btn btn-outline-warning" title="Delete chapter">
                        <x-lucide-trash class="w-4 h-4" />
                    </button>
                </form>
            </div>
        </div>

        <div class="py-5 row row-cols-sm-1 row-cols-md-1 row-cols-lg-2 g-5">
            <div class="col">
                <div class="gap-4 py-2 d-flex align-items-center">
                    <div class="bg-blue-50 d-flex justify-content-center rounded-circle"
                        style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-layout-dashboard class="text-blue-400" />
                    </div>
                    <div class="fs-5">Customize your chapter</div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="chapter-title" class="form-label text-dark">Chapter title</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <form action="/teacher/chapter/update/{{ $chapter->id }}" method="post">
                                @csrf
                                @method('put')

                                <div class="py-2 input-group">
                                    <input value="{{ $chapter->title }}" type="text" class="form-control"
                                        id="chapter-title" name="title" aria-describedby="basic-addon3" />
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        <div class="pt-1 text-sm" x-show="!open">
                            {{ $chapter->title }}
                        </div>
                    </div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="chapter-description" class="form-label text-dark">Chapter description</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <form action="/teacher/chapter/update/{{ $chapter->id }}" method="POST">
                                @csrf
                                @method('put')

                                <x-trix-editor :input_name="'description'" :text="$chapter->description" />
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        <div class="pt-1 text-sm text-neutral-100 fs-sm" x-show="!open">
                            {!! $chapter->description !!}
                        </div>
                    </div>
                </div>
                <div class="gap-4 py-4 d-flex align-items-center">
                    <div class="bg-blue-50 d-flex justify-content-center rounded-circle"
                        style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-eye class="text-blue-400" />
                    </div>
                    <div class="fs-5">Chapter access</div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="chapter-title" class="form-label text-dark">Chapter access</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <form action="/teacher/chapter/update/{{ $chapter->id }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="py-2 px-2 my-2 bg-white border-2 border rounded-2">
                                    <div class="form-check">
                                        <input type="hidden" value="0" name="is_free" />
                                        <input value="1" name="is_free" class="form-check-input"
                                            type="checkbox" id="chapter-access"
                                            @if ($chapter->is_free) checked @endif />
                                        <label class="form-check-label fs-sm" for="chapter-access">
                                            Check this box if you want to make this chapter free for preview
                                        </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                        <div class="pt-1 text-sm text-neutral-100 fs-sm" x-show="!open">
                            {{ $chapter->is_free ? 'This chapter is free for preview.' : 'This chapter is not free.' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="gap-4 py-2 d-flex align-items-center">
                    <div class="bg-blue-50 d-flex justify-content-center rounded-circle"
                        style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-video class="text-blue-400" />
                    </div>
                    <div class="fs-5">Customize your course</div>
                </div>

                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-description" class="form-label text-dark">Chapter video</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s,"
                                x-on:click="open = ! open">
                                <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div x-data="{ fileName: '' }" class="dropzone-area" x-show="open">

                            <form enctype="multipart/form-data"
                                action="/teacher/chapter/update/{{ $chapter->id }}/video" method="POST">
                                @csrf
                                @method('put')
                                <div x-ref="dnd" class="dropzone-box" style="min-height: 200px;">
                                    <div class="py-4">
                                        <input accept="video/*" type="file" name="chapter_video" title="" x-ref="file" @change="fileName = $refs.file.files[0].name" class="dropzone-input-file" @dragover="$refs.dnd.classList.add('bg-blue-50')" @dragleave="$refs.dnd.classList.remove('bg-blue-50')" @drop="$refs.dnd.classList.remove('bg-blue-50')" />
                                    </div>

                                    <div class="dropzone-content">
                                        <x-lucide-upload-cloud class="w-5 h-5" />
                                        <p>Drag your file here or click in this area.</p>
                                        <p x-text="fileName"></p>
                                    </div>
                                </div>
                                <button class="mt-4 w-full btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                        <div class="py-2 text-sm" x-show="!open">

                            @if ($chapter->video_url)
                                <video controls class="img-fluid rounded-3" style="max-height: 300px;">
                                    <source src="{{ asset('storage/' . $chapter->video_url) }}" type="video/mp4" />
                                </video>
                            @else
                                <div class="pt-1 text-sm text-neutral-100 fs-sm">
                                    Upload the chapter Video
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
