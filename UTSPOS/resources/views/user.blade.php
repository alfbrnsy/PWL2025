<!DOCTYPE html>
<html>
    <head>
        <title>Data User</title>
    </head>
    <body>
        <h1>Data User</h1>

        <!-- Link Tambah User -->
        <p><a href="/user/tambah">+ Tambah User</a></p>

        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Penggguna</th>
                <th>Kode Level</th>
                <th>Nama Level</th>
                <th></th>
                <td>Aksi</td>
            </tr>
            @foreach ($data as $d)
            <tr>
                <th>{{ $d->user_id}}</th>
                <th>{{ $d->username}}</th>
                <th>{{ $d->nama}}</th>
                <th>{{ $d->level_id}}</th>
                <th>{{ $d->level->level_kode }}</th>
                <th>{{ $d->level->level_nama }}</th>
                <td>
                    <a href="/user/ubah/{{ $d->user_id }}">Ubah</a> | <a href="/user/hapus/{{ $d->user_id }}"> Hapus </a></td> 
            </tr>
            @endforeach
        </table>
    </body>
</html>
