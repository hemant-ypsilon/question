<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>All Questions</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>Questions</a>
                        </li>
                        <li class="active">
                            <strong>All Questions</strong>
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

                    <div class="order-details"> 
                          <ul class="list-unstyled"> 
                              <li> <strong> Template Id : </strong> <span><?php echo !empty($template) ? $template->Template_Id : '';  ?></span> </li>
                              <li> <strong> Template Name : </strong> <span><?php echo !empty($template) ? $template->Template_Name : '';  ?></span> </li>
                          </ul> 

                     </div> 

                    <table class="table table-striped table-bordered table-hover dataTables-example" id="sortable">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Questions</th>
                                <th>Questions Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tabledivbody">
                               <?php if(count($allquestion)){
                                $i = 1;
                                 foreach ($allquestion as $key => $value) {
                                  ?>
                                <tr class="gradeX" class="sectionsid">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->Question_name; ?></td>
                                    <td><?php echo questionType($value->Question_Input_Type); ?></td>
                                    <td>
                                       <?php if(isset($value->Status) && $value->Status == 1){ ?>
                                         <a onclick="changeStatus(<?php echo $value->Question_Id; ?>,'Question_Id', 'Questions', '<?php echo $value->Status; ?>')" class="btn btn-info btn-rounded" href="javascript:void(0)">Active</a>
                                       <?php }else{ ?>
                                         <a onclick="changeStatus(<?php echo $value->Question_Id; ?>,'Question_Id', 'Questions', '<?php echo $value->Status; ?>')" class="btn btn-warning btn-rounded" href="javascript:void(0)">Inactive</a>
                                       <?php } ?>
                                    </td>
                                    <td class="center">
                                        <a href="javascript:void(0)" onclick="deleteItem(<?php echo $value->Question_Id; ?>,'Question_Id', 'Questions', 'Questions')" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                       <!--  <a href="<?php echo site_url('edit-question/').$value->Question_Id; ?>" title="Delete"><span class="glyphicon glyphicon-pencil"></span></a> -->
                                    </td>
                                </tr>
                                <?php $i++; } } ?>
                      
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
            </div>

        </div>






