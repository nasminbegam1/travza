<script>
        jQuery(document).ready(function(){
    if($('#s2_tokenization').length) {
                $('#s2_tokenization').select2({
                        placeholder: "",
                        tags:[],
                        tokenSeparators: [","]
                });
        }
    });
</script>

<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">Advance - Select2 Dropdowns</div>
                            <div class="panel-body pan">
                                <form role="form" class="form-horizontal form-bordered">
                                    <div class="form-body">
                                       <div class="form-group"><label class="control-label col-md-3">Tagging Support</label>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="location_tags" id="s2_tokenization" class="form-control">
                                                <!--<input type="hidden" value="red, blue" class="select2-tagging-support form-control"/>-->
                                            </div>
                                        </div>
                                       <div class="form-group"><label class="control-label col-md-3">Loading Remote Data</label>

                                            <div class="col-md-6"><input type="hidden" class="select2-loading-remote-data form-control"/></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>