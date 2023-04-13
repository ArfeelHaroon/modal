<?php
require('./inc/db.php');

//   SQL FOR FETCHING DATA
$sql = "SELECT * FROM user_detail";
$query = mysqli_query($conn, $sql);
$table = "";
while ($fetch = mysqli_fetch_assoc($query)) {
  if ($fetch['status'] == 1) {
    $status = " <span class='badge bg-success' style='padding:5px 0;'>Acive</span>";
  } else {
    $status = "<span class='badge bg-danger' style='padding:5px 0;'>Inacive</span>";
  }
  $table .= "
        <tr>
           <td>$fetch[id]</td>
           <td>$fetch[first_name] $fetch[last_name]</td>
           <td>$fetch[email]</td>
           <td>$fetch[address]</td>
           <td>$fetch[phone_number]</td>
           <td>$status</td>
           <td>
              <div id='action'>
                    <!-- Button trigger modal -->
                <button type='button' class='btn btn-info edit_btn' data-IdForEdit='$fetch[id]'>
                  Edit
                </button>
                <button type='button' id='del' class='btn delete_btn btn-danger button' data-theValue='$fetch[id]'>
                  Delete
                </button>
              </div>
           </td>
        </tr>
     ";
}
//   SQL FOR FETCHING DATA
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users info</title>
  <!-- Bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!-- jquery cdn -->
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
  <!-- Ajax cdn -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- DataTable cdn -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
  <!-- /DataTable cdn -->

  <!-- SWEET ALERT -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- External CSS -->
  <link rel="stylesheet" href="./inc/users_table.css">

</head>
<style>
  .edit_input,
  textarea {
    width: 100%;
    padding: 2px;
  }

  .badge {
    width: 4em;
    padding: 2px;
  }

  .buttons-html5,
  .buttons-print {
    font-weight: 500;
    padding: 2px 4px;
    box-shadow:  -8px 0 .4em #3E3D3C;
    margin: 1em;
  }
  .create_btn{
    float: right;
    margin: 1em 5%;
  }

  th.sorting_disabled {
    display: flex;
    align-items: center;
    align-self: center;
    flex-direction: column;
}
</style>

<body>
<button type="button" class="btn create_btn btn-primary">
  Create
</button>
  <!-- table -->
  <table id='myTable' class="display nowrap">
    <thead>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Address</th>
      <th>Phone #</th>
      <th>Status</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php echo $table ?>
    </tbody>
  </table>
     <?php include('./inc/modals.php'); ?>
  <script>
    // <!-- datatabe jquery -->
    $(document).ready(function () {
      $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columnDefs: [
          { orderable: false, targets: 6 }
        ]
       
      });
    });
    // <!-- /datatabe jquery -->

    // <!-- Modal show jquery -->
    $(document).ready(function () {
      $(".edit_btn").click(function () {
        var id = $(this).attr('data-IdForEdit');
        $("#editModal").modal('show');
        // <!-- /Modal show jquery -->
        $.ajax({
          type: 'post',
          url: './edit/edit_ajax.php',
          data: { id: id },
          success: function (data) {
            var json = JSON.parse(data);
            $('#id').val(json.id)
            $('#name').val(json.first_name)
            $('#last_name').val(json.last_name)
            $('#email').val(json.email)
            $('#address').val(json.address)
            $('#phone_number').val(json.phone_number)
          }
        });
      });
    });
    //create_btn
    $(document).on('click','.create_btn',function(){
      $("#createModal").modal('show');
    });
    // Delete Sweet Alert
    $(document).on('click', '#del', function () {
      let id = $(this).attr('data-theValue');
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "./delete/delete.php",
            data: { id: id },
            success: swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          });
          setTimeout(function () {
            location.reload();
          }, 1700);
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your file is safe :)',
            'error'
          )
        }
      });
    });
  </script>
  <!-- Bootstrap js cdn -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>