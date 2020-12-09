<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    $(document).ready(function () {
        oTable = $('#QUData').dataTable({
            "aaSorting": [[1, "desc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('quotes/getQuotes' . ($warehouse_id ? '/' . $warehouse_id : '')) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "quote_link";
                return nRow;
            },
            "aoColumns": [{"bSortable": false,"mRender": checkbox}, {"mRender": fld}, null, null, null, null, {"mRender": currencyFormat}, {"mRender": row_status}, {"bSortable": false,"mRender": attachment}, {"bSortable": false}]
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('biller');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('customer');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('supplier');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('total');?>]", filter_type: "text", data: []},
            {column_number: 7, filter_default_label: "[<?=lang('status');?>]", filter_type: "text", data: []},
        ], "footer");
        <?php if ($this->session->userdata('remove_quls')) {
        ?>
        if (localStorage.getItem('quitems')) {
            localStorage.removeItem('quitems');
        }
        if (localStorage.getItem('qudiscount')) {
            localStorage.removeItem('qudiscount');
        }
        if (localStorage.getItem('qutax2')) {
            localStorage.removeItem('qutax2');
        }
        if (localStorage.getItem('qushipping')) {
            localStorage.removeItem('qushipping');
        }
        if (localStorage.getItem('quref')) {
            localStorage.removeItem('quref');
        }
        if (localStorage.getItem('quwarehouse')) {
            localStorage.removeItem('quwarehouse');
        }
        if (localStorage.getItem('qusupplier')) {
            localStorage.removeItem('qusupplier');
        }
        if (localStorage.getItem('qunote')) {
            localStorage.removeItem('qunote');
        }
        if (localStorage.getItem('qucustomer')) {
            localStorage.removeItem('qucustomer');
        }
        if (localStorage.getItem('qubiller')) {
            localStorage.removeItem('qubiller');
        }
        if (localStorage.getItem('qucurrency')) {
            localStorage.removeItem('qucurrency');
        }
        if (localStorage.getItem('qudate')) {
            localStorage.removeItem('qudate');
        }
        if (localStorage.getItem('qustatus')) {
            localStorage.removeItem('qustatus');
        }
        <?php $this->sma->unset_data('remove_quls');
        } ?>
    });

</script>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-heart-o"></i>Add Banner Details
        </h2>


    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-6">

                <?php
                echo admin_form_open('offers/edit_offer/' . $offer['offer_id'], 'id="action-form" enctype="multipart/form-data"');?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title"  name='offer_title' aria-describedby="titleHelp" value="<?= $offer['offer_title'] ?>" placeholder="Enter Title" required>
                </div>
                <div class="form-group">
                    <label for="offer_amount">Amount</label>
                    <input type="number" class="form-control" id="offer_amount"  name='offer_amount' aria-describedby="titleHelp" value="<?= $offer['offer_amount'] ?>"  required>
                </div>
                <div class="form-group">
                    <label for="offer_type">Offer Type</label>
                    <select name="offer_type" id="offer_type" class="form-control">
                        <?php
                        if ($offer['offer_type'] == "PERCENT"){
                            echo '<option value="AMOUNT">Amount (₹)</option>
                        <option selected value="PERCENT">Percentage (%)</option>';
                        }else{
                            echo '<option selected value="AMOUNT">Amount (₹)</option>
                        <option  value="PERCENT">Percentage (%)</option>';
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="image_old">current image</label>
                    <img src="<?= $offer['offer_image'] ?>"  width='550'  height='200'/>
                    <input type="hidden" name="current_image" value="<?= $offer['offer_image'] ?>"/>
                </div>

                <div class="form-group">
                    <label for="image_new">Image</label>
                    <input type="file" class="form-control" id="image_new"  name='offer_image' aria-describedby="image_newHelp"  accept="image/x-png,image/gif,image/jpeg">
                </div>
                <div class="form-group">
                    <label for="descri"  >Description</label>
                    <textarea class="form-control" name='offer_desc'><?= $offer['offer_desc'] ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
