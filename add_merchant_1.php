<script type="text/JavaScript" src="assets/js/search/search.js"></script>
<div class="panel-body">
    <div class="tabbable tab-content-bordered">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="active"><a href="#bordered-justified-tab1" data-toggle="tab">Company</a></li>
            <li><a href="#bordered-justified-tab2" data-toggle="tab">Telephone</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane has-padding active" id="bordered-tab1">
                <form name="search_merchant" action="#" class="main-search">
                    <div class="input-group content-group">
                        <div class="has-feedback has-feedback-left">
                            <input type="text" class="form-control input-xlg" name="searchvalue_company" id="searchvalue_company" required="required" onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;" >
                            <div class="form-control-feedback">
                                <i class="icon-search4 text-muted text-size-base"></i>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-xlg" onclick="return searchmerchant(document.getElementById('searchvalue_company').value, 1);">Submit </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane has-padding" id="bordered-tab2">
                <form action="#" class="main-search">
                    <div class="input-group content-group">
                        <div class="has-feedback has-feedback-left">
                            <input type="text" class="form-control input-xlg" name="searchvalue_telephone" id="searchvalue_telephone" required="required">
                            <div class="form-control-feedback">
                                <i class="icon-search4 text-muted text-size-base"></i>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-xlg" onclick="return searchmerchant(document.getElementById('searchvalue_telephone').value, 2);">Submit </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>