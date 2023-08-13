<html>

<head>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #000000;
      text-align: center;
      height: 20px;
      margin: 6px;
      font-size: 9px;
    }
  </style>
</head>

<body>
  <div style="font-size:35px; font-family: Verdana, Geneva, Tahoma, sans-serif; text-align: center; text-shadow: black; font-weight: bold;">
    Lakjasi</div>
  <hr>
  <div style="text-align: center;">
    <h1><i>Cetak Data Pelaporan Kerusakan Jalan</i></h1><br>
  </div>
  <table cellpadding="6">
    <tr style="background-color: #F6F9FF; color:black">
      <th><strong>No</strong></th>
      <th><strong>Nama</strong></th>
      <th><strong>Lokasi Jalan</strong></th>
      <th><strong>Tanggal Pelaporan</strong></th>
      <th><strong>Foto</strong></th>
      <th><strong>Tingkat Kerusakan</strong></th>
      <th><strong>Keterangan</strong></th>
    </tr>
    <?php $nomor = 1; ?>
    <?php foreach ($pelaporan as $key => $value) : ?>

      <tr>
        <td><?= $nomor++; ?></td>
        <td><?= $value['nama'] ?></td>
        <td><a href="https://www.google.com/maps/?q=<?= $value['lat'] ?> , <?= $value['long'] ?>" target="_blank"><?= $value['lat'] ?>
            , <?= $value['long'] ?></a></td>
        <td><?= date('d-M-Y h:i A', strtotime($value['tanggal_pelaporan'])); ?></td>
        <td><a href="<?= base_url(); ?>/assets/imagePelaporan/<?= $value['foto'] ?>" target="_blank">Lihat
            Foto</a></td>
        <td><?= $value['tingkat_rusak'] ?></td>
        <td><?= $value['keterangan'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>