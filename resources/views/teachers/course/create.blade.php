<x-teacher-layout>
    <div class="d-flex w-100 vh-100 align-items-center justify-content-center">
        <div class="p-6">
            <form>
                <h2>Name your course</h2>
                <p class="lead">
                    What would you like to name your course? Don't worry, you can change this later.
                </p>

                </p>

                <div class="d-flex flex-column gap-2">
                    <label>Course title</label>
                    <input placeholder="e.g: 'Advanced web development'" value="" type="text" class="form-control" id="course-title" aria-describedby="basic-addon3" />
                    <p class="text-muted fs-sm"> What will you teach in this course? </p>
                </div>
                <div>


                    <a href="/teacher" class="btn btn-default"> Cancel </a>

                    {{-- we'll use button instead of links to actually submit forms once it's integrated
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" disabled={{$isInvalid}} class="btn btn-primary">Submit</button>
                    --}}
                    <a href="/teacher/course/setup" class="btn btn-primary">Submit</a>

                </div>
            </form>
        </div>
    </div>
</x-teacher-layout>
