    <div class="container">
        <h2>Video settings <div class="loader pull-right hidden"><img src="<?=base_url()?>public/images/loader.gif" style="width:50px;height:50px;"></div>
</h2>
        

        <div class="col-md-12">
            <div class="col-md-2 col-sm-2 col-xs-2"><h2 class="btn btn-list-all">LIST SERIES <i class="fa fa-list-ol"></i></h2></div>
            <div class="col-md-2 col-sm-2 col-xs-2"><h2 class="btn btn-list-all-video">LIST VIDEOS <i class="fa fa-list-ol"></i></h2></div>
        	<div class="col-md-2 col-sm-2 col-xs-2"><h2 class="btn btn-new-series">NEW SERIES <i class="fa fa-th-list"></i></h2></div>
        	<div class="col-md-2 col-sm-2 col-xs-2"><h2 class="btn btn-new-video">NEW VIDEO <i class="fa fa-plus"></i></h2></div>
        	<div class="col-md-2 col-sm-2 col-xs-2"><h2 class="btn btn-statistics">STATISTICS <i class="fa fa-bar-chart"></i></h2></div>
        	<div class="col-md-2 col-sm-2 col-xs-2"><h2 class="btn btn-reports">REPORTS <i class="fa fa-exclamation"></i></h2></div>
        </div>

    </div>



    <main class="content">
        <div class="hidden">
            <input type="hidden" id="series_id" name="series_id" value="<?php echo isset($series_id) ? $series_id : ''; ?>">
        </div>
    	<article class="video-container">
    		
    	</article>

    </main>


    <script type="text/javascript">
    base_url = '<?=base_url()?>';
    letter_1 = '<?php echo $this->input->get("s"); ?>';
    letter_2 = '<?php echo $this->input->get("e"); ?>';
    </script>