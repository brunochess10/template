/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	config.language = 'pt-br';
	config.uiColor = '#359ecd';
	var end="";
	var endereco_path = window.location.pathname.split("/");

	for (var i=1; i<endereco_path.length-1;i++){
		end+=endereco_path[i]+"/";
	}
	
	var endereco = "http://"+window.location.host+"/"+end+"ckeditor/ckupload.php";
	
	config.filebrowserUploadUrl = endereco;
};