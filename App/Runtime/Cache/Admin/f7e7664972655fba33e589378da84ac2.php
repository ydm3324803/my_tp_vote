<?php if (!defined('THINK_PATH')) exit();?><tbody id="category_box" style="display:none;">
	<tr>
		<td align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			选择分类
			<select id="one_category_id" name="one_category_id" style="width:150px;" onchange="changeCategory(this,'two_category_id')">
              <option value="<?php echo $_SESSION['c_root']; ?>" selected="">请选择</option>
            </select>
            <select id="two_category_id" name="two_category_id" style="width:150px;display:none;" onchange="changeCategory(this,'three_category_id')">
              <option value="" selected="">请选择</option>
            </select>
            <select id="three_category_id" name="three_category_id" style="width:150px;display:none;" onchange="changeCategory(this,'')">
              <option value="" selected="">请选择</option>
            </select>
            <input type="submit" value="" class="button button-green" id="category_button" />
		</td>
	</tr>
</tbody>