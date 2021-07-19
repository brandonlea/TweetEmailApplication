<center class="pt-64">
    <table class="table-auto border-l bg-white rounded">
        <thead class="bg-gray-100 shadow">
        <tr>
            <th class="w-5 p-5 border-r-2 border-gray-200">ID</th>
            <th class="w-5 p-5 border-r-2 border-gray-200">Status</th>
            <th class="w-5 p-5 border-r-2 border-gray-200">Created</th>
        </tr>
        </thead>
        <tbody>
        @foreach($emails as $email)
            <tr>
                <td class="w-5 px-5 border-r-2 border-b-2 border-gray-100">{{ $email->id}}</td>
                <td class="w-5  px-5 border-r-2 border-b-2  border-gray-200">{{ $email->status}}</td>
                <td class="w-5/12  px-5 border-r-2 border-b-2  border-gray-200">{{ $email->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</center>
