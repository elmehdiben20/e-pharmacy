<?php
include_once('db.php');
// add medicine
if(isset($_POST['addmedicine']))  
{
$name = addslashes($_POST['name']);
$icode = $_POST['icode'];
$stock = $_POST['stock'];
$price = $_POST['price'];
$edate = $_POST['edate'];
$grams = $_POST['grams'];
$type = $_POST['type'];
$description = addslashes($_POST['description']);
$file = $_FILES['file'];
$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];
$fileType = $_FILES['file']['type'];


    $fileExt = explode( '.', $fileName);
     $fileActualExt = strtolower(end($fileExt));


$allowed = array('png', 'jpg', 'jpeg');

//Tu fais les vérifications nécéssaires
if(in_array($fileActualExt, $allowed))
//Si l'extension n'est pas dans le tableau
{
if ($fileError === 0) {
 
 if ($fileSize < 5000000) {


   $fileNameNew = uniqid('', true).".".$fileActualExt;
   $fileDestination = '../image/'.$fileNameNew;
   move_uploaded_file($fileTmpName , $fileDestination);



      
       $fileDestination1 = 'image/'.$fileNameNew;


      $sql1 = "INSERT into medicines (name,description,stock,price,image,type,expiry_date,item_code,grams) 
      value('$name','$description','$stock','$price','$fileDestination1','$type','$edate','$icode','$grams')";
      $result1 =$con->query($sql1);

    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Bien .",
                    text: "Medicine added",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-list.php \">";

 } else {
 
  echo  '


  <script src="../assets/libs/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
         <script type="text/javascript">   
  
                  $(document).ready(function(){
  
                   
                    
                    swal({
                      icon: "erreur",
                      title: "Ouups ..",
                      text: "Grande Taille Image",
                    })
                  });
                </script>
  ';

 }
} else {


  echo  '


  <script src="../assets/libs/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
         <script type="text/javascript">   
  
                  $(document).ready(function(){
  
                   
                    
                    swal({
                      icon: "erreur",
                      title: "Ouups ..",
                      text: "Erreur de l upload Image",
                    })
                  });
                </script>
  ';
}

} else {


  echo  '


  <script src="../assets/libs/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
         <script type="text/javascript">   
  
                  $(document).ready(function(){
  
                   
                    
                    swal({
                      icon: "error",
                      title: "Ouups ..",
                      text: "Vous ne pouvez pas uploader ce type",
                    })
                  });
                </script>
  ';
}

}

// update medicine

if(isset($_POST['updatemedicine']))  
{
$id = $_POST['id'];
$name = addslashes($_POST['name']);
$icode = $_POST['icode'];
$stock = $_POST['stock'];
$price = $_POST['price'];
$edate = $_POST['edate'];
$grams = $_POST['grams'];
$type = $_POST['type'];
$description = addslashes($_POST['description']);

$sql2 = "UPDATE medicines set name='$name' , item_code='$icode', stock='$stock', price='$price', expiry_date='$edate', grams='$grams' , type='$type' , description='$description' where id=$id ";
$result2 =$con->query($sql2);
if($result2 > 0)
{

    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Good .",
                    text: "Medicine updated",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-list.php \">";






} else {
    echo  '


    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "error",
                        title: "Error .",
                        text: "Error1",
                      })
                    });
                  </script>
    ';
    
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-list.php \">";

}}


// delete medicine

if(isset($_POST['deletemedicine']))  
{
$id = $_POST['id'];

$sql3 = "UPDATE medicines set is_deleted='Not Available' where id=$id ";
$result3 =$con->query($sql3);
if($result3 > 0){
    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Good .",
                    text: "Medicine deleted",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-list.php \">";






} else {
    echo  '


    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "error",
                        title: "Error .",
                        text: "Error",
                      })
                    });
                  </script>
    ';
    
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-list.php \">";

}}



// update deleted medicine
if(isset($_POST['updatedel']))  
{
$id = $_POST['id'];

$sql4 = "UPDATE medicines set is_deleted='Available' where id=$id ";
$result4 =$con->query($sql4);
if($result4 > 0){
    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Good .",
                    text: "Medicine Updated",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-deleted.php \">";






} else {
    echo  '


    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "error",
                        title: "Error .",
                        text: "Error",
                      })
                    });
                  </script>
    ';
    
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-deleted.php \">";

}}



// add team
if(isset($_POST['addteam']))  
{
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// crypt pass
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options   = 0;
$encryption_iv = '1234567891011121';
$encryption_key = "W3docs";
@$encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

$selecte="SELECT * from team where email='$email'";
$rste= $con->query($selecte);
if($rste->num_rows >0){
  echo  '


  <script src="../assets/libs/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
         <script type="text/javascript">   
  
                  $(document).ready(function(){
  
                   
                    
                    swal({
                      icon: "error",
                      title: "error .",
                      text: "Already",
                    })
                  });
                </script>
  ';
  
      echo "<meta http-equiv=\"refresh\" content=\"1;URL=../team-list.php \">";

}else{
  $sql5 = "INSERT into team (name,email,password) value('$name','$email','$encryption')";
$result5 =$con->query($sql5);
    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Good .",
                    text: "Team Added",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../team-list.php \">";






} }



// update user

