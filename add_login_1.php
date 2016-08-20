<script type="text/JavaScript" src="assets/js/search/search.js"></script>
<div class="panel-body">
    <div class="tabbable tab-content-bordered">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="active"><a href="#bordered-tab1" data-toggle="tab">User Name</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane has-padding active" id="bordered-tab1">
                <form name="search_login" action="#" class="main-search">
                    <div class="input-group content-group">

                        <div class="has-feedback has-feedback-left">
                            <input type="text" class="form-control input-xlg" name="searchvalue_username" id="searchvalue_username" required="required" onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;" >
                            <div class="form-control-feedback">
                                <i class="icon-search4 text-muted text-size-base"></i>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-xlg" onclass="btn btn-primary btn-xlg" click="return searchlogin(document.getElementById('searchvalue_username').value, 1);">Search </button>
                        </div>


                    </div>
                </form>
            </div>

        </div>
    </div>
</div>