<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Edit Template</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>Template</a>
                        </li>
                        <li class="active">
                            <strong>Edit Template</strong>
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
                         <form action="<?php echo site_url('admin/edittemplate'); ?>" role="form" id="addquestion" method="post" class="validate form-horizontal" enctype="multipart/form-data">

                              <div class="form-group"><label class="col-sm-2 control-label">Template Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" placeholder="Template Name" name="Template_Name" id="Template_Name" value="<?php echo $template->Template_Name; ?>">
                                      <?php echo form_error('Template_Name'); ?>
                                    </div>
                                </div>
                            <div class="hr-line-dashed"></div>

                              <div class="cointainer">

                              <?php if(count($question)){
                                $i = 1;
                                  foreach ($question as $key => $value) { ?>

                              <div class="content">
                                <div class="form-group"><label class="col-sm-2 control-label">Question Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" placeholder="Question Name" name="Question_name[]" id="Question_name" value="<?php echo $value->Question_name; ?>">
                                      <?php echo form_error('Question_name'); ?>
                                    </div>
                                </div>
                                 <div class="hr-line-dashed"></div>

                                 <div class="form-group">
                                   <label class="col-sm-2 control-label">Question Input Type<span class="label-num"><?php echo $i; ?></span>:</label>
                                    <div class="col-sm-10">
                                       <select class="form-control m-b" name="Question_Input_Type[]" id="Question_Input_Type">
                                          <option value="">--Select--</option>
                                          <option <?php if(isset($value->Question_Input_Type) && $value->Question_Input_Type == 'text'){ echo 'selected="selected"'; } ?> value="text">Text Input</option>
                                          <option <?php if(isset($value->Question_Input_Type) && $value->Question_Input_Type == 'date'){ echo 'selected="selected"'; } ?> value="date">Date Input</option>
                                          <option <?php if(isset($value->Question_Input_Type) && $value->Question_Input_Type == 'select'){ echo 'selected="selected"'; } ?> value="select">Drop Down</option>
                                       </select>
                                      <?php echo form_error('Question_Input_Type'); ?>
                                    </div>

                                </div>
                                <div class="hr-line-dashed"></div>
                                   <span class="glyphicon glyphicon-minus removeBtn test"></span>
                                </div>
                                 <?php $i++; } } ?>

                                  <span class="glyphicon glyphicon-plus addBtn"></span>
                              </div>

                              <input type="hidden" name="templateId" value="<?php echo $template->Template_Id; ?>">

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button title="save as active" class="btn btn-info" type="submit" name="submit" value="<?php echo $template->Status; ?>" >Save</button>
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
                    "Question_name[]": "required",
                    "Question_Input_Type[]": "required",

              },
              messages: { 
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