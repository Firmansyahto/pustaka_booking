<!DOCTYPE html>
<html lang="en">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <table border=1>
            <?php
            foreach ($useraktif as $u) {
            ?>

                <tr>
                    <th scope="col"> Anggota : <?= $u->nama; ?></th>
                </tr>
                <tr>
                    <th scope="col">Buku Yang dibooking:</th>
                </tr>
            <?php } ?>
            <tr>
                <td>
                    <div class="table-responsive">
                        <table border=1>
                            <tr>
                                <th>No.</th>
                                <th>Buku</th>
                                <th>Penulis</th>
                                <th>penerbit</th>
                                <th>Tahun</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($items as $i) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td>
                                        <?= $i['judul_buku']; ?>
                                    </td>
                                    <td><?= $i['pengarang']; ?></td>
                                    <td><?= $i['penerbit']; ?></td>
                                    <td><?= $i['tahun_terbit']; ?></td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <?= md5(date('d M Y H:i:s')); ?>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>