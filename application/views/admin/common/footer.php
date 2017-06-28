  <div class="footer">
            <div>
                <strong>Copyright</strong> Question App &copy; 2016-2017
            </div>
        </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url('admin_assets/'); ?>js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
<!--     <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/flot/jquery.flot.time.js"></script> -->

    <!-- Peity -->
<!--     <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/demo/peity-demo.js"></script>
 -->
    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url('admin_assets/'); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <!-- <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->

    <!-- EayPIE -->
<!--     <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/easypiechart/jquery.easypiechart.js"></script> -->

    <!-- Sparkline -->
   <!--  <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script> -->

    <!-- Sparkline demo data  -->
<!--     <script src="<?php echo base_url('admin_assets/'); ?>js/demo/sparkline-demo.js"></script> -->

    <!-- Data Tables -->
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="<?php echo base_url('admin_assets/'); ?>js/bootbox.min.js"></script>

    <script src="<?php echo base_url('admin_assets/'); ?>js/plugins/toastr/toastr.min.js"></script>

    <!-- <script src="<?php echo base_url('admin_assets/'); ?>js/org_files_lib_require.js"></script> -->




   <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo base_url('admin_assets/'); ?>js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            setTimeout(function() {
                    $( ".alert" ).slideUp("normal", function() { $(this).remove(); } );
                }, 2300);

        });


    </script>

     <script type="text/javascript">
      function deleteItem(deleteId,deleteColumn,table,item){
        bootbox.confirm('Do you really want to delete this '+ item +' ?', function(result){ 
          var URL = "<?php echo site_url('admin/delete'); ?>";
           if(result){
              $.ajax({
                url: URL,
                data: {"deleteId" : deleteId, "deleteColumn" : deleteColumn, "table" : table},
                dataType:"json",
                type: "post",
                success: function(data){
                  if(data.status == 1){
                    location.reload();
                  }else{
                    location.reload();
                  }               
                }
            });
           }
        });
      }
  </script>


  <script type="text/javascript">
      function changeStatus(id,column,table,value){
        if(value == 1){
            var status = 'Inactive';
            statusVal = 2;
        }else{
            var status = 'Active';
            statusVal = 1;
        }
        bootbox.confirm('Do you want '+ status +' this ?', function(result){ 
          var URL = "<?php echo site_url('admin/changeStatus'); ?>";
           if(result){
              $.ajax({
                url: URL,
                data: {"id" : id, "column" : column, "table" : table, "value" : statusVal},
                dataType:"json",
                type: "post",
                success: function(data){
                  if(data.status == 1){
                    location.reload();
                  }else{
                    location.reload();
                  }               
                }
            });
           }
        });
      }
  </script>

  <script type="text/javascript">
  document.getElementById("userfile").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
</script>


     <!-- <script type="text/javascript">
                $("#tabledivbody").sortable({
                    items: "tr",
                    cursor: 'move',
                    opacity: 0.6,
                    update: function() {
                        sendOrderToServer();
                    }
                });
               
                function sendOrderToServer() {
                    var order = $("#tabledivbody").sortable("serialize");
                    var URL = "<?php echo site_url('admin/chnageOrder'); ?>";
                    $.ajax({
                    type: "POST", dataType: "json", url: URL,
                    data: order,
                    success: function(response) {
                        if (response.status == "success") {
                            window.location.href = window.location.href;
                        } else {
                            alert('Some error occurred');
                        }
                    }
                    });
                }

        </script>
 -->




</body>
</html>