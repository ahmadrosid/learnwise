<x-teacher-layout>
    <div class="alert alert-warning" role="alert">
        <div class="d-flex gap-4">
            <span><i class="fa-solid fa-circle-exclamation text-warning"></i></span>
            <div class="d-flex flex-column gap-2">
                <p class="mb-0">This chapter is unpublished. It will not be visible in the course.</p>
            </div>
        </div>
    </div>
    <div class="px-4 py-2">
        <a class="btn" href="/teacher/course/setup">
            <x-lucide-move-left class="h-5" />
            <span class="font-bold px-2">Back to course setup</span>
        </a>
    </div>
    <div class="px-5 py-4">
        <h2>Chapter Creation</h2>
        <div>Complete all fields (1/3)</div>

        <div class="row row-cols-sm-1 row-cols-md-1 row-cols-lg-2 py-5 g-5">
            <div class="col">
                <div class="d-flex gap-4 align-items-center py-2">
                    <div class="d-flex justify-content-center bg-blue-50 rounded-circle" style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-layout-dashboard class="text-blue-400" />
                    </div>
                    <div class="fs-5">Customize your chapter</div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 rounded-2 bg-neutral-30 border border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="chapter-title" class="form-label text-dark">Chapter title</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="text-neutral-400 w-3 h-3 cursor-pointer" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <div class="input-group py-2">
                                <input value="Fullstack Saas Laravel" type="text" class="form-control" id="chapter-title" aria-describedby="basic-addon3" />
                            </div>
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <div class="text-sm pt-1" x-show="!open">
                            Fullstack Saas Laravel
                        </div>
                    </div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 rounded-2 bg-neutral-30 border border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-description" class="form-label text-dark">Course description</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="text-neutral-400 w-3 h-3 cursor-pointer" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <x-trix-editor />
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <div class="text-sm pt-1 text-neutral-100 fs-sm" x-show="!open">
                            No description yet.
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-4 align-items-center py-4">
                    <div class="d-flex justify-content-center bg-blue-50 rounded-circle" style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-eye class="text-blue-400" />
                    </div>
                    <div class="fs-5">Chapter access</div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 rounded-2 bg-neutral-30 border border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="chapter-title" class="form-label text-dark">Chapter access</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="text-neutral-400 w-3 h-3 cursor-pointer" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <div class="rounded-2 border border-2 px-2 py-2 my-2 bg-white">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label fs-sm" for="flexCheckDefault">
                                        Check this box if you want to make this chapter free for preview
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <div class="text-sm pt-1 text-neutral-100 fs-sm" x-show="!open">
                            This chapter are not free.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex gap-4 align-items-center py-2">
                    <div class="d-flex justify-content-center bg-blue-50 rounded-circle" style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-video class="text-blue-400" />
                    </div>
                    <div class="fs-5">Customize your course</div>
                </div>

                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 rounded-2 bg-neutral-30 border border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-description" class="form-label text-dark">Course image</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="text-neutral-400 w-3 h-3 cursor-pointer" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div x-data="{ fileName: '' }" class="dropzone-area" x-show="open">
                            <div x-ref="dnd" class="dropzone-box" style="min-height: 200px;">
                                <input accept="*" type="file" name="file" title="" x-ref="file" @change="fileName = $refs.file.files[0].name" class="dropzone-input-file" @dragover="$refs.dnd.classList.add('bg-blue-50')" @dragleave="$refs.dnd.classList.remove('bg-blue-50')" @drop="$refs.dnd.classList.remove('bg-blue-50')" />
                                <div class="dropzone-content">
                                    <x-lucide-upload-cloud class="w-5 h-5" />
                                    <p>Drag your file here or click in this area.</p>
                                    <p x-text="fileName"></p>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4 w-full">Save</button>
                        </div>
                        <div class="text-sm py-2" x-show="!open">
                            <img src="/images/example-course.png" class="img-fluid rounded-3" style="max-height: 300px;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>