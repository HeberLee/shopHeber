<?php
	function mesAlert($text,$url){
		echo "<script>alert('{$text}');</script>";
		echo "<script>window.location='{$url}';</script>";
	}