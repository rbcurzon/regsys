@php use App\Models\Course; @endphp
<x-layout>
    <div class="d-flex flex-column vh-100">
        <div class="flex-grow-1 overflow-auto">
            <table class="table table-bordered w-100">
                <thead>
                <tr>
                    <th class="position-sticky top-0 px-3 py-2 text-primary bg-info">transaction_id</th>
                    <th class="position-sticky top-0 px-3 py-2 text-primary bg-info">user_id</th>
                    <th class="position-sticky top-0 px-3 py-2 text-primary bg-info">date_requested</th>
                    <th class="position-sticky top-0 px-3 py-2 text-primary bg-info">type</th>
                    <th class="position-sticky top-0 px-3 py-2 text-primary bg-info">status</th>
                    <th class="position-sticky top-0 px-3 py-2 text-primary bg-info">action</th>
                </tr>
                </thead>
                @foreach ($transactions as $transaction)
                    @can("edit-transaction", $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ Course::find($transaction->course_id)->name }}</td>
                            <td>{{ $transaction->date_requested }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td class="d-flex flex-row">
                                <form method="POST" action="/transactions/{{ $transaction->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary"><i
                                            class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                                <a href="/transactions/{{ $transaction->id }}/edit" class="btn btn-primary"><i
                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="/transactions/{{ $transaction->id }}/show" class="btn btn-primary"><i
                                        class="fa fa-eye"
                                        aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endcan
                @endforeach
            </table>
        </div>
    </div>
</x-layout>
