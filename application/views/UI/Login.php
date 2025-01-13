<?php ob_start();?>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(assets/adminlte3.2/dist/img/FIM_Logo_Custom.png);height:260px;margin-top:90px; margin-left: 20px;">
                        </div>
                        <div class="login-wrap p-1 p-md-5">
			      	        <div class="d-flex">
			      		        <div class="w-100">
			      			        <h3 class="mb-3">Log In</h3>
			      		        </div>
			      	        </div>                                 
                            <div class="form-group mb-2">
                                <label class="label" for="name">Username</label>
                                <input id="uname" type="text" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="label" for="password">Password</label>
                                <input id="password" type="password" class="form-control" placeholder="Password" required>
                            </div>
                            <p id="msg" style="font-weight:bold;text-align:center" class="login-box-msg">Silahkan log in terlebih dahulu</p>
                            <div class="form-group">
                                <button type="submit" id="login" class="form-control btn btn-primary rounded submit px-3">Log In</button>
                            </div>
		          		</div>
		            </div>
				</div>
			</div>
		</div>
	</section>


<?php
$data = ob_get_clean();
include('master_page_login.php');
ob_flush();
?>
