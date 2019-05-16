<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
  <body>
    <form method="POST" >
      <!--<input type="submit" value="showdetails" name="showdetails" onclick=window.open("showdetails.php")> -->
      <ul>
      <li><input class="header1" type="submit" value="contactus" name="insert" ></li>
      <li><input class="header2" type="submit" value="view enterd details" name="show" ></li>
    </ul>
    </form>
<?php
      $a=1;
      if(isset($_POST['submit']) || isset($_POST['insert']))
      {
        if(isset($_POST['submit']))
          { $a=1;
             $name=$_POST['name'];
              $email=$_POST['email'];
              $subject=$_POST['subject'];
              $mess=$_POST['mess'];
              $query=$_POST['query'];

               if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                  $errore = "Invalid email ";
                }
               else if(empty($name))
             	  {
             		   $errorn="enter your name";
             	  }
               else if (empty($subject))
               {
                 $errors="please enter subject";

               }
               else if (empty($mess))
               {
                 $errorm="enter message ";
               }
               else if(empty($query))
               {
                 $errorq="enter query";
               }
               else {



                $conn=new PDO("mysql:host=localhost;dbname=task","root","");

                $conn->query("insert into contactus values ('$email','$name','$subject','$mess','$query')");

                echo "<h3> Your message has been submitted succesfully</h3>";
              }
              }
            }


            if(isset($_POST['show']))
            { $a=0;
              $conn=new PDO("mysql:host=localhost;dbname=task","root","");
              //insert query
              //$conn->query("insert into contactus values ('$email','$name','$subject','$mess','$query')");
              $ft=$conn->query("select * from contactus");
              $ft->setFetchMode(PDO::FETCH_ASSOC);

             ?>
             <table border=1 align="center">
               <tr>
                 <th> email id  </th>
                  <th>  name </th>
                    <th> subject  </th>
                      <th>  mess </th>
                        <th> query  </th>
                      </tr>
             <?php
              while($row=$ft->fetch()){
                ?>

          <tr>
              <td> <?php  echo $row['email']; ?> </td>

             <td> <?php  echo $row['name']; ?> </td>

             <td><?php   echo $row['subject']; ?> </td>

              <td><?php   echo $row['mess']; ?> </td>

             <td><?php    echo $row['query'];?> </td>
         </tr>
            <?php
              }

              }

              ?>
</table>

              <?php if($a!=0) {  ?>

              <form method="POST">
                <p style="color:green"> email </p>
                <p style="color:red" > <?php
              	if(isset($errore)){
              	echo "$errore"; }?> </p>
                  <input type="text" placeholder="enter yout mail id " name="email"  value="<?php if(isset($_POST["submit"])) { echo "$email"; }?>" >
                  <p style="color:green"> name </p>
                  <p style="color:red" > <?php
                  if(isset($errorn)){
                  echo "$errorn"; }?> </p>
                  <input type="text" placeholder="Enter Name" name="name"  value="<?php if(isset($_POST["submit"])) { echo "$name"; }?>" >
                  <p style="color:green"> Subject </p>
                  <p style="color:red" > <?php
                  if(isset($errors)){
                  echo "$errors"; }?> </p>
                  <input type="text" placeholder="Enter subject for query" name="subject"  value="<?php if(isset($_POST["submit"])) { echo "$subject"; }?>" >
                  <p style="color:green"> message </p>
                  <p style="color:red" > <?php
                	if(isset($errorm)){
                	echo "$errorm"; }?> </p>
                  <input type="text" placeholder="Enter your mess. here" name="mess"  value="<?php if(isset($_POST["submit"])) { echo "$mess"; }?>" >
                  <p style="color:green"> enter your query </p>
                  <p style="color:red" > <?php
                  if(isset($errorq)){
                  echo "$errorq"; }?> </p>
                  <input type="text" placeholder="enter query " name="query"  value="<?php if(isset($_POST["submit"])) { echo "$query"; }?>" >
                  <input type="submit" class="submi" value="submit" name="submit" >

              </form>
        <?php
        }

        ?>



    </body>
    </html>
