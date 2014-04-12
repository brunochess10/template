<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Localizacao extends MY_Controller{
		function index(){
				################################################################################
				#  Seta o ID do SEO da Página
				################################################################################
				$this->seo_pagina(-1);
				################################################################################
				#  Seta o ID do SEO da Página
				################################################################################
		
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
           $this->conteudo["localizacao_do_google"] = "
                <script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=false\"></script>
                    <script type=\"text/javascript\">
                    var geocoder;
                    var map;
                    var marker ;
                    var infowindow = null;

                    var escritorio = [
                    ['" . $this->conteudo["logradouro"] . ", " . $this->conteudo["numero"] . " - " . $this->conteudo["cidade"] . " - " . $this->conteudo["estado"] . "'],
                    ];
                    var info =[
                    ['<img src=\"" . $this->conteudo["link_logo"] . "\" style=\"float:left;\">" . $this->conteudo["titulo_site"] . "'],
                    ];
  
                    function initialize() {
                        geocoder = new google.maps.Geocoder();
                        var myOptions = {
                            zoom: 16,
                            //center: latlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        }
                    map = new google.maps.Map(document.getElementById(\"map_canvas\"), myOptions);
                    //marca_escritorioes();
                    for (var i=0;i<escritorio.length;i++){
                        addMarker(map, escritorio[i].toString(), info[i].toString());
                    }
                 }
                function addMarker(map, address, title) {
                geocoder = new google.maps.Geocoder();
                geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            //icon: image,
                            title:title
                        });
                            google.maps.event.addListener(marker, 'click', function() {
                    if (infowindow){
                            infowindow.close();
                    }
                    infowindow = new google.maps.InfoWindow();
                        infowindow.setContent('<strong>'+title + '</strong><br />' + address);
                        infowindow.open(map, marker);
                    });
                    } else {
                        alert(\"Geocode was not successful for the following reason: \" + status);
                    }
              });
	}
        
        $(document).ready(function(){
            initialize();
        })
        </script>
        ";
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_localizacao_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
                
        }

?>