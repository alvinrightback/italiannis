<script type="text/javascript">

        function showFinishModal(id){
            $('#finishModal').modal('toggle');
            $.ajax({
            'url' : '<?php  echo base_url('display/get_order/'); ?>',
            'type' : 'POST', 
            'data' : {'id' : id},
            'dataType' : 'json',
            'cache' : false,
            'success' : function(data){
                    $('#orderList').html('');
                    $.each(data, function(index, value) {
                        $('#orderList').append('<li class="list-group-item"><div class="form-check"><input class="form-check-input" onchange="javascript:changeRowBG();" type="checkbox" name="trans_details_id[]" value='+value.trans_details_id+' id="defaultCheck1"><label class="form-check-label" for="defaultCheck1">'+value.quantity+'-'+value.name+'</label></div></li>');
                     });
                }
            });
        }

        function changeRowBG(){

            $("#orderList input:checkbox").each(function(){
                var row = $(this).parent().parent();
                if ($(this).prop('checked')==true){ 
                    $(row).addClass('list-group-item-success');
                    //$(row).find("#input_trans_details_id, #input_order_quantity, #input_order_status").prop('readonly', true);
                }
                else{
                    $(row).removeClass('list-group-item-success');
                }
            });
        }

</script>
<main class="main-content p-5" role="main">
	<div class="row">
		<div class="col-md-12">
			<h1>Order List</h1>
		</div>
	</div>
	<?php
	if($success){
		echo "<div class='alert alert-success'>" . $success . "</div>";
	}
	if($failed){
		echo "<div class='alert alert-danger'>" . $failed . "</div>";
	}
	?>

<div class="modal fade" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="finishModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Select finished order</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open('display/finish_order'); ?>
                                        <ul class="list-group" id="orderList">
                                            
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
</div>
</div>

                  <div class="row my-5 pt-5 clearfix">
                        <div class="col-md-12">
                            <div class="price-list-type-2 clearfix">
                                <?php if(is_array($orders)): ?>
                                    <?php foreach($orders as $row): ?>
                                    <?php if(isset($row->orders)): ?>
                                        <div class="plan">
                                            <h3 class="plan-title">
                                                <?php echo $row->table_number; ?>
                                            </h3>
                                            <div class="plan-cost"><span class="plan-type">
                                            <?php if($row->remark !== NULL): ?>
                                            <li class="list-group-item list-group-item-warning"><label class="badge badge-warning"></label> <?php echo $row->remark?></li> 
                                            <?php endif; ?> 
                                            </span></div>
                                            <ul class="plan-features">
                                                 
                                                <?php foreach ($row->orders as $key => $value): ?>
                                                    <li class="list-group-item list-group-item-success"><?php echo $value->quantity.'-'.$value->name; ?></li>
                                                <?php endforeach ?>
                                                   
                                            </ul>
                                            <div class="plan-select">
                                                <button class="btn btn-primary" onclick="showFinishModal('<?php echo $row->trans_id; ?>')">Finish</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <hr>
                                    <h2>No orders yet</h2>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

