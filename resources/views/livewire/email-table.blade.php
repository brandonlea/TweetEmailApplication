<center class="py-64">
    <table class="table-auto border-l bg-white rounded">
        <thead class="bg-gray-100 shadow">
        <tr>
            <th class="w-5 p-5 border-r-2 border-gray-200">ID</th>
            <th class="w-5 p-5 border-r-2 border-gray-200">Recipient</th>
            <th class="w-5 p-5 border-r-2 border-gray-200">Message</th>
            <th class="w-5 p-5 border-r-2 border-gray-200">From</th>
            <th class="w-5 p-5 border-r-2 border-gray-200">Timestamp</th>
            <th class="w-5 p-5 border-r-2 border-gray-200">Status</th>
            <th class="w-5 px-10 border-r-2 border-gray-200">Created</th>
            <th class="w-5 p-5">Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach($emails as $email)
            <tr>
                <td class="w-5 px-5 border-r-2 border-b-2 border-gray-100">{{ $email->id}}</td>
                <td class="w-5  px-5 border-r-2 border-b-2  border-gray-200">{{ $email->recipient}}</td>
                <td class="w-5  border-r-2 border-b-2  border-gray-200 ">{{ $email->message}}</td>
                <td class="w-5  px-5 border-r-2 border-b-2  border-gray-200 ">{{ $email->from}}</td>
                <td class="w-40 text-center border-r-2 border-b-2  border-gray-200 ">{{  gmdate("Y-m-d\:i:s", $email->timestamp)}}</td>
                <td class="w-5   px-5 border-r-2 border-b-2  border-gray-200 ">{{ $email->status}}</td>
                <td class="w-40 text-center  border-r-2 border-b-2  border-gray-200 ">{{ $email->created_at}}</td>
                <td class="w-40 text-center  border-b-2  border-gray-200 ">{{ $email->updated_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</center>
