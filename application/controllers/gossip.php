<?php
	class Gossip extends MY_Controller {
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('gossip');
		}
		// 取出留言
		function index() {
			$this->_require_ajax();
			$id = $this->input->post('id');
			$type = $this->input->post('type');
			$where = array(
				'receiver_id' => $id,
				'type_id' => $this->config->item('entity_type_'.$type),
			);
			$join = array('user' => array('user_id', 'id'));
			$gossips = $this->jiadb->fetchJoin($where, $join);
//			echo '<ul id="gossips">';
			if($gossips) {
				foreach ($gossips as $gossip) {
					?>
					<li class="feed_a clearfix">
						<div class="img_block fl">
							<a class="head_pic" onerror="onImgError(this);" href="<?=site_url('personal/profile/'.$gossip['user_id']) ?>"><img src="<?=avatar_url($gossip['user'][0]['avatar']) ?>" /></a>
						</div>
						<div class="feed_main">
							<div class="f_nick">
								<?=anchor('personal/profile/'.$gossip['user_id'], $gossip['user'][0]['name']) ?>
							</div>
                            <div class="f_text"><?=$gossip['content'] ?></div>
							<div class="f_summary clearfix">
								<div>
									<?=jdate($gossip['time']) ?>
								</div>
							</div>
						</div>
					</li>
					<?
				}
			} else {
				echo '<p id="tmp_gossip">还没有人留言</p>';
			}
//			echo '</ul>';
		}
		
		function add() {
			$this->_require_login();
			$this->_require_ajax();
			$id = $this->input->post('id');
			$type = $this->input->post('type');
			$content = $this->input->post('content');
			$gossip = array(
				'user_id' => $this->session->userdata('id'),
				'receiver_id' => $id,
				'type_id' => $this->config->item('entity_type_'.$type),
				'time' => time(),
				'content' => $content
			);
			$this->db->insert('gossip', $gossip);
			$gossip_id = $this->db->insert_id();
			$join = array(
				'user' => array('user_id', 'id')
			);
			$gossip = $this->jiadb->fetchJoin(array('id' => $gossip_id), $join);
			$gossip = $gossip[0];
			?>
            <li class="feed_a clearfix">
				<div class="img_block fl">
					<a class="head_pic" href="<?=site_url('personal/profile/'.$gossip['user_id']) ?>"><img src="<?=avatar_url($gossip['user'][0]['avatar']) ?>" /></a>
				</div>
				<div class="feed_main">
					<div class="f_nick">
						<?=anchor('personal/profile/'.$gossip['user_id'], $gossip['user'][0]['name']) ?>

					</div>
                    <div class="f_text"><?=$gossip['content'] ?></div>
					<div class="f_summary clearfix">
						<p>
							<?=jdate($gossip['time']) ?>
						</p>
					</div>
				</div>
			</li>
			<?
		}
	}
