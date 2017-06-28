<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Add Question</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>Question</a>
                        </li>
                        <li class="active">
                            <strong>Add New Question</strong>
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
                         <form action="<?php echo site_url('admin/addquestion'); ?>" role="form" id="addquestion" method="post" class="validate form-horizontal" enctype="multipart/form-data">

                                <div class="form-group"><label class="col-sm-2 control-label">Template Name</label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Template Name" name="Template_Name" id="Template_Name">
                                        <?php echo form_error('Template_Name'); ?>
                                      </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="cointainer">
                                   <div class="content">
                                      <div class="form-group"><label class="col-sm-2 control-label">Question Name</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Question Name" name="Question_name[]" id="Question_name" required>
                                            <?php echo form_error('Question_name'); ?>
                                          </div>
                                      </div>
                                   <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                       <label class="col-sm-2 control-label">Question Input Type<span class="label-num">1</span>:</label>
                                        <div class="col-sm-10">
                                           <select class="form-control m-b" name="Question_Input_Type[]" id="Question_Input_Type">
                                              <option value="">--Select--</option>
                                              <option value="text">Text Input</option>
                                              <option value="date">Date Input</option>
                                              <option value="select">Drop Down</option>
                                           </select>
                                          <?php echo form_error('Question_Input_Type'); ?>
                                        </div>
                                    </div>

                                     <span class="glyphicon glyphicon-minus removeBtn test"></span>
                                  </div>
                                    <span class="glyphicon glyphicon-plus addBtn"></span>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button title="save as active" class="btn btn-info" type="submit" name="submit" value="1" >Save</button>
                                        <button title="Save as deactive" class="btn btn-primary" type="submit" name="submit" value="2">Deactive</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style type="text/css">
           .test {
                  display: none;
                  }
            .addBtn, .removeBtn{
              text-align: right;
              cursor: pointer;
            }
        </style>

        <script>
              $().ready(function() {
                // validate the comment form when it is submitted
                $("#commentForm").validate();

                // validate signup form on keyup and submit
                $("#addquestion").validate({
                  rules: {
                        "Template_Name": "required",
                        "Question_name[]": "required",
                        "Question_Input_Type[]": "required",

                  },
                  messages: { 
                    "Template_Name": "Please write question template!",
                    "Question_name[]": "Please write question!",
                    "Question_Input_Type[]": "Please select question input type!",
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

      <script type="text/javascript">
         //remove button
        $('.removeBtn').click( function() {
            var cointainer = $(this).closest('.cointainer');
            var counts = cointainer.children('.content').length;
            
            counts--;
            if(counts < 10) {
                cointainer.children('.addBtn').show();         
                if (counts == 1) {
                    cointainer.find('.removeBtn').hide();
                }
            }
            $(this).parent().remove();
            
            cointainer.find('.label-num').text(function(idx){
                return 1 + idx
            })
        });


        //add button
          $('.addBtn').click( function() {
              var cointainer = $(this).closest('.cointainer');
              var counts = cointainer.children('.content').length;
              var content = $(this).prev();
              
              counts++;   
              if (counts > 10) {                     
                  $(this).hide();  
              }
              if(counts > 1){
                $('.removeBtn').show();
              }

              content.clone(true,true).insertAfter(content).find('input').val('').end().find('.label-num').text(counts);
              
            //  $('.removeBtn').show();
          });
      </script>