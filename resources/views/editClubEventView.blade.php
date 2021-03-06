<!-- Needs variables: event, schedule, templates, places, jobtypes, entries -->

@extends('layouts.master')

@section('title')
	Veranstaltung ändern
@stop

@section('content')

@if(Session::has('userId') 
	AND Session::has('userGroup')
	AND (Session::get('userGroup') == 'marketing'
		OR Session::get('userGroup') == 'clubleitung'))

	{!! Form::open(['method' => 'POST', 'route' => ['editClubEvent', $event->id]]) !!}

	<div class="row">
		<div class="container col-xs-12 col-md-6">
			<div class="panel">
				<div class="panel-heading">
					<h4 class="panel-title">Veranstaltung ändern:</h4>
				</div>

				<div class="panel-body">
					<div class="form-group">
				      	<label for="title" class="col-xs-12 col-md-2 control-label">Titel:</label>
				      	<div class="col-xs-12 col-md-10">
				      		{!! Form::text('title', $event->evnt_title, array('class'=>'form-control', 
				      										  'placeholder'=>'z.B. Weinabend',
				      										  'style'=>'cursor: auto',
				      										  'required') ) !!}
				     	</div>
				    </div>
					
					<br><span class="visible-xs"><br><br></span>
				    
				    <div class="form-group">	
						<label for="subtitle" class="col-xs-12 col-md-2 control-label">Untertitel:</label>
						<div class="col-xs-12 col-md-10">
							{!! Form::text('subtitle', $event->evnt_subtitle, array('class'=>'form-control', 
				      										  'placeholder'=>'z.B. Das Leben ist zu kurz, um schlechten Wein zu trinken', 
				      										  'style'=>'cursor: auto') ) !!}
						</div>
				    </div>
					
					<br>
					<br class="visible-xs">
					<br class="visible-xs">

				    <div class="form-group">	
				     	<label for="evnt_type" class="col-xs-2 col-md-2 control-label">Typ:</label>
				     	<div class="col-xs-10 col-md-10">
				     		<div class="radio">
					     		<label>
						            {!! Form::radio('evnt_type', "0", $event->evnt_type == 0 ? array("checked") : "" ) !!}
						            normales Programm
						        </label>
							</div>
							<div class="radio">
					     		<label>
						            {!! Form::radio('evnt_type', "1", $event->evnt_type == 1 ? array("checked") : "") !!}
						            Information
						        </label>
							</div>
							<div class="radio">
					     		<label>
						            {!! Form::radio('evnt_type', "2", $event->evnt_type == 2 ? array("checked") : "") !!}
						            Spezial
						        </label>
							</div>
							<div class="radio">
					     		<label>
						            {!! Form::radio('evnt_type', "3", $event->evnt_type == 3 ? array("checked") : "") !!}
						            Live Band / Live DJ / Lesung 
						        </label>
							</div>
							<div class="radio">
					     		<label>
						            {!! Form::radio('evnt_type', "4", $event->evnt_type == 4 ? array("checked") : "") !!}
						            interne Veranstaltung
						        </label>
							</div>
							<div class="radio">
					     		<label>
						            {!! Form::radio('evnt_type', "5", $event->evnt_type == 5 ? array("checked") : "") !!}
						            Nutzung
						        </label>
							</div>
						</div>
				    </div>					

					<br><br>
				   
				    <div class="form-group">
				    	<div class="col-xs-2 col-md-2">
				    		&nbsp;
				    	</div>
				     	<div class="col-xs-10 col-md-10">
				     		<label>
								{!! Form::checkbox('isPrivate', '1', ($event->evnt_is_private + 1)%2) !!}
								Öffentliche Veranstaltung?
							</label>
						</div>
				    </div>		    
					
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>

					<div class="form-group">
						<label for="place" class="col-xs-2 col-md-2 control-label">Sektion: &nbsp;</label>
						<div class="col-xs-10 col-md-10">
						   	{!! Form::text('place', $places[$event->plc_id], array('id'=>'place') ) !!}
						 	<a class="btn-small btn-primary dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
						        <span class="caret"></span>
						    </a>
						    <ul class="dropdown-menu">
						    @foreach($places as $place)
						        <li> 
						        	<a href="javascript:void(0);" 
						        	   onClick="document.getElementById('place').value='{{$place}}'">{{$place}}</a>
						        </li>
							@endforeach
						    </ul>  	
					    </div>
				   	</div>
					
					<br><span class="visible-xs"><br></span>

				    <div class="form-group">	
						<label for="beginDate" class="col-xs-2 col-md-2 control-label">Beginn:</label>
						<div class="col-xs-10 col-md-10">
							{!! Form::input('date', 'beginDate', $event->evnt_date_start) !!} 
							<span class="visible-xs"><br></span>um {!! Form::input('time', 'beginTime', $event->evnt_time_start) !!}
						</div>
				    </div>
				    <span class="visible-xs">&nbsp;</span>
				    <div class="form-group">
						<label for="endDate" class="col-xs-2 col-md-2 control-label">Ende:</label>
						<div class="col-xs-10 col-md-10">
							{!! Form::input('date', 'endDate', $event->evnt_date_end) !!} 
							<span class="visible-xs"><br></span>um {!! Form::input('time', 'endTime', $event->evnt_time_end) !!}
						</div>
				    </div>

					<br>
					<br>
					<span class="visible-xs">&nbsp;</span>
				    
				    <div class="form-group">	
						<label for="preparationTime" class="col-xs-2 col-md-2 control-label">DV-Zeit:</label>
						<div class="col-xs-10 col-md-10">
							 {!! Form::input('time', 'preparationTime', $event->getSchedule->schdl_time_preparation_start) !!}
						</div>
				    </div>
					

				    <br><br class="hidden-xs"><br class="hidden-xs"><span class="visible-xs">&nbsp;</span>

				    <div class="form-group col-xs-12 -md-12">
				    	<label for="password" class="col-md-5">Passwort zum Eintragen:</label>
				    	<div class="col-xs-12 col-md-7">
				    		{!! Form::password('password', '' ) !!}
				    	</div>
				    </div>

				    <div class="form-group col-xs-12 col-md-12">
				    	<label fro="passwordDouble" class="col-md-5">Passwort wiederholen:</label>
				    	<div class="col-xs-12 col-md-7">
				    		{!! Form::password('passwordDouble', '') !!}
				    	</div>
				    </div>
				    	<small>Um das Passwort zu löschen trage in beiden Feldern "delete" ein (ohne Anführungszeichen). </small>
				</div>
			</div>
		</div>

			
		<div class="container col-xs-12 col-md-6">
			<br class="visible-xs">	
			<div class="panel">
				<div class="panel-heading">
					<h4 class="panel-title">Weitere Infos:</h4>(öffentlich)
				</div>
				<div class="panel-body">				
				    <div class="form-group">	
						<div class="col-xs-12 col-md-12">
							{!! Form::textarea('publicInfo', $event->evnt_public_info, array('class'=>'form-control', 
																	  'rows'=>'8',
																	  'placeholder'=>'z.B. Karten nur im Vorverkauf') ) !!}
						</div>
					</div>	
				</div>
			</div>
			<br>
			<div class="panel">
				<div class="panel-heading">
					<h4 class="panel-title">Details:</h4>(nur intern sichtbar)
				</div>
				<div class="panel-body">
				    <div class="form-group">
						<div class="col-xs-12 col-md-12">
							{!! Form::textarea('privateDetails', $event->evnt_private_details, array('class'=>'form-control', 
																		  'rows'=>'5', 
																		  'placeholder'=>'z.B. DJ-Tisch wird gebraucht') ) !!}
						</div>
				    </div>
				</div>
			</div>
		</div>
	</div>				
	<br>
	@include('partials.editSchedule', array('schedule', 'templates', 'jobtypes', 'entries'))
	<br>
	{!! Form::submit('Änderungen speichern', array('class'=>'btn btn-success')) !!}
	&nbsp;&nbsp;&nbsp;&nbsp;
	<br class="visible-xs"><br class="visible-xs">
	<a href="javascript:history.back()" class="btn btn-default">Ohne Änderung zurück</a>
	
	{!! Form::close() !!}
	
@else
	@include('partials.accessDenied')
@endif
@stop



