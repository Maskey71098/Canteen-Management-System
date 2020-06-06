<?php
					$mysqli->close();
					$host='localhost';
					$user='root';
					$password='';
					$conn = new mysqli($host, $user, $password)or die($conn->error);
					$sql="CREATE DATABASE $canteen$id_for_database"; //findsomething here
					if($conn->query($sql)){
						$sql="CREATE USER 'admin$canteen$id_for_database'@'LOCALHOST'";
						if($conn->query($sql)){
							$sql="GRANT ALL PRIVILEGES ON $canteen$id_for_database.* TO 'admin$canteen$id_for_database'@'LOCALHOST'";
							if($conn->query($sql)){
								$sql="CREATE TABLE `$canteen$id_for_database`.`users`(userid INT NOT NULL AUTO_INCREMENT,first_name varchar(50),last_name varchar(50),email varchar(100),phonenumber bigint(15),password varchar(100),faculty varchar(20),hash varchar(100),balance bigint,balancespent bigint,active boolean,primary key (userid));";
								if($conn->query($sql)){
									$sql="CREATE TABLE `$canteen$id_for_database`.`items`(item_id INT NOT NULL AUTO_INCREMENT,itemname varchar(50),price int(15),available boolean,primary key (item_id));";	
									if($conn->query($sql)){
										$sql="CREATE TABLE `$canteen$id_for_database`.`orderdetails`(odid INT NOT NULL AUTO_INCREMENT,orderid INT(15),item_name varchar(50),quantity int(15),price int(15),primary key (odid));";
										if($conn->query($sql)){
											$sql="CREATE TABLE `$canteen$id_for_database`.`orders`(orderid INT NOT NULL AUTO_INCREMENT,userid int,date_of_purchase date,totalmoney bigint,completed int(1),time_id int(1),primary key (orderid));";
											if($conn->query($sql)){
												$sql="CREATE TABLE `$canteen$id_for_database`.`times_col`(time_id INT NOT NULL AUTO_INCREMENT,time_of_order varchar(100),primary key (time_id));";
												$result=$conn->query($sql);
												for($x = 8;$x<=11;$x++){
													$time="$x"."am";
													echo $time;
													$sql="INSERT into `$canteen$id_for_database`.`times_col`(time_of_order)"."VALUES('$time')";
			
													if($conn->query($sql)){
														$suc = true;
													}else{
														$suc = false;?>
														<script>
														alert("here");
														</script>
													<?php
														}
													
												}
												$sql="INSERT into `$canteen$id_for_database`.`times_col`(time_of_order)"."VALUES('12pm')";
												$result=$conn->query($sql);
												for($x = 1;$x<=5;$x++){
													$time="$x"."pm";
													$sql="INSERT into `$canteen$id_for_database`.`times_col`(time_of_order)"."VALUES('$time')";
													if($conn->query($sql)){
														$sucs = true;
													}else{
														$sucs = false;?>
														<script>
														alert("there");
														</script>
													<?php
													}
												}				
														if($suc == true && $sucs == true){
																$_SESSION['lain']="YES";
																$datbase=$canteen.$id_for_database;
																$_SESSION['datbasesession']=$datbase;
																header('location: http://'.$_SERVER['HTTP_HOST'].'/minortest/login.php');
														}else{
															echo <<<EOT
																<script>
																alert("Error");
																</script>
																EOT;
														}
										}else{
											echo <<<EOT
											<script>
											alert("$conn->error();");
											</script>
											EOT;
										}
										}else{
											echo <<<EOT
											<script>
											alert("$conn->error();");
											</script>
											EOT;
										}
									}
									else{
										echo <<<EOT
										<script>
										alert("$conn->error();");
										</script>
										EOT;
									}
									}
									else{
										echo <<<EOT
										<script>
										alert("$conn->error();");
										</script>
										EOT;
							}}
						 	else{
						 		echo <<<EOT
								<script>
								alert("$conn->error();");
								</script>
								EOT;
							}
						}	
						else{
							echo <<<EOT
							<script>
							alert("$conn->error();");
							</script>
							EOT;
						}
					}
					else{
						echo <<<EOT
						<script>
							alert("$conn->error();");
						</script>
					EOT;
					}
?>