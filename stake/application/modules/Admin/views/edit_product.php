<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">Update Product</h1>
                </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Shoppingt</li>
                    <li class="breadcrumb-item active">Update Product</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <?php echo form_open(base_url('Admin/Package/EditProduct/' . $product['id'])); ?>
                        <div class="kt-portlet__body">
                            <h2><?php echo $this->session->flashdata('message'); ?></h2>
                            <div class="form-group">
                                <label>Package Title</label>
                                <div></div>
                                <?php
                                echo form_input(array('type' => 'text', 'class' => 'form-control', 'name' => 'title', 'value' => $product['title']));
                                ?>
                                <span class="text-danger"><?php echo form_error('title'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>BV</label>
                                <div></div>
                                <?php
                                echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'bv', 'value' => $product['bv']));
                                ?>
                                <span class="text-danger"><?php echo form_error('bv'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>MRP</label>
                                <div></div>
                                <?php
                                echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'mrp', 'value' => $product['mrp']));
                                ?>
                                <span class="text-danger"><?php echo form_error('mrp'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>DP</label>
                                <div></div>
                                <?php
                                echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'dp', 'value' => $product['dp']));
                                ?>
                                <span class="text-danger"><?php echo form_error('dp'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>IGST</label>
                                <div></div>
                                <?php
                                echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'igst', 'value' => $product['igst']));
                                ?>
                                <span class="text-danger"><?php echo form_error('igst'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>SGST</label>
                                <div></div>
                                <?php
                                echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'sgst', 'value' => $product['sgst']));
                                ?>
                                <span class="text-danger"><?php echo form_error('sgst'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <div></div>
                                <?php
                                echo form_textarea(array('class' => 'form-control', 'name' => 'description', 'value' => $product['description'], 'rows' => 5, 'cols' => 3));
                                ?>
                                <span class="text-danger"><?php echo form_error('description'); ?></span>
                            </div>

                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <?php
                                echo form_input(array('type' => 'submit', 'class' => 'btn btn-primary', 'name' => 'create', 'value' => 'Update'));
                                ?>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <?php 
                        echo form_open_multipart(base_url('Admin/Package/upload_product_image/' . $product['id']) ,array('id' => 'productImageForm'));
                        ?>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" name="userfile" class="form-control"/>
                        </div>
                        <button class="btn btn-success upload-result" type="submit" style="display:block;">Upload</button>
                        <?php echo form_close();?>
                    </div>
                    <?php
                    foreach ($product_images as $key => $p_image) {
                        ?>
                        <div class="img">
                            <img class="img-responsive" src="<?php echo base_url('uploads/'.$p_image['image']); ?>">
                            <a href="<?php echo base_url('Admin/Package/delete_product_image/'.$product['id'].'/'.$p_image['id']);?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once'footer1.php'; ?>


<script type="text/javascript">
$(document).on('submit','#productImageForm',function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var  formData = new FormData(this);
    var t = $(this);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function (data) {
            res = JSON.parse(data);
            alert(res.message)
            t.append('<input type="hidden" name="'+res.token_name+'" value="'+res.token_value+'" style="display:none;">')
            if(res.success == 1)
                location.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
})   
</script>
