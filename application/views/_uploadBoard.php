
<div class="container-fluid">
<table width="400" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<td><strong>Album Content Upload Board </strong></td>
</tr>
</table>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<?php echo form_open_multipart('productuploadC/input_validation'); ?>
<td>
<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
	<td valign="top">singer</td>
	<td valign="top">:</td>
	<td><textarea name="singer" cols="70" rows="3" id="singer"><?php echo set_value('singer'); ?></textarea><?php echo form_error('singer'); ?></td>
</tr>
<tr>
	<td valign="top">category</td>
	<td valign="top">:</td>
	<td>
		<input  type="radio" name="category" value="male">male
		<input  type="radio" name="category" value="female">female
		<input  type="radio" name="category" value="band">band
		<?php echo form_error('category'); ?>
	</td>
</tr>
<tr>
	<td valign="top">singersdoc</td>
	<td valign="top">:</td>
	<td><textarea name="singersdoc" cols="70" rows="3" id="singersdoc"><?php echo set_value('singersdoc'); ?></textarea><?php echo form_error('singersdoc'); ?></td>
</tr>
<tr>
	<td valign="top">singerphoto</td>
	<td valign="top">:</td>
	<td><input type="file" name="singerphoto" id="singerphoto" value="upload"><?php echo form_error('singerphoto'); ?></td>
</tr>
<tr>
	<td valign="top">productname</td>
	<td valign="top">:</td>
	<td><textarea name="productname" cols="70" rows="3" id="productname"><?php echo set_value('productname'); ?></textarea><?php echo form_error('productname'); ?></td>
</tr>
<tr>
	<td valign="top">productprice</td>
	<td valign="top">:</td>
	<td><textarea name="productprice" cols="70" rows="3" id="productprice"><?php echo set_value('productprice'); ?></textarea><?php echo form_error('productprice'); ?></td>
</tr>
<tr>
	<td valign="top">productimage</td>
	<td valign="top">:</td>
	<td><input type="file" name="productimage" id="productimage"><?php echo form_error('productimage'); ?></td>
</tr>

<tr>
	<td valign="top">description</td>
	<td valign="top">:</td>
	<td><textarea name="description" cols="70" rows="3" id="description"><?php echo set_value('description'); ?></textarea><?php echo form_error('description'); ?></td>
</tr>
<tr>
	<td valign="top">fulldescription</td>
	<td valign="top">:</td>
	<td><textarea name="fulldescription" cols="70" rows="3" id="fulldescription"><?php echo set_value('fulldescription'); ?></textarea><?php echo form_error('fulldescription'); ?></td>
</tr>
<tr>
	<td valign="top">releaseddate</td>
	<td valign="top">:</td>
	<td><textarea name="releaseddate" cols="70" rows="3" id="releaseddate"
	><?php echo set_value('releaseddate'); ?></textarea><?php echo form_error('releaseddate'); ?></td>
</tr>
<tr>
	<td valign="top">labelcompany</td>
	<td valign="top">:</td>
	<td><textarea name="labelcompany" cols="70" rows="3" id="labelcompany"><?php echo set_value('labelcompany'); ?></textarea><?php echo form_error('labelcompany'); ?></td>
</tr>
<tr>
	<td valign="top">songname</td>
	<td valign="top">:</td>
	<td><textarea name="songname" cols="70" rows="10" id="songname"><?php echo set_value('songname'); ?></textarea><?php echo form_error('songname'); ?></td>
</tr>
<tr>
	<td valign="top">time</td>
	<td valign="top">:</td>
	<td><textarea name="time" cols="70" rows="5" id="time"><?php echo set_value('time'); ?></textarea><?php echo form_error('time'); ?></td>
</tr>
<tr>
	<td valign="top">ranking</td>
	<td valign="top">:</td>
	<td><input type="text" name="ranking" value="<?php echo set_value('ranking'); ?>"><?php echo form_error('ranking'); ?></td>
</tr>
<tr>
	<td valign="top">注意事項</td>
	<td valign="top">:</td>
	<td>英文的大小寫且之間請用"`"隔開，空白格不用理會。</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><input type="submit" name="uploadBtn" value="Submit" /> <input type="reset" name="Submit2" value="Reset" /></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<table width="400" border="0" align="center" cellpadding="3" cellspacing="0">
</table>
</div>

</body>
</html>