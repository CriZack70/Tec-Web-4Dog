<?php
$errorMessage = isset($_SESSION["errorelogin"]) ? $_SESSION["errorelogin"] : "";
unset($_SESSION["errorelogin"]);
?>
<script>
        let errorMessage = "<?php echo $errorMessage; ?>";
    </script>
                        
<section class="section5 mt-3 mb-2 border border-0 shadow-none" style="background-color: white;">
        
	<div class="container d-flex justify-content-center align-items-center mt-1 mb-2 ">
		<div class="row w-100">
			<div class="col-12 col-md-6 mx-auto my-auto">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs ">
					<li class="nav-item">
						<a class="nav-link active" id="accedi-tab" data-bs-toggle="tab" href="#accedi" role="tab" aria-controls="accedi" aria-selected="true">Accedi</a>
					</li>
					<li class="nav-item">
						<a class=" nav-link "id="registrati-tab" data-bs-toggle="tab" href="#registrati" role="tab" aria-controls="registrati" aria-selected="false">Registrati</a>
					</li>
				</ul>
				<!-- Nav tabTab pane -->
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active mx-auto my-auto mt-3" id="accedi" role="tabpanel" aria-labelledby="accedi-tab">
						<div id="accediContent"></div>
					</div>
					<div class="tab-pane fade mx-auto my-auto mt-3 " id="registrati" role="tabpanel" aria-labelledby="registrati-tab">
						<div class="reg-pane" id="registratiContent"></div>
					</div>	
					
        
				</div>
			</div>
	    </div>
	</div>  
	
</section>

				
					
					
            


