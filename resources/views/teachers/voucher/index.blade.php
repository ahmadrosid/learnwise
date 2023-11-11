<x-teacher-layout>
    <div class="p-5">
        <div class="pb-4 d-flex align-items-center">
            <div class="flex-fill">
                <div style="max-width: 260px;">
                    <input type="text" class="bg-white form-control" placeholder="Filter voucher..." />
                </div>
            </div>
            <div class="">
                <a href="{{ route('teacher.voucher.create') }}" class="gap-2 btn btn-primary d-flex align-items-center">
                    <x-lucide-plus-circle class="w-4 h-4" />
                    Add a voucher
                </a>
            </div>
        </div>
        <div class="overflow-hidden bg-white border border-bottom-0 rounded-3">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col">Discount</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($vouchers as $voucher)
                        <tr>
                            <td> {{ $voucher->code }} </td>
                            <td>{{ $voucher->expiry_date }} </td>
                            <td class="text-center">
                                @if ($voucher->discount_type === 'percentage')
                                    {{ $voucher->discount }}%
                                @else
                                    @currency($voucher->discount)
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">More</button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="p-2 px-3 dropdown-item" href="#">
                                                <x-lucide-pencil class="w-4 h-4" style="margin-right: 8px;" /> Edit
                                                course
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-teacher-layout>
