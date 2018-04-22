<!-- FullCalendar -->
<link href="<?php echo base_url("assets/bootstrap/vendors/fullcalendar/dist/fullcalendar.min.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("assets/bootstrap/vendors/fullcalendar/dist/fullcalendar.print.css"); ?>" rel="stylesheet" media="print">

<div class="right_col" role="main">

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class='fa fa-calendar'></i> CALENDARIO </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  			  
<script>
	   	/* CALENDAR */
		$(document).ready(function() {

				if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
				console.log('init_calendar');
					
				var date = new Date(),
					d = date.getDate(),
					m = date.getMonth(),
					y = date.getFullYear(),
					started,
					categoryClass;

				var calendar = $('#calendar').fullCalendar({
				defaultView: "agendaWeek",
				locale: 'es',
				  header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listMonth'
				  },
				  buttonText: {
					  today:    'Hoy',
					  month:    'Mes',
					  week:     'Semana',
					  day:      'Día',
					  list:     'Lista'
				  },
				  selectable: true,
				  selectHelper: true,
				  select: function(start, end, allDay) {
					$('#fc_create').click();

					started = start;
					ended = end;

					$(".antosubmit").on("click", function() {
					  var title = $("#title").val();
					  if (end) {
						ended = end;
					  }

					  categoryClass = $("#event_type").val();

					  if (title) {
						calendar.fullCalendar('renderEvent', {
							title: title,
							start: started,
							end: end,
							allDay: allDay
						  },
						  true // make the event "stick"
						);
					  }

					  $('#title').val('');

					  calendar.fullCalendar('unselect');

					  $('.antoclose').click();

					  return false;
					});
				  },
				  eventClick: function(calEvent, jsEvent, view) {
					$('#fc_edit').click();
					$('#title2').val(calEvent.title);

					categoryClass = $("#event_type").val();

					$(".antosubmit2").on("click", function() {
					  calEvent.title = $("#title2").val();

					  calendar.fullCalendar('updateEvent', calEvent);
					  $('.antoclose2').click();
					});

					calendar.fullCalendar('unselect');
				  },
				  editable: true,
				  
				  events: [
				  
<?php
if($information){
	foreach ($information as $data):
?>
				  {
					title: '<?php 
							echo "# COMPUTADORES: " . $data["numero_computadores"] . " - ";
							echo " USUARIO: " . $data['first_name'] . " " . $data['last_name'] . " - ";
							echo " GRUPO ITEMS: " . $data['examen'] . " - ";
							if($data['fk_id_prueba'] == 69){
								echo $data['cual'];
							}else{
								echo $data['prueba'];
							}
							?>',
					start: '<?php echo $data["fecha_apartado"] . " " . $data["hora_inicial_24"]; ?>',
					end: '<?php echo $data["fecha_apartado"] . " " . $data["hora_final_24"]; ?>',
					url: '<?php echo base_url("solicitud/solicitudes_usuario/" . $data["fk_id_user"] . "/" . $data["id_solicitud"] ); ?>'
				  },
				  
<?php
		endforeach;
	}
?>
				  
				  ]			  
				});
		});
</script>
				  				  

                    <div id='calendar'></div>

                  </div>
                </div>
              </div>

</div>

    <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title2" name="title2">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                  </div>
                </div>

              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->

<!-- bootstrap-datetimepicker -->    	
<script src="<?php echo base_url("assets/bootstrap/vendors/moment/min/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/bootstrap/vendors/fullcalendar/dist/fullcalendar.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/bootstrap/vendors/fullcalendar/dist/lang/es.js"); ?>"></script>