<?php include'header.php' ?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    <?php echo $header; ?> 
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>OrderId</th>
                        <th>Amount</th>
                        <th>BV</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orders as $key => $order) {
                        ?>
                        <tr>
                            <td><?php echo ($key + 1) ?></td>
                            <td><a href="<?php echo base_url('Dashboard/Shopping/Invoice/' . $order['order_id']); ?>">#<?php echo $order['order_id']; ?></a></td>
                            <td>$<?php echo $order['amount']; ?></td>
                            <td><?php echo $order['bv']; ?></td>
                            <td><?php echo ucwords(str_replace('_', ' ', $order['payment_method'])); ?></td>
                            <td><?php echo $order['created_at']; ?></td>
                            <td><a href="<?php echo base_url('Dashboard/Shopping/Invoice/' . $order['order_id']); ?>">Invoice</a></td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
</div>
<?php include'footer1.php' ?>