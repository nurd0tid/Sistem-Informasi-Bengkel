<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-size: 16px;
        }

        h1 {
            text-align: center;
            text-decoration: underline;
            font-size: 26px;
        }

        .table {
            margin-top: 32px;
            border-collapse: collapse;
        }

        .table th,
        td {
            border: 1px solid #000;
            padding: 7px 9px;
        }

        td:empty {
            background: #ffdf7e;
        }
    </style>
</head>

<body>
    <h1><?= strtoupper("laporan tutup buku "); ?></h1>
    <div style="text-align:center"><?= $subtitle; ?></div>

    <table width="100%" class="table">
        <thead>
            <tr>
                <?php {
                    ?>
                    <th>#</th>
                    <th>Service/Penjualan</th>
                    <th>Motor</th>
                    <th>Jenis Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                <?php } ?>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $grand_total = 0;
            foreach ($fetch as $row) {
                $i++;
                $grand_total = $grand_total + $row->qty * $row->price; {
                    ?>
                    <tr>
                        <td style="text-align:center"><?= $i; ?></td>
                        <td style="text-align:center"><?= $row->name; ?></td>
                        <td style="text-align:center"><?= $row->motor; ?></td>
                        <td style="text-align:center"><?= $row->jenisbarang; ?></td>
                        <td style="text-align:center"><?= $row->qty; ?></td>
                        <td style="text-align:center"><?= $row->price; ?></td>
                        <td style="text-align:center"><?= rupiah($row->qty * $row->price); ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
        <tfoot>
            <tr>
                <td style="text-align:right" colspan="6">Total Keseluruhan : </td>
                <td style="text-align:center"><?= rupiah($grand_total); ?></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>