<html>
<head>
    <meta charset="ISO-8859-1">
    <style>

        html, body {
            width: 50mm; /* was 907px */
            height: 12.5cm; /* was 529px */
            display: block;
            font-family: "Consolas";
            margin:0;
            /*font-size: auto; NOT A VALID PROPERTY */
        }
        table{
            width:100%;
            display:inline;
            font-size:13px;
        }
        .box-body{
            padding:5px;
            font-size:13px;
        }
        @media print {
            html, body {
            width: 50mm; /* was 907px */
            height: 12.5cm; /* was 529px */
            display: block;
            font-family: "Consolas";
            margin:0;
            /*font-size: auto; NOT A VALID PROPERTY */
        }
        table{
            width:100%;
            display:inline;
            font-size:13px;
        }
        .box-body{
            padding:5px;
            font-size:13px;
        }
        }
    </style>
</head>
<body>
    <div class="box-body">
        <table style="display:inline;">
            <thead>
                    <?php foreach ($judul_app as $k) { ?>
                    <tr>
                    <td style="text-align: left" colspan="4"><?php echo $k['judul_app']; ?></td>
                    </tr>
                    <tr>
                    <td style="text-align: left" colspan="4"><?php echo $k['alamat']; ?></td>
                    </tr>
                    <?php } ?>


                <tr>
                    <td>Pembeli</td>
                    <td></td>
                    <td> : </td>
                    <td style="text-align: left;"><?php echo $details[0]->customer_id;?></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td></td>
                    <td> : </td>
                    <td style="text-align: right;"><?php echo $details[0]->id;?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td></td>
                    <td> : </td>
                    <td><?php echo date("d-m-Y H:i:s",strtotime($details[0]->date));?></td>
                </tr>
                <tr>
                    <td style="width: 100%;">Pembayaran</td>
                    <td></td>
                    <td> : </td>
                    <td valign="top"><?php echo $details[0]->is_cash == 1 ? "Cash" : "Credit";?></td>
                </tr>
                <tr>
                    <td style="width: 100%;">Petugas</td>
                    <td></td>
                    <td> : </td>
                    <td valign="top"><?php print_r($prof[0]->name);?>/<?php if ($prof[0]->role == 0) { echo "Kasir";} elseif ($prof[0]->role == 1) { echo "Pemilik";}?></td>
                </tr>
            </thead>
        </table>
        <br />
        <?php $line = "===================================================";?>
        <?php echo $line;?>
        <table>
            <thead>
            <tr style="height:10px;font-size:14px;">
                <td style="width: 100%;">Barang</td>
                <!-- <td style="width:100px;">Kategori</td> -->
                <td style="width: 100%;">Jml</td>
                <td style="width: 100%;">Harga</td>
                <td style="width: 100%;text-align: right;">Total</td>
            </tr>
            <tr>
                <td colspan="4"><?php echo $line;?></td>
            </tr>
            </thead>
            <tbody style="height:150px;">
            <?php if(isset($details) && is_array($details)){ ?>
                <?php foreach($details as $key => $transaksi){?>
                    <tr valign="top" style="height:10px;font-size:14px;">
                        <td style="width: 100%;"><?php echo $transaksi->product_name;?></td>
                        <!-- <td style="width:100px; text-align: left;"><?php echo $transaksi->category_name;?></td> -->
                        <td style="width: 100%; text-align: left;"><?php echo $transaksi->quantity;?></td>
                        <td style="width: 100%; text-align: left;">Rp<?php echo number_format($transaksi->price_item);?></td>
                        <td style="width: 100%; text-align: right;">Rp<?php echo number_format($transaksi->subtotal);?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
        <?php echo $line;?>
        <table>
            <thead>
            
            <tr style="height:10px;font-size:14px;">
                <td style="width: 100%;">Total</td>
                <td style="width: 100%; color: transparent;">Brg</td>
                <td style="width: 100%; color: transparent;"></td>
                <!-- <td style="width:100px;">Kategori</td> -->
                <td style="width: 100%; color: transparent;">Jml</td>
                <td style="width: 100%;">: </td>
                <td style="width: 100%;text-align: right;">Rp<?php echo number_format($res[0]->total);?></td>
            </tr>
            <tr style="height:10px;font-size:14px;">
                <td style="width: 100%;">Bayar</td>
                <td style="width: 100%; color: transparent;">Brg</td>
                <td style="width: 100%; color: transparent;"></td>
                <!-- <td style="width:100px;">Kategori</td> -->
                <td style="width: 100%; color: transparent;">Jml</td>
                <td style="width: 100%;">: </td>
                <td style="width: 100%;text-align: right;">Rp<?php echo number_format($res[0]->dibayar);?></td>
            </tr>
            <tr style="height:10px;font-size:14px;">
                <td style="width: 100%;">Kembali</td>
                <td style="width: 100%; color: transparent;">Brg</td>
                <td style="width: 100%; color: transparent;"></td>
                <!-- <td style="width:100px;">Kategori</td> -->
                <td style="width: 100%; color: transparent;">Jml</td>
                <td style="width: 100%;">: </td>
                <td style="width: 100%;text-align: right;">Rp<?php echo number_format($res[0]->kembalian);?></td>
            </tr>
            
            <td colspan="8"><?php echo $line;?></td>
            </tr>
            </tr>
            <td colspan="8" style="text-align: center; font-size: 10px;">Terima kasih Telah Berbelanja di Toko Kami !</td>
            </tr>
            </thead>
        </table>
        <table style="display: none;">
            <thead>
            <tr>
                <td style="width:180px;text-align: center;">Pembeli</td>
                <td style="width:180px;text-align: center;">Pengantar</td>
                <td style="width:180px;text-align: center;">Hormat Kami</td>
                <!--<td style="width:350px;text-align: center;">**Terimakasih**</td>-->
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td style="width:150px;text-align: center;">&nbsp;</td>
                <td style="width:342px;text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="width:342px;text-align: center;">&nbsp; </td>
            </tr>
            <tr>
                <td style="width:100px;text-align: center;">(.............)</td>
                <td style="width:120px;text-align: center;">(.............)</td>
                <td style="width:150px;text-align: center;">(.............)</td>
                <!--<td style="width:342px;text-align: center;">dan elektronik</td>-->
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>