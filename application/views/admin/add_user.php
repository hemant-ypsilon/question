<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Add User</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>User</a>
                        </li>
                        <li class="active">
                            <strong>Add New User</strong>
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
                         <form action="<?php echo site_url('admin/adduser'); ?>" role="form" id="adduser" method="post" class="validate form-horizontal">

                                <div class="form-group"><label class="col-sm-2 control-label">User Type</label>

                                    <div class="col-sm-10">
                                        <label class="checkbox-inline"> 
                                          <input value="1" id="userType" type="radio" name="userType"> Member 
                                        </label> <label class="checkbox-inline">

                                      <input value="2" id="userType" type="radio" name="userType"> Merchant </label> <label class="checkbox-inline"></label>
                                       <?php echo form_error('userType'); ?>
                                  </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Full Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" placeholder="Full Name" name="User_FullName" id="User_FullName">
                                      <?php echo form_error('User_FullName'); ?>
                                    </div>
                                </div>
                                 <div class="hr-line-dashed"></div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="User_Email" id="User_Email" placeholder="Email" >
                                      <?php echo form_error('User_Email'); ?>
                                    </div>
                                </div>

                                 <div class="hr-line-dashed"></div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Mobile No.</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="User_MobileNo" id="User_MobileNo" placeholder="Mobile No.">
                                      <?php echo form_error('User_MobileNo'); ?>
                                      </div>
                                </div>

                                 <div class="hr-line-dashed"></div>

                                  <div class="form-group"><label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control" name="User_Password" id="User_Password" placeholder="Password" >
                                      <?php echo form_error('User_Password'); ?>
                                    </div>
                                </div>

                                 <div class="hr-line-dashed"></div>

                                 <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password">
                                      <?php echo form_error('cpassword'); ?>
                                      </div>
                                </div>
                    
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="button">Cancel</button>
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
            $("#adduser").validate({
              rules: {
                    userType: "required",
                    User_FullName: "required",
                    User_MobileNo: { required: true,number: true, maxlength: 10,  minlength: 10},
                     old_password: {
                      required: true
                    },
                     User_Password: {
                      required: true,
                      minlength: 5
                    },
                    cpassword: {
                      required: true,
                      minlength: 5,
                      equalTo: "#User_Password"
                    },
                    User_Email: {
                      required: true,
                      email: true
                    }

              },
              messages: { 
                userType: "Please select user type",
                User_FullName: "Please enter user full name",
                User_MobileNo: {
                  required: "Please enter your Phone Number",
                  number: "Phon number should be in number",
                  maxlength: "Your phon number not be more than 10 characters long",
                  minlength: "Your phon number must be at least 10 characters long"
                },
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
                    },
                    User_Email: { 
                      email : "Please enter a valid email address",
                      required : "Please enter email address"
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