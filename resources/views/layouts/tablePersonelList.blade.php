<style>
    .form-personnel {
        /*
        max-width: 400px;
        margin-top: 100px;
        */
        margin: 0 auto;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px #ccc;
    }

    .table .thead-dark th {
        color: #fff;
        background-color: #212529;
        border-color: #32383e;
        text-align: center;
    }
    .table thead th:first-child {
        border-top-left-radius: 7px;
    }
    .table thead th:last-child {
        border-top-right-radius: 7px;
    }

    /* Pagination Style for Dark Theme */
    .pagination {
        /*  color: #fff;  Text color */
    }

    .page-link {
        /*  background-color: #343a40; Background color of the page link */
        /* border-color: #343a40;  Border color of the page link */
        color: #343a40;
    }

    .page-link:hover {
        background-color: #343a40;
        /* Background color of the page link on hover */
        border-color: #23272b;
        /* Border color of the page link on hover */
        color: #fff;
    }

    .page-item.active .page-link {
        background-color: #343a40;
        /* Background color of the active page link */
        border-color: #343a40;
        /* Border color of the active page link */
    }
</style>

<br>

<div class="d-flex justify-content-end col-11 mb-1">
    <a href="{{ route('personnel.create') }}" class="btn btn-info">เพิ่มข้อมูล</a>
</div>
<div class="container form-personnel col-10">

    <table class="table" border="0">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ลำดับ</th>
                <th scope="col">ชื่อ-สกุล</th>
                {{-- <th scope="col">นามสกุล</th> --}}
                <th scope="col">เบอร์โทรศัพท์</th>
                <th scope="col" width="20%" ></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $item)
                <tr>
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    <td>{{ $item->getPrefixName($item->prefix_id) }}{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td>{{ $item->telephone }}</td>
                    <td >
                        <div style="display: flex; gap: 5px;">
                        <a class="btn btn-warning btn-sm" href="{{ route('personnel.edit', ['id' => $item->id]) }}"
                            role="button" title=""><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path
                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                            </svg> แก้ไข</a>
                        <form action="{{ route('personnel.destroy', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this user?')"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>ลบ</button>
                        </form>
                        {{-- <a class="btn btn-danger btn-sm" href="{{ route('personnel.destroy', ['id' => $item->id]) }}"
                            role="button" title="" onclick="return confirm('คุณต้องการลบรายการนี้หรือไม่?')"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg> ลบ</a> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- แสดง pagination links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>



</div>
