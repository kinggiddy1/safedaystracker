<?php

	
	function redirect($userEmail,$password,$type){
		global $process;
		$page         = "";
		$loginPage    = "login";
		$adminDashboard ="dashboard.php";
		$chief ="chief-editor-dashboard.php";
		if ($userEmail == '' || $userEmail == null) {
			$page = $loginPage;
		}else{

			if($password == 'true'){

				switch($type){

					case "Chief Editor":

					if($process->check("SELECT * FROM `users` WHERE `users`.`email` = ?",["$userEmail"]) == true){
						$page = $chief;
						
					}
					break;

					case "Admin":
						

					if($process->check("SELECT * FROM `users` WHERE `users`.`email` = ?",["$userEmail"]) == true){
						$page = $adminDashboard;
						
					}
					break;
					case "Editor":

						if($process->check("SELECT * FROM `users` WHERE `users`.`email` = ?",["$userEmail"]) == true){
							$page = $editor;

						}
						break;
					default:

					$page = $loginPage;
					break;

				}
				
			}else{
	
				$page =$loginPage;
			}
		}
		
		header('Location: '. $page);
	}