<script type="text/JavaScript" src="assets/js/search/search.js"></script>
<!--<div class="panel-body">-->
<!--<div class="row">-->
<!--<div class="col-sm-4 col-md-4 col-lg-4 col-lg-offset-4">-->
<!-- <form name="search_menu" action="#" class="main-search">-->
<!--                    <div class="input-group content-group">-->
<!--                        <div class="has-feedback has-feedback-left">-->
<!--                            <input type="text" class="form-control input-xlg" name="searchvalue_roadmemo" id="searchvalue_roadmemo" required="required" onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;" >-->
<!--                            <div class="form-control-feedback">-->
<!--                                <i class="icon-search4 text-muted text-size-base"></i>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="input-group-btn">-->
<!--                            <button type="button" class="btn btn-primary btn-xlg" onclass="btn btn-primary btn-xlg"  onclick="return searchform1(document.getElementById('searchvalue_roadmemo').value, 1, 'div_searchroadmemo','rmentry_3.php');">Submit </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
<!--</div>-->
<!--</div>-->
<!---->
<!--</div>-->

<div class="input-group">
    <input type="text" class="form-control input-xs" name="searchvalue_roadmemo" id="searchvalue_roadmemo" placeholder="Enter Rm No...." required="required" onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;" >
        <span class="input-group-btn">
            <button type="button" class="btn btn-primary btn-xs" onclick="return searchform1(document.getElementById('searchvalue_roadmemo').value, 1, 'div_searchroadmemo','rmentry_3.php');">Search</button>
        </span>
</div>
