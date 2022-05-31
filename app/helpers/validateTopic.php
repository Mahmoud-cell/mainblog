<?php
    function validateTopic($topic){
        
        $errors = array();
        
        if(empty($topic['name'])) {
            array_push($errors, 'name is required');
        }
        
        
        // define var has value of table called useres where email attribue that the the //user provided  || => mean select
        
        //the episode no 13
//        $existingTopic = selectOne('topics', ['name' => $topic['name']]);
//        if($existingTopic) {
//           array_push($errors, 'name already exist');
//        }
        
        $existingTopic = selectOne('topics', ['name' => $post['name']]);
        if($existingTopic) {
            if(isset($post['update-topic']) && $existingTopic['id'] != $post['id']) {
                
           array_push($errors, 'name already exist');

            }
            
            if(isset($post['add-topic']) ){
                
           array_push($errors, 'name already exist');
                
            }
            
        }
        
        return $errors;
    }

