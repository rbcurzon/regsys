<x-layout>
    <div class="container">
        <h2 class="my-4">View</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $transaction->id }}</td>
                </tr>
                <tr>
                    <td>user_id</td>
                    <td>{{ $transaction->user_id }}</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>{{ $transaction->name }}</td>
                </tr>
                <tr>
                    <td>section</td>
                    <td>{{ $transaction->section_id }}</td>
                </tr>
                <tr>
                    <td>course</td>
                    <td>{{ \App\Models\Course::find($transaction->course_id)->name }}</td>
                </tr>
                <tr>
                    <td>year_level</td>
                    <td>{{ $transaction->year_level }}</td>
                </tr>
                <tr>
                    <td>date_requested</td>
                    <td>{{ $transaction->date_requested }}</td>
                </tr>
                <tr>
                    <td>date_needed</td>
                    <td>{{ $transaction->date_needed }}</td>
                </tr>
                <tr>
                    <td>purpose</td>
                    <td>{{ $transaction->purpose }}</td>
                </tr>
                <tr>
                    <td>type</td>
                    <td>{{ $transaction->type }}</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>{{ $transaction->status }}</td>
                </tr>

            </tbody>
        </table>
    </div>

</x-layout>
