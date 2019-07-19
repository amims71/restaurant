@extends('layouts.headerAdmin')

@section('title')
    Users
@endsection

@section('body')

<body>
<style>
    .button {
        text-align: center;
        padding-top: 20px;
        clear: both;
    }
</style>
<div id="modal-delete" class="modal fade" aria-hidden="true;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Are you sure, you want to delete this user?</h3>
                        <h3 class="m-t-none m-b">Sorry. You don't have permissin to delete user.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="button text-center">
                            <div class="form-group">
                                <!-- <button class="btn btn-white">Cancel</button> -->
                                <button type="button" class="btn btn-white" data-dismiss="modal">No</button>

                                <button type="submit" class="btn btn-primary" disabled>Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
$con=mysqli_connect('localhost','root','','restaurant') or die();
?>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5> User Information </h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>

                                    <th>Sl.</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Mobile Number</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM users";
                            if ($result = mysqli_query($con, $sql)) {
                                $i=1;
                                while ($row = mysqli_fetch_array($result)) {
                                    // print_r($row);
                                    echo '  <tr class="gradeA">
                                                <td>' . $i . ' </td>
                                                <td>' . $row['name'] . ' </td>                                
                                                <td class="center">' . $row['email'] . '</td>
                                                <td class="center">' . $row['phone'] . '</td>
                                                <td class="center">' . $row['address'] . '</td>
                                            </tr>';
                                    $i++;
                                }
                            }

                            ?>


                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Date picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="js/plugins/dataTables/datatables.min.js"></script>
<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>


<script src="js/plugins/select2/select2.full.min.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script type="text/javascript">


    $(".select2_demo_3").select2({
        placeholder: "Select Blood Group",
        allowClear: true,

    });
    // $(document).ready(function() {
    //   $("#select2_demo_3").select2({
    //     dropdownParent: $("#myModal")
    //   });
    // });


    // $('#data_1 .input-group.date').datepicker({
    //     todayBtn: "linked",
    //     keyboardNavigation: false,
    //     forceParse: false,
    //     calendarWeeks: true,
    //     autoclose: true
    // });

</script>
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });


        $('#data_2 .input-group.date').datepicker({
            format: "M-yyyy",
            viewMode: "months",
            minViewMode: "months"
        });

    });


</script>
@endsection