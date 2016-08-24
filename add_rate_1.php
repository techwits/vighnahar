<script type="text/JavaScript" src="assets/js/search/search.js"></script>
<div class="panel-body">
    <div class="tabbable tab-content-bordered">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="active"><a href="#bordered-tab1" data-toggle="tab">Consignor Name</a></li>
            <li><a href="#bordered-tab2" data-toggle="tab">Consignee Name </a></li>
            <li><a href="#bordered-tab3" data-toggle="tab">Product </a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane has-padding active" id="bordered-tab1">
                <form name="search_menu" action="#" class="main-search">
                    <div class="input-group content-group">
                        <div class="has-feedback has-feedback-left">
                            <input type="text" class="form-control input-xlg" name="searchvalue_consignorname" id="searchvalue_consignorname" required="required" onkeypress="return only_Alpha_Numeric_underscore_dot(event);" ondrop="return false;" onpaste="return false;" >
                            <div class="form-control-feedback">
                                <i class="icon-search4 text-muted text-size-base"></i>
                            </div>

                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-xlg" onclass="btn btn-primary btn-xlg" onclick="return searchform1(document.getElementById('searchvalue_consignorname').value, 1, 'div_searchrate','add_rate_2.php');">Submit </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane has-padding" id="bordered-tab2">
                <form name="search_menu" action="#" class="main-search">
                    <div class="input-group content-group">
                        <div class="has-feedback has-feedback-left">
                            <input type="text" class="form-control input-xlg" name="searchvalue_consigneename" id="searchvalue_consigneename" required="required" onkeypress="return only_Alpha_Numeric_underscore_dot(event);" ondrop="return false;" onpaste="return false;" >
                            <div class="form-control-feedback">
                                <i class="icon-search4 text-muted text-size-base"></i>
                            </div>

                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-xlg" onclass="btn btn-primary btn-xlg" onclick="return searchform1(document.getElementById('searchvalue_consigneename').value, 2, 'div_searchrate','add_rate_2.php');">Submit </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane has-padding" id="bordered-tab3">
                <form action="#" class="main-search">
                    <div class="input-group content-group">
                        <div class="has-feedback has-feedback-left">
                            <input type="text" class="form-control input-xlg" name="searchvalue_product" id="searchvalue_product" required="required" onkeypress="return only_Alpha_Numeric_underscore_dot(event);" ondrop="return false;" onpaste="return false;" >
                            <div class="form-control-feedback">
                                <i class="icon-search4 text-muted text-size-base"></i>
                            </div>

                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-xlg" onclass="btn btn-primary btn-xlg" onclick="return searchform1(document.getElementById('searchvalue_product').value, 3, 'div_searchrate','add_rate_2.php');">Submit </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>