<h3 align="center">Daftar aktivitas</h3>
<table border="1" align="center" cellpadding="10" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Nama Aktivitas</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($ar_aktivitas as $data)
            <tr>
                <th>{{ $no }}</th>
                <td>{{ $data->pengguna }}</td>
                <td>{{ $data->nama_aktivitas }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>{{ $data->keterangan }}</td>
            </tr>
            @php $no++ @endphp
        @endforeach
    </tbody>
</table>
