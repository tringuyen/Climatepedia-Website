				<?php
					include ("inc.admin-user.connect.php");
					
					$query = ("SELECT article_name, article_url, article_draft FROM pedia_articles WHERE article_draft = '0' ORDER BY article_name ASC");
					$result=$db->query($query);
					
					$total_articles = $result->num_rows;					
					
					if($total_articles <= 10) {
					$total_lists = 1;
					}
					
					elseif($total_articles > 10 && $total_articles < 20) {
					$total_lists = 2;
					}
					
					elseif($total_articles > 20 && $total_articles < 30) {
					$total_lists = 3;
					}
					
					elseif($total_articles > 30 && $total_articles < 40) {
					$total_lists = 4;
					}
					
					elseif($total_articles > 40) {
					$total_lists = 5;
					$lists_continued = true;
					}
					
					// One column
					
					if($total_lists == 1) {		
					
						$i = 1;			
					
						echo ("<ol id=article_list23>");
					
						while($row=$result->fetch_array()) {

							echo ("<li><a href=" . $row['article_url'] . ">" . $i . ". " . $row['article_name'] . "</a></li>");
							$i++;
						}
				
					}
				
					// Two columns				
				
					elseif($total_lists == 2) {		
					
						$first_list = 10;
						$second_list = $total_articles - 10;
					
					
						$article_i = 1;			
						$i = 1;

						
						$article_name = $article_url = array();
						
						while($row=$result->fetch_assoc()) {

							$article_name[$article_i] = $row['article_name'];
							$article_url[$article_i] = $row['article_url'];
							$article_i++;
						}
						
						
						echo ("<ol id=article_list1>");
						
						$i = 1;
						while($i <= $first_list) {
							echo ("<li><a href=" . $article_url[$i] . ">" . $i . ". " . $article_name[$i] . "</a></li>");
							$i++;
						}

						echo ("</ol><ol id=article_list2>");
						
						
						$i = 1;
						$k = 11;
						while($i <= $second_list) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}
						

						
						echo ("</ol>");	
				
					}
					
					// Three columns
				
					elseif($total_lists == 3) {		
					
						$first_list = 10;
						$second_list = 10;
						$third_list = $total_articles - 20;

					
					
						$article_i = 1;			
						$i = 1;

						
						$article_name = $article_url = array();
						
						while($row=$result->fetch_assoc()) {

							$article_name[$article_i] = $row['article_name'];
							$article_url[$article_i] = $row['article_url'];
							$article_i++;
						}
						
						
						echo ("<ol id=article_list1>");
						
						$i = 1;
						while($i <= $first_list) {
							echo ("<li><a href=" . $article_url[$i] . ">" . $i . ". " . $article_name[$i] . "</a></li>");
							$i++;
						}

						echo ("</ol><ol id=article_list2>");
						
						$i = 1;
						$k = 11;
						while($i <= $second_list) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}
						
						
						echo ("</ol><ol id=article_list3>");
						
						$i = 1;
						$k = 21;
						while($i <= $third_list) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}

						
						echo ("</ol>");	
				
					}
				
				
					// Four columns
				
					elseif($total_lists == 4) {		
					
						$first_list = 10;
						$second_list = 10;
						$third_list = 10;
						$fourth_list = $total_articles - 30;
					
					
						$article_i = 1;			
						$i = 1;

						
						$article_name = $article_url = array();
						
						while($row=$result->fetch_assoc()) {

							$article_name[$article_i] = $row['article_name'];
							$article_url[$article_i] = $row['article_url'];
							$article_i++;
						}
						
						
						echo ("<ol id=article_list1>");
						
						$i = 1;
						while($i <= $first_list) {
							echo ("<li><a href=" . $article_url[$i] . ">" . $i . ". " . $article_name[$i] . "</a></li>");
							$i++;
						}

						echo ("</ol><ol id=article_list2>");
						
						$i = 1;
						$k = 11;
						while($i <= $second_list) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}
						
						
						echo ("</ol><ol id=article_list3>");
						
						$i = 1;
						$k = 21;
						while($i <= $third_list) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}
						
						echo ("</ol><ol id=article_list4>");
						
						$i = 1;
						$k = 31;
						while($i <= $fourth_list) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}

						
						echo ("</ol>");	
				
					}	
				
				// Five columns
				
					elseif($total_lists == 5) {		
					
						$first_list = 10;
						$second_list = 10;
						$third_list = 10;
						$fourth_list = 10;
						$fifth_list = $total_articles - 40;	
						
						$article_i = 1;			
						$i = 1;

						
						$article_name = $article_url = array();
						
						while($row=$result->fetch_assoc()) {

							$article_name[$article_i] = $row['article_name'];
							$article_url[$article_i] = $row['article_url'];
							$article_i++;
						}
						
						
						echo ("<ol id=article_list1>");
						
						$i = 1;
						while($i <= $first_list) {
							echo ("<li><a href=" . $article_url[$i] . ">" . $i . ". " . $article_name[$i] . "</a></li>");
							$i++;
						}

						echo ("</ol><ol id=article_list2>");
						
						$i = 1;
						$k = 11;
						while($i <= $second_list) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}
						
						
						echo ("</ol><ol id=article_list3>");
						
						$i = 1;
						$k = 21;
						while($i <= $third_list) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}
						
						echo ("</ol><ol id=article_list4>");
						
						$i = 1;
						$k = 31;
						while($i <= $fourth_list) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}

						echo ("</ol><ol id=article_list5>");
						
						$i = 1;
						$k = 41;
						while($i <= $fourth_list && $k < 50) {
							echo ("<li><a href=" . $article_url[$k] . ">" . $k . ". " . $article_name[$k] . "</a></li>");
							$i++;
							$k++;
						}
						
						echo ("<li><a href=# id=article_list_more><strong>View More &rarr;</strong></a></li></ol>");	
				
					}	
				
				
				?>