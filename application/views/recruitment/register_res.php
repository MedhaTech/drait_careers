<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7 d-none d-lg-block bg-gray-100 titlePanel px-5 py-5">
            <h3 class="text-danger">Instructions : </h3>
          </div>
          <div class="col-lg-5">
            <div class="p-5">
              
               <?php if($res){ ?>
               <div class="text-center">
                   <i class="fas fa-check-circle fa-5x text-success"></i>
                   <h5 class='font-weight-bold pt-4'>REGISTRATION SUCCESS</h5>
                   <h6 class=''>Your account has been successfully created !</h6>
                   <?php echo anchor('recruitment',"Click here to Login",'class="btn btn-sm btn-danger my-2"'); ?>
               </div>
               <?php } else { ?>
               <div class="text-center">
                   <i class="fas fa-exclamation-circle fa-5x text-danger"></i>
                   <h5 class='font-weight-bold pt-4'>REGISTRATION FAIL</h5>
                   <h6 class=''>Oops..!! Something went wrong. <br/> Please try again later..!!</h6>
                   <?php echo anchor('recruitment/register',"Click here to Regiter again",'class="btn btn-sm btn-danger my-2"'); ?>
               </div>
              <?php } ?>	 
                
               
                           
              
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>