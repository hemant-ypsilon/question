    <div class="wrapper wrapper-content">
    
                     <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success">
                           <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <a href="<?php echo site_url('all-user'); ?>"><span class="label label-success pull-right">Total Users</span></a>
                                <h5>Users</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php  echo $User[0]->totalUser; ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <a href="<?php echo site_url('all-question'); ?>"><span class="label label-info pull-right">Total Question</span></a> 
                                <h5> Question</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php  echo $Question[0]->totalQue; ?></h1>
                                
                            </div>
                        </div>
                    </div>
                   <!--  <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <a href="<?php echo site_url('all-store'); ?>"><span class="label label-primary pull-right">Total Store</span></a>
                                <h5> Store</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $Store[0]->totalStore; ?></h1>
                               
                            </div>
                        </div>
                    </div> -->
                    
        </div>

                </div>

             <!-- Toastr style -->
        <link href="<?php echo base_url('admin_assets/'); ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">


        <script type="text/javascript">
              setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.success('Welcome to Question App dashboard');

                }, 1300);

        </script>