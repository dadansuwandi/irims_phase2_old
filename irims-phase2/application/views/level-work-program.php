<?php 
	$rows = $this->risk_identification_model->get_list_from_PMAO(); 
?>
<div id="work-program-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Informasi Program Kerja</b></h3>
			</div>
			<div class="modal-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<!-- <a href="#" class="btn green">Add New <i class="fa fa-plus"></i></a> -->
							</div>
						</div>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover" id="myTable">
					<thead>
						<tr>
							<th class="hidden-xs">No.</th>
							<th class="hidden-xs">Branch Code</th>
							<th class="hidden-xs">Project Title</th>
							<th class="hidden-xs">Activity</th>
							<th class="hidden-xs">Start Date</th>
							<th class="hidden-xs">Due Date</th>
							<th style="width: 14%; align=center;">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($rows as $row):
							$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $row["branch_code"]; ?></td>
								<td class="project-tittle"><strong><?php echo $row["project_tittle"]; ?></strong></td>
								<td class="activity">
									<?php 
									foreach ($row["activity"] as $activity) {
										echo '<ul><b>' . $activity["activity_name"] . '</b>'; 
										foreach ($activity["task"] as $task) {
											echo '<li>' . $task["task_name"] . '</li>';
										}
										echo '</ul>'; 
									}
									?>
							
								</td>
								<td><?php echo $row["start_date"]; ?></td>
								<td><?php echo $row["due_date"]; ?></td>
								<td style="width: 14%; align=center;">
									<button class="btnSelect">Select</button>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<script>
$('.informasi-work-program').on('click', function(e) {
	$('#work-program-modal').modal('show');
	e.preventDefault();
});

//begin select row
$("#myTable").on('click', '.btnSelect', function() {
	// get the current row
	var currentRow = $(this).closest("tr");

	var inputValueProjectTittle = currentRow.find(".project-tittle").html(); // get current row 1st table cell TD value
	var inputValueActivity = currentRow.find(".activity").html(); // get current row 2nd table cell TD value
	var data = inputValueProjectTittle + "\n" + inputValueActivity;

	//$('#WORK_PROGRAM').val(inputValueProjectTittle);
	//$('#ACTIVITY').val(inputValueActivity);

	$("#WORK_PROGRAM").data("wysihtml5").editor.setValue(inputValueProjectTittle);
	$("#ACTIVITY").data("wysihtml5").editor.setValue(inputValueActivity);

	//close modal after select
	$('#work-program-modal').modal('hide');
	return false;
});
//end select row
</script>