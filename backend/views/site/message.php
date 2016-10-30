<script>
    $(function(){
       var i = "<?=$time?>";
        var intervalid = setInterval(fun, 1000);
        function fun() {
            if (i == 0) {
                window.location.href = "<?=$defurl?>";
                clearInterval(intervalid);
            }
            $("#timeSet").text(i+"S后跳转") ;
            i--;
        }
    })
</script>

<div class="container">
        <div id="widget-container-col-6" class="col-xs-12 col-sm-3 widget-container-col ui-sortable">
            <div id="widget-box-6" class="widget-box widget-color-dark light-border ui-sortable-handle">
                <div class="widget-header">
                    <h5 class="widget-title smaller"><?=$string?></h5>

                    <div class="widget-toolbar">
                        <span class="badge badge-danger">提示</span>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main padding-6">
                        <div class="alert alert-info text-center" id="timeSet">
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>