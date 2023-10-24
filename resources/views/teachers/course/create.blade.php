<x-teacher-layout>
    <div class="d-flex w-100 align-items-center justify-content-center">
        <div class="p-6">
            <form method="POST" action="{{ route('teacher.course.store') }}">
                @csrf
                <h2>Name your course</h2>
                <p class="lead">
                    What would you like to name your course? Don't worry, you can change this later.
                </p>

                </p>

                <div class="gap-2 d-flex flex-column">
                    <label>Course title</label>
                    <input placeholder="e.g: 'Advanced web development'" value="{{ old('title') }}" type="text"
                        class="form-control" id="course-title" aria-describedby="course-name-helper" name="title" />
                    <p class="text-muted fs-sm" id="course-name-helper"> What will you teach in this course? </p>
                </div>
                <div class="my-2">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                    <a href="/teacher" class="btn btn-default"> Cancel </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                @error('slug')
                    <span class="my-4 text-danger">This title is already taken. Please choose another one!</span>
                @enderror

            </form>
        </div>
    </div>
</x-teacher-layout>
