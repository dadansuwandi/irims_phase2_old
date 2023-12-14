<?php 
	$excoEffectivenessQuestions = $this->exco_effectiveness_question_model->getQuestionAndAnswerChoice();
?>
<div id="skor-kemungkinan-modal" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Perhitungan Keefektifan Pengendalian Internal/Exco</b></h3>
			</div>
			<div class="modal-body">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> Form Penilaian Exco (K)
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" action="#" class="form-horizontal" id="exco-effectiveness-question-form-kemungkinan" data-redirect-url="#" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label class="control-label">1. <?php echo $excoEffectivenessQuestions['1']['question']; ?> <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios10" required="required" value="<?php echo $excoEffectivenessQuestions['1']['answers']['0']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['1']['answers']['0']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios20" required="required" value="<?php echo $excoEffectivenessQuestions['1']['answers']['1']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['1']['answers']['1']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios30" required="required" value="<?php echo $excoEffectivenessQuestions['1']['answers']['2']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['1']['answers']['2']['option']; ?> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label class="control-label">2. <?php echo $excoEffectivenessQuestions['2']['question']; ?> <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios40" required="required" value="<?php echo $excoEffectivenessQuestions['2']['answers']['0']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['2']['answers']['0']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios50" required="required" value="<?php echo $excoEffectivenessQuestions['2']['answers']['1']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['2']['answers']['1']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios60" required="required" value="<?php echo $excoEffectivenessQuestions['2']['answers']['2']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['2']['answers']['2']['option']; ?> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label class="control-label">3. <?php echo $excoEffectivenessQuestions['3']['question']; ?> <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios3" id="optionsRadios70" required="required" value="<?php echo $excoEffectivenessQuestions['3']['answers']['0']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['3']['answers']['0']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios3" id="optionsRadios80" required="required" value="<?php echo $excoEffectivenessQuestions['3']['answers']['1']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['3']['answers']['1']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios3" id="optionsRadios90" required="required" value="<?php echo $excoEffectivenessQuestions['3']['answers']['2']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['3']['answers']['2']['option']; ?> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-9">
                                        <button type="submit" class="btn btn-circle green">Submit<i class="m-icon-swapright m-icon-white"></i></button>
									    <button type="button" class="btn btn-circle default" data-dismiss="modal"><i class="m-icon-swapleft"></i>Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
			</div>
			<div class="modal-footer">
                
			</div>
		</div>
	</div>
</div>

<div id="skor-dampak-modal" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Perhitungan Keefektifan Pengendalian Internal/Exco</b></h3>
			</div>
			<div class="modal-body">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> Form Penilaian Exco (D)
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" action="#" class="form-horizontal" id="exco-effectiveness-question-form-dampak" data-redirect-url="#" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label class="control-label">1. <?php echo $excoEffectivenessQuestions['1']['question']; ?> <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios10" required="required" value="<?php echo $excoEffectivenessQuestions['1']['answers']['0']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['1']['answers']['0']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios20" required="required" value="<?php echo $excoEffectivenessQuestions['1']['answers']['1']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['1']['answers']['1']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios30" required="required" value="<?php echo $excoEffectivenessQuestions['1']['answers']['2']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['1']['answers']['2']['option']; ?> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label class="control-label">2. <?php echo $excoEffectivenessQuestions['2']['question']; ?> <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios40" required="required" value="<?php echo $excoEffectivenessQuestions['2']['answers']['0']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['2']['answers']['0']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios50" required="required" value="<?php echo $excoEffectivenessQuestions['2']['answers']['1']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['2']['answers']['1']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios60" required="required" value="<?php echo $excoEffectivenessQuestions['2']['answers']['2']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['2']['answers']['2']['option']; ?> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label class="control-label">3. <?php echo $excoEffectivenessQuestions['3']['question']; ?> <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios3" id="optionsRadios70" required="required" value="<?php echo $excoEffectivenessQuestions['3']['answers']['0']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['3']['answers']['0']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios3" id="optionsRadios80" required="required" value="<?php echo $excoEffectivenessQuestions['3']['answers']['1']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['3']['answers']['1']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios3" id="optionsRadios90" required="required" value="<?php echo $excoEffectivenessQuestions['3']['answers']['2']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['3']['answers']['2']['option']; ?> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-9">
                                        <button type="submit" class="btn btn-circle green">Submit<i class="m-icon-swapright m-icon-white"></i></button>
									    <button type="button" class="btn btn-circle default" data-dismiss="modal"><i class="m-icon-swapleft"></i>Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
			</div>
			<div class="modal-footer">
                
			</div>
		</div>
	</div>
