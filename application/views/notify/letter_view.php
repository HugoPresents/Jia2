<?=form_open('','class="write_letter_form"')?>
<?=form_button('letter', '写站内信','id="write_letter"') ?>
<div id="write_letter_area" style="display:none">
	<li class="li_input"><label>收信人：</label>
		<div id="receiver"></div>
		<!--
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
							<?=form_textarea(array('id' => "receiver")) ?>
							<?=form_hidden('receiver_id') ?>
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
		</table>-->
		<a href="#?w=500" rel="popup4" class="inline bold" id="check_linkman">选择收信人</a>
	</li>
	<li ><label>內&nbsp;&nbsp;容：</label>
		<div class="mytextarea">
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
							<?=form_textarea(array('name' => 'content', 'id' => "letter_content")) ?>
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
		</table></div>
	</li>
	<li class="li_d"><?=form_button('submit', '发送', 'id="send_letter" disabled="disabled"') ?></li>
</div>
<?=form_close() ?>
<div class="letter_content">
			<div class="tab_title">
				<div class="s01" id="t_01">
					<a href="#" id="in_box">收件箱</a>
				</div>
				<div class="s02" id="t_02">
					<a href="#" id="out_box">发件箱</a>
				</div>
			</div>
			<div class="tab_content">
				<div id="letter_box" class="clear"></div>
			</div>
			
</div>
<div id="popup4" class="popup_block">
	<div id="linkman">		
			<a href="#" id="linkman0" class="sd01">我的关注</a>
			<a href="#" id="linkman1" class="sd02">我的粉丝</a>		
		</div>
		<ol class="slats" id="linkmanlist0">
			<li class="group">
				<a href="#">
					<img src="../img/user.jpg" alt="" />
					<span>1用户名</span>
				</a>
			</li>
			<li class="group">
				<a href="#">
					<img src="../img/user01.jpg" alt="" />
					<span>2加加社团</span>
				</a>
			</li>
			<li class="group">
				<a href="#">
					<img src="../img/user02.jpg" alt="" />
					<span>3tiramisu@gmail.com</span>
				</a>
			</li>
			<li class="group">
				<a href="#">
					<img src="../img/user.jpg" alt="" />
					<span>4用户名</span>
				</a>
			</li>
			<li class="group">
				<a href="#">
					<img src="../img/user01.jpg" alt="" />
					<span>5加加社团</span>
				</a>
			</li>
			<li class="group">
				<a href="#">
					<img src="../img/user02.jpg" alt="" />
					<span>6tiramisu@gmail.com</span>
				</a>
			</li>
			<li class="group">
				<a href="#">
					<img src="../img/user.jpg" alt="" />
					<span>7用户名</span>
				</a>
			</li>
			<li class="group">
				<a href="#">
					<img src="../img/user01.jpg" alt="" />
					<span>8加加社团</span>
				</a>
			</li>
			<li class="group">
				<a href="#">
					<img src="../img/user02.jpg" alt="" />
					<span>9tiramisu@gmail.com</span>
				</a>
			</li>
		</ol>	
				
		<ol id="linkmanlist1" class="slats hidden">
			<li class="group">
				<a href="#">
					<img src="../img/user02.jpg" alt="" />
					<span>tiramisu@gmail.com</span>
				</a>
			</li>
			<li class="group">
				<a href="#">
					<img src="../img/user01.jpg" alt="" />
					<span>加加社团</span>
				</a>
			</li>
			<li class="group">
			<a href="#">
				<img src="../img/user.jpg" alt="" />
				<span>用户名</span>
			</a>
		</li>
		
		</ol>
		
		<div class="pagination pagination2">
			<strong>1</strong>&nbsp;
			<a href="#">2</a>&nbsp;
			<a href="#">3</a>&nbsp;
			<a href="#">&gt;</a>&nbsp;	
		</div>
	</div>
</div>  
<script>
	$(function(){
		linkman_tab();
		
		$(".slats").delegate("li","click",function(){
			var linkmans="";
			linkman=$(this).find("span").text();
			//alert(linkman);
			
			//linkmans+=linkman+"; ";
			$("#receiver").append($('<span class="linkman_tag">' + linkman + '<i class="del_linkman"> × </i> </span>'));
			//$("#popup4").css("display","none");控制关闭那个窗口的
			$('#fade , .popup_block').fadeOut(function() {
				$('#fade, a.close').remove(); 
			}); 
		});
		
		$(".del_linkman").live("click",function(){
			$(this).parent().remove();
		});
		
	})	
</script>