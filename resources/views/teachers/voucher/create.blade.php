<x-teacher-layout>
    <div class="d-flex w-100 align-items-center justify-content-center">
        <div class="p-6">
            <form method="POST" action="{{ route('teacher.voucher.store') }}">
                @csrf
                <h2>Add a new voucher code</h2>

                </p>

                <div class="gap-2 d-flex flex-column">
                    <label for="code">Voucher Code</label>
                    <input placeholder="e.g: 'MyCode2188'" value="{{ old('code') }}" type="text" class="form-control"
                        id="code" aria-describedby="code-helper" name="code" />
                    <p class="text-muted fs-sm" id="code-helper"> There is no restriction in giving voucher code,
                        as long as it hasn't been used before. </p>
                </div>

                <div class="gap-2 d-flex flex-column">
                    <label for="discount-type">Discount type</label>
                    <select id="discount-type" class="border form-select" aria-label="Select discount type"
                        name="discount_type" aria-describedby="discount-type-helper">
                        <option value="">Select discount type</option>
                        <option value="percentage">%</option>
                        <option value="fixed">$</option>
                    </select>
                    <p class="text-muted fs-sm" id="discount-type-helper"> Choose how you want the discount be
                        calculated!
                    </p>
                </div>


                <div class="gap-2 d-flex flex-column">
                    <label for="discount">Discount</label>
                    <input placeholder="e.g: '12'" value="{{ old('discount') }}" type="number" class="form-control"
                        id="discount" aria-describedby="discount-helper" name="discount" />
                    <p class="text-muted fs-sm" id="discount-helper"> Value you define here will look to discount type
                        above and calculate the discount accordingly. </p>
                </div>


                <div class="gap-2 d-flex flex-column">
                    <label for="expiry-date">Expiry Date</label>
                    <input value="{{ old('expiry_date') }}" type="date" class="form-control" id="expiry-date"
                        aria-describedby="expiry-date-helper" name="expiry_date" />
                    <p class="text-muted fs-sm" id="expiry-date-helper"> Your voucher is no longer valid when this date
                        is reached, while leaving this field blank will keep your voucher valid forever. </p>
                </div>

                <div class="my-2">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                    <a href="/teacher/voucher" class="btn btn-default"> Cancel </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                @error('code')
                    <span class="my-4 text-danger">This code is already used. Please choose another one!</span>
                @enderror

            </form>
        </div>
    </div>
</x-teacher-layout>
