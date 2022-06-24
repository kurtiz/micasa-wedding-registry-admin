<?= $this->extend("layouts/base"); ?>
    <!-- NOTE This keeps this page in the "content" placeholder in the layouts/base.php file  -->
<?= $this->section("content"); ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?= base_url(); ?>/public/favicon.ico" type="image/x-icon"/>
        <title>Print Receipt</title>
    </head>

     <body onload="print();" onafterprint="
    <?php
        if(session()->getTempdata("uri_referer") != null || session()->getTempdata("uri_referer") != ""){
            echo "window.location.assign('". session()->getTempdata("uri_referer") . "')";
        }else {
            echo "window.history.back()";
        }
    ?>
    ">

    <style>
        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        body {
            font-size: .65em;
        }

        h1 {
            font-size: 1.5em;
            color: #222222;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .6em;
            color: #666;
            line-height: 1.2em;
        }
        .contact p {
            font-size: 9px;
        }

        #top,
        #mid,
        #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #top {
            min-height: 100px;
        }

        #mid {
            min-height: 80px;
        }

        #bot {
            min-height: 50px;
        }

        #top .logo {
            /* //float: left; */
            height: 40px;
            width: 40px;
            /* background: url(assets/images/logo1.png) no-repeat; */
            background-size: 40px 40px;
        }

        .info {
            display: block;
            /* //float:left; */
            margin-left: 30px;
            text-align: center;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            /* //padding: 5px 0 5px 15px; */
            /* //border: 1px solid #EEE */
        }

        .tabletitle {
            /* padding: 5px; */
            font-size: 12px;
            background: #EEE;
        }

        .service {
            border-bottom: 1px solid #EEE;
        }

        .item {
            width: 24mm;
        }

        .itemtext {
            font-size: 11px;
        }

        #legalcopy {
            margin-top: 5mm;
        }
    </style>

    <div class="info" style="text-align: center;">
        <?php if ($store_data->logoDisplay == "on"):?>
            <?php if (!empty($store_data->logo)): ?>
                <img src="<?= $store_data->logo ?>" width="100px" alt="" srcset="">
            <?php else: ?>
                <img src="<?= base_url() ?>/public/src/img/brand.png" width="100px" alt="" srcset="">
            <?php endif; ?>
    <?php endif;?>
        <p>
        <?php if (strlen($store_data->store_name)< 30):?>
            <h1>
                <?= $store_data->store_name ?>
            </h1>
        <?php else:?>
        <h5>
            <?= $store_data->store_name ?>
        </h5>
        <?php endif;?>
        </p>
    </div>

    <div id="mid">
        <div style="text-align: center;" class="info">
        <?php if($receipt->salesCount == "on"):?>
            <h2 style="font-size:2em">
                    Order No: <?=$receipt->salesCount?>
            </h2>
        <?php endif;?>
            <h2 style="font-size:1em">
                <?php
                    if (session()->get("what")=="receipt"){
                        echo "Receipt No.:";
                    }else if (session()->get("what")=="invoice"){
                        echo "Invoice No.:";
                    }
                ?>
                <?php
                    if (isset($receipt->receipt_num)){
                        echo $receipt->receipt_num;
                    }else {
                        echo $receipt->invoice_num;
                    }
                ?>
            </h2>
            <?= $receipt->fulldate ?>
            <div class="contact">
            <p>
                <?= $store_data->address ?><br>
                <a><?= $store_data->mobile ?></a>, <a><?= $store_data->fax ?></a>.
            </p>
            </div>
        </div>
    </div>

    <div id="bot">

        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item">
                        <h2>Item</h2>
                    </td>
                    <td class="Hours">
                        <h2>Qty</h2>
                    </td>
                    <td class="Rate">
                        <h2>Price</h2>
                    </td>
                    <td class="Rate">
                        <h2>Amt</h2>
                    </td>
                </tr>
                <?php for ($i = 0; $i < count($receiptDetails); $i++) : ?>
                    <b>
                        <tr class="service">
                            <td class="tableitem">
                                <b><p class="itemtext"><?= $receiptDetails[$i]["product"]; ?></p></b>
                            </td>
                            <td class="tableitem">
                                <b><p class="itemtext amt"><?= $receiptDetails[$i]["quantity"]; ?></p></b>
                            </td>
                            <td class="tableitem">
                                <b><p class="itemtext amt"><?= $receiptDetails[$i]["price"]; ?></p></b>
                            </td>
                            <td class="tableitem">
                                <b><p class="itemtext amt"><?= $receiptDetails[$i]["price"] * $receiptDetails[$i]["quantity"] ?></p></b>
                            </td>
                        </tr>
                    </b>
                <?php endfor; ?>
                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2><b>Sales Rep:</b>
                    </td>
                    <td class="payment">
                        <h2><?=$receipt->user_name?></h2>
                    </td>
                </tr>
<!--                <tr class="tabletitle">-->
<!--                    <td></td>-->
<!--                    <td class="Rate">-->
<!--                        <h2><b>Served By:</b>-->
<!--                    </td>-->
<!--                    <td class="payment">-->
<!--                        <h2>--><?php ////echo $_COOKIE['waiters'];?><!--</h2></h2>-->
<!--                    </td>-->
<!--                </tr>-->
                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>Vat(<?=$receipt->vat?>%):</h2>
                    </td>
                    <td class="payment">
                        <h2>GHc. <?=$receipt->vat_amount?></h2>
                    </td>
                </tr>

                <?php if(!empty($receipt->discount_type)):?>
                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>Discount:</h2>
                    </td>
                    <td class="payment">
                        <h2>GHc. <?=$receipt->discount?></h2>
                    </td>
                </tr>
                <?php endif; ?>

                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>Subtotal:</h2>
                    </td>
                    <td class="payment">
                        <h2>GHc. <?=$receipt->subtotal?></h2>
                    </td>
                </tr>

                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>Total:</h2>
                    </td>
                    <td class="payment">
                        <h2>GHc. <?=$receipt->total_amount?></h2>
                    </td>
                </tr>

            </table>
        </div>
        <!--End Table-->

        <div id="legalcopy" class="contact">
            <p class="legal" style="text-align:center">
                ~ Powered By <strong>Our Technologies Consortium</strong> ~ <br>
            </p>
            <p style="text-align:center">
                024 349 5149 | 055 327 6163
                <br>ourproductandservices1@gmail.com
            </p>

        </div>

    </div>

    <script>
        d = document.getElementsByClassName('amt');
        for (i = 0; i > d.length; i++) {
            d[i].innerText = parseFloat(d[i].innerText).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        for (i = 0; i < d.length; i++) {
            d[i].innerText = parseFloat(d[i].innerText).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

    </script>
    </body>
    </html>
<?= $this->endSection(); ?>