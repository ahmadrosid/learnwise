@php

    $requiredFields = [
        [
            'label' => 'Title',
            'value' => $chapter->title,
        ],
        [
            'label' => 'Description',
            'value' => $chapter->description,
        ],
        [
            'label' => 'Video',
            'value' => $chapter->video_url,
        ],
    ];

    $completedFields = array_reduce(
        $requiredFields,
        function ($carry, $field) {
            return $carry + (!empty($field['value']) ? 1 : 0);
        },
        0,
    );

    $isReadytoPublish = $completedFields === count($requiredFields);

    $sectionName = null;

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
            </div>
            <div class="gap-1 d-flex">
                <form action="{{ route('teacher.chapter.publish', $chapter->id) }}" method="POST">
                    @csrf
                    @method('put')

                    <button {{ !$isReadytoPublish ? 'disabled' : '' }} class="btn btn-primary" type="submit">
                        {{ $chapter->is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                </form>

                <form action="{{ route('teacher.chapter.delete', $chapter->id) }}" method="POST">

                    @csrf
                    @method('delete')
                    <input type="hidden" name="slug" value="{{ $slug }}" />

                    <button class="btn btn-outline-danger" title="Delete chapter">
                        <x-lucide-trash class="w-4 h-4" />
                    </button>
                </form>
            </div>
        </div>

        @if (!$chapter->is_published)
            <div>
                <div class="flex-wrap gap-2 py-2 d-flex">
                    @foreach ($requiredFields as $field)
                        <div
                            class="p-1 bg-light fs-sm d-flex gap-1 align-items-center {{ $field['value'] ? 'text-success' : 'text-danger' }}">
                            @if ($field['value'])
                                <x-lucide-check-square class="w-3 h-3" />
                            @else
                                <x-lucide-x-square class="w-3 h-3" />
                            @endif
                            {{ $field['label'] }}
                        </div>
                    @endforeach
                </div>
                @if (in_array(false, array_column($requiredFields, 'value')))
                    <p class="text-muted fs-xs fst-italic"> To publish the chapter, you must complete all the required
                        fields.
                    </p>
                @else
                    <p class="text-muted fs-xs fst-italic"> All required fields are now filled. The chapter is ready to
                        publish!</p>
                @endif
            </div>
        @endif

        <div class="py-5 row row-cols-sm-1 row-cols-md-1 row-cols-lg-2 g-5">
            <div class="col">
                <div class="gap-4 py-2 d-flex align-items-center">
                    <div class="bg-blue-50 d-flex justify-content-center rounded-circle"
                        style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-layout-dashboard class="text-blue-400" />
                    </div>
                    <div class="fs-5">Customize this chapter</div>
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
                            <form action="{{ route('teacher.chapter.update', $chapter->id) }}" method="post">
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
                            <form action="{{ route('teacher.chapter.update', $chapter->id) }}" method="post">
                                @csrf
                                @method('put')

                                <x-trix-editor :input_name="'description'" :text="$chapter->description" />
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        @if ($chapter->description)
                            <div class="pt-1 text-sm text-neutral-100 fs-sm" x-show="!open">
                                {!! $chapter->description !!}
                            </div>
                        @else
                            <div class="pt-1 text-sm text-muted fs-xs fst-italic" x-show="!open">
                                No description provided.
                            </div>
                        @endif
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
                            <form action="{{ route('teacher.chapter.update', $chapter->id) }}" method="post">
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
                    <div class="fs-5">Upload Chapter Video</div>
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
                        <div x-data="{
                            chapterVideoFileName: chapterVideoFileName,
                            chapterVideoURL: chapterVideoURL,
                            chapterVideoFile: chapterVideoFile,
                            youtubeURL: youtubeURL,
                            isSubmitVideoButtonDisabled: isSubmitVideoButtonDisabled,
                            chapterVideoDuration: chapterVideoDuration,
                        }" class="dropzone-area" x-show="open">

                            <form enctype="multipart/form-data"
                                action="{{ route('teacher.chapter.update.video', $chapter->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div x-ref="dnd" class="dropzone-box" style="min-height: 200px;">
                                    <div class="py-4">
                                        <input accept="video/*" type="file" name="chapter_video" title=""
                                            x-ref="file" @change="onVideoChange" class="dropzone-input-file"
                                            @dragover="$refs.dnd.classList.add('bg-blue-50')"
                                            @dragleave="$refs.dnd.classList.remove('bg-blue-50')"
                                            @drop="$refs.dnd.classList.remove('bg-blue-50')" />
                                    </div>

                                    <div class="dropzone-content">
                                        <x-lucide-upload-cloud class="w-5 h-5" />
                                        <p>Drag your file here or click in this area.</p>
                                        <p x-text="chapterVideoFileName"></p>
                                    </div>
                                </div>
                                <div class="mt-4 flex-column d-flex">
                                    <label class="text-dark" for="chapter_video_url">Or paste your video from
                                        youtube</label>
                                    <input type="url" id="chapter_video_url" x-model="youtubeURL" x-ref="url"
                                        name="chapter_video_url" @input="handleVideoUrlChange"
                                        class="form-control" />
                                </div>
                                {{-- <input type="hidden" name="video_duration" x-bind:value="chapterVideoDuration" /> --}}
                                <button class="mt-4 w-full btn btn-primary" type="submit"
                                    :disabled="isSubmitVideoButtonDisabled">Save</button>
                            </form>
                        </div>
                        <div class="py-2 text-sm" x-show="!open">

                            @if ($chapter->video_url)
                                @if ($chapter->video_source === 'cloudinary')
                                    <video controls class="img-fluid rounded-3" style="max-height: 300px;">
                                        <source src="{{ asset('storage/' . $chapter->video_url) }}"
                                            type="video/mp4" />
                                    </video>
                                @elseif($chapter->video_source === 'youtube')
                                    <iframe class="rounded card-img-top" style="aspect-ratio: 16/9;"
                                        src="https://www.youtube.com/embed/{{ $chapter->video_url }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                @endif
                            @else
                                <div class="pt-1 text-sm text-muted fs-xs fst-italic" x-show="!open">
                                    Upload the chapter Video
                                </div>
                            @endif

                        </div>
                    </div>
                </div>


                <div class="gap-4 py-2 d-flex align-items-center">
                    <div class="bg-blue-50 d-flex justify-content-center rounded-circle"
                        style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-video class="text-blue-400" />
                    </div>
                    <div class="fs-5">Group this chapter </div>
                </div>

                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="chapter-title" class="form-label text-dark">Chapter Section</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s,"
                                x-on:click="open = ! open">
                                <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <div class="gap-4 d-flex flex-column">
                                <form action={{ route('section.create') }} method="POST">
                                    @csrf


                                    <label for="section-title">Add new section</label>
                                    <div class="py-2 input-group">
                                        <input type="text" class="form-control" id="section-title"
                                            name="section_title" aria-describedby="basic-addon3" />
                                        <input type="hidden" name="course_id" value={{ $courseId }} />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>

                                <form action="{{ route('teacher.chapter.update', $chapter->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <label for="sections">Or select from existing section</label>
                                    <div class="py-2 select-group">
                                        <select class="border form-select select-choice" aria-label="Select category"
                                            name="section_id" id="sections">
                                            <option value="">Select section</option>
                                            @if ($sections->count() > 0)
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}"
                                                        {{ $chapter->section_id !== null && $chapter->section_id === $section->id ? ' selected' : '' }}>
                                                        {{ $section->title }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <input type="hidden" name="chapter_id" value="{{ $chapter->id }}" />
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>

                        @if ($chapter->section_id)
                            <div class="pt-1 text-sm text-neutral-100 fs-sm" x-show="!open">
                                {{ $chapter->section_title }}
                            </div>
                        @else
                            <div class="pt-1 text-sm text-muted fs-xs fst-italic" x-show="!open">
                                No Section defined
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        function updateButtonStatus(e) {
            if (e.target.value) {
                console.log(this);
                this.isSubmitVideoButtonDisabled = false;
            }
        }

        function onVideoChange(e) {
            if (e.target.files && e.target.files.length) {
                this.chapterVideoFileName = e.target.files[0].name;
                this.chapterVideoFile = e.target.files[0];
                this.isSubmitVideoButtonDisabled = false;
            }
        }
    </script>
</x-teacher-layout>
