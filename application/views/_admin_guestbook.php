
<div id="wrap">
	<div id="main" class="container-fluid">
	    <div class="row board">
	   		<div class="col-sm-4 col-md-4 col-lg-4">
	            <div class="panel panel-default" data-spy="affix" data-offset-top="200">
	                <div class="panel-body" id="resizable">         
	                    <form id="reply_form">
	                    <div class="input-group">
	                    	<span class="input-group-addon" style="border-radius: 4px; border-right: solid 1px #ccc;">
	                          <i class="glyphicon glyphicon-user"> 
	                          Administrator</i>
	                        </span>
	                    </div>
	                    <hr>
	                    <div class="input-group">
						  <span class="input-group-addon">回覆給編號第：</span>
						  <input type="text" class="form-control" disabled="disabled" value="" id="message_number">
						  <span class="input-group-addon">的留言</span>
						</div>
	                        <textarea id="admin_reply" class="form-control counted" name="admin_reply" placeholder="按一下「回覆留言」對該篇留言回覆" rows="6" style="margin-bottom:10px; margin-top: 5px;"></textarea>
	                        <h6 class="pull-right" id="counter">320 characters remaining</h6>
	                        <input class="btn btn-lg btn-success btn-block" id="submit_reply" value="確定回覆" style="margin-top: 20px" disabled="disabled" onclick="send_admin_reply()">
	                    </form>
	                </div>
	            </div>
	        </div>
	    	<div class="col-sm-8 col-md-8 col-lg-8">
	        <?php foreach ($get_message as $messageContent) { ?>
	    		<table class="table" style="border:solid; border-color: #FF5454; word-wrap: break-word; word-break: break-all;">
				    <tr>
				    	<td>
					      	<table class="table-hover table messageContent">
					      		<tr>
						        	<td style="width:150px">編號：</td>
						        	<td><?php echo $messageContent['id']; ?></td>
						        </tr>
						        <tr>
						        	<td>會員名稱：</td>
						        	<td><?php echo $messageContent['name']; ?></td>
						        </tr>
						        <tr>
						        	<td>內容：</td>
						        	<td><?php echo $messageContent['comment']; ?></td>
						      	</tr>
						      	<tr>
									<td>日期：</td>
									<td><?php echo $messageContent['datetime']; ?></td>
								</tr>
					    	</table>
					    	<div class="reloadDIV">
					    	<table class="table table-hover messageContent">
					    		<tr>
					    			<td style="width: 150px">管理員回覆：</td>
									<td><?php echo $messageContent['admin_reply']; ?></td>
					    		</tr>
					    		<tr>
					    			<td>回覆時間：</td>
									<td><?php echo $messageContent['reply_time']; ?></td>
					    		</tr>
					    	</table>
					    	</div>
					    	<hr>
					    	<div style="float: right">
					    		<button type="button" class="btn btn-danger delete_confirm" data-id="<?php echo $messageContent['id']; ?>"data-toggle="modal" data-target="#deleteModal">刪除留言</button>
					    	</div>
					    	<div style="float: left">
					    		<button type="button" class="btn btn-primary" onclick=" <?php echo "focusToMessage('".$messageContent['id']."')" ?> ">回覆此則留言</button>
					    	</div>
						</td>
					</tr>
				</table>
			<?php } ?>
	    	</div>
		</div> <!--end of row-->
			<ul class="pagination pull-right">
			</ul>
	</div> <!--end of container-->
</div>
<!-- Modal for delete -->
  <div class="modal fade" id="deleteModal" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h2 class="modal-title" style="text-align: center;"><strong>確定了？</strong></h2>
              </div>
              <div class="modal-body">
                  <h3 style="text-align: center;" class="delete_info"></h3>
              </div>
              <div class="modal-footer">
                <button type="button" id="deleteBtn" onclick="delete_message()" class="btn btn-danger" style="float:left">確定刪除</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">不要刪除</button>
            </div>
          </div>
      </div>
  </div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/charcount.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
    	$('.delete_confirm').on('click', delete_confirm); //$('delete_confirm')按鈕會跳出modal，故另外用on連結函式。
    });
    function delete_confirm() {
    	$('#deleteBtn').data('id',$(this).data('id')); 
    	$('.delete_info').text('刪除ID為 "' + $(this).data('id') + '" 的留言嗎?');
    }
	function focusToMessage($messageID) {
		$('#message_number').css({
			'color':'red',
			'text-align':'center',
			'background-color':'white'
		});
		$('#message_number').val($messageID);
		$('#submit_reply').attr('disabled',false);
	}
	function send_admin_reply() {
		var $messageID = $('#message_number').val();
		var $admin_reply = $('#admin_reply').val();
		if ($admin_reply.length == 0) {
			alert('尚未輸入要回覆的內容！');
			return;
		}
		$.ajax({
            url : "<?php echo site_url('ProductuploadC/ajax_update_adminReply')?>",
            type: "POST",
            data: { id : $messageID, reply_message : $admin_reply },
            dataType: "JSON",
            cache: false,
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {
                    alert('回覆成功！');
                    location.reload();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error on update comment');
            }
        });
    }
	function delete_message() {
        var $theMessageID = $('#deleteBtn').data('id'); 
        
        $.ajax({
            url:"<?php echo site_url('ProductuploadC/ajax_delete_message/')?>"+$theMessageID,
            type: 'GET', //因為CI傳參數給控制器函式的方法是用URL，所以改成GET             
            dataType : 'JSON',  
            cache: false,
            success: function(data)
            {
                if (data.status) 
                    {
                        alert('已成功刪除！');
                        $('#deleteModal').modal('hide');
                        location.reload();
                    } 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error on update image'); 
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        }); 
        
    }
</script>
</body>
</html>