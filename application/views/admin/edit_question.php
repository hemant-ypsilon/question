<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Edit Category</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>Category</a>
                        </li>
                        <li class="active">
                            <strong>Edit Category</strong>
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
                         <form action="<?php echo site_url('admin/editquestion'); ?>" role="form" id="editquestion" method="post" class="validate form-horizontal" enctype="multipart/form-data">

                                <div class="form-group"><label class="col-sm-2 control-label">Question Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" placeholder="Question Name" name="Question_name" id="Question_name" value="<?php echo $question->Question_name; ?>">
                                      <?php echo form_error('Question_name'); ?>
                                    </div>
                                </div>
                                 <div class="hr-line-dashed"></div>

                                 <div class="form-group">
                                   <label class="col-sm-2 control-label">Question Input Type</label>
                                    <div class="col-sm-10">
                                       <select class="form-control m-b" name="Question_Input_Type" id="Question_Input_Type">
                                          <option value="">--Select--</option>
                                          <option <?php if(isset($question->Question_Input_Type) && $question->Question_Input_Type == 1){ echo 'selected="selected"'; } ?> value="1">Text Input</option>
                                          <option <?php if(isset($question->Question_Input_Type) && $question->Question_Input_Type == 2){ echo 'selected="selected"'; } ?> value="2">Date Input</option>
                                          <option <?php if(isset($question->Question_Input_Type) && $question->Question_Input_Type == 3){ echo 'selected="selected"'; } ?> value="3">Drop Down</option>
                                       </select>
                                      <?php echo form_error('Question_Input_Type'); ?>
                                    </div>
                                </div>

                                
                                <div class="hr-line-dashed"></div>

                                <input type="hidden" name="questionId" value="<?php echo $question->Question_Id; ?>">

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="button" onclick="window.location = '<?php echo site_url('all-question'); ?>'">Cancel</button>
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
            $("#editquestion").validate({
              rules: {
                    Question_name: "required",
                    Question_Input_Type: "required"

              },
              messages: { 
                Question_name: "Please write question!",
                Question_Input_Type: "Please select question input type!",
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