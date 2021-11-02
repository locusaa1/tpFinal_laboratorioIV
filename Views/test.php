<?php
require_once ('title.php');
require_once ('nav.php');
require_once ('adminNav.php');
?>
<div class="table-responsive">
    <table id="theTable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>Name</td>
            <td>Address</td>
            <td>Gender</td>
            <td>Designation</td>
            <td>Age</td>
        </tr>
        </thead>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="application/javascript">
    $(document).ready( function () {
        $('#theTable').DataTable({
        });
    } );
</script>
