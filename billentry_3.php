<!--    <script type="text/JavaScript" src="assets/js/search/search.js"></script>-->
<!---->
<!--    <div class="panel-body">-->
<!--        <div class="row">-->
<!--            <div class="col-sm-4 col-md-4 col-lg-4 col-lg-offset-4">-->
<!--                <form name="search_menu" action="#" class="main-search">-->
<!--                    <input type="hidden" name="session_userid" id="session_userid" value="< ?php echo $_SESSION['user_id']; ?>">-->
<!--                    <input type="hidden" name="session_ip" id="session_ip" value="< ?php echo $_SESSION['ip']; ?>">-->
<!--                        <div class="input-group content-group">-->
<!--                            <div class="has-feedback has-feedback-left">-->
<!--                                <input type="text" class="form-control input-xlg" name="searchvalue_billno" id="searchvalue_billno" placeholder="Bill No." required="required" onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;" >-->
<!--                                <div class="form-control-feedback">-->
<!--                                    <i class="icon-search4 text-muted text-size-base"></i>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="input-group-btn">-->
<!--                                <button type="button" class="btn btn-primary btn-xlg" onclass="btn btn-primary btn-xlg"  onclick="return searchform1_session(document.getElementById('searchvalue_billno').value, 1, 'div_searchbillno','billentry_4.php', '< ?php echo $_SESSION['user_id']; ?>', '< ?php echo $_SESSION['ip']; ?>');">Submit </button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="input-group">
        <input type="text" class="form-control" name="searchvalue_billno" id="searchvalue_billno" placeholder="Enter Bill No...." required="required" onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;" >
        <span class="input-group-btn">
            <button type="button" class="btn btn-primary btn-xs" onclick="return searchform1_session(document.getElementById('searchvalue_billno').value, 1, 'div_searchbillno','billentry_4.php', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['ip']; ?>');">Search</button>
        </span>
    </div>
    