</div>

<div id="skor-k-d-modal" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><b>Perhitungan Keefektifan Pengendalian Internal/Exco</b></h3>
			</div>
			<div class="modal-body">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> Form Penilaian Exco (K) dan (D)
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" action="#" class="form-horizontal" id="exco-effectiveness-question-form-k-d" data-redirect-url="#" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label class="control-label">1. <?php echo $excoEffectivenessQuestions['1']['question']; ?> <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios10" required="required" value="<?php echo $excoEffectivenessQuestions['1']['answers']['0']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['1']['answers']['0']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios20" required="required" value="<?php echo $excoEffectivenessQuestions['1']['answers']['1']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['1']['answers']['1']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios1" id="optionsRadios30" required="required" value="<?php echo $excoEffectivenessQuestions['1']['answers']['2']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['1']['answers']['2']['option']; ?> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label class="control-label">2. <?php echo $excoEffectivenessQuestions['2']['question']; ?> <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios40" required="required" value="<?php echo $excoEffectivenessQuestions['2']['answers']['0']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['2']['answers']['0']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios50" required="required" value="<?php echo $excoEffectivenessQuestions['2']['answers']['1']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['2']['answers']['1']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios60" required="required" value="<?php echo $excoEffectivenessQuestions['2']['answers']['2']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['2']['answers']['2']['option']; ?> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <label class="control-label">3. <?php echo $excoEffectivenessQuestions['3']['question']; ?> <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios3" id="optionsRadios70" required="required" value="<?php echo $excoEffectivenessQuestions['3']['answers']['0']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['3']['answers']['0']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios3" id="optionsRadios80" required="required" value="<?php echo $excoEffectivenessQuestions['3']['answers']['1']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['3']['answers']['1']['option']; ?> </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="optionsRadios3" id="optionsRadios90" required="required" value="<?php echo $excoEffectivenessQuestions['3']['answers']['2']['option_id']; ?>"> <?php echo $excoEffectivenessQuestions['3']['answers']['2']['option']; ?> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-9">
                                        <button type="submit" class="btn btn-circle green">Submit<i class="m-icon-swapright m-icon-white"></i></button>
									    <button type="button" class="btn btn-circle default" data-dismiss="modal"><i class="m-icon-swapleft"></i>Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
			</div>
			<div class="modal-footer">
                
			</div>
		</div>
	</div>
</div>

<script>
//readonly Current Risk option
$('#RESIDUAL_RISK_K_ID').prop('readonly', true);
$('#RESIDUAL_RISK_D_ID').prop('readonly', true);

$('.nilai-skor-kemungkinan').on('click', function(e) {
    if (($("#INHERENT_RISK_K_ID option:selected").val() == "") || ($("#INHERENT_RISK_D_ID option:selected").val() == "")) {
        alert("Ups, Silahkan isi nilai Inherent Risk !");
        return false;
    } else {
        $('#skor-kemungkinan-modal').modal('show');
        e.preventDefault();
    }
});

$('.nilai-skor-dampak').on('click', function(e) {
    if (($("#INHERENT_RISK_K_ID option:selected").val() == "") || ($("#INHERENT_RISK_D_ID option:selected").val() == "")) {
        alert("Ups, Silahkan isi nilai Inherent Risk !");
        return false;
    } else {
        $('#skor-dampak-modal').modal('show');
        e.preventDefault();
    }
});

$('.nilai-skor-k-d').on('click', function(e) {
    if (($("#INHERENT_RISK_K_ID option:selected").val() == "") || ($("#INHERENT_RISK_D_ID option:selected").val() == "")) {
        alert("Ups, Silahkan isi nilai Inherent Risk !");
        return false;
    } else {
        $('#skor-k-d-modal').modal('show');
        e.preventDefault();
    }
});

