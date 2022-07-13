<html>
<head>
    <meta charset="ISO-8859-1">
    <style>

        html, body {
            width: 23cm; /* was 907px */
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
            padding:10px;
            font-size:13px;
        }
        @media print {
            html, body {
                width: 23cm; /* was 8.5in */
                height: 12.5cm; /* was 529px */
                /* height: 13.5cm; was 5.5in */
                display: block;
                font-family: "Consolas";
                padding:0 10px;
                margin:0;
                /*font-size: auto; NOT A VALID PROPERTY */
            }
            table{
                width:100%;
                display:inline;
                font-size:13px;
            }
            .box-body{
                padding:10px;
                font-size:13px;
            }

            @page {
                size: 24cm 14cm /* . Random dot? */;
            }
        }
    </style>
</head>
<body>
    <div class="box-body">
        <table style="display:inline;">
            <thead>
                <tr>
                    <td style="width:350px;"><?php echo $toko[0]['judul_app'];?></td>
                    <td style="width:200px;">Kode Transaksi</td>
                    <td style="width:200px;">: <?php echo $details[0]->id;?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width:350px;"><?php echo $toko[0]['alamat'];?></td>
                    <td>Tgl Transaksi</td>
                    <td>: <?php echo date("d-m-Y H:i:s",strtotime($details[0]->tgl));?></td>
                </tr>
                <tr>
                    <td style="width:350px;">Supplier: <?php echo $details[0]->supplier_name;?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br />
        <?php $line = "==================================================================================================================";?>
        <?php echo $line;?>
        <table>
            <thead>
            <tr>
                <td style="width:160px;">Name</td>
                <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?>
                <td colspan="3" style="width: 450px;text-align: right;">Quantity</td>
                <?php }else {?>
                <td style="width:100px;">Category</td>
                <td style="width:100px;">Quantity</td>
                <td style="width:200px;">Price/item</td>
                <td style="width:100px;text-align: right;">Subtotal</td>
                <?php } ?>
            </tr>
            </thead>
        </table>
        <?php echo $line;?>
        <table>
            <thead  style="height:270px;">

            <?php if(isset($details) && is_array($details)){ ?>
                <?php foreach($details as $key => $transaksi){?>                    
                    <tr valign="top" style="height:10px;font-size:14px;">
                        <td style="width:160px;"><?php echo $transaksi->product_name;?></td>
                        <?php if ($transaksi->total_price == 0 || $transaksi->total_price == NULL) { ?>
                        <td  colspan="3" style="width:100px; text-align: right;"><?php echo $transaksi->quantity;?></td>
                        <?php }else{ ?>
                        <td style="width:100px; text-align: left;"><?php echo $transaksi->category_name;?></td>
                        <td style="width:100px; text-align: left;"><?php echo $transaksi->quantity;?></td>
                        <td style="width:200px; text-align: left;">Rp<?php echo number_format($transaksi->price_item);?></td>
                        <td style="width:100px; text-align: right;">Rp<?php echo number_format($transaksi->subtotal);?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <?php $total = 10 - ($key + 1);
                for($a =1; $a <= $total; $a++){ ?>
                    <tr style="height:10px;font-size:14px;">
                        <td style="width:160px;">&nbsp;</td>
                        <td style="width:100px;"></td>
                        <td style="width:100px;"></td>
                        <td style="width:200px;"></td>
                        <td style="width:100px;"></td>
                    </tr>
                <?php } ?>
            <?php } ?>

            </thead>
        </table>
        <?php echo $line;?>
        <?php if ($details[0]->total_price == 0 || $details[0]->total_price == NULL) { ?>
        <?php }else {?>
        <table>
            <thead>
            <tr>
                <td style="width:160px;"></td>
                <td style="width:100px;"></td>
                <td style="width:100px;"></td>
                <td style="width:200px;">Total</td>
                <td style="width:100px;text-align: right;">Rp<?php echo number_format($transaksi->total_price);?></td>
            </tr>
            </thead>
        </table>
        <?php echo $line;?>
        <?php } ?>
        <br />
        <table style="display: none;">
            <thead>
            <tr>
                <!-- <td style="width:180px;text-align: center;">Pembeli</td> -->
                <td style="width:180px;text-align: center;">Petugas</td>
                <!-- <td style="width:180px;text-align: center;">Hormat Kami</td> -->
                <!--<td style="width:350px;text-align: center;">**Terimakasih**</td>-->
            </tr>
            </thead>
            <tbody>
            <tr>
                <!-- <td></td> -->
                <td></td>
                <td style="width:150px;text-align: center;">&nbsp;</td>
                <!-- <td style="width:342px;text-align: center;">&nbsp;</td> -->
            </tr>
            <tr>
                <!-- <td></td> -->
                <td></td>
                <td></td>
                <td style="width:342px;text-align: center;">&nbsp; </td>
            </tr>
            <tr>
                <!-- <td style="width:100px;text-align: center;">(.............)</td> -->
                <td style="width:120px;text-align: center;">(.............)</td>
                <!-- <td style="width:150px;text-align: center;">(.............)</td> -->
                <!--<td style="width:342px;text-align: center;">dan elektronik</td>-->
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>