if(isset($_POST['updateteam']))  
{
$id = $_POST['id'];
$name = addslashes($_POST['name']);
$email = $_POST['email'];
$password = $_POST['password'];
$type = $_POST['type'];

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options   = 0;
$encryption_iv = '1234567891011121';
$encryption_key = "W3docs";
@$encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

$selecte="SELECT * from team where email='$email'";
$rste= $con->query($selecte);
if($rste->num_rows >0){
  echo  '


  <script src="../assets/libs/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
         <script type="text/javascript">   
  
                  $(document).ready(function(){
  
                   
                    
                    swal({
                      icon: "error",
                      title: "error .",
                      text: "Already",
                    })
                  });
                </script>
  ';
  
      echo "<meta http-equiv=\"refresh\" content=\"1;URL=../team-list.php \">";

}else{
  $sql6 = "UPDATE team set name='$name' , password='$encryption', type='$type' where id=$id ";
  $result6 =$con->query($sql6);
    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Good .",
                    text: "User updated",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../team-list.php \">";






}}




// delete team

if(isset($_POST['deleteteam']))  
{
$id = $_POST['id'];

$sql7 = "UPDATE team set is_deleted='Not Available' where id=$id ";
$result7 =$con->query($sql7);
if($result7 > 0){

    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Good .",
                    text: "User deleted",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../team-deleted.php \">";






} else {
    echo  '


    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "error",
                        title: "Error .",
                        text: "Error",
                      })
                    });
                  </script>
    ';
    
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=../team-deleted.php \">";

}}




// update deleted user
if(isset($_POST['updatedeluser']))  
{
$id = $_POST['id'];

$sql8 = "UPDATE team set is_deleted='Available' where id=$id ";
$result8 =$con->query($sql8);
if($result8 > 0){
    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Good .",
                    text: "User Updated",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../team-deleted.php \">";






} else {
    echo  '


    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "error",
                        title: "Error .",
                        text: "Error",
                      })
                    });
                  </script>
    ';
    
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=../team-deleted.php \">";

}}

// update image medicine
if(isset($_POST['updateimagemedicine']))  
{
  $id= $_POST['id'];
  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];
  
  
      $fileExt = explode( '.', $fileName);
       $fileActualExt = strtolower(end($fileExt));
  
  
  $allowed = array('png', 'jpg', 'jpeg');
  
  //Tu fais les vérifications nécéssaires
  if(in_array($fileActualExt, $allowed))
  //Si l'extension n'est pas dans le tableau
  {
  if ($fileError === 0) {
   
   if ($fileSize < 5000000) {
  
  
     $fileNameNew = uniqid('', true).".".$fileActualExt;
     $fileDestination = '../image/'.$fileNameNew;
     move_uploaded_file($fileTmpName , $fileDestination);
  
  
  
        
         $fileDestination1 = 'image/'.$fileNameNew;
  
  
        $sql1 = "UPDATE medicines set image='$fileDestination1' where id=$id ";
        $result1 =$con->query($sql1);
  
      echo  '
  
  
  <script src="../assets/libs/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
         <script type="text/javascript">   
  
                  $(document).ready(function(){
  
                   
                    
                    swal({
                      icon: "success",
                      title: "Bien .",
                      text: "Image Updated",
                    })
                  });
                </script>
  ';
  
      echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-list.php \">";
  
   } else {
   
    echo  '
  
  
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "erreur",
                        title: "Ouups ..",
                        text: "Grande Taille Image",
                      })
                    });
                  </script>
    ';
    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-list.php \">";
  
   }
  } else {
  
  
    echo  '
  
  
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "erreur",
                        title: "Ouups ..",
                        text: "Erreur de l upload Image",
                      })
                    });
                  </script>
    ';
    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-list.php \">";
  }
  
  } else {
  
  
    echo  '
  
  
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "error",
                        title: "Ouups ..",
                        text: "Vous ne pouvez pas uploader ce type",
                      })
                    });
                  </script>
    ';
    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../medicine-list.php \">";
  }
}

// update validation admin
if(isset($_POST['updatevalidationadmin']))  
{
$id = $_POST['id'];
$email = $_POST['email'];
$type = $_POST['type'];

$sql10 = "UPDATE medicines_order set valid='$type' where id=$id ";
$result10 =$con->query($sql10);
if($result10 > 0){
    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Good .",
                    text: "Validation Updated",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../orders_details.php?id=$email \">";






} else {
    echo  '


    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "error",
                        title: "Error .",
                        text: "Error",
                      })
                    });
                  </script>
    ';
    
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=../orders_details.php?id=$email \">";

}}
// update delivery admin
if(isset($_POST['updatedela']))  
{
$id = $_POST['id'];
$email = $_POST['email'];

$sql10 = "UPDATE medicines_order set delivery='Delivery Done' where id=$id  ";
$result10 =$con->query($sql10);
if($result10 > 0){
    echo  '


<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">   

                $(document).ready(function(){

                 
                  
                  swal({
                    icon: "success",
                    title: "Good .",
                    text: "Delivery Updated",
                  })
                });
              </script>
';

    echo "<meta http-equiv=\"refresh\" content=\"1;URL=../orders_details.php?id=$email \">";






} else {
    echo  '


    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
           <script type="text/javascript">   
    
                    $(document).ready(function(){
    
                     
                      
                      swal({
                        icon: "error",
                        title: "Error .",
                        text: "Error",
                      })
                    });
                  </script>
    ';
    
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=../orders_details.php?id=$email \">";

}}