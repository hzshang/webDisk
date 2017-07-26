<?php
require_once '_main.php';
require_once '../lib/setting.php'
?>
<div class="content-wrapper">
            <!-- left column -->
        <section class="content-header">
            <h1>
				发布通知<small>Announcement</small>
            </h1>
        	</section>
        <section class="content">

	        <div class="row">
	            <div class="col-md-6">
		            <div class="box box-primary">
		        		<div class="box-header">
			                <i class="fa fa-bullhorn"></i>
			                <h3 class="box-title">通知</h3>
		            	</div>
			            <div class="box-body">
				               <div class="form-group">
								    <textarea id="myAnnounce" class="form-control" rows="10"><?php
								    include '../user/announce.php';
								    ?></textarea>
							   </div>
			                <div class="box-footer">
								<button id="announceBtn" class="btn btn-primary">发布</button>
				            </div>
			            </div>
		            </div>
	            </div>
			</div>
        </section>
</div>
<script src="../asset/js/jQuery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../asset/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		function announce(){
			$.ajax({
				type:"POST",
				url:'_announce.php',
				data:{
					'text':$("#myAnnounce").val()
				},
				success:function(data){
					alert("发布成功!");
				},
	            error:function(jqXHR){
	                alert("发生错误："+jqXHR.status);
                }
			});
		}
		$("#announceBtn").click(function(){
			announce();
		});
	});
</script>
<?php
require_once '_footer.php'; ?>