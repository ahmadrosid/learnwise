@php
    $requiredFields = [
        [
            'label' => 'Title',
            'value' => $course->title,
        ],
        [
            'label' => 'Description',
            'value' => $course->description,
        ],
        [
            'label' => 'Thumbnail',
            'value' => $course->thumbnail,
        ],
        [
            'label' => 'Category',
            'value' => $course->category_id,
        ],
        [
            'label' => 'Price',
            'value' => $course->price,
        ],
        [
            'label' => 'At least one chapter published',
            'value' => false,
        ],
    ];
    foreach ($course->chapters as $chapter) {
        if (isset($chapter['is_published']) && ($chapter['is_published'] === true || $chapter['is_published'] === 1)) {
            $requiredFields[5]['value'] = true;
            break;
        }
    }
    $completedFields = array_reduce(
        $requiredFields,
        function ($carry, $field) {
            return $carry + (!empty($field['value']) ? 1 : 0);
        },
        0,
    );

    $isReadyToPublish = $completedFields === count($requiredFields);

@endphp

<x-teacher-layout>

    @if (!$course->is_published)
        <div class="alert alert-warning" role="alert">
            <div class="gap-4 d-flex">
                <span><i class="fa-solid fa-circle-exclamation text-warning"></i></span>
                <div class="gap-2 d-flex flex-column">
                    <p class="mb-0">This course is unpublished. It will not be visible in the course.</p>
                </div>
            </div>
        </div>
    @endif

    <div class="p-5">

        <div class="d-flex justify-content-between">
            <div>
                <h2>Course setup</h2>
            </div>

            <div class="gap-1 d-flex">
                <form action="{{ route('teacher.course.publish', $course->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" value="{{ $course->id }}" name="id" />
                    <button class="btn btn-primary" type="submit"
                        {{ !$isReadyToPublish || $hasBeenSold ? 'disabled' : '' }}>
                        {{ $course->is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                </form>
                <form action="{{ route('teacher.course.delete', $course->slug) }}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="id" value="{{ $course->id }}" />

                    <button {{ $hasBeenSold ? 'disabled' : '' }} type="submit" class="btn btn-outline-danger"
                        title="Delete course">
                        <x-lucide-trash class="w-4 h-4" />
                    </button>
                </form>
            </div>
        </div>


        @if (!$course->is_published)
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
                    <p class="text-muted fs-xs fst-italic"> To publish the course, you must complete all the required
                        fields.
                    </p>
                @else
                    <p class="text-muted fs-xs fst-italic"> All required fields are now filled. Your course is ready to
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
                    <div class="fs-5">Customize your course</div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-title" class="form-label text-dark">Course title</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <form action="{{ route('teacher.course.update', $course->slug) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="py-2 input-group">
                                    <input name="title" value="{{ $course->title }}" type="text"
                                        class="form-control" id="course-title" aria-describedby="basic-addon3" />
                                </div>
                                <input type="hidden" name="slug" value="{{ $course->slug }}" />
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                        <div class="pt-1 text-sm" x-show="!open">
                            {{ $course->title }}
                        </div>
                    </div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-description" class="form-label text-dark">Course description</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <form action="{{ route('teacher.course.update', $course->slug) }}" method="POST">
                                @csrf
                                @method('put')
                                <x-trix-editor :input_name="'description'" :text="$course->description" />
                                <button class="btn btn-primary">Save</button>
                            </form>
                        </div>

                        @if ($course->description)
                            <div class="pt-1 fs-sm" x-show="!open">

                                {!! $course->description !!}
                            </div>
                        @else
                            <div class="pt-1 text-muted fs-xs fst-italic" x-show="!open">
                                Tell your candidate students about this course.
                            </div>
                        @endif
                    </div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-description" class="form-label text-dark">Course image</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="pt-2" x-show="open" style="min-height: 305px;">
                            <div x-data="imgPreview" x-cloak>
                                <form action="{{ route('teacher.course.update.thumbnail', $course->slug) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input name="thumbnail" class="form-control" type="file" id="imgSelect"
                                        accept="image/*" x-ref="myFile" @change="previewFile">
                                    <p class="p-2 text-muted fs-xs">16:9 aspect ratio recommended!</p>
                                    <template x-if="imgsrc">
                                        <div class="py-2">
                                            <img :src="imgsrc" class="imgPreview img-fluid rounded-3">
                                            <div class="py-2">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </template>
                                </form>
                            </div>
                        </div>
                        <div class="py-2 text-sm" x-show="!open">
                            @if (!$course->thumbnail)
                                <img src="{{ asset('thumbnail-placehoder-image.jpg') }}" class="img-fluid rounded-3"
                                    style="max-height: 350px;" />
                            @else
                                <img src="@thumbnail($course)" class="img-fluid rounded-3"
                                    style="max-height: 350px;" />
                            @endif
                        </div>
                    </div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-title" class="form-label text-dark">Course category</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s,"
                                x-on:click="open = ! open">
                                <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <form action="{{ route('teacher.course.update', $course->slug) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="py-2">
                                    <select class="border form-select select-choice" aria-label="Select category"
                                        name="category_id">
                                        <option value="">Select category</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="slug" value="{{ $course->slug }}" />
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>

                        @if ($course->category_id)
                            <div class="pt-1 fs-sm" x-show="!open">
                                {{ $course->category_id ? $course->category->name : 'No category defined.' }}
                            </div>
                        @else
                            <div class="pt-1 text-muted fs-xs fst-italic" x-show="!open">
                                No category defined
                                <div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="gap-4 py-2 d-flex align-items-center">
                    <div class="bg-blue-50 d-flex justify-content-center rounded-circle"
                        style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-list-checks class="text-blue-400" />
                    </div>
                    <div class="fs-5">Course chapters</div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                        <div class="pt-1 pb-2 d-flex justify-content-between align-items-center">
                            <label for="course-description" class="form-label text-dark">Course chapters</label>
                            <button class="gap-2 p-1 btn btn-sm d-flex align-items-center" x-on:click="open = ! open">
                                <x-lucide-plus-circle class="w-3 h-3 cursor-pointer text-neutral-400"
                                    x-show="!open" />
                                <span x-show="!open">Add new chapter</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <!-- Alphine drag and drop: https://codepen.io/lgaud/pen/abVEwgz -->
                        <div>
                            <div class="py-2" x-data="{ items: {{ json_encode($chapters) }}, newItem: '', dragging: null, dropping: null }"
                                @drop.prevent="items=dragDropList(items, dragging, dropping)"
                                @dragover.prevent="$event.dataTransfer.dropEffect = &quot;move&quot;">

                                <template x-if="items.length === 0">
                                    <div class="fst-italic fs-xs text-muted">This course has no chapter yet. <div>
                                </template>
                                <div class="py-2" x-data="{ items: {{ json_encode($chapters) }}, newItem: '', dragging: null, dropping: null }"
                                    @drop.prevent="items=dragDropList(items, dragging, dropping)"
                                    @dragover.prevent="$event.dataTransfer.dropEffect = &quot;move&quot;">
                                    <div class="overflow-hidden border border-blue-100 list-group rounded-2">
                                        <template x-for="(item, index) in items" :key="index">
                                            <div class="p-0 border-blue-100 position-relative list-group-item border-bottom"
                                                draggable="true"
                                                :class="{ 'border-bottom-0': items.length - 1 === index }"
                                                @dragstart="dragging = index" @dragend="dragging = null">
                                                <div>
                                                    <button
                                                        class="py-2 px-2 border-0 border-blue-100 btn rounded-0 border-end cursor-grab">
                                                        <x-lucide-grip-vertical
                                                            class="w-5 h-5 cursor-pointer text-neutral-400" />
                                                    </button>
                                                    <span x-text="item.title" class="px-2"></span>
                                                    <div class="px-2 pt-1 float-end d-flex align-items-center">
                                                        <template x-if="item.is_published">
                                                            <span class="px-1 text-white rounded bg-success"
                                                                style="font-size:small;">Published</span>
                                                        </template>

                                                        <template x-if="!item.is_published">
                                                            <span class="px-1 text-white rounded bg-dark"
                                                                style="font-size:small;">Draft</span>
                                                        </template>

                                                        <a x-bind:href="'/teacher/chapter/edit/' + item.id">
                                                            <button type="button" class="px-1 btn">
                                                                <x-lucide-pencil class="w-3 h-3"
                                                                    style="margin-right: 8px;" />
                                                            </button>
                                                        </a>
                                                        <form x-bind:action="'/teacher/chapter/delete/' + item.id"
                                                            method="POST">

                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="slug"
                                                                value="{{ $course->slug }}" />
                                                            <button type="submit" class="px-1 btn"
                                                                aria-label="Delete">
                                                                <x-lucide-trash
                                                                    class="w-3 h-3 cursor-pointer text-neutral-400" />
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="position-absolute"
                                                    style="top: 0; bottom: 0; right: 0; left: 0;"
                                                    x-show.transition="dragging !== null"
                                                    :class="{
                                                        'bg-blue-100': dropping === index,
                                                        'cursor-grabbing': dragging ===
                                                            index
                                                    }"
                                                    @dragenter.prevent="if(index !== dragging) {dropping = index}"
                                                    @dragleave="if(dropping === index) dropping = null"></div>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="pb-2" x-show="open" x-trap="open">
                                        <form action="{{ route('teacher.chapter.store') }}" method="POST">
                                            @csrf
                                            <div class="py-2 input-group">
                                                <input value="" x-model="newItem" type="text"
                                                    class="form-control" name="title" />
                                            </div>
                                            <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gap-4 py-2 d-flex align-items-center">
                        <div class="bg-blue-50 d-flex justify-content-center rounded-circle"
                            style="width: 35px; height: 35px; padding: 6px;">
                            <x-lucide-dollar-sign class="text-blue-400" />
                        </div>
                        <div class="fs-5">Sell your course</div>
                    </div>

                    <div class="py-4" x-data="{ open: false }">
                        <div class="p-2 px-3 border rounded-2 bg-neutral-30 border-neutral-40">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="course-title" class="form-label text-dark">Course price</label>
                                <button class="btn p-1 d-flex align-items-center gap-1 btn--s,"
                                    x-on:click="open = ! open">
                                    <x-lucide-pencil class="w-3 h-3 cursor-pointer text-neutral-400" x-show="!open" />
                                    <span x-show="!open">Edit</span>
                                    <span x-show="open">Cancel</span>
                                </button>
                            </div>
                            <div class="py-2" x-show="open">
                                <form action="{{ route('teacher.course.update', $course->slug) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="py-2 input-group">
                                        <input value="{{ $course->price }}" name="price" type="text"
                                            class="form-control" id="course-title" aria-describedby="basic-addon3" />
                                    </div>
                                    <input type="hidden" value="{{ $course->slug }}" name="slug" />
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </form>
                            </div>

                            @if ($course->price)
                                <div class="pt-1 fs-sm" x-show="!open">
                                    $ {{ $course->price }}
                                </div>
                            @else
                                <div class="pt-1 text-muted fs-xs fst-italic" x-show="!open">
                                    You have not defined the price for this course.
                                    <div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-teacher-layout>
