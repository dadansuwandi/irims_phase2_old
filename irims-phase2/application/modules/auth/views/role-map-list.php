<!-- BEGIN LOAD MODEL-->
<?php
$this->load->model('acl/role_model');
?>
<!-- END LOAD MODEL-->

<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Users Role Map<small><?php echo $this->config->item('page_title'); ?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo site_url('welcome'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo site_url('auth/user/rules'); ?>">Role map</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Index</a>
		</li>
	</ul>
	
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-users"></i>Users Role Maping
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<a href="<?php echo site_url('auth/role_map/add'); ?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover" id="sample_6">
					<thead>
						<tr>
							<th>No.</th>
							<th class="hidden-xs" style="text-align: center">Username</th>
							<th style="text-align: center" class="hidden-xs">Role</th>
							<th style="text-align: center">Actions</th>
						</tr>
					</thead>
					
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->


<?php $this->load->view('delete-modal'); ?>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script>
	//jQuery(document).ready(function() {
		//TableAdvanced.init();
		var table = $('#sample_6').DataTable({
		
        orderCellsTop: true,
		dom: 'Bfrtip',
		
        buttons: [
             'csv', 'excel', 'pdf'
        ],
		"aoColumns": [
		{ "mDataProp" : "No","width":"3%"},
        { "mDataProp" : "UserName","width":"50%"},
		{ "mDataProp" : "Role","width":"35%"},
        { "mDataProp" : "Actions"}
       
        ],
        initComplete: function () {
            var api = this.api();
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
					if (colIdx == 0 || colIdx == 4 ) return;
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });

		$.ajax({
        type: 'POST',
        url: "<?php echo site_url('auth/role_map/GetData');?>",
        cache: false,
        success: function(data) {
		  
			var objdtRisk = (data == '' ? [] : jQuery.parseJSON(data));
			var urlEdit="";
			var urlView="";
			var urlDelete="";
			
			var dtRisk = new Object();
				for (var i = 0; i < objdtRisk.length; i++) {
					dtRisk.No = i+1;
					dtRisk.UserName = objdtRisk[i]["UserName"];
					dtRisk.Role = objdtRisk[i]["name"];
					
					urlView ="<?php echo site_url('auth/role_map/view/'.'"+objdtRisk[i]["UserMapID"]+"'); ?>";
					urlEdit ="<?php echo site_url('auth/role_map/edit/'.'"+objdtRisk[i]["UserMapID"]+"'); ?>";
					urlDelete ="<?php echo site_url('auth/role_map/delete/'.'"+objdtRisk[i]["UserMapID"]+"'); ?>";

					
					dtRisk.Actions="<a href='"+urlView+"' title='View' class='btn btn-xs grey-cascade'><i class='fa fa-search'></i></a>"
					 + '&nbsp;&nbsp;&nbsp;&nbsp;'+ "<a href='"+urlEdit+"' title='Edit' class='btn btn-xs blue'><i class='fa fa-edit'></i></a>"
					 + '&nbsp;&nbsp;&nbsp;&nbsp;'+ "<a href='"+urlDelete+"' title='Delete' class='btn btn-xs red' data-button='delete'> <i class='fa fa-times'></i></a>"
					$('.table').dataTable().fnAddData(dtRisk);
					//table.fnAddData(Kelas);
				}
        }
    });



</script>
<!-- END JAVASCRIPTS -->
