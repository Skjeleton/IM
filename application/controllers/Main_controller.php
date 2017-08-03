<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Main_controller extends CI_Controller{
        protected function getUserId(){
            return 1;
        }
        
        function __construct(){
            parent::__construct();
        }
    }