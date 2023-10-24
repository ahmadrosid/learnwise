<x-teacher-layout>
    <div class="p-5">
        <div>
            <h2>Course setup</h2>
            <p class="text-neutral-100">Complete all field 6/6</p>
        </div>

        <div class="row row-cols-sm-1 row-cols-md-1 row-cols-lg-2 py-5 g-5">
            <div class="col">
                <div class="d-flex gap-4 align-items-center py-2">
                    <div class="d-flex justify-content-center bg-blue-50 rounded-circle" style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-layout-dashboard class="text-blue-400" />
                    </div>
                    <div class="fs-5">Customize your course</div>
                </div>

                <div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 rounded-2 bg-neutral-30 border border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-title" class="form-label text-dark">Course title</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="text-neutral-400 w-3 h-3 cursor-pointer" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <form action="{{ route('teacher.course.update', $course->slug) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="input-group py-2">
                                    <input name="title" value="{{$course->title}}" type="text" class="form-control" id="course-title" aria-describedby="basic-addon3" />
                                </div>
                                <input type="hidden" name="slug" value="{{$course->slug}}" />
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                        <div class="text-sm pt-1" x-show="!open">
                            {{$course->title }}
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
                            <form action="{{ route('teacher.course.update', $course->slug) }}" method="POST">
                                @csrf
                                @method('put')
                                <x-trix-editor :input_name="'description'" :text="$course->description" />
                                <button class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        <div class="text-sm pt-1" x-show="!open">
                            {!! $course->description !!}
                        </div>
                    </div>
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
                        <div class="pt-2" x-show="open" style="min-height: 305px;">
                            <div x-data="imgPreview" x-cloak>
                                <form action="{{route('teacher.course.update.thumbnail', $course->slug)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input name="thumbnail" class="form-control" type="file" id="imgSelect" accept="image/*" x-ref="myFile" @change="previewFile">
                                    <p class="text-muted fs-xs p-2">16:9 aspect ratio recommended!</p>
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
                        <div class="text-sm py-2" x-show="!open">
                            <img src="{{asset('storage/'.$course->thumbnail)}}" class="img-fluid rounded-3" style="max-height: 300px;" />
                        </div>
                    </div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 rounded-2 bg-neutral-30 border border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-title" class="form-label text-dark">Course category</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="text-neutral-400 w-3 h-3 cursor-pointer" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <form action="{{ route('teacher.course.update', $course->slug) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="py-2">
                                    <select class="form-select border select-choice" aria-label="Select category" name="category_id">
                                        <option value="">Select category</option>

                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{ $course->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="slug" value="{{$course->slug}}" />
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        <div class="text-sm pt-1" x-show="!open">
                            {{$course->category->name}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex gap-4 align-items-center py-2">
                    <div class="d-flex justify-content-center bg-blue-50 rounded-circle" style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-list-checks class="text-blue-400" />
                    </div>
                    <div class="fs-5">Course chapters</div>
                </div>
                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 rounded-2 bg-neutral-30 border border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center pb-2 pt-1">
                            <label for="course-description" class="form-label text-dark">Course chapters</label>
                            <button class="btn btn-sm p-1 d-flex align-items-center gap-2" x-on:click="open = ! open">
                                <x-lucide-plus-circle class="text-neutral-400 w-3 h-3 cursor-pointer" x-show="!open" />
                                <span x-show="!open">Add new chapter</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <!-- Alphine drag and drop: https://codepen.io/lgaud/pen/abVEwgz -->
                        <div>
                            <div class="py-2" x-data="{ items: {{json_encode($chapters)}}, newItem:'', dragging: null, dropping: null}" @drop.prevent="items=dragDropList(items, dragging, dropping)" @dragover.prevent="$event.dataTransfer.dropEffect = &quot;move&quot;">
                                <div class="list-group border border-blue-100 rounded-2 overflow-hidden">
                                    <template x-for="(item, index) in items" :key="index">
                                        <div class="position-relative list-group-item border-bottom border-blue-100 p-0" draggable="true" :class="{'border-bottom-0': items.length-1 === index}" @dragstart="dragging = index" @dragend="dragging = null">
                                            <div>
                                                <button class="btn border-0 rounded-0 px-2 py-2 border-end border-blue-100 cursor-grab">
                                                    <x-lucide-grip-vertical class="text-neutral-400 w-5 h-5 cursor-pointer" />
                                                </button>
                                                <span x-text="item.title" class="px-2"></span>
                                                <div class="float-end d-flex px-2 pt-1">
                                                    <a x-bind:href="'/teacher/chapter/edit/' + item.id">
                                                        <button type="button" class="btn px-1">
                                                            <x-lucide-pencil class="w-3 h-3" style="margin-right: 8px;" />
                                                        </button>
                                                    </a>
                                                    <form x-bind:action="'/teacher/chapter/delete/' + item.id" method="POST">

                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn px-1" aria-label="Delete">
                                                            <x-lucide-trash class="text-neutral-400 w-3 h-3 cursor-pointer" />
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="position-absolute" style="top: 0; bottom: 0; right: 0; left: 0;" x-show.transition="dragging !== null" :class="{'bg-blue-100': dropping === index, 'cursor-grabbing': dragging === index}" @dragenter.prevent="if(index !== dragging) {dropping = index}" @dragleave="if(dropping === index) dropping = null"></div>
                                        </div>
                                    </template>
                                </div>
                                <div class="pb-2" x-show="open" x-trap="open">
                                    <form action="/teacher/chapter/create" method="POST">
                                        @csrf
                                        <div class="input-group py-2">
                                            <input value="" x-model="newItem" type="text" class="form-control" name="title" />
                                        </div>
                                        <input type="hidden" name="course_id" value="{{$course->id}}" />
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-4 align-items-center py-2">
                    <div class="d-flex justify-content-center bg-blue-50 rounded-circle" style="width: 35px; height: 35px; padding: 6px;">
                        <x-lucide-dollar-sign class="text-blue-400" />
                    </div>
                    <div class="fs-5">Sell your course</div>
                </div>

                <div class="py-4" x-data="{ open: false }">
                    <div class="p-2 px-3 rounded-2 bg-neutral-30 border border-neutral-40">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="course-title" class="form-label text-dark">Course price</label>
                            <button class="btn p-1 d-flex align-items-center gap-1 btn--s," x-on:click="open = ! open">
                                <x-lucide-pencil class="text-neutral-400 w-3 h-3 cursor-pointer" x-show="!open" />
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Cancel</span>
                            </button>
                        </div>
                        <div class="py-2" x-show="open">
                            <form action="{{ route('teacher.course.update', $course->slug) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="input-group py-2">
                                    <input value="{{$course->price}}" name="price" type="text" class="form-control" id="course-title" aria-describedby="basic-addon3" />
                                </div>
                                <input type="hidden" value="{{$course->slug}}" name="slug" />
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                        <div class="text-sm pt-1" x-show="!open">
                            $ {{$course->price}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>