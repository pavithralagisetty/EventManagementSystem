<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<div class="card-body">
  <?php
  $eid=$_POST['edit_id4'];
  $sql="SELECT bitbooking.BookingID,bitbooking.Name,bitbooking.MobileNumber,bitbooking.Email,bitbooking.EventDate,bitbooking.EventStartingtime,bitbooking.EventEndingtime,bitbooking.VenueAddress,bitbooking.EventType,bitbooking.AdditionalInformation,bitbooking.BookingDate,bitbooking.Remark,bitbooking.Status,bitbooking.UpdationDate,bitpayments.ServiceName,bitpayments.SerDes,bitpayments.ServicePrice from bitbooking join bitpayments on bitbooking.ServiceID=bitpayments.ID  where bitbooking.ID=:eid";
  $query = $dbh -> prepare($sql);
  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query->rowCount() > 0)
  {
    foreach($results as $row)
    { 
      ?>
      <table border="1" class="table align-items-center table-flush table-bordered">
        <tr>
          <th>Booking Number</th>
          <td><?php  echo $row->BookingID;?></td>
          <th>Client Name</th>
          <td><?php  echo $row->Name;?></td>
        </tr>


        <tr>
          <th>Mobile Number</th>
          <td><?php  echo $row->MobileNumber;?></td>
          <th>Email</th>
          <td><?php  echo $row->Email;?></td>
        </tr>
        <tr>

          <th>Event Date</th>
          <td><?php  echo $row->EventDate;?></td>
          <th>Event Starting Time</th>
          <td><?php  echo $row->EventStartingtime;?></td>
        </tr>
        <tr>

          <th>Event Ending Time</th>
          <td><?php  echo $row->EventEndingtime;?></td>
          <th>Venue Address</th>
          <td><?php  echo $row->VenueAddress;?></td>
        </tr>
        <tr>

          <th>Event Type</th>
          <td><?php  echo $row->EventType;?></td>
          <th>AdditionalInformation</th>
          <td><?php  echo $row->AdditionalInformation;?></td>
        </tr>
        <tr>

          <th>Service Name</th>
          <td><?php  echo $row->ServiceName;?></td>
          <th>Service Description</th>
          <td><?php  echo $row->SerDes;?></td>
        </tr>
        <tr>
          <th>Service Price</th>
          <td>$<?php  echo $row->ServicePrice;?></td>
          <th>Apply Date</th>
          <td><?php  echo $row->BookingDate;?></td>
        </tr>
        <tr>
          <th>Order Final Status</th>

          <td> 
            <?php  $status=$row->Status;
            if($row->Status=="Approved")
            {
              echo "Your Booking has been approved";
            }
            if($row->Status=="Cancelled")
            {
              echo "Your Booking has been cancelled";
            }
            if($row->Status=="")
            {
              echo "Not Response Yet";
            }
            ;?>
          </td>
          <th >Admin Remark</th>
          <?php 
          if($row->Status=="")
          { 
            ?>
            <td><?php echo "Not Updated Yet"; ?></td>
            <?php 
          } else {
            ?>
            <td><?php  echo htmlentities($row->Status);?></td>
            <?php 
          } ?>
        </tr>
      </table> 
      <?php 
      $cnt=$cnt+1;
    }
  } ?>
</div>