//begin exco kemungkinan
$('#exco-effectiveness-question-form-kemungkinan').on('submit', function(e){
    var inputValueOptionsRadios1 = $("input:radio[name='optionsRadios1']:checked").val();
    var inputValueOptionsRadios2 = $("input:radio[name='optionsRadios2']:checked").val();
    var inputValueOptionsRadios3 = $("input:radio[name='optionsRadios3']:checked").val();
    var groupValueTotal = Number(inputValueOptionsRadios1) + Number(inputValueOptionsRadios2) + Number(inputValueOptionsRadios3);

    //get mst_exco_effectiveness_value_categories table where (params=group_value) 
    // in row json object
    var urlPost = '<?php echo site_url('risk/risk_evaluation/getExcoEffectivenessValueCategoryByGroupValue'); ?>'; 
    var concatUrlPostGroupValueTotal = urlPost + '/' + groupValueTotal;
    $.ajax({
        type: 'POST',
        url: concatUrlPostGroupValueTotal,
        dataType: 'json',
        data:{"myData":concatUrlPostGroupValueTotal},
        success: function(response) {
            //get exco_score
            $('#EXCO_EFFECTIVENESS_VALUE_K_ID').val(response.exco_score);
            //$('#EXCO_EFFECTIVENESS_VALUE_D_ID').val(0);

            //show information exco effectiveness kemungkinan
            $('#EXCO_EFFECTIVENESS_VALUE_K_ID_INFO').fadeIn( 3000 ).delay( 15000 ).fadeOut( 4000 );
            $('#EXCO_EFFECTIVENESS_VALUE_K_ID_TINGKAT').text(response.level);
            $('#EXCO_EFFECTIVENESS_VALUE_K_ID_DESCRIPTION').text(response.name);

            //get Inherent Risk value in selected
            if (($("#INHERENT_RISK_K_ID option:selected").val() == "") || ($("#INHERENT_RISK_D_ID option:selected").val() == "")) {
                alert("Ups, Silahkan isi nilai Inherent Risk !");
                return false;
            } else {
                //get INHERENT_RISK_K_ID option value
                var INHERENT_RISK_K_ID = Number($('#INHERENT_RISK_K_ID option:selected').val());
                var INHERENT_RISK_D_ID = Number($('#INHERENT_RISK_D_ID option:selected').val());
                var EXCO_EFFECTIVENESS_VALUE_K_ID = Number($('#EXCO_EFFECTIVENESS_VALUE_K_ID').val());
                var EXCO_EFFECTIVENESS_VALUE_D_ID = Number($('#EXCO_EFFECTIVENESS_VALUE_D_ID').val());

                // define variable for multiplication/perkalian (K)
                switch (INHERENT_RISK_K_ID) { 
                    case 1: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_1 ?>");
                        break;
                    case 2: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_2 ?>");
                        break;
                    case 3: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_3 ?>");
                        break;		
                    case 4: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_4 ?>");
                        break;
                    case 5: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_5 ?>");
                        break;
                    default:
                        INHERENT_RISK_K_ID_VALUE = "No value found";
                }

                // define variable for multiplication/perkalian (D)
                switch (INHERENT_RISK_D_ID) { 
                    case 1: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_A ?>");
                        break;
                    case 2: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_B ?>");
                        break;
                    case 3: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_C ?>");
                        break;		
                    case 4: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_D ?>");
                        break;
                    case 5: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_E ?>");
                        break;
                    default:
                        INHERENT_RISK_D_ID_VALUE = "No value found";
                }

                //insert value Current Risk after multiplication/perkalian
                var RESIDUAL_RISK_K_ID = Number(INHERENT_RISK_K_ID_VALUE) * Number(EXCO_EFFECTIVENESS_VALUE_K_ID);
                $('#RESIDUAL_RISK_K_ID').val(Math.ceil(RESIDUAL_RISK_K_ID));
                $('#RESIDUAL_RISK_K_ID').trigger('change');

                /* var RESIDUAL_RISK_D_ID = Number(INHERENT_RISK_D_ID_VALUE);
                $('#RESIDUAL_RISK_D_ID').val(RESIDUAL_RISK_D_ID);
                $('#RESIDUAL_RISK_D_ID').trigger('change'); */
            }
        },
        error : function () {
            console.log ('error');
        }
    });

    //close modal after submit form
    e.preventDefault();
    $('#skor-kemungkinan-modal form')[0].reset();
    $('#skor-kemungkinan-modal').modal('hide');
    return false;
});
//end exco kemungkinan

