<h4 class="title_01 title_02"><a>返回社团首页</a></h4>
<div class="main_02">
<div id="add-corporation">
	<?=form_open('activity/do_add/' . $corporation['id']) ?>
		<span ><label>活动名称：</label>
			<div class="InputWrapper"><div class="InputInner">
				<?=form_input('name') ?>
			</div></div>
		</span>
		<span ><label>活动地点：</label> <div class="InputWrapper"><div class="InputInner"><?=form_input('address') ?></div></div></span>
		<span ><label>活动时间：</label>
			<div id="start">
			<div class="InputWrapper"><div class="InputInner">
				<?=form_input('start_time', '', 'id="from"') ?>
			</div></div></div>
			<div id="conn">
			-
			</div>
			<div id="end">
			<div class="InputWrapper"><div class="InputInner">
				<?=form_input('deadline','', 'id="to"') ?>
			</div></div></div>
		</span>
		<span ><label>活动简介：</label>
			<table class="Textarea">
			<tbody>
				<tr>
					<td id="Textarea-tl"></td>
					<td id="Textarea-tm"></td>
					<td id="Textarea-tr"></td>
				</tr>
				<tr>
					<td id="Textarea-ml"></td>
					<td id="Textarea-mm" class="">
						<div>
							<?=form_textarea('comment') ?>
						</div>
					</td>
					<td id="Textarea-mr"></td>
				</tr>
				<tr>
					<td id="Textarea-bl"></td>
					<td id="Textarea-bm"></td>
					<td id="Textarea-br"></td>
				</tr>
			</tbody>
			</table>
		</span>
		<p class="li_d"><?=form_submit('submit', '保存','class="pub_button"') ?></p>
	<?=form_close() ?>
	<script type="text/javascript">
	$(function() {
    	var dates = $( "#from, #to" ).datepicker({  
        defaultDate: "+1w",  
        changeMonth: true,  
        numberOfMonths: 1,
        altFormat: "yy-mm-dd",
        onSelect: function( selectedDate ) {  
            var option = this.id == "from" ? "minDate" : "maxDate",  
                instance = $( this ).data( "datepicker" ),  
                date = $.datepicker.parseDate(  
                    instance.settings.dateFormat ||  
                    $.datepicker._defaults.dateFormat,  
                    selectedDate, instance.settings );  
            dates.not( this ).datepicker( "option", option, date );
        	}  
    	});  
	});  
	</script>
</div>	
</div>  