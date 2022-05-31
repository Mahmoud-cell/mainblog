<?php
    function validateUser($user){
        
        $errors = array();
        
        if(empty($user['username'])) {
            array_push($errors, 'username is required');
        }
        
        if(empty($user['email'])) {
            array_push($errors, 'email is required');
        }
        
        if(empty($user['password'])) {
            array_push($errors, 'password is required');
        }
        
        if($user['passwordConf'] != $user['password']) {
            array_push($errors, 'password do not match');
        }
        
        // define var has value of table called useres where email attribue that the the //user provided  || => mean select
        
        //the episode no 13
//        $existingUser = selectOne('users', ['email' => $user['email']]);
//        if($existingUser) {
//           array_push($errors, 'email already exist');
//        }

        
        $existingUser = selectOne('users', ['email' => $user['email']]);
        if($existingUser) {
            if(isset($user['update-user']) && $existingUser['id'] != $user['id']) {
                
           array_push($errors, 'Email already exist');

            }
            
            if(isset($user['create-admin']) ){
                
           array_push($errors, 'Email already exist');
                
            }
            
        }
        
        return $errors;
    }


    function validateLogin($user){
        
        $errors = array();
        
        if(empty($user['username'])) {
            array_push($errors, 'username is required');
        }
        
        if(empty($user['password'])) {
            array_push($errors, 'password is required');
        }
                
        return $errors;
    }