//begin exco dampak
$('#exco-effectiveness-question-form-dampak').on('submit', function(e){
    var inputValueOptionsRadios1 = $("input:radio[name='optionsRadios1']:checked").val();
    var inputValueOptionsRadios2 = $("input:radio[name='optionsRadios2']:checked").val();
    var inputValueOptionsRadios3 = $("input:radio[name='optionsRadios3']:checked").val();
    var groupValueTotal = Number(inputValueOptionsRadios1) + Number(inputValueOptionsRadios2) + Number(inputValueOptionsRadios3);

    //get mst_exco_effectiveness_value_categories table where (params=group_value) 
    // in row json object
    var urlPost = '<?php echo site_url('risk/risk_evaluation/getExcoEffectivenessValueCategoryByGroupValue'); ?>'; 
    var concatUrlPostGroupValueTotal = urlPost + '/' + groupValueTotal;
    $.ajax({
        type: 'POST',
        url: concatUrlPostGroupValueTotal,
        dataType: 'json',
        data:{"myData":concatUrlPostGroupValueTotal},
        success: function(response) {
            //get exco_score
            //$('#EXCO_EFFECTIVENESS_VALUE_K_ID').val(0);
            $('#EXCO_EFFECTIVENESS_VALUE_D_ID').val(response.exco_score);

            //show information exco effectiveness dampak
            $('#EXCO_EFFECTIVENESS_VALUE_D_ID_INFO').fadeIn( 3000 ).delay( 15000 ).fadeOut( 4000 );
            $('#EXCO_EFFECTIVENESS_VALUE_D_ID_TINGKAT').text(response.level);
            $('#EXCO_EFFECTIVENESS_VALUE_D_ID_DESCRIPTION').text(response.name);

            //get Inherent Risk value in selected
            if (($("#INHERENT_RISK_K_ID option:selected").val() == "") || ($("#INHERENT_RISK_D_ID option:selected").val() == "")) {
                alert("Ups, Silahkan isi nilai Inherent Risk !");
                return false;
            } else {
                //get INHERENT_RISK_K_ID option value
                var INHERENT_RISK_K_ID = Number($('#INHERENT_RISK_K_ID option:selected').val());
                var INHERENT_RISK_D_ID = Number($('#INHERENT_RISK_D_ID option:selected').val());
                var EXCO_EFFECTIVENESS_VALUE_K_ID = Number($('#EXCO_EFFECTIVENESS_VALUE_K_ID').val());
                var EXCO_EFFECTIVENESS_VALUE_D_ID = Number($('#EXCO_EFFECTIVENESS_VALUE_D_ID').val());

                // define variable for multiplication/perkalian (K)
                switch (INHERENT_RISK_K_ID) { 
                    case 1: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_1 ?>");
                        break;
                    case 2: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_2 ?>");
                        break;
                    case 3: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_3 ?>");
                        break;		
                    case 4: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_4 ?>");
                        break;
                    case 5: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_5 ?>");
                        break;
                    default:
                        INHERENT_RISK_K_ID_VALUE = "No value found";
                }

                // define variable for multiplication/perkalian (D)
                switch (INHERENT_RISK_D_ID) { 
                    case 1: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_A ?>");
                        break;
                    case 2: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_B ?>");
                        break;
                    case 3: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_C ?>");
                        break;		
                    case 4: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_D ?>");
                        break;
                    case 5: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_E ?>");
                        break;
                    default:
                        INHERENT_RISK_D_ID_VALUE = "No value found";
                }

                //insert value Current Risk after multiplication/perkalian
                /* var RESIDUAL_RISK_K_ID = Number(INHERENT_RISK_K_ID_VALUE);
                $('#RESIDUAL_RISK_K_ID').val(RESIDUAL_RISK_K_ID);
                $('#RESIDUAL_RISK_K_ID').trigger('change'); */

                var RESIDUAL_RISK_D_ID = Number(INHERENT_RISK_D_ID_VALUE) * Number(EXCO_EFFECTIVENESS_VALUE_D_ID);
                $('#RESIDUAL_RISK_D_ID').val(Math.ceil(RESIDUAL_RISK_D_ID));
                $('#RESIDUAL_RISK_D_ID').trigger('change');
            }
        },
        error : function () {
            console.log ('error');
        }
    });

    //close modal after submit form
    e.preventDefault();
    $('#skor-dampak-modal form')[0].reset();
    $('#skor-dampak-modal').modal('hide');
    return false;
});
//end exco dampak

