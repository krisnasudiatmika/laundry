<div id="masterContent">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('theme/js/printPreview.js');?>"></script>
<script type="text/javascript">
        $(function(){
            $("#btnPrint").printPreview({
                obj2print:'#masterContent',
                width:'10'
                
                /*optional properties with default values*/
                //obj2print:'body',     /*if not provided full page will be printed*/
                //style:'',             /*if you want to override or add more css assign here e.g: "<style>#masterContent:background:red;</style>"*/
                //width: '670',         /*if width is not provided it will be 670 (default print paper width)*/
                //height:screen.height, /*if not provided its height will be equal to screen height*/
                //top:0,                /*if not provided its top position will be zero*/
                //left:'center',        /*if not provided it will be at center, you can provide any number e.g. 300,120,200*/
                //resizable : 'yes',    /*yes or no default is yes, * do not work in some browsers*/
                //scrollbars:'yes',     /*yes or no default is yes, * do not work in some browsers*/
                //status:'no',          /*yes or no default is yes, * do not work in some browsers*/
                //title:'Print Preview' /*title of print preview popup window*/
                
            });
        });
    </script>
    
  <html>
	  <div id="masterContent">
	  The Best Laundry 
	  Telp : 081238172198
	  <hr> 
	  Plgn. 55555 Bpk/Ibu. Krisna
	  ksdasdasdasdasdasdas
	  -----------------------------------
	  </div>
	  <button id="btnPrint">Print Preview</button>
  </html>