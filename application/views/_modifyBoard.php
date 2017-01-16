
<div class="container-fluid">
  <table class = "table table-hover modifyBoard">
      <thead>
          <tr>
              <th> Product ID </th>
              <th> Album Name </th>
              <th> Album Cover</th>
              <th> Singer </th>
              <th> Price(TWD) </th>
         </tr>
     </thead>
     <tbody>
      <?php foreach ($sample as $product_sample) { ?>
         <tr>
             <td> <?php echo $product_sample['productid'] ?> </td>
             <td> <?php echo $product_sample['productname'] ?> </td>
             <td><img src=" <?php echo base_url("uploads/files/").$product_sample['productimage'] ?> " alt=" <?php echo $product_sample['productname'] ?> " style="width:100px;height:100px;"></td>
             <td> <?php echo $product_sample['singer'] ?> </td>
             <td> <?php echo $product_sample['productprice'] ?> </td>
             <!-- Trigger the modal with a button -->
             <td><a href="javascript: void(0)" onClick="<?php echo 'edit_product('."'".$product_sample['productid']."')"?>" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">修改</a></td>
             <td><a href="javascript: void(0)" data-id="<?php echo $product_sample['productid'] ?>" class="btn btn-warning delete_confirm" data-toggle="modal" data-target="#deleteModal">刪除</a></td>
         </tr>
      <?php }; ?>
      </tbody>
  </table>
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
                <button type="button" id="deleteBtn" onclick="delete_product()" class="btn btn-danger" style="float:left">確定刪除</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">不要刪除</button>
            </div>
          </div>
      </div>
  </div>

  <!-- Modal for update -->
  <div class="modal fade" id="updateModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">修改專輯內容</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="edit_form">
                    <input type="hidden" value="" name="productid"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Singer</label>
                            <div class="col-md-9">
                                <textarea name="singer" class="form-control" rows="1" id="singer"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Category</label>
                            <div class="col-md-9">
                                <input type="radio" name="category" value="male" class="male">male
                                <input type="radio" name="category" value="female" class="female">female
                                <input type="radio" name="category" value="band" class="band">band
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Singersdoc</label>
                            <div class="col-md-9">
                                <textarea name="singersdoc" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group image_form_gruop">
                            <label class="control-label col-md-3">Singerphoto</label>
                            <div class="col-md-9">
                                <textarea name="singerphoto" class="form-control has-success" rows="1"></textarea>
                                <span class="help-block"></span>
                            </div>
                            <label class="control-label col-md-3" style="padding-left: 0px; padding-right: 0px">更新歌手圖片</label>
                            <div id="uploadForm" class="col-md-5" class="">
                                <input id="ajax_singerphoto" type="file" class="input-sm">
                                <button type="button" class="btn btn-info btn-xs" id="update_imageBtn" style="margin-left: 10px" onclick="ajax_imageUpdate('singerphoto')">upload</button>
                            </div>
                        </div>
                        <p class="text-right" style="color: red">僅接受gif、jpg、png、jpeg。先上傳更新檔再一併更新。</p>
                        <div class="form-group">
                            <label class="control-label col-md-3">Productname</label>
                            <div class="col-md-9">
                                <textarea name="productname" class="form-control" rows="1" id="productname"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Productprice</label>
                            <div class="col-md-9">
                                <textarea name="productprice" class="form-control" rows="1"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group image_form_gruop">
                            <label class="control-label col-md-3">Productimage</label>
                            <div class="col-md-9">
                                <textarea name="productimage" class="form-control" rows="1"></textarea>
                                <span class="help-block"></span>
                            </div>
                            <label class="control-label col-md-3" style="padding-left: 0px; padding-right: 0px">更新專輯封面</label>
                            <div id="uploadForm" class="col-md-5">
                                <input id="ajax_productimage" type="file" class="input-sm">
                                <button type="button" class="btn btn-info btn-xs" id="update_imageBtn" style="margin-left: 10px" onclick="ajax_imageUpdate('productimage')">上傳更新檔</button>
                            </div>
                        </div>
                        <p class="text-right" style="color: red">僅接受gif、jpg、png、jpeg。先上傳更新檔再一併更新。</p>
                        <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fulldescription</label>
                            <div class="col-md-9">
                                <textarea name="fulldescription" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Releaseddate</label>
                            <div class="col-md-9">
                                <textarea name="releaseddate" class="form-control" rows="1"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Labelcompany</label>
                            <div class="col-md-9">
                                <textarea name="labelcompany" class="form-control" rows="1"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Songname</label>
                            <div class="col-md-9">
                                <textarea name="songname" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Time</label>
                            <div class="col-md-9">
                                <textarea name="time" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Ranking</label>
                            <div class="col-md-9">
                                <textarea name="ranking" class="form-control" rows="1"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="edit_error"></p>
                <button type="button" id="saveBtn" onclick="save_edit()" class="btn btn-primary">更新</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.delete_confirm').on('click', delete_confirm); //$('delete_confirm')按鈕會跳出modal，故另外用on連結函式。
    });
    function delete_confirm() {
        $('#deleteBtn').data('id',$(this).data('id')); 
        //把ID設定給deleteBtn，delete_product()再從deleteBtn抓ID
        $('.delete_info').text('刪除Product ID為 "' + $(this).data('id') + '" 的專輯嗎?');
    }
    function delete_product() {
        var $theProductID = $('#deleteBtn').data('id'); 
        //can't catch the data-id if using $(this)
        $.ajax({
            url:"<?php echo site_url('ProductuploadC/ajax_delete_product/')?>"+$theProductID,
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
 
    function ajax_imageUpdate(updateWhich) {
        var fd = new FormData();
        if (updateWhich == 'singerphoto') {
            fd.append('singerphoto', $('#ajax_singerphoto').prop('files')[0]);
            var $target = $('#singer').serializeArray();
            fd.append('singer', $target[0]['value']);
            var url = "<?php echo site_url('ProductuploadC/ajax_update_singerphoto/')?>";
        }
        if (updateWhich == 'productimage') {
            fd.append('productimage', $('#ajax_productimage').prop('files')[0]);
            var $target=$('#productname').serializeArray();
            fd.append('productname', $target[0]['value']);
            var url = "<?php echo site_url('ProductuploadC/ajax_update_productimage/')?>"
        }
        $.ajax({ // $_FILES['input_file_name']
                url: url,
                data: fd,
                type: 'POST',               
                processData: false, 
                contentType: false, 
                dataType : 'JSON', 
                cache: false, 
                success: function(data)
                {
                    if (updateWhich == 'singerphoto') {
                        $('textarea[name="singerphoto"]').val(data[0].singerphoto);
                    }
                    if (updateWhich == 'productimage') {
                        $('textarea[name="productimage"]').val(data[0].productimage);
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

    function edit_product(id){  
        $('#edit_form')[0].reset(); 
            $.ajax({
                url : "<?php echo site_url('ProductuploadC/ajax_editPage/')?>" + id ,
                type: "GET",
                dataType: "JSON",
                cache: false,
                success: function(data)
                {   //data是物件要加上[ ]才可
                    //把productid加在隱藏表單input type=hidden再夾帶出去(從save_edit出發)
                    //如此後面要update的時候才抓得到要where
                    $('[name="productid"]').val(data[0].productid);
                    $('[name="singer"]').val(data[0].singer);
                    $('[class="'+data[0].category+'"]').prop('checked', true);
                    //只要input radio設定同一個name就只有一項可以被選取，其他會自動取消
                    //為加上原內容，避開使用name屬性，故改用value
                    $('[name="singersdoc"]').val(data[0].singersdoc);
                    $('textarea[name="singerphoto"]').val(data[0].singerphoto);
                    $('[name="productname"]').val(data[0].productname);
                    $('[name="productprice"]').val(data[0].productprice);
                    $('textarea[name="productimage"]').val(data[0].productimage);
                    $('[name="description"]').val(data[0].description);
                    $('[name="fulldescription"]').val(data[0].fulldescription);
                    $('[name="releaseddate"]').val(data[0].releaseddate);
                    $('[name="labelcompany"]').val(data[0].labelcompany);
                    $('[name="songname"]').val(data[0].songname);
                    $('[name="time"]').val(data[0].time);
                    $('[name="ranking"]').val(data[0].ranking);
                    $('#updateModal').modal('show'); // show bootstrap modal when complete loaded
                },
                error: function (req, status, err) 
                {
                  console.log('Something went wrong', status, err);
                }
            });  
    } //end of function edit_product
    function save_edit()
    {
        $('#saveBtn').text('saving...'); 
        $('#saveBtn').attr('disabled',true); 
        $.ajax({
            url : "<?php echo site_url('ProductuploadC/ajax_update_all/')?>",
            type: "POST",
            data: $('#edit_form').serialize(),
            dataType: "JSON",
            cache: false,
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#updateModal').modal('hide');
                    location.reload();
                }
                else
                { 
                    $('.edit_error').text('有欄位是空白的！');         
                }
                $('#saveBtn').text('save'); 
                $('#saveBtn').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error on update data');
                $('#saveBtn').text('save'); 
                $('#saveBtn').attr('disabled',false);
            }
        });
    }
</script>
</body>
</html>