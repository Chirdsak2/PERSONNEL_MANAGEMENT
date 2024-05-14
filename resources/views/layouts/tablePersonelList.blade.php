<style>
    .table .thead-dark th {
        color: #fff;
        background-color: #212529;
        border-color: #32383e;
        text-align: center;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .pagination {
        display: inline-block;
    }

    .pagination li {
        display: inline;
        margin: 0 5px;
    }

    .pagination li a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }

    .pagination li.active a {
        background-color: #007bff;
        color: white;
    }

    .pagination li a:hover:not(.active) {
        background-color: #ddd;
    }
</style>



<div class="container col-10">
    <table class="table" border="1">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ลำดับ</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">นามสกุล</th>
                <th scope="col">เบอร์โทรศัพท์</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($users as $user)
                <tr>
                    <td align="center" scope="row">{{ $i++ }}</td align="center">
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->telephone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class=" pagination">
        {{ $users->links() }}
    </div>



</div>
