
<?php 
    // #1 if i create  FUNCTION IN db.php file and invoke it here there is no problem cause #1
    include(ROOT_PATH . "/app/database/db.php"); //#1
    include(ROOT_PATH . "/app/helpers/middleware.php");
    include(ROOT_PATH . "/app/helpers/validateUser.php"); // #2

    $table = 'users';
    $admin_users = selectAll($table);
        //the episode no 13    
    $errors = array();

    //set empety to check user entry || related with UX  
    $id = '';
    $username = '';
    $admin = '';
    $email = '';
    $password = '';
    $passwordConf = '';

    function loginUser($user) 
    {
        $_SESSION['id'] = $user['id'];    
        $_SESSION['username'] = $user['username'];    
        $_SESSION['admin'] = $user['admin'];    
        $_SESSION['message'] = 'you are now logged in';    
        $_SESSION['type'] = 'success'; 
            
        if ($_SESSION['admin']) {
            header('location: ' . BASE_URL .'/admin/dashboard.php');
        } else {
            header('location: ' . BASE_URL .'/index.php');
        }   
        exit();    
        
    }
    // isset() mean if i click btn that have form method post
    if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
        
        $errors = validateUser($_POST); // #2
        // ..
        /*
          if no errors create row and return user_id 
          then go to select this row with selectOne 
          function and put it in user array 
        */
        if(count($errors) === 0) {
        unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if(isset($_POST['admin'])) {
                $_POST['admin'] = 1;
                $user_id = create($table, $_POST); //_post restores data
                $_SESSION['message'] = 'Admin user created successfully';
                $_SESSION['type'] = 'success';
                header('location: ' . BASE_URL . '/admin/users/index.php'); //redirect user  to index php
                exit();   
            } else {
                $_POST['admin'] = 0;
                $user_id = create($table, $_POST); //_post restores data
                $user = selectOne($table, ['id' => $user_id]);// remember selectOne fn is show selected row only

                loginUser($user);
            }
            
        } 
        // if there are errors => this for user experience
        // the data that he had enterd is saved
        else{
            $username = $_POST['username'];
            $admin = isset($_POST['admin']) ? 1 : 0;
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordConf = $_POST['passwordConf'];
        }
        
    }


    
    if(isset($_POST['update-user'])) {
        adminOnly();
        $errors = validateUser($_POST);
        if(count($errors) === 0) {
            $id = $_POST['id'];
            unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id']);
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
                $user_id = update($table, $id, $_POST);
                $_SESSION['message'] = 'Admin user created successfully';
                $_SESSION['type'] = 'success';
                header('location: ' . BASE_URL . '/admin/users/index.php');
                exit();   
         
    }  else{
            $username = $_POST['username'];
            $admin = isset($_POST['admin']) ? 1 : 0;
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordConf = $_POST['passwordConf'];
        }
        
}



if(isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    //dd($user);
    $id = $user['id'];
    $username = $user['username'];
    $admin = $user['admin'];
    $email = $user['email'];
}






if (isset($_POST['login-btn'])) {
        $errors = validateLogin($_POST); 
        
    if(count($errors) === 0) {
        $user = selectOne($table, ['username' => $_POST['username']]);
            
        if($user && password_verify($_POST['password'], $user['password'])) {
            
        loginUser($user);

        
        } else {
            array_push($errors, 'wrong credentials');
        }  
            
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];
}


if (isset($_GET['delete_id'])) {
        adminOnly();
        $count = delete($table, $_GET['delete_id']);
        $_SESSION['message'] = 'Admin user deleted successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/users/index.php'); //redirect user  to index php
        exit();   
}



/*this file for users login, log out and register*/
?>
