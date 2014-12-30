@extends('layouts.master')

@section('content')
    <div class="col-lg-12">
	    <div class="page-header">
	      <h1 id="heading">Select Reports Files to Load</h1>
	    </div>
	  </div>
    <?php
    $dt = new DateTime();
    ?>
    <div class="container">
      <div class="row">
	<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
	 <form method="post" action="load_reports" id="demoform">
	    <select name="report_files[]" size="10" multiple="multiple" class="hide">
	      @@foreach ($files as $option)
		<option value={{ $option }}>{{$option}}</option>
	      @endforeach
	    </select>
	    <br>
	    <button class="btn btn-default btn-block" type="submit">Submit data</button>
	  </form>
	</div>
      </div>
      </div>
@stop

@section('footer')
    <script src="/js/vendor/jquery-1.11.0.js"></script>
    <script src="/js/vendor/bootstrap.js"></script>
    <script src="/js/vendor/jquery.bootstrap-duallistbox.js"></script>
    <script>
      var demo1 = $('select[name="report_files[]"]').bootstrapDualListbox();
      $("#demoform").submit(function() {
      alert($('[name="report_files[]"]').val());
      return true;
      });
</script>
@stop