//begin exco kemungkinan dan dampak
$('#exco-effectiveness-question-form-k-d').on('submit', function(e){
    var inputValueOptionsRadios1 = $("input:radio[name='optionsRadios1']:checked").val();
    var inputValueOptionsRadios2 = $("input:radio[name='optionsRadios2']:checked").val();
    var inputValueOptionsRadios3 = $("input:radio[name='optionsRadios3']:checked").val();
    var groupValueTotal = Number(inputValueOptionsRadios1) + Number(inputValueOptionsRadios2) + Number(inputValueOptionsRadios3);

    //get mst_exco_effectiveness_value_categories table where (params=group_value) 
    // in row json object
    var urlPost = '<?php echo site_url('risk/risk_evaluation/getExcoEffectivenessValueCategoryByGroupValue'); ?>'; 
    var concatUrlPostGroupValueTotal = urlPost + '/' + groupValueTotal;
    $.ajax({
        type: 'POST',
        url: concatUrlPostGroupValueTotal,
        dataType: 'json',
        data:{"myData":concatUrlPostGroupValueTotal},
        success: function(response) {
            //get exco_score
            $('#EXCO_EFFECTIVENESS_VALUE_K_ID').val(response.exco_score);
            $('#EXCO_EFFECTIVENESS_VALUE_D_ID').val(response.exco_score);

            //show information exco effectiveness kemungkinan
            $('#EXCO_EFFECTIVENESS_VALUE_K_ID_INFO').fadeIn( 3000 ).delay( 15000 ).fadeOut( 4000 );
            $('#EXCO_EFFECTIVENESS_VALUE_K_ID_TINGKAT').text(response.level);
            $('#EXCO_EFFECTIVENESS_VALUE_K_ID_DESCRIPTION').text(response.name);
            $('#EXCO_EFFECTIVENESS_VALUE_D_ID_INFO').fadeIn( 3000 ).delay( 15000 ).fadeOut( 4000 );
            $('#EXCO_EFFECTIVENESS_VALUE_D_ID_TINGKAT').text(response.level);
            $('#EXCO_EFFECTIVENESS_VALUE_D_ID_DESCRIPTION').text(response.name);

            //get Inherent Risk value in selected
            if (($("#INHERENT_RISK_K_ID option:selected").val() == "") || ($("#INHERENT_RISK_D_ID option:selected").val() == "")) {
                alert("Ups, Silahkan isi nilai Inherent Risk !");
                return false;
            } else {
                //get INHERENT_RISK_K_ID option value
                var INHERENT_RISK_K_ID = Number($('#INHERENT_RISK_K_ID option:selected').val());
                var INHERENT_RISK_D_ID = Number($('#INHERENT_RISK_D_ID option:selected').val());
                var EXCO_EFFECTIVENESS_VALUE_K_ID = Number($('#EXCO_EFFECTIVENESS_VALUE_K_ID').val());
                var EXCO_EFFECTIVENESS_VALUE_D_ID = Number($('#EXCO_EFFECTIVENESS_VALUE_D_ID').val());

                // define variable for multiplication/perkalian (K)
                switch (INHERENT_RISK_K_ID) { 
                    case 1: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_1 ?>");
                        break;
                    case 2: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_2 ?>");
                        break;
                    case 3: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_3 ?>");
                        break;		
                    case 4: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_4 ?>");
                        break;
                    case 5: 
                        INHERENT_RISK_K_ID_VALUE = Number("<?php echo RISK_PROBABILITY_VALUE_5 ?>");
                        break;
                    default:
                        INHERENT_RISK_K_ID_VALUE = "No value found";
                }

                // define variable for multiplication/perkalian (D)
                switch (INHERENT_RISK_D_ID) { 
                    case 1: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_A ?>");
                        break;
                    case 2: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_B ?>");
                        break;
                    case 3: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_C ?>");
                        break;		
                    case 4: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_D ?>");
                        break;
                    case 5: 
                        INHERENT_RISK_D_ID_VALUE = Number("<?php echo RISK_IMPACT_VALUE_E ?>");
                        break;
                    default:
                        INHERENT_RISK_D_ID_VALUE = "No value found";
                }

                //insert value Current Risk after multiplication/perkalian
                var RESIDUAL_RISK_K_ID = Number(INHERENT_RISK_K_ID_VALUE) * Number(EXCO_EFFECTIVENESS_VALUE_K_ID);
                $('#RESIDUAL_RISK_K_ID').val(Math.ceil(RESIDUAL_RISK_K_ID));
                $('#RESIDUAL_RISK_K_ID').trigger('change');

                var RESIDUAL_RISK_D_ID = Number(INHERENT_RISK_D_ID_VALUE) * Number(EXCO_EFFECTIVENESS_VALUE_D_ID);
                $('#RESIDUAL_RISK_D_ID').val(Math.ceil(RESIDUAL_RISK_D_ID));
                $('#RESIDUAL_RISK_D_ID').trigger('change');
            }
        },
        error : function () {
            console.log ('error');
        }
    });

    //close modal after submit form
    e.preventDefault();
    $('#skor-k-d-modal form')[0].reset();
    $('#skor-k-d-modal').modal('hide');
    return false;
});
//end exco kemungkinan dan dampak
</script>