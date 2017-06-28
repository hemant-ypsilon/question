<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Setting</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>Setting</a>
                        </li>
                        <li class="active">
                            <strong>Change Password</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                         <?php if ($this->session->flashdata('success')) { 
                             echo getMessage('success', $this->session->flashdata('success'));
                         }  if ($this->session->flashdata('error')) { 
                             echo  getMessage('error', $this->session->flashdata('error'));
                         }  if ($this->session->flashdata('info')) { 
                             echo  getMessage('info', $this->session->flashdata('info'));
                         }?>

                        <div class="ibox-content">
                         <form action="<?php echo site_url('admin/change_password'); ?>" role="form" id="changepassword" method="post" class="validate form-horizontal">

                                <div class="form-group"><label class="col-sm-2 control-label">Old Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control" placeholder="Old Password" name="old_password" id="old_password">
                                      <?php echo form_error('old_password'); ?>
                                    </div>
                                </div>

                                 <div class="hr-line-dashed"></div>

                                 <div class="form-group"><label class="col-sm-2 control-label">New Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" >
                                      <?php echo form_error('old_password'); ?>
                                    </div>
                                </div>

                                 <div class="hr-line-dashed"></div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control" name="new_cpassword" id="new_cpassword" placeholder="Confirm Password">
                                      <?php echo form_error('old_password'); ?>
                                      </div>
                                </div>

                            
                    
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="button" onclick="window.location = '<?php echo site_url(); ?>'">Cancel</button>
                                        <button class="btn btn-primary" type="submit" name="submit">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
          $().ready(function() {
            // validate the comment form when it is submitted
            $("#commentForm").validate();

            // validate signup form on keyup and submit
            $("#changepassword").validate({
              rules: {
                     old_password: {
                      required: true
                    },
                     new_password: {
                      required: true,
                      minlength: 5
                    },
                    new_cpassword: {
                      required: true,
                      minlength: 5,
                      equalTo: "#new_password"
                    }

              },
              messages: {
                  old_password: {
                      required: "Please provide a old password"
                    },
                   new_password: {
                      required: "Please provide a password",
                      minlength: "Your password must be at least 5 characters long"
                    },
                    new_cpassword: {
                      required: "Please provide a confirm password",
                      minlength: "Your password must be at least 5 characters long",
                      equalTo: "Please enter the same password as above"
                    }
              },

              debug: false,
              errorClass: 'error error-message',
              validClass: 'success',
              errorElement: 'span',
              highlight: function(element, errorClass, validClass) {
                $(element).parents("div.control-group").addClass(errorClass).removeClass(validClass);
              },
              unhighlight: function(element, errorClass, validClass) {
                $(element).parents(".error").removeClass(errorClass).addClass(validClass);
              }

            });

          });
  </script>