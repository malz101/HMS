<div class="filter-bar">
    <h4>Filter by:</h4>
    <form class='filter-form' action="<?php echo URLROOT; ?>/issue/viewAll" method="POST" id="filter-issues-form" name="filter-issues-form" data-name="Filter Issue Form">
        <div class="filter-form-group">
            <label>Status</label>
            <select id="status" name="status" required="" data-name="Status" class="w-select" onChange="this.form.submit()">
                <option value="%">ALL</option>
                <option value="%PENDING%" <?php if($data['status']=='%PENDING%'):?>selected<?php endif?>>Pending</option>
                <option value="%NEED REPAIRS%" <?php if($data['status']=='%NEED REPAIRS%'):?>selected<?php endif?>>Need Repairs</option>
                <option value="%FIXING%" <?php if($data['status']=='%FIXING%'):?>selected<?php endif?>>Fixing</option>
                <option value="%FOLLOW UP%" <?php if($data['status']=='%FOLLOW UP%'):?>selected<?php endif?>>Follow up</option>
                <option value="%RESOLVED%" <?php if($data['status']=='%RESOLVED%'):?>selected<?php endif?>>Resolved</option>
            </select>
        </div>

        <div class="filter-form-group">
            <label for="classification">Type</label>
            <select id="classification" name="classification" required data-name="classification" class="w-select" onChange="this.form.submit()">
                <option value="%">ALL</option>
                <option value="%ADMINISTRATIVE%" <?php if($data['classification']=='%ADMINISTRATIVE%'):?>selected<?php endif?>>Administrative</option>
                <option value="%APPLIANCE" <?php if($data['classification']=='%APPLIANCE%'):?>selected<?php endif?>>Appliance</option>
                <option value="%ELECTRICAL%" <?php if($data['classification']=='%ELECTRICAL%'):?>selected<?php endif?>>Electrical</option>
                <option value="%FURNITURE%" <?php if($data['classification']=='%FURNITURE%'):?>selected<?php endif?>>Furniture</option>
                <option value="%INFRASTRUCTURE%" <?php if($data['classification']=='%PENDING%'):?>selected<?php endif?>>Infrastructure</option>
                <option value="%PLUMBING%" <?php if($data['classification']=='%INFRASTRUCTURE%'):?>selected<?php endif?>>Plumbing</option>
                <option value="%ROOM FIXTURES%" <?php if($data['classification']=='%ROOM FIXTURES%'):?>selected<?php endif?>>Room Fixtures</option>
            </select>
        </div>
    </form>   
</div>