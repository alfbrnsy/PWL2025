<h1>Data User</h1>

<table border="1" cellpadding="2" cellspacing="0">
    <tr>
        <th> Jumlah Pengguna </th>
    </tr>
    <tr>
        <td>{{ $userCount }}</td>
    </tr>
</table>

<h2>Detail Pengguna</h2>
<table border="1" cellpadding="2" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Nama</th>
        <th>ID Level Pengguna</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->nama }}</td>
        <td>{{ $user->level_id }}</td>
    </tr>
    @endforeach
</table>
