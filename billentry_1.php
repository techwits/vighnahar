<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<?php
//echo("SESSIONUSERID :- ". _SESSIONUSERID_ ."</br>");
//echo("SESSIONIP :- "._SESSIONIP_ ."</br>");
?>


<div class="col-sm-12 col-md-12 col-lg-12 col-lg-12">
    <!-- Scrollable datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            	<h5 class="panel-title">New Bill</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>


        <div class="panel-body">
        	<div class="row">
                <div class="col-md-3">
                    <div class="form-group form-group-material">
                        <label>Financial Year </label>
                        <div class="input-group">
                            <?php
                            $CYear=date("Y");
                            $CMonth=date("m");
                            if($CMonth<4){
                                $CYear=$CYear-1;
                            }
                            $FinancialYear_C=Get_FinancialYear($con, $CYear);
                            //														echo("FinancialYear :- $FinancialYear </br>");
                            $FinancialYear_P=$FinancialYear_C-1;
                            ?>
                            <select name="financialyear" id="financialyear" class="form-control" required>
                                <?php
                                Fill_FinancialYear($con, $FinancialYear_P, $FinancialYear_C);
                                ?>
                            </select>
                                <span class="input-group-addon">
                                    <i class="icon-truck"></i>
                                </span>
                        </div>
                    </div>
                </div>
    
    
                <div class="col-md-3">
                    <div class="form-group form-group-material">
                        <label>Date <span class="text-danger">*</span></label>
                        <div class="content-group-lg">
                            <div class="input-group">
                                <input type="hidden" class="form-control daterange-single"  name="todaysdate" id="todaysdate" required="required">
                                <input type="text" class="form-control daterange-single"  name="rmdate" id="rmdate" required="required">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Select Consignor <span class="text-danger">*</span></label>
    
                        <select name="consignoraddressid" id="consignoraddressid" class="select-size-xs" onchange="return get_LROnConsignor(this.value, '<?php echo _SESSIONUSERID_; ?>', '<?php echo _SESSIONIP_; ?>');">
                            <option></option>
                                <?php
                                    Fill_Consignor($con);
                                ?>
                        </select>
    
                    </div>
                </div>
            </div>
        </div>
            
        
    </div>
</div>
<div id="div_consignorlr" class="dataTables_wrapper no-footer">
            </div>